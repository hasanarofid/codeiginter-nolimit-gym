<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelVisitor extends Model
{
    protected $table            = 'member_visit';
    protected $primaryKey       = 'idx';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['idx', 'idmember', 'cabang', 'locker', 'handuk', 'user', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callback untuk sebelum insert
    protected $beforeInsert = ['removeUpdatedAt'];

    public function get_visitor($id, $cabang, $start_date = null, $end_date = null)
    {
        $bld = $this->db->table($this->table);
        $bld->select('member_visit.*, customers.id, customers.nama');
        $bld->join('customers', 'customers.id = member_visit.idmember', 'left');

        if ($cabang != '%') {
            $bld->where('member_visit.cabang', $cabang);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $bld->where('DATE(member_visit.created_at) >=', $start_date);
            $bld->where('DATE(member_visit.created_at) <=', $end_date);
        } elseif (!empty($start_date)) {
            $bld->where('DATE(member_visit.created_at)', $start_date);
        } else {
            $bld->where('DATE(member_visit.created_at) = DATE(CURDATE())');
        }

        if (($id != false) || ($id != null)) {
            $bld->where('customers.id', $id);
            return $bld->get()->getRow();
        }

        $bld->orderBy('member_visit.created_at', 'DESC');
        return $bld->get()->getResult();
    }

    // Fungsi untuk menghapus updated_at saat insert
    protected function removeUpdatedAt(array $data)
    {
        if (isset($data['data']['updated_at'])) {
            unset($data['data']['updated_at']);
        }
        return $data;
    }

    public function getFirstVisit($idmember, $cabang)
    {
        return $this->where('idmember', $idmember)
            ->where('cabang', $cabang)
            ->orderBy('created_at', 'ASC')
            ->first();
    }
}
