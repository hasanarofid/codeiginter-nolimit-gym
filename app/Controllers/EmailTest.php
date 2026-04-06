<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class EmailTest extends Controller
{
    public function send()
    {
        $email = service('email');

        // Konfigurasi email
        $email->setTo('juniararifwicaksono@gmail.com');
        $email->setFrom('noreply@nolimitstraining.id', 'No Limit Training');
        $email->setSubject('Test Email');

        // Template HTML sederhana
        $message = '
            <html>
            <head>
                <title>Test Email</title>
            </head>
            <body style="font-family: Arial, sans-serif; text-align: center;">
                <h2 style="color: #007BFF;">Ini adalah email yang dikirim dari domain nolimitstraining.id</h2>
                <p>Jika Anda menerima email ini, berarti konfigurasi SMTP berhasil.</p>
                <p><strong>Terima kasih!</strong></p>
            </body>
            </html>
        ';

        $email->setMessage($message);
        $email->setMailType('html'); // Set format email ke HTML

        // Kirim email
        if ($email->send()) {
            return 'Email berhasil dikirim!';
        } else {
            return 'Gagal mengirim email. Error: ' . $email->printDebugger(['headers']);
        }
    }
}
