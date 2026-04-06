<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class PaymentStatus extends ResourceController
{
    public function index()
    {
        return view('payment/payment_status');
    }

    public function checkStatus($orderId)
    {
        $serverKey = 'SB-Mid-server-gjTHQeKzrXnWReRWgArTQWhB';
        $url = "https://api.midtrans.com/v2/{$orderId}/status";

        $headers = [
            'Authorization: Basic ' . base64_encode($serverKey . ':'),
            'Content-Type: application/json'
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        curl_close($curl);

        return $this->respond(json_decode($response, true));
    }
}
