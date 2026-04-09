<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFnbItem extends Model
{
    protected $table            = 'fnb_item';
    protected $primaryKey       = 'iditem';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['iditem', 'idkat', 'kdcab', 'nama', 'harga', 'stok', 'user'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_items($cabang = null)
    {
        $builder = $this->db->table($this->table . ' i');
        $builder->select('i.*, k.nama as kategori_nama');
        $builder->join('fnb_kategori k', 'k.id = i.idkat', 'left');
        if ($cabang && $cabang != '%') {
            $builder->where('i.kdcab', $cabang);
        }
        $builder->where('i.deleted_at', null);
        return $builder->get()->getResult();
    }

    public function generate_id($cabang)
    {
        $builder = $this->db->table($this->table);
        $builder->select('RIGHT(iditem, 4) as kode', false);
        $builder->where('kdcab', $cabang);
        $builder->orderBy('iditem', 'DESC');
        $builder->limit(1);
        $query = $builder->get();

        if ($query->getNumRows() <> 0) {
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = $cabang . "ITM" . $batas;
        return $kodetampil;
    }
}
