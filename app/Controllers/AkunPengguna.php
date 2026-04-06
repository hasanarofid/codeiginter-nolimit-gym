<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_user;
use CodeIgniter\HTTP\ResponseInterface;

class AkunPengguna extends BaseController
{
    protected $modeluser;

    public function __construct()
    {
        $this->modeluser = new Model_user();
    }

    public function index()
    {
        $detail = $this->modeluser->get_user($this->userId);
        $data = [
            'title' => 'Profil Pengguna',
            'nama' => old('nama', $detail->Nama),
            'username' => old('username', $detail->UserID),
            'newpass' => old('newpass'),
            'retype' => old('retype'),
            'action' => base_url('user/update_pass'),
        ];

        return view('users/user_profile', $data);
    }

    public function update()
    {
        $this->validation->setRules([
            'username' => 'required',
            'nama' => 'required',
            'newpass' => 'required|min_length[8]',
            'retype' => 'required|matches[newpass]',
        ], [
            'username' => ['required' => 'tidak boleh kosong'],
            'nama' => ['required' => 'harus di isi'],
            'newpass' => ['required' => 'Harus diisi', 'min_length' => 'minimal 8 karakter'],
            'retype' => ['required' => 'Harus diisi', 'matches' => 'Password tidak sama']
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $userid = $this->request->getVar('username');
        $nama = $this->request->getVar('nama');
        $passbaru = $this->request->getVar('retype');

        $up = [
            'Nama' => $nama,
            'Password' => password_hash($passbaru, PASSWORD_DEFAULT)
        ];

        $upData = $this->modeluser->update($userid, $up);

        if ($upData === true) {
            session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success: </strong> Perubahan berhasil
            </div>');
            return redirect()->to('/user');
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Warning !!, </strong> Gagal melakukan perubahan
            </div>');
            return redirect()->to('/user');
        }
    }
}
