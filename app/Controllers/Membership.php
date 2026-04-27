<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\Model_customer;
use App\Models\Model_user;
use App\Models\ModelMembership;
use App\Models\ModelMemCat;
use App\Models\ModelMemtrans;

class Membership extends BaseController
{
    protected $modelcustomer, $modelmembership, $modelcabang, $modeltrans;
    protected $modeluser, $modelmemcat;
    public function __construct()
    {
        helper('pusher');
        $this->modelcustomer = new Model_customer();
        $this->modelmembership = new ModelMembership();
        $this->modelcabang = new Model_cabang();
        $this->modeltrans = new ModelMemtrans();
        $this->modeluser = new Model_user();
        $this->modelmemcat = new ModelMemCat();
    }

    public function index()
    {
        $cat = $this->modelmemcat->get_category();

        $package = '';
        foreach ($cat as $row) {
            $package .= '
            <optgroup label="' . $row['catname'] . '">';
            $pkg = $this->modelmembership->get_mem_by_cat($row['catid']);
            foreach ($pkg as $p) {
                $package .= "<option value='$p[id]'>$p[nama] - " . number_format($p['nominal'], 0, '.', ',') . "</option>";
            }
            $package .= '</optgroup>';
        }

        $data = [
            'title' => 'NoLimits | Registration',
            'action' => base_url('/registration/save'),
            'firstname' => old('firstname'),
            'lastname' => old('lastname'),
            'email' => old('email'),
            'hpwa' => old('hpwa'),
            'alamat' => old('alamat'),
            'cabang' => old('cabang'),
            'paket' => old('paket'),
            'payment' => old('payment'),
            'cabangs' => $this->modelcabang->get_cabang('%'),
            // 'packages' => $this->modelmembership->get_membership_public(),
            'packages' => $package,

        ];
        return view('modules/member/member_registration', $data);
    }

