<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_customer extends Model
{
    protected $table        = 'customers';
    protected $primaryKey   = 'id';
    // protected $returnType   = "object";
    protected $useSoftDeletes   = true;
    protected $allowedFields = ['id', 'kdcab', 'noktp', 'nama', 'tgl_lhr', 'hp_wa', 'email', 'alamat', 'barcode', 'password', 'idcard_image', 'fp_image', 'user'];

    // // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_customer($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getByCabang($cabang)
    {
        if ($cabang != '%') {
            $this->where(['kdcab' => $cabang]);
        }
        return $this->findAll();
    }

    public function get_count($kdcab)
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(id) AS jml");
        $builder->where('kdcab', $kdcab);
        return $builder->get()->getRow();
    }

    public function get_by_cabang($kdcab)
    {
        $bb = $this->db->table($this->table);
        $bb->select('*');
        if ($kdcab != '%') {
            $bb->where('kdcab', $kdcab);
        }
        return $bb->get()->getResult();
    }

    public function get_by_email($email)
    {
        return $this->where(['email' => $email])->first();
    }

    public function generateID($kdcab)
    {
        $lastId = $this->get_count($kdcab)->jml;
        $lastId += 1;

        $newId = $kdcab . str_pad($lastId, 4, '0', STR_PAD_LEFT);

        return $newId;
    }
}
