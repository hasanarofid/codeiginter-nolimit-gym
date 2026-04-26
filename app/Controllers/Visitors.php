<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\Model_customer;
use App\Models\ModelMembership;
use App\Models\ModelMemtrans;
use App\Models\ModelUmumVisit;
use App\Models\ModelVisitor;
use CodeIgniter\HTTP\ResponseInterface;

class Visitors extends BaseController
{
    protected $modelumum, $modelcustomer, $modelvisitor;
    protected $modelmemtrans, $modelmembership, $modelcabang;

    public function __construct()
    {
        $this->modelumum = new ModelUmumVisit();
        $this->modelcustomer = new Model_customer();
        $this->modelvisitor = new ModelVisitor();
        $this->modelmemtrans = new ModelMemtrans();
        $this->modelmembership = new ModelMembership();
        $this->modelcabang = new Model_cabang();
    }

    public function index()
    {
        $data = [
            'title' => 'Histori Pengunjung',
            'action' => base_url('visitors/store'),
            'idmember' => old('idmember'),
            'locker' => old('locker'),
            'handuk' => old('handuk'),
            'members' => $this->modelcustomer->get_by_cabang($this->user_cabang),
            'visitors' => $this->modelvisitor->get_visitor(null, $this->user_cabang),
        ];

        return view('modules/visitor/visitor_form', $data);
    }

