<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\ModelKlsBoxing;
use App\Models\ModelTrainer;
use CodeIgniter\HTTP\ResponseInterface;

class KelasBoxing extends BaseController
{
    protected $modelboxing, $modelcabang, $modeltrainer;
    public function __construct()
    {
        $this->modelboxing = new ModelKlsBoxing();
        $this->modelcabang = new Model_cabang();
        $this->modeltrainer = new ModelTrainer();
    }

    public function index()
    {
        $data = [
            'title' => 'Jadwal Boxing / Muaythai',
            'classes' => $this->modelboxing->jadwal_boxing($id = false, $this->user_cabang),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        return view('modules/boxing/boxing_list', $data);
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
                'title' => 'Detail Jadwal Boxing / Muaythai',
                'detail' => $this->modelboxing->jadwal_boxing($id),
                'permission' => $this->permission,
                'role_array' => $this->role_array
            ];

            return view('modules/boxing/boxing_detail', $data);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jadwal Boxing / Muaythai',
            'action' => base_url('/boxing/store'),
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
            'trainers' => $this->modeltrainer->get_trainer_oncab($this->user_cabang, 'coach boxing / muaithai')
        ];

        return view('modules/boxing/boxing_form', $data);
    }

    public function store()
    {
        $data = [
            'kdcab' => $this->request->getPost('kdcab'),
            'nama' => $this->request->getPost('nama'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_akhir' => $this->request->getPost('jam_akhir'),
            'trainer' => $this->request->getPost('trainer'),
            'user' => $this->userId
        ];

        $simpan = $this->modelboxing->insert($data);
        if ($simpan === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelboxing->errors());
        } else {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/boxing');
        }
    }

    public function edit($id)
    {
        $find = $this->modelboxing->jadwal_boxing($id);
        $data = [
            'title' => 'Edit Data Boxing / Muaythai',
            'action' => base_url('/boxing/update'),
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
            'trainers' => $this->modeltrainer->get_trainer_oncab($this->user_cabang, 'coach boxing / muaithai')
        ];

        return view('modules/boxing/boxing_form', $data);
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
        ];

        $edit = $this->modelboxing->update($id, $data);
        if ($edit === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelboxing->errors());
        } else {
            $pesan = `<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Berhasil di Rubah
                </div>`;
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/boxing');
        }
    }

    public function delete($id)
    {
        $this->modelboxing->delete($id); // Soft delete
        return redirect()->to('/boxing');
    }
}
