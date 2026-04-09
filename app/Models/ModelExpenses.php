<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelExpenses extends Model
{
    protected $table            = 'pengeluaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['kdcab', 'tgl', 'kategori', 'keterangan', 'nominal', 'user'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_expenses($cabang = null)
    {
        $builder = $this->db->table($this->table);
        if ($cabang && $cabang != '%') {
            $builder->where('kdcab', $cabang);
        }
        $builder->where('deleted_at', null);
        $builder->orderBy('tgl', 'DESC');
        return $builder->get()->getResult();
    }
}
