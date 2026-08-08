<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\ModelMemtrans;
use App\Models\ModelUmumVisit;
use CodeIgniter\HTTP\ResponseInterface;

class ReportTrans extends BaseController
{
    protected $modelmemtrans, $modelcabang, $modelvisitnonmem;

    public function __construct()
    {
        $this->modelmemtrans = new ModelMemtrans();
        $this->modelcabang = new Model_cabang();
        $this->modelvisitnonmem = new ModelUmumVisit();
    }

    public function transaksi_membership()
    {
        $data = [
            'title' => 'Laporan Transaksi Membership',
            'cab_def' => $this->user_cabang,
            'branches' => $this->modelcabang->get_cabang('%')
        ];

        return view('modules/report/report_membership', $data);
    }

    public function fetch_transactions()
    {
        $branch     = $this->request->getVar('branch_location');
        $start_date = $this->request->getVar('start_date');
        $end_date   = $this->request->getVar('end_date');

        $transactions = $this->modelmemtrans->get_mem_trans($branch, $start_date, $end_date);

        // Format data to be sent to DataTable
        $data = [];
        $total_amount = 0;
        foreach ($transactions as $transaction) {
            $data[] = [
                $transaction->pkgname,
                $transaction->nmcust,
                $transaction->nmcab,
                date('d/m/Y', strtotime($transaction->payment_date)),
                $transaction->payment_type,
                number_format($transaction->nominal, 2, ',', '.'),
            ];
            $total_amount += $transaction->nominal;
        }

        return $this->response->setJSON([
            'data' => $data,
            'total_amount' => number_format($total_amount, 2, ',', '.')
        ]);
    }

    public function transaksi_umumvisit()
    {
        $data = [
            'title' => 'Laporan Visit Non Member',
            'cab_def' => $this->user_cabang,
            'branches' => $this->modelcabang->get_cabang('%')
        ];

        return view('modules/report/report_umumvisit', $data);
    }

    public function fetch_nonmember_trx()
    {
        $branch     = $this->request->getVar('cabang');
        $start_date = $this->request->getVar('date_satu');
        $end_date   = $this->request->getVar('date_dua');
        // dd($branch, $start_date, $end_date);

        $transactions = $this->modelvisitnonmem->get_umum_trans($branch, $start_date, $end_date);
        // dd($transactions);
        // Format data to be sent to DataTable
        $data = [];
        $total_amount = 0;
        foreach ($transactions as $transaction) {
            $data[] = [
                $transaction->pkgname,
                $transaction->nmcust,
                $transaction->nmcab,
                date('d/m/Y', strtotime($transaction->created_at)),
                $transaction->payment_method,
                number_format($transaction->nominal, 2, ',', '.'),
            ];
            $total_amount += $transaction->nominal;
        }

        return $this->response->setJSON([
            'data' => $data,
            'total_amount' => number_format($total_amount, 2, ',', '.')
        ]);
    }

    public function rekap_harian()
    {
        $data = [
            'title' => 'Rekap Laporan Harian',
            'cab_def' => $this->user_cabang,
            'branches' => $this->modelcabang->get_cabang('%')
        ];

        return view('modules/report/report_rekap_harian', $data);
    }

    public function fetch_rekap_harian()
    {
        $branch     = $this->request->getVar('branch_location');
        $date       = $this->request->getVar('date');
        
        if (!$date) {
            $date = date('Y-m-d');
        }

        $db = \Config\Database::connect();

        // 1. Ambil transaksi Membership untuk tanggal yang dipilih
        $transactions = $this->modelmemtrans->get_mem_trans($branch, $date, $date);

        $all_trx = [];

        foreach ($transactions as $transaction) {
            $prevCount = $db->table('membership_trans')
                            ->where('custid', $transaction->custid)
                            ->where('created_at <', $transaction->created_at)
                            ->where('status', 1)
                            ->countAllResults();
            
            $status = ($prevCount > 0) ? '<span class="badge badge-info">Renew</span>' : '<span class="badge badge-success">Join</span>';

            $all_trx[] = [
                'created_at' => $transaction->created_at ?? $transaction->payment_date,
                'row' => [
                    $transaction->pkgname,
                    $transaction->nmcust,
                    $status,
                    $transaction->nmcab,
                    date('d/m/Y', strtotime($transaction->payment_date)),
                    $transaction->payment_type,
                    number_format($transaction->nominal, 2, ',', '.'),
                ],
                'nominal' => (float)$transaction->nominal
            ];
        }

        // 2. Ambil transaksi Visit Non-Member untuk tanggal yang dipilih
        $nmQuery = $db->table('nonmember_visit nv')
            ->select("nv.idx AS idtx, nv.created_at, nv.nama AS nmcust,
                      CONCAT(mc.catname, ' ', mp.nama) AS pkgname,
                      nv.nominal, nv.payment_method AS payment_type, c.nama AS nmcab")
            ->join('membership mp', 'mp.id = nv.paket_id', 'left')
            ->join('membership_cat mc', 'mc.catid = mp.catid', 'left')
            ->join('cabang c', 'c.id = nv.cabang', 'left')
            ->where('DATE(nv.created_at)', $date)
            ->where('nv.deleted_at IS NULL');

        if ($branch && $branch !== '%') {
            $nmQuery->where('nv.cabang', $branch);
        }

        $nm_list = $nmQuery->orderBy('nv.created_at', 'DESC')->get()->getResult();

        foreach ($nm_list as $nm) {
            $status_nm = '<span class="badge badge-warning">Non-Member</span>';
            $all_trx[] = [
                'created_at' => $nm->created_at,
                'row' => [
                    $nm->pkgname ?? 'Non Member',
                    $nm->nmcust,
                    $status_nm,
                    $nm->nmcab,
                    date('d/m/Y', strtotime($nm->created_at)),
                    $nm->payment_type ?? 'Cash',
                    number_format($nm->nominal, 2, ',', '.'),
                ],
                'nominal' => (float)$nm->nominal
            ];
        }

        // Urutkan gabungan transaksi berdasarkan waktu pembuatan terbaru
        usort($all_trx, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $data = [];
        $total_amount = 0;
        foreach ($all_trx as $item) {
            $data[] = $item['row'];
            $total_amount += $item['nominal'];
        }

        return $this->response->setJSON([
            'data' => $data,
            'total_amount' => number_format($total_amount, 2, ',', '.')
        ]);
    }
}
