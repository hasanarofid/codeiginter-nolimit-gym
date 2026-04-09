<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFnbTrans extends Model
{
    protected $table            = 'fnb_trans';
    protected $protectFields    = true;
    protected $allowedFields    = ['hdr_id', 'item_id', 'harga', 'qty', 'subtotal'];

    public function get_details($hdr_id)
    {
        $builder = $this->db->table($this->table . ' t');
        $builder->select('t.*, i.nama as item_nama');
        $builder->join('fnb_item i', 'i.iditem = t.item_id', 'left');
        $builder->where('t.hdr_id', $hdr_id);
        return $builder->get()->getResult();
    }
}
