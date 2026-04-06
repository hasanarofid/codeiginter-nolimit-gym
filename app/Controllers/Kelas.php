<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\ModelKelas;
use App\Models\ModelTrainer;

class Kelas extends BaseController
{
    protected $modelkelas, $modelcabang, $modeltrainer;

    function __construct()
    {
        $this->modelkelas = new ModelKelas();
        $this->modelcabang = new Model_cabang();
        $this->modeltrainer = new ModelTrainer();
    }

    public function index()
    {
        $data = [
            'title' => 'Jadwal Kelas',
            'classes' => $this->modelkelas->jadwal_kelas($id = false, $this->user_cabang),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        return view('modules/kelas/kelas_list', $data);
    }

    public function detail($id = null)
    {
        if ($id == null) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Jadwal</strong> Tidak Ditemukan
                            </div>');
            return redirect()->to('/jadwal');
        } else {
            $data = [
                'title' => 'Detail Jadwal Kelas',
                'detail' => $this->modelkelas->jadwal_kelas($id),
                'permission' => $this->permission,
                'role_array' => $this->role_array
            ];

            return view('modules/kelas/kelas_detail', $data);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jadwal Kelas',
            'action' => base_url('/jadwal/store'),
            'readonly' => '',
            'button' => 'Create',
            'btn_class' => 'btn btn-primary',
            'id' => old('id'),
            'kdcab' => old('kdcab'),
            'nama' => old('nama'),
            'hari' => old('hari'),
            'jam_mulai' => old('jam_mulai'),
            'jam_akhir' => old('jam_akhir'),
            'trainer' => old('trainer'),
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
            'trainers' => $this->modeltrainer->get_trainer_oncab($this->user_cabang, 'class trainer')
        ];

        return view('modules/kelas/kelas_form', $data);
    }

    public function store()
    {
        helper('text'); // untuk manipulasi string

        $lastId = $this->modelkelas->get_count()->jml;
        $lastId += 1;

        if (strlen($lastId) == 1) {
            $newId = 'KLS00' . $lastId;
        } else if (strlen($lastId) == 2) {
            $newId = 'KLS0' . $lastId;
        } else {
            $newId = 'KLS' . $lastId;
        }

        $data = [
            'id' => $newId,
            'kdcab' => $this->request->getPost('kdcab'),
            'nama' => $this->request->getPost('nama'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_akhir' => $this->request->getPost('jam_akhir'),
            'trainer' => $this->request->getPost('trainer'),
            'user' => $this->userId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $simpan = $this->modelkelas->insert($data);
        if ($simpan === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelkelas->errors());
        } else {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/jadwal');
        }
    }

    public function edit($id)
    {
        $find = $this->modelkelas->jadwal_kelas($id);
        $data = [
            'title' => 'Edit Kelas',
            'action' => base_url('/jadwal/update'),
            'readonly' => '',
            'button' => 'Edit',
            'btn_class' => 'btn btn-warning',
            'id' => old('id', $find->id),
            'kdcab' => old('kdcab', $find->kdcab),
            'nama' => old('nama', $find->nama),
            'hari' => old('hari', $find->hari),
            'jam_mulai' => old('jam_mulai', $find->jam_mulai),
            'jam_akhir' => old('jam_akhir', $find->jam_akhir),
            'trainer' => old('trainer', $find->trainer),
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
            'trainers' => $this->modeltrainer->get_trainer_oncab($this->user_cabang)
        ];

        return view('modules/kelas/kelas_form', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'kdcab' => $this->request->getPost('kdcab'),
            'nama' => $this->request->getPost('nama'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_akhir' => $this->request->getPost('jam_akhir'),
            'trainer' => $this->request->getPost('trainer'),
            'user' => $this->userId,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $edit = $this->modelkelas->update($id, $data);
        if ($edit === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelkelas->errors());
        } else {
            $pesan = `<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Berhasil di Rubah
                </div>`;
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/jadwal');
        }
    }

    public function delete($id)
    {
        $this->modelkelas->delete($id); // Soft delete
        return redirect()->to('/jadwal');
    }
}