    public function save_registration()
    {
        $this->validation->setRules([
            'firstname' => 'required',
            'hpwa' => 'required',
            'alamat' => 'required',
            'email' => 'required|valid_email|is_unique[customers.email]|is_unique[user.UserID]',
            'cabang' => 'required',
            'paket' => 'required',
            'payment' => 'required',
            'fotoktp' => 'uploaded[fotoktp]|is_image[fotoktp]|mime_in[fotoktp,image/jpg,image/jpeg,image/png]|max_size[fotoktp,4096]',
            'foto' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,4096]',
            'password' => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
        ], [
            'firstname' => ['required' => 'Harus diisi'],
            'hpwa' => ['required' => 'No Hp / WA harus diisi'],
            'alamat' => ['required' => 'Alamat harus diisi'],
            'email' => ['required' => 'Harus diisi', 'valid_email' => 'Email tidak valid', 'is_unique' => 'Email sudah terdaftar'],
            'cabang' => ['required' => 'Harus di pilih'],
            'paket' => ['required' => 'Harus di pilih'],
            'payment' => ['required' => 'Harus di pilih'],
            'fotoktp' => ['uploaded' => 'Upload foto KTP', 'is_image' => 'Gambar tidak valid', 'mime_in' => 'Format harus jpg, jpeg, png', 'max_size' => 'Maksimal file 4MB'],
            'foto' => ['uploaded' => 'Upload foto profil', 'is_image' => 'Gambar tidak valid', 'mime_in' => 'Format harus jpg, jpeg, png', 'max_size' => 'Maksimal file 4MB'],
            'password' => ['required' => 'Password harus diisi', 'min_length' => 'Minimal 8 karakter'],
            'pass_confirm' => ['required' => 'Konfirmasi password harus diisi', 'matches' => 'Password tidak cocok'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        helper('text'); // untuk manipulasi string

        $cabang = $this->request->getVar('cabang');
        $lastId = $this->modelcustomer->get_count($cabang)->jml;

        $lastId += 1;

        if (strlen($lastId) == 1) {
            $newId = $cabang . '00' . $lastId;
        } else if (strlen($lastId) == 2) {
            $newId = $cabang . '0' . $lastId;
        } else {
            $newId = $cabang . '' . $lastId;
        }

        $paket = $this->request->getVar('paket');
        $payment = $this->request->getVar('payment');
        $alamat = $this->request->getVar('alamat');
        $hpwa = $this->request->getVar('hpwa');
        $email = $this->request->getVar('email');
        $idcard = null;
        $nama = $this->request->getVar('firstname') . " " . $this->request->getVar('lastname');
        $fotoktp = $this->request->getFile('fotoktp');
        $foto = $this->request->getFile('foto');

        if (($fotoktp->isValid() && !$fotoktp->hasMoved()) && ($foto->isValid() && !$foto->hasMoved())) {
            $ext_fotoktp = $fotoktp->guessExtension();
            $ext_foto = $foto->guessExtension();

            $upKtpPath = './img/uploads/member/ktp/';
            $upFpPath = './img/uploads/member/fp/';

            $ktpName = 'ktp_' . $newId . '.' . $ext_fotoktp;
            $fpName = 'fp_' . $newId . '.' . $ext_foto;

            // Cek apakah ada file dengan nama yang sama
            $ktpPath = $upKtpPath . $ktpName;
            if (file_exists($ktpPath)) {
                unlink($ktpPath); // Hapus file yang lama
            }

            // Cek apakah ada file dengan nama yang sama
            $fpPath = $upFpPath . $fpName;
            if (file_exists($fpPath)) {
                unlink($fpPath); // Hapus file yang lama
            }

            $fotoktp->move($upKtpPath, $ktpName);
            $foto->move($upFpPath, $fpName);

            $newData = [
                'id' => $newId,
                'kdcab' => $cabang,
                'noktp' => $idcard,
                'nama' => $nama,
                'tgl_lhr' => null,
                'hp_wa' => $hpwa,
                'email' => $email,
                'alamat' => $alamat,
                'barcode' => null,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'idcard_image' => $ktpName,
                'fp_image' => $fpName,
                'user' => null
            ];

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $this->modelcustomer->insert($newData);

            // Create user for login (Group MS = Membership)
            $newUser = [
                'UserID'    => $email,
                'Password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'Nama'      => $nama,
                'UserGroup' => 'MS',
                'Ket'       => 'disabled', // Set status to disabled until approved
                'kdcab'     => $cabang,
                'CreatedDate' => date('Y-m-d H:i:s')
            ];
            $this->modeluser->insert($newUser);

            $getpaket = $this->modelmembership->get_membership($paket);
            $transid = $this->generateUniqueId($cabang);
            $trans = [
                'id' => $transid,
                'custid' => $newId,
                'membershipid' => $paket,
                'nominal' => $getpaket['nominal'],
                'payment_type' => $payment,
                'expired_date' => null,
                'status' => 0,
                'user' => null
            ];

            $this->modeltrans->insert($trans);

            // SendPush Notification
            $message = "Pendaftaran baru an. " . $nama . " dengan ID : " . $newId;
            $dataNotif = [
                'title' => "Pendaftaran Member Baru",
                'message' => $message,
            ];

            sendPusherNotification('my-channel', 'my-event', $dataNotif);

            // Send confirmation email
            $getCabang = $this->modelcabang->get_detail($cabang);
            $emailData = [
                'emailto' => $email,
                'cabang' => $getCabang->nama,
                'noid' => $newId,
                'nama'  => $nama,
                'paket' => $getpaket['nama'],
                'nominal' => $getpaket['nominal'],
                'hp' => $getCabang->hp,
            ];

            $conf_email = service('email');
            $conf_email->setFrom('noreply@nolimitstraining.id', 'NoLimits');
            $conf_email->setTo($emailData['emailto']);
            $conf_email->setSubject('Info Registration Confirmation');
            $message = view('modules/email/email_registration_non_midtrans', $emailData);
            $conf_email->setMessage($message);

            if (!$conf_email->send()) {
                log_message('error', $conf_email->printDebugger(['headers']));
                throw new \Exception('Gagal mengirim email konfirmasi.');
            }

            $db->transCommit();

            session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                             <strong>Success: </strong> Pendaftaran berhasil, segera lakukan konfirmasi ke kasir untuk aktivasi keanggotaan Anda. 
                        </div>');
        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Oops: </strong> ' . $e->getMessage() . ' Silakan coba lagi nanti.
                        </div>');
        }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Oops: </strong> Ada kesalahan ketikah mengunggah file.
                            </div>');
        }

        return redirect()->to(base_url('/registration'));
    }

    public function term_condition()
    {
        return view('member_term_condition');
    }

    public function member_package()
    {
        $data = [
            'title' => 'Paket Membership',
            // 'packages' => $this->modelmembership->get_membership(),
            'packages' => $this->modelmembership->get_join_paket(),
            'permission' => $this->permission,
            'role_array' => $this->role_array

        ];
        return view('modules/member/member_packages', $data);
    }

    public function detail($id = null)
    {
        if ($id == null) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Trainer</strong> Tidak Ditemukan
                            </div>');
            return redirect()->to('/trainer');
        } else {
            $membership = $this->modelmembership->get_membership($id);
            $cat = $this->modelmemcat->get_category($membership['catid']);
            $data = [
                'title' => 'Detail Jadwal Kelas',
                'detail' => $membership,
                'category' => $cat['catname'],
                'permission' => $this->permission,
                'role_array' => $this->role_array
            ];

            return view('modules/member/member_detail', $data);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Paket',
            'action' => base_url('/membership/store'),
            'readonly' => '',
            'button' => 'Create',
            'btn_class' => 'btn btn-primary',
            'id' => old('id'),
            'catid' => old('catid'),
            'kota' => old('kota'),
            'nama' => old('nama'),
            'nominal' => old('nominal'),
            'expired' => old('expired'),
            'deskripsi' => old('deskripsi'),
            'cities' => $this->modelcabang->get_kota(),
            'category' => $this->modelmemcat->get_category()
        ];

        return view('modules/member/member_form', $data);
    }

