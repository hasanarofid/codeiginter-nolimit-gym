<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\Model_customer;
use App\Models\Model_user;
use App\Models\ModelMemtrans;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Customers extends BaseController
{
    protected $modelcustomer, $modeltransmem, $modelcabang, $modeluser;
    public function __construct()
    {
        $this->modelcustomer = new Model_customer();
        $this->modeltransmem = new ModelMemtrans();
        $this->modelcabang = new Model_cabang();
        $this->modeluser = new Model_user();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Customer',
            'customers' => $this->modelcustomer->getByCabang($this->user_cabang),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        return view('modules/customer/customer_list', $data);
    }

    public function detail($id = null)
    {
        if ($id == null) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Oops: </strong> Data customer tidak ditemukan.
            </div>');
            return redirect()->to(base_url('/customer'));
        } else {
            $expired = $this->modeltransmem->kadaluarsa($id);
            $detail = $this->modelcustomer->get_customer($id);
            $memberships = $this->modeltransmem->get_by_custid($id);

            // dd($expired);
            $data = [
                'title' => 'Detail Customer',
                'detail' => $detail,
                'cabang' => $this->modelcabang->get_detail($detail['kdcab']),
                'cabangs' => $this->modelcabang->get_cabang('%'),
                'membership' => $memberships,
                'expired' => $expired,
                'renewal' => count($memberships),
            ];

            return view('modules/customer/customer_detail', $data);
        }
    }

    public function profil()
    {
            $detail = $this->modelcustomer->get_by_email($this->userId);
            if (!$detail) {
                return redirect()->to('/dashboard')->with('pesan', '<div class="alert alert-warning">Profil customer tidak ditemukan atau User bukan merupakan Member.</div>');
            }

        $data = [
            'title' => 'Profil Member',
            'detail' => $detail,
            'cabang' => $this->modelcabang->get_detail($detail['kdcab']),
            'membership' => $this->modeltransmem->get_by_custid($detail['id']),
            'expired' => $this->modeltransmem->get_expired($detail['id']),
            'barcode' => '<img class="img-fluid" src="' . base_url('customer/barcode/' . $detail['id']) . '" alt="' . $detail['id'] . '">'
        ];

        return view('modules/customer/customer_profil', $data);
    }

    public function update_pass()
    {
        $detail = $this->modelcustomer->get_by_email($this->userId);
        $data = [
            'title' => 'Ubah Password Member',
            'action' => base_url('/customer/password_update'),
            'passlama' => old('passlama'),
            'passbaru' => old('passbaru'),
            'pass2' => old('pass2'),
            'detail' => $detail,
        ];

        return view('modules/customer/customer_pass', $data);
    }

    public function edit_pass()
    {
        // Atur rules secara eksplisit
        $this->validation->setRules([
            'passlama' => 'required',
            'passbaru' => 'required|max_length[50]|min_length[8]',
            'pass2' => 'required|matches[passbaru]',
        ], [
            'passlama' => ['required' => 'Password lama wajib diisi.'],
            'passbaru' => ['required' => 'Password baru wajib diisi.', 'max_length' => 'Password maksimal 50 karakter.', 'min_length' => 'Password minimal 8 karakter'],
            'pass2' => ['required' => 'Pengulangan password wajib diisi.', 'matches' => 'Password tidak sama.'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Validasi lolos, lanjutkan proses
        $passlama   = $this->request->getPost('passlama');
        $passbaru   = $this->request->getPost('pass2');
        $email      = $this->request->getPost('email');

        $cek_pass   = $this->modeluser->get_user($email);
        if (password_verify($passlama, $cek_pass->Password)) {
            $up_pass = $this->modeluser->update($email, ['Password' => password_hash($passbaru, PASSWORD_DEFAULT)]);
            if ($up_pass === false) {
                return redirect()->back()->withInput()->with('errors', $this->modeluser->errors());
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-success">Password berhasil dirubah</div>');
                return redirect()->to('/customer/password');
            }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-warning">Password lama salah</div>');
            return redirect()->to('/customer/password');
        }
    }

    public function edit($id)
    {
        $detail = $this->modelcustomer->get_customer($id);

        $data = [
            'title' => 'Edit Profil Member',
            'action' => base_url('customer/update'),
            'detail' => $detail,
        ];

        return view('modules/customer/customer_form', $data);
    }

    public function update()
    {
        $this->validation->setRules([
            'tgl_lhr' => 'required',
            'hp_wa' => 'required',
            'alamat' => 'required'
        ], [
            'tgl_lhr' => ['required' => 'Tidak boleh kosong'],
            'hp_wa' => ['required' => 'Tidak boleh kosong'],
            'alamat' => ['required' => 'Tidak boleh kosong'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $id = $this->request->getPost('id');
        $tgl_lhr = $this->request->getPost('tgl_lhr');
        $hp_wa = $this->request->getPost('hp_wa');
        $alamat = $this->request->getPost('alamat');

        $data = [
            'tgl_lhr' => $tgl_lhr,
            'hp_wa' => $hp_wa,
            'alamat' => $alamat,
        ];
        $update = $this->modelcustomer->update($id, $data);

        if ($update) {
            session()->setFlashdata('pesan', '<div class="alert alert-success">Data profil berhasil diubah</div>');
            return redirect()->to('/customer/edit/' . $id);
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger"><strong>Error : </strong> Ubah data profil gagal !! diubah</div>');
            return redirect()->to('/customer/edit/' . $id);
        }
    }

    public function adm_up_fp()
    {
        $id = $this->request->getVar('id');
        $fp = $this->request->getFile('fp');

        if ($fp->isValid() && !$fp->hasMoved()) {
            $ext_fp = $fp->guessExtension();
            $upFpPath = './img/uploads/member/fp/';
            $fpName = 'fp_' . $id . '.' . $ext_fp;

            // Cek apakah ada file dengan nama yang sama
            $fpPath = $upFpPath . $fpName;
            if (file_exists($fpPath)) {
                unlink($fpPath); // Hapus file yang lama
            }

            $fp->move($upFpPath, $fpName);

            $data = [
                'fp_image' => $fpName,
                'user' => $this->userId
            ];

            $this->modelcustomer->update($id, $data);
        }

        return redirect()->to('/customer/detail/' . $id);
    }

    public function adm_up_ktp()
    {
        $id = $this->request->getVar('id');
        $ktp = $this->request->getFile('ktp');

        if ($ktp->isValid() && !$ktp->hasMoved()) {
            $ext_ktp = $ktp->guessExtension();
            $upKtpPath = './img/uploads/member/ktp/';
            $ktpName = 'fp_' . $id . '.' . $ext_ktp;

            // Cek apakah ada file dengan nama yang sama
            $ktpPath = $upKtpPath . $ktpName;
            if (file_exists($ktpPath)) {
                unlink($ktpPath); // Hapus file yang lama
            }

            $ktp->move($upKtpPath, $ktpName);

            $data = [
                'idcard_image' => $ktpName,
                'user' => $this->userId
            ];

            $this->modelcustomer->update($id, $data);
        }

        return redirect()->to('/customer/detail/' . $id);
    }

    public function generate($customerId)
    {

        // Generate barcode berdasarkan ID customer
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($customerId, $generator::TYPE_CODE_128);

        // Atur header agar output langsung berupa gambar PNG
        header('Content-Type: image/png');
        echo $barcode;
    }
}
