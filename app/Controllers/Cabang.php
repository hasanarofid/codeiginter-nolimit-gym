<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;

class Cabang extends BaseController
{

    protected $modelcabang;

    public function __construct()
    {
        $this->modelcabang = new Model_cabang();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Cabang',
            'cabang' => $this->modelcabang->get_cabang(),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        // dd($data['cabang']);
        // dd($this->permission);
        return view('modules/cabang/cabang_list', $data);
    }

    public function detail($id = null)
    {
        if ($id == null) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>ID Cabang</strong> Tidak Ditemukan
                            </div>');
            return redirect()->to('/cabang');
        } else {
            $data = [
                'title' => 'Detail Cabang',
                'detail' => $this->modelcabang->get_detail($id),
                'permission' => $this->permission,
                'role_array' => $this->role_array
            ];

            return view('modules/cabang/cabang_detail', $data);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Cabang',
            'action' => base_url('/cabang/store'),
            'readonly' => '',
            'button' => 'Create',
            'btn_class' => 'btn btn-primary',
            'id' => old('id'),
            'nama' => old('nama'),
            'alamat' => old('alamat'),
            'kota' => old('kota'),
            'telp' => old('telp'),
            'hp' => old('hp'),
            'email' => old('email'),
            'sosmed' => old('sosmed'),
            'bank_name' => old('bank'),
            'bank_rek' => old('rekening'),
            'bank_acc_an' => old('atas_nama')
        ];

        return view('modules/cabang/cabang_form', $data);
    }

    public function store()
    {
        helper('text'); // untuk manipulasi string

        $lastId = $this->modelcabang->get_count()->jml;
        $lastId += 1;

        if (strlen($lastId) == 1) {
            $newId = 'NL0' . $lastId;
        } else {
            $newId = 'NL' . $lastId;
        }

        $data = [
            // 'id' => substr(md5(uniqid(mt_rand(), true)), 0, 5),
            'id' => $newId,
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'telp' => $this->request->getPost('telp'),
            'hp' => $this->request->getPost('hp'),
            'email' => $this->request->getPost('email'),
            'sosmed' => $this->request->getPost('sosmed'),
            'bank_name' => $this->request->getPost('bank'),
            'bank_rek' => $this->request->getPost('rekening'),
            'bank_acc_an' => $this->request->getPost('atas_nama')
        ];

        $simpan = $this->modelcabang->insert($data);
        if ($simpan === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelcabang->errors());
        } else {

            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to(base_url('/cabang/create'));
        }
    }

    public function edit($id)
    {
        $find = $this->modelcabang->find($id);
        $data = [
            'title' => 'Edit Cabang',
            'action' => base_url('/cabang/update'),
            'readonly' => '',
            'button' => 'Edit',
            'btn_class' => 'btn btn-warning',
            'id' => old('id', $find['id']),
            'nama' => old('nama', $find['nama']),
            'alamat' => old('alamat', $find['alamat']),
            'kota' => old('kota', $find['kota']),
            'telp' => old('telp', $find['telp']),
            'hp' => old('hp', $find['hp']),
            'email' => old('email', $find['email']),
            'sosmed' => old('sosmed', $find['sosmed']),
            'bank_name' => old('bank', $find['bank_name']),
            'bank_rek' => old('rekening', $find['bank_rek']),
            'bank_acc_an' => old('atas_nama', $find['bank_acc_an'])
        ];

        return view('modules/cabang/cabang_form', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'telp' => $this->request->getPost('telp'),
            'hp' => $this->request->getPost('hp'),
            'email' => $this->request->getPost('email'),
            'sosmed' => $this->request->getPost('sosmed'),
            'bank_name' => $this->request->getPost('bank'),
            'bank_rek' => $this->request->getPost('rekening'),
            'bank_acc_an' => $this->request->getPost('atas_nama')
        ];

        if ($this->modelcabang->update($id, $data)) {
            return redirect()->to('/cabang');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->modelcabang->errors());
        }
    }

    public function delete($id)
    {
        $this->modelcabang->delete($id); // Soft delete
        return redirect()->to('/cabang');
    }
}
