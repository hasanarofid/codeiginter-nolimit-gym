<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_customer;
use App\Models\Model_user;
use App\Models\ModelMembership;
use App\Models\ModelMemtrans;
use CodeIgniter\HTTP\ResponseInterface;

class Payment extends BaseController
{
    protected $modelmemtrans, $modelcustomer, $modelmembership;
    protected $modeluser;

    public function __construct()
    {
        $this->modelcustomer = new Model_customer();
        $this->modelmembership = new ModelMembership();
        $this->modelmemtrans = new ModelMemtrans();
        $this->modeluser = new Model_user();
    }

    public function index($id = false)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-gjTHQeKzrXnWReRWgArTQWhB';
        // \Midtrans\Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        // get trans
        $dataTrans = $this->modelmemtrans->get_data($id);
        // dd($dataTrans);

        // get package membership
        $dataPackage = $this->modelmembership->get_membership($dataTrans['membershipid']);
        // dd($dataPackage);

        // get data customer
        $dataCustomer = $this->modelcustomer->get_customer($dataTrans['custid']);
        // dd($dataCustomer);

        // Populate items
        $items = array(
            array(
                'id'       => $dataTrans['id'],
                'price'    => $dataTrans['nominal'],
                'quantity' => 1,
                'name'     => "Paket " . $dataPackage['nama']
            ),
            // array(
            //     'id'       => 'item2',
            //     'price'    => 50000,
            //     'quantity' => 2,
            //     'name'     => 'Nike N90'
            // )
        );

        // Populate customer's billing address
        // $billing_address = array(
        //     'first_name'   => "Andri",
        //     'last_name'    => "Setiawan",
        //     'address'      => "Karet Belakang 15A, Setiabudi.",
        //     'city'         => "Jakarta",
        //     'postal_code'  => "51161",
        //     'phone'        => "081322311801",
        //     'country_code' => 'IDN'
        // );

