<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMemCat;
use CodeIgniter\HTTP\ResponseInterface;

class MembershipCategory extends BaseController
{
    protected $modelmemcat;

    public function __construct()
    {
        $this->modelmemcat = new ModelMemCat();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori Paket',
            'categories' => $this->modelmemcat->get_category(),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        return view('modules/member/member_cat_list', $data);
    }

    public function detail($id = false)
    {
        if ($id == false) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Oops: </strong> Kategori membership tidak di temukan !!
                            </div>');
        } else {
            $detail =  $this->modelmemcat->get_category($id);
            $data = [
                'title' => 'Detail Kategori Paket',
                'catid' => $detail['catid'],
                'name' => $detail['catname'],
            ];
            return view('modules/member/member_cat_detail', $data);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori Paket',
            'action' => base_url('membership/category/store'),
            'button' => 'Save',
            'btn_class' => 'btn btn-info',
            'catname' => old('catname'),
            'catid' => old('catid')
        ];

        return view('modules/member/member_cat_form', $data);
    }

    public function store()
    {
        $nama = $this->request->getVar('catname');

        $insert = $this->modelmemcat->insert(['catname' => $nama]);

        if ($insert === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelmemcat->errors());
        } else {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/membership/category/create');
        }
    }

    public function edit($id)
    {
        if ($id == false) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Oops: </strong> Kategori membership tidak di temukan !!
                            </div>');
        } else {
            $detail =  $this->modelmemcat->get_category($id);
            $data = [
                'title' => 'Update Kategori Paket',
                'action' => base_url('membership/category/update'),
                'button' => 'Update',
                'btn_class' => 'btn btn-warning',
                'catname' => old('catname', $detail['catname']),
                'catid' => old('catid', $detail['catid'])
            ];

            return view('modules/member/member_cat_form', $data);
        }
    }

    public function update()
    {
        $id = $this->request->getVar('catid');
        $nama = $this->request->getVar('catname');

        $update = $this->modelmemcat->update($id, ['catname' => $nama]);

        if ($update === false) {
            return redirect()->back()->withInput()->with('errors', $this->modelmemcat->errors());
        } else {
            $pesan = '<div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Data Tersimpan
                </div>';
            session()->setFlashdata('pesan', $pesan);
            return redirect()->to('/membership/category/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $this->modelmemcat->delete($id); // Soft delete
        return redirect()->to('/membership/category');
    }
}
