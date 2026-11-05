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

    public function getByCabang($cabang, $membership_status = null)
    {
        $today = date('Y-m-d');

        // Subquery untuk mendapatkan membership_trans terakhir yang aktif (status=1) dan belum dihapus
        $subQuery = "(SELECT custid, MAX(expired_date) AS max_expired_date FROM membership_trans WHERE status = 1 AND deleted_at IS NULL GROUP BY custid) mt";

        $builder = $this->db->table($this->table . ' c');
        $builder->select('c.*, mt.max_expired_date');
        $builder->join($subQuery, 'mt.custid = c.id', 'left');

        if ($cabang != '%') {
            $builder->where('c.kdcab', $cabang);
        }

        if ($membership_status === 'aktif') {
            $builder->where('mt.max_expired_date >=', $today);
        } elseif ($membership_status === 'tidak_aktif') {
            $builder->where('mt.max_expired_date <', $today);
        } elseif ($membership_status === 'na') {
            $builder->where('mt.max_expired_date IS NULL');
        }

        $builder->orderBy('c.id', 'ASC');
        $results = $builder->get()->getResultArray();

        // Tambahkan computed property 'membership_status' dan 'expired_date'
        foreach ($results as &$row) {
            $row['expired_date'] = $row['max_expired_date'];
            if (empty($row['max_expired_date'])) {
                $row['membership_status'] = 'N.A';
            } elseif ($row['max_expired_date'] >= $today) {
                $row['membership_status'] = 'aktif';
            } else {
                $row['membership_status'] = 'tidak_aktif';
            }
        }

        return $results;
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
        $builder = $this->db->table($this->table);
        $builder->select('id');
        $builder->where('kdcab', $kdcab);
        $builder->like('id', $kdcab, 'after');
        $builder->orderBy('id', 'DESC');
        $builder->limit(1);
        
        $row = $builder->get()->getRow();
        
        $lastId = 0;
        if ($row) {
            $lastId = (int) substr($row->id, strlen($kdcab));
        }
        $lastId += 1;

        $newId = $kdcab . str_pad($lastId, 4, '0', STR_PAD_LEFT);

        return $newId;
    }
}
