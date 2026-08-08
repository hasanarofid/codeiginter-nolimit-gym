<?php

namespace App\Controllers;

use App\Models\Model_cabang;
use App\Models\Model_user;
use App\Models\Model_usergroup;
use App\Models\ModelMemtrans;

class Dashboard extends BaseController
{
    protected $modeluser, $modelusergrp, $modelmemtrans, $modelcabang;

    public function __construct()
    {
        $this->modeluser = new Model_user();
        $this->modelusergrp = new Model_usergroup();
        $this->modelmemtrans = new ModelMemtrans();
        $this->modelcabang = new Model_cabang();
    }

    public function index()
    {
        $getUser  = $this->modeluser->get_login(session()->userid);
        $monthly_earning = $this->modelmemtrans->earnings_this_month($getUser->kdcab)->total;
        $anual_earning = $this->modelmemtrans->earnings_this_year($getUser->kdcab)->total;
        $pending_req = $this->modelmemtrans->get_pending_request($getUser->kdcab)->jml;
        $active_member = $this->modelmemtrans->get_member_active($getUser->kdcab)->jml;

        // Fetch Schedule Data
        $modelKelas = new \App\Models\ModelKelas();
        $modelKlsBoxing = new \App\Models\ModelKlsBoxing();
        
        // Handle % (All Branches) for Super Admin - focus on their primary branch or a default one
        $cabang_id = ($getUser->kdcab == '%') ? 'NL01' : $getUser->kdcab; 

        $data = [
            'title' => 'Dashboard',
            'cabangs' => $this->modelcabang->get_cabang($this->user_cabang),
            'dashboard' => session()->dashboard,
            'schedule_class' => $modelKelas->tabel_kelas($cabang_id),
            'schedule_boxing' => $modelKlsBoxing->tabel_bothai($cabang_id),
        ];

        // data pendapatan yang muncul di dashboard (Membership + NonMember)
        $db = \Config\Database::connect();

        // 1. Daily Earning
        $daily_mem = $this->modelmemtrans->get_daily_earning($getUser->kdcab)->total ?? 0;
        $nmDailyQuery = $db->table('nonmember_visit')->select('SUM(nominal) as total')->where('DATE(created_at) = CURDATE()')->where('deleted_at IS NULL');
        if ($getUser->kdcab !== '%') { $nmDailyQuery->where('cabang', $getUser->kdcab); }
        $daily_nm = $nmDailyQuery->get()->getRow()->total ?? 0;
        $daily_earning_total = $daily_mem + $daily_nm;

        // 2. Monthly Earning
        $monthly_mem = $this->modelmemtrans->earnings_this_month($getUser->kdcab)->total ?? 0;
        $nmMonthlyQuery = $db->table('nonmember_visit')->select('SUM(nominal) as total')->where('MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())')->where('deleted_at IS NULL');
        if ($getUser->kdcab !== '%') { $nmMonthlyQuery->where('cabang', $getUser->kdcab); }
        $monthly_nm = $nmMonthlyQuery->get()->getRow()->total ?? 0;
        $monthly_earning_total = $monthly_mem + $monthly_nm;

        // 3. Annual Earning
        $anual_mem = $this->modelmemtrans->earnings_this_year($getUser->kdcab)->total ?? 0;
        $nmAnnualQuery = $db->table('nonmember_visit')->select('SUM(nominal) as total')->where('YEAR(created_at) = YEAR(CURDATE())')->where('deleted_at IS NULL');
        if ($getUser->kdcab !== '%') { $nmAnnualQuery->where('cabang', $getUser->kdcab); }
        $anual_nm = $nmAnnualQuery->get()->getRow()->total ?? 0;
        $anual_earning_total = $anual_mem + $anual_nm;

        $today_transactions = $this->modelmemtrans->get_mem_trans($getUser->kdcab, date('Y-m-d'), date('Y-m-d'));
        
        $transactions_with_status = [];
        foreach ($today_transactions as $tr) {
            $prevCount = $db->table('membership_trans')
                            ->where('custid', $tr->custid)
                            ->where('created_at <', $tr->created_at)
                            ->where('status', 1)
                            ->countAllResults();
            $tr->is_renew      = ($prevCount > 0);
            $tr->is_nonmember  = false;
            $transactions_with_status[] = $tr;
        }

        // Ambil kunjungan Non-Member hari ini dan gabungkan
        $nmQuery = $db->table('nonmember_visit nv')
            ->select("nv.idx AS idtx, nv.created_at, NULL AS custid, nv.nama AS nmcust,
                      CONCAT(mc.catname, ' ', mp.nama) AS pkgname,
                      nv.created_at AS payment_date, nv.nominal,
                      NULL AS expired_date, 1 AS status, nv.payment_method AS payment_type,
                      c.id AS idcab, c.nama AS nmcab, 0 AS is_renew, 1 AS is_nonmember")
            ->join('membership mp', 'mp.id = nv.paket_id', 'left')
            ->join('membership_cat mc', 'mc.catid = mp.catid', 'left')
            ->join('cabang c', 'c.id = nv.cabang', 'left')
            ->where('DATE(nv.created_at)', date('Y-m-d'))
            ->where('nv.deleted_at IS NULL');

        if ($getUser->kdcab !== '%') {
            $nmQuery->where('nv.cabang', $getUser->kdcab);
        }

        $nm_transactions = $nmQuery->orderBy('nv.created_at', 'DESC')->get()->getResult();
        foreach ($nm_transactions as $nm) {
            $transactions_with_status[] = $nm;
        }

        // Urutkan gabungan berdasarkan waktu terbaru
        usort($transactions_with_status, fn($a, $b) => strtotime($b->created_at) - strtotime($a->created_at));

        // total dari cabang2, lihat detail dari report
        $data['report'] = [
            'daily_earning' => 'Rp.' . number_format($daily_earning_total, 0, ',', '.'),
            'monthly_earning' => 'Rp.' . number_format($monthly_earning_total, 0, ',', '.'),
            'anual_earning' => 'Rp.' . number_format($anual_earning_total, 0, ',', '.'),
            'pending_req' => $pending_req,
            'member_active' => $active_member,
            'customer_visit' => 115,
            'perpanjangan' => $this->modelmemtrans->get_perpanjangan($this->user_cabang),
            'today_transactions' => $transactions_with_status
        ];
        $data['title'] = 'Dashboard';

        return view('dashboard', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'NoLimits | Login',
            'action' => '/login/process',
            'username' => old('username'),
        ];
        return view('login', $data);
    }

    public function process()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $get_ip   = $this->request->getIPAddress();

        $this->validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username' => ['required' => 'Tidak boleh kosong'],
            'password' => ['required' => 'Tidak boleh kosong'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $getUser  = $this->modeluser->get_login($username);
        // dd($getUser);

        if ($getUser) {
            if ($getUser->Ket == 'disabled') {
                $pesan = '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Akun Anda tidak aktif
                            </div>';
                session()->setFlashdata('pesan', $pesan);
                return redirect()->to('/login');
            } else {
                if (password_verify($password, $getUser->Password)) {

                    $usergrp =  $this->modelusergrp->get_group($getUser->UserGroup);
                    $data = [
                        'userid' => $getUser->UserID,
                        'nama' => $getUser->Nama,
                        'group' => $getUser->UserGroup,
                        'crud' => $usergrp->crud,
                        'dashboard' => $usergrp->dashboard_path,
                        'cabang' => $getUser->kdcab,
                        'logged_in' => true
                    ];

                    session()->set($data);

                    return redirect()->to(base_url('dashboard'));
                } else {
                    $pesan = '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                Password Salah
                            </div>';
                    session()->setFlashdata('pesan', $pesan);
                    return redirect()->to('/login');
                }
            }
        } else {
            $pesan = '<div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        Pengguna tidak ditemukan
                    </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
