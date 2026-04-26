<?php

namespace APP\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\ModelTrainer;

class Trainer extends BaseController
{
    protected $modeltrainer, $modelcabang;

    public function __construct()
    {
        $this->modeltrainer = new ModelTrainer();
        $this->modelcabang = new Model_cabang();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Trainer',
            'trainers' => $this->modeltrainer->get_trainer_oncab($this->user_cabang),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        return view('modules/trainer/trainer_list', $data);
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
            $data = [
                'title' => 'Detail Jadwal Kelas',
                'detail' => $this->modeltrainer->get_trainer($id),
                'permission' => $this->permission,
                'role_array' => $this->role_array
            ];

            return view('modules/trainer/trainer_detail', $data);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Trainer',
            'action' => base_url('/trainer/store'),
            'readonly' => '',
            'button' => 'Create',
            'btn_class' => 'btn btn-primary',
            'id' => old('id'),
            'kdcab' => old('kdcab'),
            'nama' => old('nama'),
            'jenis' => old('jenis'),
            'alamat' => old('alamat'),
            'hp' => old('hp'),
            'foto' => old('foto'),
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
        ];

        return view('modules/trainer/trainer_form', $data);
    }

    public function store()
    {
        helper('text'); // untuk manipulasi string

        $lastId = $this->modeltrainer->get_count()->jml;
        $lastId += 1;

        if (strlen($lastId) == 1) {
            $newId = 'TRN000' . $lastId;
        } else if (strlen($lastId) == 2) {
            $newId = 'TRN00' . $lastId;
        } else if (strlen($lastId) == 3) {
            $newId = 'TRN0' . $lastId;
        } else {
            $newId = 'TRN' . $lastId;
        }

        $foto = $this->request->getFile('foto');
        $fotoName = 'user.png'; // Default Image

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Validate File
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($foto->getMimeType(), $allowedMimeTypes) || $foto->getSize() > 3072 * 1024) {
                session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">File tidak valid. Pastikan format JPG/PNG dan ukuran < 3MB.</div>');
                return redirect()->to('/trainer');
            }

            $uploadPath = './img/uploads/fp/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $ext = $foto->guessExtension();
            $fotoName = $newId . "." . $ext;

            $filePath = $uploadPath . $fotoName;
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            if (!$foto->move($uploadPath, $fotoName)) {
                session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal memindahkan file.</div>');
                return redirect()->to('/trainer');
            }
        }

        $data = [
            'id' => $newId,
            'kdcab' => $this->request->getPost('kdcab'),
            'nama' => $this->request->getPost('nama'),
            'jenis' => $this->request->getPost('jenis'),
            'alamat' => $this->request->getPost('alamat'),
            'hp' => $this->request->getPost('hp'),
            'foto' => $fotoName
        ];

        $simpan = $this->modeltrainer->insert($data);
        if ($simpan === false) {
            return redirect()->back()->withInput()->with('errors', $this->modeltrainer->errors());
        }

        session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">Data Tersimpan</div>');
        return redirect()->to('/trainer');
    }

    public function edit($id)
    {
        $find = $this->modeltrainer->get_trainer($id);
        // dd($find);
        $data = [
            'title' => 'Edit Trainer',
            'action' => base_url('/trainer/update'),
            'readonly' => '',
            'button' => 'Edit',
            'btn_class' => 'btn btn-warning',
            'id' => old('id', $find['id']),
            'kdcab' => old('kdcab', $find['kdcab']),
            'nama' => old('nama', $find['nama']),
            'jenis' => old('jenis', $find['jenis']),
            'alamat' => old('alamat', $find['alamat']),
            'hp' => old('hp', $find['hp']),
            'foto' => old('foto', $find['foto']),
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
        ];

        return view('modules/trainer/trainer_form', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $foto = $this->request->getFile('foto');

        if (!empty($foto->getName())) {
            $fotoName = 'user.png'; // Default Image

            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                // Validate File
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($foto->getMimeType(), $allowedMimeTypes) || $foto->getSize() > 3072 * 1024) {
                    session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">File tidak valid. Pastikan format JPG/PNG dan ukuran < 3MB.</div>');
                    return redirect()->to('/trainer');
                }

                $uploadPath = './img/uploads/fp/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $ext = $foto->guessExtension();
                $fotoName = $id . "." . $ext;

                $filePath = $uploadPath . $fotoName;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                if (!$foto->move($uploadPath, $fotoName)) {
                    session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal memindahkan file.</div>');
                    return redirect()->to('/trainer');
                }
            }
        }

        $data = [
            'kdcab' => $this->request->getPost('kdcab'),
            'nama' => $this->request->getPost('nama'),
            'jenis' => $this->request->getPost('jenis'),
            'alamat' => $this->request->getPost('alamat'),
            'hp' => $this->request->getPost('hp'),
        ];

        if ($this->modeltrainer->update($id, $data)) {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Berhasil di Rubah
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/trainer');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->modeltrainer->errors());
        }
    }

    public function delete($id)
    {
        $this->modeltrainer->delete($id); // Soft delete
        return redirect()->to('/trainer');
    }
}