    public function store()
    {
        $this->validation->setRules([
            'idmember' => 'required|max_length[10]',
            'locker' => 'required',
            'handuk' => 'required',
        ], [
            'idmember' => ['required' => 'Id Member harus di isi', 'max_length' => 'Id Member tidak valid'],
            'locker' => ['required' => 'No. Locker harus di isi'],
            'handuk' => ['required' => 'Handuk harus di pilih'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $idmember = $this->request->getVar('idmember');
        $customer = $this->modelcustomer->get_customer($idmember);

        if (!$customer) {
            session()->setFlashdata('pesan', '<div class="alert alert-danger">Member tidak ditemukan</div>');
            return redirect()->back()->withInput();
        }

        // Check Membership Expiry
        $exp = $this->modelmemtrans->get_expired($idmember);
        $is_expired = true;
        $expired_date = ($exp) ? date('Y-m-d', strtotime($exp->expired_date)) : null;
        $today = date('Y-m-d');
        if ($expired_date && $expired_date >= $today) {
            $is_expired = false;
        }

        if ($is_expired) {
            $pesan = '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Gagal!</strong> Keanggotaan sudah kadaluarsa atau tidak aktif. Silakan perpanjang terlebih dahulu.
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/visitors/member')->withInput();
        }

        $locker = $this->request->getVar('locker');
        $handuk = $this->request->getVar('handuk');
        $user = $this->userId;

        // Check Cross-Branch Access (7 Days Rule)
        if ($customer['kdcab'] != $this->user_cabang) {
            $first_visit = $this->modelvisitor->getFirstVisit($idmember, $this->user_cabang);
            if ($first_visit) {
                $first_date = new \DateTime($first_visit['created_at']);
                $today_dt = new \DateTime(date('Y-m-d'));
                $interval = $first_date->diff($today_dt);
                $days = $interval->days;

                if ($days >= 7) {
                    $pesan = '<div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Akses Ditolak!</strong> Jatah akses 7 hari Anda di cabang ini sudah habis (Mulai sejak: ' . date('d M Y', strtotime($first_visit['created_at'])) . ').
                        </div>';
                    session()->setFlashdata('pesan', $pesan);
                    return redirect()->to('/visitors/member')->withInput();
                }
            }
        }

        $data = [
            'idmember' => $idmember,
            'cabang' => $this->user_cabang, // Use current branch instead of member home branch
            'locker' => $locker,
            'handuk' => $handuk,
            'user' => $user,
        ];

        $save = $this->modelvisitor->insert($data);

        if ($save) {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data kunjungan tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/visitors/member');
        } else {
            $pesan = '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Terjadi kesalahan saat menyimpan data
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/visitors/member');
        }
    }

    public function update()
    {
        $idx = $this->request->getVar('idx');
        $handuk = $this->request->getVar('hndk');
        $user = $this->userId;

        $data = [
            'handuk' => $handuk,
            'user' => $user,
        ];

        $update = $this->modelvisitor->update($idx, $data);

        if ($update) {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data kunjungan tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/visitors/member');
        }
    }

    public function nonmember()
    {
        $kotacab = $this->modelcabang->get_kota($this->user_cabang);

        $prices = [];
        foreach ($kotacab as $city) {
            $harga = $this->modelmembership->pkgPervisit($city->kota);

            foreach ($harga as $row) {
                array_push($prices, [
                    'id' => $row['id'],
                    'nominal' => $row['nominal'],
                    'description' => $row['paket']
                ]);
            }
        }

        $json = json_decode(json_encode($prices), true);

        // dd($json);
        $data = [
            'title' => 'Histori Pengunjung Non Member',
            'action' => base_url('visitors/nonmember/store'),
            'nama' => old('nama'),
            'locker' => old('locker'),
            'handuk' => old('handuk'),
            'prices' => $json,
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
            'user_cabang' => $this->user_cabang,
            'visitors' => $this->modelumum->get_visitor($this->user_cabang),
        ];

        return view('modules/visitor/visitor_nonmember_form', $data);
    }

    public function nonmember_store()
    {
        $this->validation->setRules([
            'nama' => 'required',
            'locker' => 'required',
            'handuk' => 'required',
            'paket' => 'required',
            'payment' => 'required',
            'cabang' => 'required'
        ], [
            'nama' => ['required' => 'Nama harus di isi'],
            'locker' => ['required' => 'No. Locker harus di isi'],
            'handuk' => ['required' => 'Handuk harus di pilih'],
            'paket' => ['required' => 'Handuk harus di pilih'],
            'payment' => ['required' => 'Handuk harus di pilih'],
            'cabang' => ['required' => 'Handuk harus di pilih'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $idmember = $this->request->getVar('nama');
        $cabang = $this->request->getVar('cabang');
        $locker = $this->request->getVar('locker');
        $handuk = $this->request->getVar('handuk');
        $paket = $this->request->getVar('paket');
        $payment = $this->request->getVar('payment');
        $user = $this->userId;

        $biaya = $this->modelmembership->get_membership($paket);
        $data = [
            'nama' => $idmember,
            'cabang' => $cabang,
            'locker' => $locker,
            'handuk' => $handuk,
            'nominal' => $biaya['nominal'],
            'payment_method' => $payment,
            'paket_id' => $paket,
            'user' => $user,
        ];

        $save = $this->modelumum->insert($data);

        if ($save) {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data kunjungan tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/visitors/nonmember');
        }
    }

    public function nonmember_update()
    {
        $idx = $this->request->getVar('idx');
        $handuk = $this->request->getVar('hndk');
        $user = $this->userId;

        $data = [
            'handuk' => $handuk,
            'user' => $user,
        ];

        $update = $this->modelumum->update($idx, $data);

        if ($update) {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data kunjungan tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/visitors/nonmember');
        }
    }

    public function getMemberData()
    {
        log_message('debug', 'Incoming CSRF Token: ' . $this->request->getHeaderLine('X-CSRF-TOKEN'));
        log_message('debug', 'Session CSRF Token: ' . csrf_hash());

        if ($this->request->isAJAX()) {
            $memberId = $this->request->getPost('member_id');
            $member = $this->modelcustomer->find($memberId);

            $expired = $this->modelmemtrans->get_expired($memberId);

            if ($member) {
                $is_expired = true;
                $expiry_text = 'No Active Membership';
                
                if ($expired) {
                    $expired_date = date('Y-m-d', strtotime($expired->expired_date));
                    $today = date('Y-m-d');
                    $is_expired = ($expired_date < $today);
                    $expiry_text = date('M, d Y', strtotime($expired->expired_date));
                } else {
                    $expired_date = null;
                    $expiry_text = 'N.A';
                }

                // Cross-branch logic for AJAX
                $is_cross_branch = ($member['kdcab'] != $this->user_cabang);
                $cross_branch_msg = "";
                $is_cross_expired = false;

                if ($is_cross_branch) {
                    $first_visit = $this->modelvisitor->getFirstVisit($memberId, $this->user_cabang);
                    if ($first_visit) {
                        $first_date = new \DateTime($first_visit['created_at']);
                        $today_dt = new \DateTime(date('Y-m-d'));
                        $interval = $first_date->diff($today_dt);
                        $days = $interval->days;

                        if ($days >= 7) {
                            $is_cross_expired = true;
                            $cross_branch_msg = "Akses 7 hari di cabang ini sudah HABIS (Mulai: " . date('d M Y', strtotime($first_visit['created_at'])) . ")";
                        } else {
                            $remaining = 7 - $days;
                            $cross_branch_msg = "Member dari cabang lain. Hari ke-" . ($days + 1) . " (Sisa " . $remaining . " hari lagi)";
                        }
                    } else {
                        $cross_branch_msg = "Member dari cabang lain. Ini adalah kunjungan PERTAMA di cabang ini (Akses 7 hari dimulai hari ini).";
                    }
                }

                return $this->response
                    ->setHeader('X-CSRF-TOKEN', csrf_hash())
                    ->setJSON([
                        'status' => 'success',
                        'data' => [
                            'id' => $member['id'],
                            'nama' => $member['nama'],
                            'fp_image' => base_url('img/uploads/member/fp/' . $member['fp_image']),
                            'expiry_date' => $expiry_text,
                            'is_expired' => $is_expired,
                            'is_cross_branch' => $is_cross_branch,
                            'is_cross_expired' => $is_cross_expired,
                            'cross_branch_msg' => $cross_branch_msg
                        ],
                    ]);
            } else {
                return $this->response
                    ->setHeader('X-CSRF-TOKEN', csrf_hash()) // Tambahkan header CSRF
                    ->setJSON([
                        'status' => 'error',
                        'message' => 'Member not found',
                    ]);
            }
        }

        return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }
}