    public function store()
    {
        helper('text'); // untuk manipulasi string

        $lastId = $this->modelmembership->get_count()->jml;
        $lastId += 1;

        if (strlen($lastId) == 1) {
            $newId = 'MBS' . date('my') . '00' . $lastId;
        } else if (strlen($lastId) == 2) {
            $newId = 'MBS' . date('my') . '0' . $lastId;
        } else {
            $newId = 'MBS' . date('my') . $lastId;
        }

        $data = [
            'id' => $newId,
            'nama' => $this->request->getPost('nama'),
            'catid' => $this->request->getPost('catid'),
            'kota' => $this->request->getPost('kota'),
            'nominal' => $this->request->getPost('nominal'),
            'expired' => $this->request->getPost('expired'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'user' => $this->userId
        ];

        $simpan = $this->modelmembership->insert($data);
        if ($simpan === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelmembership->errors());
        } else {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/membership');
        }
    }

    public function edit($id)
    {
        $find = $this->modelmembership->get_membership($id);
        $data = [
            'title' => 'Edit Paket Membership',
            'action' => base_url('/membership/update'),
            'readonly' => '',
            'button' => 'Edit',
            'btn_class' => 'btn btn-warning',
            'id' => old('id', $find['id']),
            'catid' => old('catid', $find['catid']),
            'kota' => old('kota', $find['kota']),
            'nama' => old('nama', $find['nama']),
            'nominal' => old('nominal', $find['nominal']),
            'expired' => old('expired', $find['expired']),
            'deskripsi' => old('deskripsi', $find['deskripsi']),
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
            'category' => $this->modelmemcat->get_category()
        ];

        return view('modules/member/member_form', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');


        $data = [
            'nama' => $this->request->getPost('nama'),
            'catid' => $this->request->getPost('catid'),
            'kota' => $this->request->getPost('kota'),
            'nominal' => $this->request->getPost('nominal'),
            'expired' => $this->request->getPost('expired'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'user' => $this->userId,
            // 'updated_at' => date('Y-m-d H:i:s')
        ];

        $update = $this->modelmembership->update($id, $data);
        if ($update === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelmembership->errors());
        } else {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Berhasil di Rubah
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/membership');
        }
    }

    public function delete($id)
    {
        $this->modelmembership->delete($id); // Soft delete
        return redirect()->to('/membership');
    }

    public function forgot_password()
    {
        $data = [
            'title' => '| Forgot Password',
            'action' => base_url('/forgot-password/process'),
            'email' => old('email'),
        ];

        return view('modules/member/member_forgot_password', $data);
    }

    public function forgot_process()
    {
        $this->validation->setRules([
            'email' => 'required|valid_email'
        ], [
            'email' => [
                'required' => 'Harus di isi..',
                'valid_email' => 'Email tidak valid'
            ]
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $email = $this->request->getVar('email');

        // Cek keberadaan email
        $customer = $this->modelcustomer->get_by_email($email);
        $hasil = $customer == null ? 0 : 1;

        if ($hasil > 0) {

            // generate Token
            $token = $this->generateToken();
            $link = base_url("reset-password?token={$token}");
            $dateTime = date('Y-m-d H:i:s');
            $tokenExpiry = strtotime($dateTime) + 3600;

            $dataReset = [
                'link' => $link,
                'expiredToken' => $tokenExpiry
            ];

            $conf_email = service('email');

            $conf_email->setFrom('noreply@nolimitstraining.id', 'NoLimits');
            $conf_email->setTo($email);
            $conf_email->setSubject('Konfirmasi Ubah Password ');
            $message = view('modules/email/email_forgot_password', $dataReset);
            $conf_email->setMessage($message);

            if ($conf_email->send()) {

                $this->modeluser->update($email, ['token' => $token, 'token_created_at' => date('Y-m-d H:i:s')]);
                session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success: </strong> Cek email untuk melakukan perubahan password
                            </div>');
            } else {
                log_message('error', $conf_email->printDebugger(['headers']));
                // $data['email_error'] = '';
                session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Oops: </strong> Failed to send email confirmation. Please try again later.
                            </div>');
            }

            // session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/forgot-password');
        } else {
            $pesan = '<div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Ooops, </strong>Email tidak ditemukan, hubungi admin Nolimits untuk memastikan ...
              </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/forgot-password');
        }
    }

    public function resetPassword()
    {
        $token = $this->request->getVar('token');
        $user  = $this->modeluser->getByToken($token);

        $tokenExpiry = strtotime($user->token_created_at) + 3600; // Token berlaku 1 jam
        if (time() > $tokenExpiry) {

            $pesan = '<div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Ooops, </strong>Token sudah kadaluarsa, silahkan ajukan permintaan reset password baru ...
              </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/forgot-password');
        } else {

            $data = [
                'title' => 'Reset Password',
                'action' => base_url('/reset-password'),
                'email' => $user->UserID,
                'token' => $user->token
            ];

            return view('modules/member/member_reset_password', $data);
        }
    }

    public function updatePassword()
    {
        $email   = $this->request->getVar('email');
        $token   = $this->request->getVar('token');
        $newpass = $this->request->getVar('newpass');

        // Validasi input
        $this->validation->setRules([
            'newpass' => 'required|min_length[6]',
            'retype' => 'required|matches[newpass]',
        ], [
            'newpass' => ['required' => 'Harus di isi', 'min_length' => 'Minimal 6 karakter'],
            'retype' => ['required' => 'Harus di isi', 'matches' => 'Password tidak sama'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Update password di database
        $hashedPassword = password_hash($newpass, PASSWORD_DEFAULT);
        $this->modeluser->updatePassword($email, $token, $hashedPassword);

        $pesan = '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Ok, </strong>Password telah di perbaharui ...
              </div>';
        session()->setFlashdata('pesan', $pesan);
        return redirect()->to('/login');
    }

    public function set_perpanjangan()
    {
        // Restrict to Management Only
        if (!in_array(session()->group, ['SA', 'AD', 'OP'])) {
            session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert"><strong>Akses Ditolak:</strong> Perpanjangan membership hanya bisa dilakukan oleh manajemen.</div>');
            return redirect()->to(base_url('/dashboard'));
        }

        $paket      = $this->request->getVar('paket');
        $cabang     = $this->request->getVar('cabang');
        $idcust     = $this->request->getVar('idcust');
        $payment    = $this->request->getVar('payment');

        $customer   = $this->modelcustomer->get_customer($idcust);

        $getpaket = $this->modelmembership->get_membership($paket);
        $transid = $this->generateUniqueId($cabang);
        $trans = [
            'id' => $transid,
            'custid' => $idcust,
            'membershipid' => $paket,
            'nominal' => $getpaket['nominal'],
            'payment_type' => $payment,
            'expired_date' => null,
            'status' => 0,
            'user' => null
        ];


        // Cek apakah transaksi dengan tanggal ini sudah ada
        $existingTransaction = $this->modeltrans->where('custid', $idcust)
            ->where('DATE(created_at)', date('Y-m-d'))
            ->first();

        if ($existingTransaction) {
            $update = [
                'custid' => $idcust,
                'membershipid' => $paket,
                'nominal' => $getpaket['nominal'],
                'payment_type' => $payment,
                'expired_date' => null,
                'status' => 0,
                'user' => null
            ];
            // Update transaksi jika sudah ada
            $this->modeltrans->update($existingTransaction['id'], $update);
            // $message = "Transaksi berhasil diperbarui!";
        } else {
            // Tambahkan transaksi baru jika belum ada
            $this->modeltrans->insert($trans);
            // $message = "Transaksi baru berhasil disimpan!";
        }

        // SendPush Notification
        $message = "Perpanjangan member an. " . $customer['nama'] . " dengan ID : " . $idcust;
        $dataNotif = [
            'title' => "Perpanjangan Member",
            'message' => $message,
        ];

        sendPusherNotification('my-channel', 'my-event', $dataNotif);
        // return $this->response->setJSON(['status' => 'success']);


        return redirect()->to(base_url('/customer/detail/' . $customer['id']));
    }

    private function randPass($n)
    {
        $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    function generateUniqueId($prefix = '')
    {
        // Dapatkan tanggal dan waktu saat ini dalam format YmdHis (tahun, bulan, hari, jam, menit, detik)
        $dateTime = date('YmdHis');

        // Tambahkan microsecond untuk memastikan keunikan
        $microTime = microtime(true);
        $microSeconds = sprintf("%06d", ($microTime - floor($microTime)) * 1000000);

        // Gunakan hash unik berdasarkan waktu dan random bytes
        $randomBytes = bin2hex(random_bytes(4)); // 4 byte (8 karakter) cukup untuk tambahan unik
        $uniqueId = $prefix . $dateTime . $microSeconds . $randomBytes;

        return $uniqueId;
    }

    private function generateToken($length = 32)
    {
        return bin2hex(random_bytes($length / 2));
    }

    public function getPaketByCabang($idcabang)
    {
        $cabang = $this->modelcabang->get_detail($idcabang);
        $pkt = $this->modelmembership->pkgByKota($cabang->kota);

        // dd($pkt);
        return $this->response->setJSON($pkt);
    }

    public function getPervisitBycabang($idcabang)
    {
        $cabang = $this->modelcabang->get_detail($idcabang);
        $pkt = $this->modelmembership->pkgPervisit($cabang->kota);

        // dd($pkt);
        return $this->response->setJSON($pkt);
    }
}
