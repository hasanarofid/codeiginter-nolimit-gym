<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFnbHdr extends Model
{
    protected $table            = 'fnb_hdr';
    protected $primaryKey       = 'hdr_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['hdr_id', 'kdcab', 'total_nominal', 'payment_method', 'user'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generate_id($cabang)
    {
        // Format: TRX-{CAB}-{YMD}-{SEQ}
        $date = date('ymd');
        $prefix = "TRX" . $cabang . $date;
        
        $builder = $this->db->table($this->table);
        $builder->select('RIGHT(hdr_id, 4) as kode', false);
        $builder->where('kdcab', $cabang);
        $builder->like('hdr_id', $prefix, 'after');
        $builder->orderBy('hdr_id', 'DESC');
        $builder->limit(1);
        $query = $builder->get();

        if ($query->getNumRows() <> 0) {
            $data = $query->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = $prefix . $batas;
        return $kodetampil;
    }
}
