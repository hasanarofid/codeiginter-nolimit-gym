<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelExpenses;
use CodeIgniter\HTTP\ResponseInterface;

class Expenses extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ModelExpenses();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengeluaran (Expenses)',
            'expenses' => $this->model->get_expenses($this->user_cabang),
            'cabang' => $this->user_cabang,
        ];

        return view('modules/expenses/expenses_index', $data);
    }

    public function store()
    {
        $data = [
            'kdcab' => $this->user_cabang,
            'tgl' => $this->request->getPost('tgl'),
            'kategori' => $this->request->getPost('kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
            'nominal' => $this->request->getPost('nominal'),
            'user' => $this->userId
        ];

        $this->model->insert($data);

        session()->setFlashdata('pesan', '<div class="alert alert-success">Expense recorded successfully</div>');
        return redirect()->to('/expenses');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('pesan', '<div class="alert alert-success">Expense record deleted</div>');
        return redirect()->to('/expenses');
    }
}
