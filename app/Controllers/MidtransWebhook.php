<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMemtrans;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class MidtransWebhook extends ResourceController
{
    protected $modelmemtrans;
    public function __construct()
    {
        $this->modelmemtrans = new ModelMemtrans();
    }
    public function index()
    {
        // conf server key
        // $serverkey = getenv('MIDTRANS_SERVER_KEY');
        $serverkey = 'SB-Mid-server-gjTHQeKzrXnWReRWgArTQWhB';

        // cek apakah request dari midtrans
        $json =  file_get_contents('php://input');
        $data = json_decode($json, true);

        // validasi signature key
        $orderId    = $data['order_id'];
        $statusCode = $data['status_code'];
        $grossAmount = $data['gross_amount'];
        $inputSignatureKey = $data['signature_key'];
        $exceptedSignatureKey = hash("sha512", $orderId . $statusCode . $grossAmount . $serverkey);

        if ($inputSignatureKey != $exceptedSignatureKey) {
            return $this->failUnauthorized('Invalid Signature');
        }

        // proses data berdasarkan status pembayaran
        switch ($data['transaction_status']) {
            case 'capture':
                // logika untuk transaksi kartu kredit
                if ($data['fraud_status'] == 'challenge') {
                    // pembayaran ter challange
                    // logik
                } else if ($data['fraud_status'] == 'accept') {
                    // pembayaran sukses
                    // update data di DB
                }
                break;
            case 'settlement':
                // pembayaran sukses
                // update pembayaran di database
                $data = [
                    'payment_bill' => $orderId,
                    'transaction_time' => $data['transaction_time'],
                    'transaction_status' => $data['transaction_status'],
                    'payment_type' => $data['payment_type'],
                    'bank' => $data['va_numbers']['bank'],
                    'va_number' => $data['va_numbers']['va_number'],
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->modelkelas->update($id, $data);
                break;
            case 'pending';
                // pembayaran tertunda
                // Update status di DB
                $data = [
                    'payment_bill' => $orderId,
                    'transaction_time' => $data['transaction_time'],
                    'transaction_status' => $data['transaction_status'],
                    'payment_type' => $data['payment_type'],
                    'bank' => $data['va_numbers']['bank'],
                    'va_number' => $data['va_numbers']['va_number'],
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->modelkelas->update($id, $data);
                break;
            case 'deny':
                // Pembayaran ditolak
                // Update status di DB
                break;
            case 'expire':
                // Pembayaran kadaluarsa
                // Update status di DB
                break;
            case 'cancel':
                // Pembayaran di batalkan
                // Update status di DB
                break;
        }

        return $this->respond(['status' => 'success']);
    }
}