        // Populate customer's shipping address
        // $shipping_address = array(
        //     'first_name'   => "John",
        //     'last_name'    => "Watson",
        //     'address'      => "Bakerstreet 221B.",
        //     'city'         => "Jakarta",
        //     'postal_code'  => "51162",
        //     'phone'        => "081322311801",
        //     'country_code' => 'IDN'
        // );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => $dataCustomer['nama'],
            'last_name'        => "",
            'email'            => $dataCustomer['email'],
            // 'phone'            => "081322311801",
            // 'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
        );

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                // 'gross_amount' => 150000,
            ),
            'item_details'        => $items,
            'customer_details'    => $customer_details
        );

        $data = ['snapToken' => \Midtrans\Snap::getSnapToken($params)];

        return view('payment/pay', $data);
    }

    public function saveTransaction()
    {
        // Pastikan ini adalah permintaan POST
        if ($this->request->isAJAX()) {
            // Ambil data JSON dari permintaan
            $json = $this->request->getJSON();

            // Pastikan data JSON tersedia
            if ($json) {
                // Ambil data item id
                $item_id = $json->item_details[0]->id ?? null;

                // Ambil data yang diperlukan dari JSON bersarang
                $payment_type       = $json->payment_type ?? null;
                $transaction_time   = $json->transaction_time ?? null;
                $transaction_status = $json->transaction_status ?? null;

                // Ambil bank dan va_number dari array `va_numbers` jika ada
                $bank = $json->va_numbers[0]->bank ?? null;
                $va_number = $json->va_numbers[0]->va_number ?? null;

                // Cek apakah data yang dibutuhkan tidak null
                if ($item_id && $payment_type && $transaction_time && $transaction_status && $bank && $va_number) {
                    // Siapkan data untuk disimpan ke dalam database
                    $data = [
                        'payment_type'       => $payment_type,
                        'transaction_time'   => $transaction_time,
                        'transaction_status' => $transaction_status,
                        'bank'               => $bank,
                        'va_number'          => $va_number,
                    ];


                    // Update data ke dalam database
                    if ($this->modelmemtrans->update($item_id, $data)) {
                        return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                            ->setJSON(['message' => 'Data transaksi berhasil disimpan']);
                    } else {
                        return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                            ->setJSON(['message' => 'Gagal menyimpan data transaksi']);
                    }
                } else {
                    // Jika data yang dibutuhkan tidak lengkap
                    return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                        ->setJSON(['message' => 'Data payment_type, transaction_time, transaction_status, bank, dan va_number diperlukan']);
                }
            } else {
                // Jika data JSON tidak valid
                return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                    ->setJSON(['message' => 'Data JSON tidak valid']);
            }
        } else {
            // Jika metode bukan POST
            return $this->response->setStatusCode(ResponseInterface::HTTP_METHOD_NOT_ALLOWED)
                ->setJSON(['message' => 'Metode tidak diizinkan']);
        }
    }

    public function confirm()
    {
        if ($this->request->getPost()) {
            $tgl = $this->request->getVar('payment_date');
            $tgl = empty($tgl) ? date('Y-m-d') : $tgl;

            $idtrx = $this->request->getVar('idtrx');
            $idcust = $this->request->getVar('idcust');
            $memid = $this->request->getVar('memid');
            $payment_type = $this->request->getVar('payment_type');
            $renewal = $this->request->getVar('renew');

            $getmembership = $this->modelmembership->get_membership($memid);
            $getcustomer = $this->modelcustomer->get_customer($idcust);
            
            // cek apakah data user sudah ada 
            $custonuser = $this->modeluser->hitung_user($getcustomer['email']);
            // dd($custonuser);
            
            // cek transaksi pembayaran untuk renewal atau new members
            if ($renewal == 0) {
                // update status aktif
                $data_up = [
                    'payment_date' => date('Y-m-d', strtotime($tgl)),
                    'status' => 1,
                    'expired_date' => date('Y-m-d 23:59:00', strtotime("+$getmembership[expired] month", strtotime($tgl))),
                    'user' => $this->userId,
                ];

                // $this->modelmemtrans->update(null, ['status' => 0]);
                $updt = $this->modelmemtrans->update($idtrx, $data_up);

                if ($updt === true) {
                    if ($custonuser == 0) {
                        // insert to users
                        $newpas = $this->generatePassword();
                        $data_users = [
                            'UserID' => strtolower($getcustomer['email']),
                            'Password' => password_hash($newpas, PASSWORD_DEFAULT),
                            'Nama' => $getcustomer['nama'],
                            'UserGroup' => 'MS',
                            'LastActivity' => null,
                            'LastIP' => null,
                            'CurrentActivity' => null,
                            'CurrentIP' => null,
                            'CreatedDate' => date('Y-m-d H:i:s'),
                            'CreatedBy' => $this->userId,
                            'Ket' => 'Membership',
                            'kdcab' => $getcustomer['kdcab']
                        ];
                        // dd($data_users);
        
                        $this->modeluser->insert($data_users);

                        // echo $x == true ? 'sukses' : 'tidak tersimpan';

                        $emailData = [
                            'emailto' => $getcustomer['email'],
                            'nama'  => $getcustomer['nama'],
                            'default_pass' => $newpas,
                            'link' => base_url('/login')
                        ];

                        // dd($emailData);
                        $conf_email = service('email');

                        $conf_email->setFrom('noreply@nolimitstraining.id', 'NoLimits');
                        $conf_email->setTo($emailData['emailto']);
                        $conf_email->setSubject('Info Payment Confirmation');
                        $message = view('modules/email/email_password', $emailData);
                        $conf_email->setMessage($message);

                        if ($conf_email->send()) {
                            session()->setFlashdata('konfirmpass', '<div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Success: </strong> Konfirmasi berhasil dikirim ke email, informasikan kepada member 
                                </div>');
                        } else {
                            // $data['email_error'] = '';
                            session()->setFlashdata('konfirmpass', '<div class="alert alert-warning" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Oops: </strong> Failed to send email confirmation. Please try again later.
                                </div>');
                        }
                    } else {
                        // Activate existing user account
                        $this->modeluser->update($getcustomer['email'], ['Ket' => 'Membership']);
                        
                        session()->setFlashdata('konfirmpass', '<div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success: </strong> Akun Member telah diaktifkan. Member sekarang bisa login menggunakan email dan password mereka.
                            </div>');
                    }
                }
            } else {
                $ubahStatus = [
                    'status' => 2
                ];

                // lakukan perubahan status keanggotaan lama
                $this->modelmemtrans->ubah_status($idcust, $idtrx, $ubahStatus);

                // update perpanjangan
                $data_renew = [
                    'payment_date' => date('Y-m-d', strtotime($tgl)),
                    'status' => 1,
                    'expired_date' => date('Y-m-d 23:59:00', strtotime("+$getmembership[expired] month", strtotime($tgl))),
                    'user' => $this->userId,
                ];

                // $this->modelmemtrans->update(null, ['status' => 0]);
                $updt = $this->modelmemtrans->update($idtrx, $data_renew);
            }


            session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success, </strong> pembayaran sudah di update.
            </div>');

            return redirect()->to(base_url('/customer/detail/' . $idcust));
        }
    }

    function generatePassword($length = 6)
    {
        // Karakter yang digunakan untuk password, menghilangkan huruf 'o' dan angka '0'
        $characters = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        $password = '';
        $charactersLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $charactersLength - 1);
            $password .= $characters[$randomIndex];
        }

        return $password;
    }
}
