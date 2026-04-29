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
            'branches' => $this->modelcabang->get_cabang($this->user_cabang)
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
            'branches' => $this->modelcabang->get_cabang($this->user_cabang)
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
            'branches' => $this->modelcabang->get_cabang($this->user_cabang)
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

        // Fetch membership transactions for the specific date
        $transactions = $this->modelmemtrans->get_mem_trans($branch, $date, $date);

        $data = [];
        $total_amount = 0;
        
        foreach ($transactions as $transaction) {
            // Logic to determine Join vs Renew
            // Count previous transactions for this customer that are approved (status 1)
            $db = \Config\Database::connect();
            $prevCount = $db->table('membership_trans')
                            ->where('custid', $transaction->custid)
                            ->where('payment_date <', $transaction->payment_date)
                            ->where('status', 1)
                            ->countAllResults();
            
            $status = ($prevCount > 0) ? '<span class="badge badge-info">Renew</span>' : '<span class="badge badge-success">Join</span>';

            $data[] = [
                $transaction->pkgname,
                $transaction->nmcust,
                $status,
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
}
