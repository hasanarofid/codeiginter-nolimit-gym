<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\ModelMemtrans;
use App\Models\ModelUmumVisit;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReportTrans extends BaseController
{
    protected $modelmemtrans, $modelcabang, $modelvisitnonmem;

    public function __construct()
    {
        $this->modelmemtrans = new ModelMemtrans();
        $this->modelcabang = new Model_cabang();
        $this->modelvisitnonmem = new ModelUmumVisit();
    }

    private function normalize_date($dateString, $default = null)
    {
        if (empty($dateString)) {
            return $default ?: date('Y-m-d');
        }
        $clean = str_replace('/', '-', trim($dateString));
        $time = strtotime($clean);
        return $time ? date('Y-m-d', $time) : ($default ?: date('Y-m-d'));
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
        $branch     = $this->request->getVar('branch_location') ?: '%';
        $start_date = $this->request->getVar('start_date');
        $end_date   = $this->request->getVar('end_date');

        if ($start_date) {
            $start_date = $this->normalize_date($start_date);
        }
        if ($end_date) {
            $end_date = $this->normalize_date($end_date);
        }

        $transactions = $this->modelmemtrans->get_mem_trans($branch, $start_date, $end_date);

        $data = [];
        $total_amount = 0;
        foreach ($transactions as $transaction) {
            $tglTrx = !empty($transaction->payment_date) ? $transaction->payment_date : $transaction->created_at;
            $data[] = [
                $transaction->pkgname,
                $transaction->nmcust,
                $transaction->nmcab,
                date('d/m/Y', strtotime($tglTrx)),
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

    public function export_membership()
    {
        $branch     = $this->request->getVar('branch_location') ?: '%';
        $start_date = $this->request->getVar('start_date');
        $end_date   = $this->request->getVar('end_date');

        if ($start_date) {
            $start_date = $this->normalize_date($start_date);
        }
        if ($end_date) {
            $end_date = $this->normalize_date($end_date);
        }

        $transactions = $this->modelmemtrans->get_mem_trans($branch, $start_date, $end_date);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Transaksi Membership');

        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Nama Paket');
        $sheet->setCellValue('C1', 'Nama Member');
        $sheet->setCellValue('D1', 'Cabang');
        $sheet->setCellValue('E1', 'Tgl. Transaksi');
        $sheet->setCellValue('F1', 'Metode');
        $sheet->setCellValue('G1', 'Nominal');

        $row = 2;
        $no = 1;
        $total = 0;

        foreach ($transactions as $trx) {
            $tglTrx = !empty($trx->payment_date) ? $trx->payment_date : $trx->created_at;
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $trx->pkgname);
            $sheet->setCellValue('C' . $row, $trx->nmcust);
            $sheet->setCellValue('D' . $row, $trx->nmcab);
            $sheet->setCellValue('E' . $row, date('d/m/Y', strtotime($tglTrx)));
            $sheet->setCellValue('F' . $row, $trx->payment_type);
            $sheet->setCellValue('G' . $row, $trx->nominal);
            $total += (float)$trx->nominal;
            $row++;
        }

        // Total Row
        $sheet->setCellValue('A' . $row, 'Total');
        $sheet->mergeCells("A{$row}:F{$row}");
        $sheet->setCellValue('G' . $row, $total);

        // Styling
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle("A{$row}:G{$row}")->getFont()->setBold(true);
        $sheet->getStyle('G2:G' . $row)->getNumberFormat()->setFormatCode('#,##0.00');
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Transaksi_Membership_' . date('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
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
        $branch     = $this->request->getVar('cabang') ?: '%';
        $start_date = $this->request->getVar('date_satu');
        $end_date   = $this->request->getVar('date_dua');

        if ($start_date) {
            $start_date = $this->normalize_date($start_date);
        }
        if ($end_date) {
            $end_date = $this->normalize_date($end_date);
        }

        $transactions = $this->modelvisitnonmem->get_umum_trans($branch, $start_date, $end_date);

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

    public function export_nonmember_trx()
    {
        $branch     = $this->request->getVar('cabang') ?: '%';
        $start_date = $this->request->getVar('date_satu');
        $end_date   = $this->request->getVar('date_dua');

        if ($start_date) {
            $start_date = $this->normalize_date($start_date);
        }
        if ($end_date) {
            $end_date = $this->normalize_date($end_date);
        }

        $transactions = $this->modelvisitnonmem->get_umum_trans($branch, $start_date, $end_date);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Visit Non Member');

        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Nama Paket');
        $sheet->setCellValue('C1', 'Nama Pengunjung');
        $sheet->setCellValue('D1', 'Cabang');
        $sheet->setCellValue('E1', 'Tgl. Transaksi');
        $sheet->setCellValue('F1', 'Metode');
        $sheet->setCellValue('G1', 'Nominal');

        $row = 2;
        $no = 1;
        $total = 0;

        foreach ($transactions as $trx) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $trx->pkgname ?: 'Visit Non Member');
            $sheet->setCellValue('C' . $row, $trx->nmcust);
            $sheet->setCellValue('D' . $row, $trx->nmcab);
            $sheet->setCellValue('E' . $row, date('d/m/Y', strtotime($trx->created_at)));
            $sheet->setCellValue('F' . $row, $trx->payment_method);
            $sheet->setCellValue('G' . $row, $trx->nominal);
            $total += (float)$trx->nominal;
            $row++;
        }

        // Total Row
        $sheet->setCellValue('A' . $row, 'Total');
        $sheet->mergeCells("A{$row}:F{$row}");
        $sheet->setCellValue('G' . $row, $total);

        // Styling
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle("A{$row}:G{$row}")->getFont()->setBold(true);
        $sheet->getStyle('G2:G' . $row)->getNumberFormat()->setFormatCode('#,##0.00');
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Visit_NonMember_' . date('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
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

    private function get_rekap_data($branch, $date, $payment_method = '%')
    {
        $date = $this->normalize_date($date);
        $db = \Config\Database::connect();

        // 1. Ambil transaksi Membership untuk tanggal yang dipilih
        $transactions = $this->modelmemtrans->get_mem_trans($branch, $date, $date);

        $all_trx = [];

        foreach ($transactions as $transaction) {
            $currentPayment = $transaction->payment_type ?: 'Cash';
            if ($payment_method !== '%' && !empty($payment_method)) {
                if (strcasecmp($payment_method, 'qris_all') === 0) {
                    if (stripos($currentPayment, 'qris') === false) {
                        continue;
                    }
                } elseif (strcasecmp($currentPayment, $payment_method) !== 0) {
                    continue;
                }
            }

            $prevCount = $db->table('membership_trans')
                            ->where('custid', $transaction->custid)
                            ->where('created_at <', $transaction->created_at)
                            ->where('status', 1)
                            ->countAllResults();
            
            $status_label = ($prevCount > 0) ? 'Renew' : 'Join';
            $status_badge = ($prevCount > 0) ? '<span class="badge badge-info">Renew</span>' : '<span class="badge badge-success">Join</span>';
            $tglTrx = !empty($transaction->payment_date) ? $transaction->payment_date : $transaction->created_at;

            $all_trx[] = [
                'created_at' => $transaction->created_at ?? $transaction->payment_date,
                'pkgname' => $transaction->pkgname,
                'nmcust' => $transaction->nmcust,
                'status_label' => $status_label,
                'status_html' => $status_badge,
                'nmcab' => $transaction->nmcab,
                'tgl_transaksi' => date('d/m/Y', strtotime($tglTrx)),
                'payment_type' => $currentPayment,
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
            $currentPayment = $nm->payment_type ?: 'Cash';
            if ($payment_method !== '%' && !empty($payment_method)) {
                if (strcasecmp($payment_method, 'qris_all') === 0) {
                    if (stripos($currentPayment, 'qris') === false) {
                        continue;
                    }
                } elseif (strcasecmp($currentPayment, $payment_method) !== 0) {
                    continue;
                }
            }

            $all_trx[] = [
                'created_at' => $nm->created_at,
                'pkgname' => $nm->pkgname ?: 'Visit Non Member',
                'nmcust' => $nm->nmcust,
                'status_label' => 'Non-Member',
                'status_html' => '<span class="badge badge-warning">Non-Member</span>',
                'nmcab' => $nm->nmcab,
                'tgl_transaksi' => date('d/m/Y', strtotime($nm->created_at)),
                'payment_type' => $currentPayment,
                'nominal' => (float)$nm->nominal
            ];
        }

        // Urutkan gabungan transaksi berdasarkan waktu pembuatan terbaru
        usort($all_trx, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return $all_trx;
    }

    public function fetch_rekap_harian()
    {
        $branch = $this->request->getVar('branch_location') ?: '%';
        $date   = $this->request->getVar('date');
        $payment_method = $this->request->getVar('payment_method') ?: '%';

        $all_trx = $this->get_rekap_data($branch, $date, $payment_method);

        $data = [];
        $total_amount = 0;
        $total_cash = 0;
        $total_qris = 0;
        $qris_breakdown = [
            'Qris BCA' => 0,
            'Qris BNI' => 0,
            'Qris BRI' => 0,
            'Qris Mandiri' => 0,
            'Qris Lainnya' => 0,
        ];
        $total_transfer = 0;

        $no = 1;
        foreach ($all_trx as $item) {
            $data[] = [
                $no++,
                $item['pkgname'],
                $item['nmcust'],
                $item['status_html'],
                $item['nmcab'],
                $item['tgl_transaksi'],
                $item['payment_type'],
                number_format($item['nominal'], 2, ',', '.')
            ];
            $nom = (float)$item['nominal'];
            $total_amount += $nom;

            $pm = trim($item['payment_type']);
            if (stripos($pm, 'qris') !== false) {
                $total_qris += $nom;
                if (stripos($pm, 'bca') !== false) {
                    $qris_breakdown['Qris BCA'] += $nom;
                } elseif (stripos($pm, 'bni') !== false) {
                    $qris_breakdown['Qris BNI'] += $nom;
                } elseif (stripos($pm, 'bri') !== false) {
                    $qris_breakdown['Qris BRI'] += $nom;
                } elseif (stripos($pm, 'mandiri') !== false) {
                    $qris_breakdown['Qris Mandiri'] += $nom;
                } else {
                    $qris_breakdown['Qris Lainnya'] += $nom;
                }
            } elseif (stripos($pm, 'transfer') !== false) {
                $total_transfer += $nom;
            } else {
                $total_cash += $nom;
            }
        }

        return $this->response->setJSON([
            'data' => $data,
            'total_amount' => number_format($total_amount, 2, ',', '.'),
            'total_cash' => number_format($total_cash, 2, ',', '.'),
            'total_qris' => number_format($total_qris, 2, ',', '.'),
            'total_transfer' => number_format($total_transfer, 2, ',', '.'),
            'qris_breakdown' => [
                'bca' => number_format($qris_breakdown['Qris BCA'], 2, ',', '.'),
                'bni' => number_format($qris_breakdown['Qris BNI'], 2, ',', '.'),
                'bri' => number_format($qris_breakdown['Qris BRI'], 2, ',', '.'),
                'mandiri' => number_format($qris_breakdown['Qris Mandiri'], 2, ',', '.'),
                'lainnya' => number_format($qris_breakdown['Qris Lainnya'], 2, ',', '.'),
            ]
        ]);
    }

    public function export_rekap_harian()
    {
        $branch = $this->request->getVar('branch_location') ?: '%';
        $date   = $this->request->getVar('date');
        $payment_method = $this->request->getVar('payment_method') ?: '%';

        $all_trx = $this->get_rekap_data($branch, $date, $payment_method);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rekap Laporan Harian');

        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Nama Paket');
        $sheet->setCellValue('C1', 'Nama Member');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Cabang');
        $sheet->setCellValue('F1', 'Tgl. Transaksi');
        $sheet->setCellValue('G1', 'Metode');
        $sheet->setCellValue('H1', 'Nominal');

        $row = 2;
        $no = 1;
        $total = 0;
        $total_cash = 0;
        $total_qris = 0;
        $qris_breakdown = [
            'Qris BCA' => 0,
            'Qris BNI' => 0,
            'Qris BRI' => 0,
            'Qris Mandiri' => 0,
            'Qris Lainnya' => 0,
        ];
        $total_transfer = 0;

        foreach ($all_trx as $trx) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $trx['pkgname']);
            $sheet->setCellValue('C' . $row, $trx['nmcust']);
            $sheet->setCellValue('D' . $row, $trx['status_label']);
            $sheet->setCellValue('E' . $row, $trx['nmcab']);
            $sheet->setCellValue('F' . $row, $trx['tgl_transaksi']);
            $sheet->setCellValue('G' . $row, $trx['payment_type']);
            $sheet->setCellValue('H' . $row, $trx['nominal']);
            
            $nom = (float)$trx['nominal'];
            $total += $nom;

            $pm = trim($trx['payment_type']);
            if (stripos($pm, 'qris') !== false) {
                $total_qris += $nom;
                if (stripos($pm, 'bca') !== false) {
                    $qris_breakdown['Qris BCA'] += $nom;
                } elseif (stripos($pm, 'bni') !== false) {
                    $qris_breakdown['Qris BNI'] += $nom;
                } elseif (stripos($pm, 'bri') !== false) {
                    $qris_breakdown['Qris BRI'] += $nom;
                } elseif (stripos($pm, 'mandiri') !== false) {
                    $qris_breakdown['Qris Mandiri'] += $nom;
                } else {
                    $qris_breakdown['Qris Lainnya'] += $nom;
                }
            } elseif (stripos($pm, 'transfer') !== false) {
                $total_transfer += $nom;
            } else {
                $total_cash += $nom;
            }

            $row++;
        }

        // Total Row
        $sheet->setCellValue('A' . $row, 'Total Keseluruhan');
        $sheet->mergeCells("A{$row}:G{$row}");
        $sheet->setCellValue('H' . $row, $total);
        $totalRow = $row;
        $row += 2;

        // Breakdown Summary
        $sheet->setCellValue('A' . $row, 'RINGKASAN METODE PEMBAYARAN');
        $sheet->mergeCells("A{$row}:C{$row}");
        $sheet->getStyle('A' . $row)->getFont()->setBold(true);
        $row++;

        $sheet->setCellValue('A' . $row, 'Total Cash / Tunai');
        $sheet->setCellValue('C' . $row, $total_cash);
        $row++;

        $sheet->setCellValue('A' . $row, 'Total Transfer Bank');
        $sheet->setCellValue('C' . $row, $total_transfer);
        $row++;

        $sheet->setCellValue('A' . $row, 'Total QRIS (Semua Bank)');
        $sheet->setCellValue('C' . $row, $total_qris);
        $row++;

        $sheet->setCellValue('B' . $row, '- Qris BCA');
        $sheet->setCellValue('C' . $row, $qris_breakdown['Qris BCA']);
        $row++;

        $sheet->setCellValue('B' . $row, '- Qris BNI');
        $sheet->setCellValue('C' . $row, $qris_breakdown['Qris BNI']);
        $row++;

        $sheet->setCellValue('B' . $row, '- Qris BRI');
        $sheet->setCellValue('C' . $row, $qris_breakdown['Qris BRI']);
        $row++;

        $sheet->setCellValue('B' . $row, '- Qris Mandiri');
        $sheet->setCellValue('C' . $row, $qris_breakdown['Qris Mandiri']);
        $row++;

        if ($qris_breakdown['Qris Lainnya'] > 0) {
            $sheet->setCellValue('B' . $row, '- Qris Lainnya');
            $sheet->setCellValue('C' . $row, $qris_breakdown['Qris Lainnya']);
            $row++;
        }

        // Styling
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle("A{$totalRow}:H{$totalRow}")->getFont()->setBold(true);
        $sheet->getStyle("H2:H{$totalRow}")->getNumberFormat()->setFormatCode('#,##0.00');
        $sheet->getStyle("C" . ($totalRow + 3) . ":C" . $row)->getNumberFormat()->setFormatCode('#,##0.00');
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap_Laporan_Harian_' . ($this->normalize_date($date)) . '_' . date('His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
