<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelFnbHdr;
use App\Models\ModelFnbItem;
use App\Models\ModelFnbTrans;
use CodeIgniter\HTTP\ResponseInterface;

class Pos extends BaseController
{
    protected $modelItem, $modelHdr, $modelTrans;

    public function __construct()
    {
        $this->modelItem = new ModelFnbItem();
        $this->modelHdr = new ModelFnbHdr();
        $this->modelTrans = new ModelFnbTrans();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $branch = $db->table('cabang')->where('id', $this->user_cabang)->get()->getRow();

        $data = [
            'title' => 'Point of Sale (POS)',
            'items' => $this->modelItem->get_items($this->user_cabang),
            'user_cabang' => $this->user_cabang,
            'cabang_nama' => $branch ? $branch->nama : 'Semua Cabang',
        ];

        return view('modules/pos/pos_index', $data);
    }

    public function store()
    {
        $cart = $this->request->getPost('cart');
        if (empty($cart)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Cart is empty']);
        }

        $id_trx = $this->modelHdr->generate_id($this->user_cabang);
        $total = 0;

        foreach ($cart as $item) {
            // Check & Decrement Stock
            $p = $this->modelItem->find($item['id']);
            if ($p && $p['stok'] < $item['qty']) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Stok tidak cukup untuk: ' . $p['nama'] . ' (Sisa: ' . $p['stok'] . ')']);
            }

            $subtotal = $item['harga'] * $item['qty'];
            $total += $subtotal;

            $this->modelTrans->insert([
                'hdr_id' => $id_trx,
                'item_id' => $item['id'],
                'harga' => $item['harga'],
                'qty' => $item['qty'],
                'subtotal' => $subtotal
            ]);

            // Update Stock
            $this->modelItem->update($item['id'], ['stok' => $p['stok'] - $item['qty']]);
        }

        $this->modelHdr->insert([
            'hdr_id' => $id_trx,
            'kdcab' => $this->user_cabang,
            'total_nominal' => $total,
            'user' => $this->userId
        ]);

        return $this->response
            ->setHeader('X-CSRF-TOKEN', csrf_hash()) // Tambahkan header CSRF untuk sinkronisasi AJAX
            ->setJSON([
                'status' => 'success',
                'message' => 'Transaction saved successfully',
                'trx_id' => $id_trx
            ]);
    }

    public function inventory()
    {
        $db = \Config\Database::connect();
        $branch = $db->table('cabang')->where('id', $this->user_cabang)->get()->getRow();

        $data = [
            'title' => 'Manajemen Stok F&B',
            'items' => $this->modelItem->get_items($this->user_cabang),
            'cabang' => $this->user_cabang,
            'cabang_nama' => $branch ? $branch->nama : 'Semua Cabang',
        ];

        return view('modules/pos/pos_items', $data);
    }

    public function item_save()
    {
        $id = $this->request->getPost('iditem');
        $nama = $this->request->getPost('nama');
        $harga = $this->request->getPost('harga');
        $kat = $this->request->getPost('idkat');
        $stok = $this->request->getPost('stok');

        if (!$id) {
            $id = $this->modelItem->generate_id($this->user_cabang);
        }

        $data = [
            'iditem' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok,
            'idkat' => $kat,
            'kdcab' => $this->user_cabang,
            'user' => $this->userId
        ];

        $this->modelItem->replace($data);

        session()->setFlashdata('pesan', '<div class="alert alert-success">Item saved successfully</div>');
        return redirect()->to('/pos/inventory');
    }

    public function item_delete($id)
    {
        $this->modelItem->delete($id);
        session()->setFlashdata('pesan', '<div class="alert alert-success">Item deleted successfully</div>');
        return redirect()->to('/pos/inventory');
    }

    public function report()
    {
        $db = \Config\Database::connect();
        $dateSatu = $this->request->getVar('date_satu') ?? date('Y-m-d');
        $dateDua = $this->request->getVar('date_dua') ?? date('Y-m-d');

        $builder = $db->table('fnb_hdr h');
        $builder->select('h.*, t.qty, t.harga as current_price, i.nama as item_nama, c.nama as cabang_nama');
        $builder->join('fnb_trans t', 't.hdr_id = h.hdr_id');
        $builder->join('fnb_item i', 'i.iditem = t.item_id');
        $builder->join('cabang c', 'c.id = h.kdcab', 'left');
        
        if ($this->user_cabang != '%') {
            $builder->where('h.kdcab', $this->user_cabang);
        }
        $builder->where('DATE(h.created_at) >=', $dateSatu);
        $builder->where('DATE(h.created_at) <=', $dateDua);
        $builder->orderBy('h.created_at', 'DESC');
        
        $results = $builder->get()->getResult();

        $data = [
            'title' => 'Laporan Penjualan POS',
            'results' => $results,
            'date_satu' => $dateSatu,
            'date_dua' => $dateDua,
        ];

        return view('modules/pos/pos_report', $data);
    }
}
