<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_user;
use App\Models\Model_usergroup;
use App\Models\Model_cabang;

class ManajemenUser extends BaseController
{
    protected $modeluser, $modelusergrp, $modelcabang;

    public function __construct()
    {
        $this->modeluser    = new Model_user();
        $this->modelusergrp = new Model_usergroup();
        $this->modelcabang  = new Model_cabang();
    }

    private function guardAdmin()
    {
        if (!in_array(session()->group, ['SA', 'AD'])) {
            return redirect()->to(base_url('/dashboard'));
        }
        return null;
    }

    public function index()
    {
        if ($r = $this->guardAdmin()) return $r;

        $users = $this->db->table('user')
            ->select('user.UserID, user.Nama, user.UserGroup, user.Ket, user.kdcab, user_group.nama AS group_nama, cabang.nama AS cabang_nama')
            ->join('user_group', 'user_group.groupid = user.UserGroup', 'left')
            ->join('cabang', 'cabang.id = user.kdcab', 'left')
            ->whereNotIn('user.UserGroup', ['MS'])
            ->get()->getResultArray();

        $data = [
            'title'      => 'Manajemen User',
            'users'      => $users,
            'permission' => explode(',', session()->crud),
            'role_array' => ['C', 'R', 'U', 'D'],
        ];

        return view('modules/users/user_list', $data);
    }

    public function create()
    {
        if ($r = $this->guardAdmin()) return $r;

        $data = [
            'title'     => 'Tambah User',
            'action'    => base_url('admin/users/store'),
            'button'    => 'Simpan',
            'btn_class' => 'btn btn-primary float-right',
            'id'        => '',
            'nama'      => old('nama'),
            'username'  => old('username'),
            'group'     => old('group'),
            'kdcab'     => old('kdcab'),
            'ket'       => 'active',
            'groups'    => $this->modelusergrp->whereNotIn('groupid', ['MS'])->findAll(),
            'cabangs'   => $this->modelcabang->get_cabang('%'),
        ];

        return view('modules/users/user_form', $data);
    }

    public function store()
    {
        if ($r = $this->guardAdmin()) return $r;

        $this->validation->setRules([
            'username' => 'required|is_unique[user.UserID]',
            'nama'     => 'required',
            'password' => 'required|min_length[6]',
            'group'    => 'required',
            'kdcab'    => 'required',
        ], [
            'username' => ['required' => 'Username wajib diisi.', 'is_unique' => 'Username sudah digunakan.'],
            'nama'     => ['required' => 'Nama wajib diisi.'],
            'password' => ['required' => 'Password wajib diisi.', 'min_length' => 'Minimal 6 karakter.'],
            'group'    => ['required' => 'Role wajib dipilih.'],
            'kdcab'    => ['required' => 'Cabang wajib dipilih.'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $this->modeluser->insert([
            'UserID'      => $this->request->getVar('username'),
            'Nama'        => $this->request->getVar('nama'),
            'Password'    => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'UserGroup'   => $this->request->getVar('group'),
            'kdcab'       => $this->request->getVar('kdcab'),
            'Ket'         => 'active',
            'CreatedDate' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('pesan', '<div class="alert alert-success">User berhasil ditambahkan.</div>');
        return redirect()->to(base_url('admin/users'));
    }

    public function edit($userid)
    {
        if ($r = $this->guardAdmin()) return $r;

        $user = $this->modeluser->get_user($userid);
        if (!$user) {
            return redirect()->to(base_url('admin/users'));
        }

        $data = [
            'title'     => 'Edit User',
            'action'    => base_url('admin/users/update'),
            'button'    => 'Update',
            'btn_class' => 'btn btn-warning float-right',
            'id'        => $user->UserID,
            'nama'      => old('nama', $user->Nama),
            'username'  => $user->UserID,
            'group'     => old('group', $user->UserGroup),
            'kdcab'     => old('kdcab', $user->kdcab),
            'ket'       => $user->Ket,
            'groups'    => $this->modelusergrp->whereNotIn('groupid', ['MS'])->findAll(),
            'cabangs'   => $this->modelcabang->get_cabang('%'),
        ];

        return view('modules/users/user_form', $data);
    }

    public function update()
    {
        if ($r = $this->guardAdmin()) return $r;

        $userid = $this->request->getVar('id');

        $this->validation->setRules([
            'nama'  => 'required',
            'group' => 'required',
            'kdcab' => 'required',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $up = [
            'Nama'      => $this->request->getVar('nama'),
            'UserGroup' => $this->request->getVar('group'),
            'kdcab'     => $this->request->getVar('kdcab'),
            'Ket'       => $this->request->getVar('ket') ?? 'active',
        ];

        $newpass = $this->request->getVar('password');
        if (!empty($newpass)) {
            $up['Password'] = password_hash($newpass, PASSWORD_DEFAULT);
        }

        $this->modeluser->update($userid, $up);

        session()->setFlashdata('pesan', '<div class="alert alert-success">User berhasil diupdate.</div>');
        return redirect()->to(base_url('admin/users'));
    }

    public function toggle($userid)
    {
        if ($r = $this->guardAdmin()) return $r;

        if ($userid === session()->userid) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning">Tidak bisa menonaktifkan akun sendiri.</div>');
            return redirect()->to(base_url('admin/users'));
        }

        $user = $this->modeluser->get_user($userid);
        $newStatus = ($user->Ket === 'active') ? 'disabled' : 'active';
        $this->modeluser->update($userid, ['Ket' => $newStatus]);

        $msg = $newStatus === 'active' ? 'User berhasil diaktifkan.' : 'User berhasil dinonaktifkan.';
        session()->setFlashdata('pesan', '<div class="alert alert-info">' . $msg . '</div>');
        return redirect()->to(base_url('admin/users'));
    }
}
