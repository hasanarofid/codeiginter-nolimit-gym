<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelas extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'kdcab', 'nama', 'hari', 'jam_mulai', 'jam_akhir', 'trainer', 'created_at', 'updated_at', 'deleted_at', 'user'];

    // protected bool $allowEmptyInserts = false;

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // validation yang di set pada model hanya berlaku untuk field yang ada pada var $allowedFields 

    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function get_kelas($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function jadwal_kelas($id = false, $cabang = false)
    {
        $builder =  $this->db->table($this->table);

        $builder->select("kelas.id, kelas.nama, kelas.hari, kelas.jam_mulai, kelas.jam_akhir, kelas.kdcab, kelas.trainer, cabang.nama AS nmcab, trainer.nama AS nmtrainer");
        $builder->join('cabang', 'cabang.id = kelas.kdcab', 'left');
        $builder->join('trainer', 'trainer.id = kelas.trainer', 'left');

        if (($cabang != false) && ($cabang != '%')) {
            $builder->where('cabang.id', $cabang);
        }

        if ($id == false) {
            $builder->orderBy('kelas.id', 'DESC');
            return $builder->get()->getResultArray();
        } else {
            $builder->where('kelas.id', $id);
            return $builder->get()->getRow();
        }
    }

    public function tabel_kelas($cabang)
    {
        // $db = db_connect();

        $sql = "SELECT 
                ROW_NUMBER() OVER () AS No,
                CONCAT(k.jam_mulai, ' - ', k.jam_akhir) AS Waktu,
                MAX(CASE WHEN k.hari = 'Senin' THEN CONCAT( '<h4>',k.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Senin,
                MAX(CASE WHEN k.hari = 'Selasa' THEN CONCAT('<h4>',k.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Selasa,
                MAX(CASE WHEN k.hari = 'Rabu' THEN CONCAT('<h4>',k.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Rabu,
                MAX(CASE WHEN k.hari = 'Kamis' THEN CONCAT('<h4>',k.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Kamis,
                MAX(CASE WHEN k.hari = 'Jumat' THEN CONCAT('<h4>',k.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Jumat,
                MAX(CASE WHEN k.hari = 'Sabtu' THEN CONCAT('<h4>',k.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Sabtu,
                MAX(CASE WHEN k.hari = 'Minggu' THEN CONCAT('<h4>',k.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Minggu
            FROM 
                kelas k
            JOIN 
                trainer t ON k.trainer = t.id
            WHERE k.kdcab = '$cabang'
            GROUP BY 
                k.jam_mulai, k.jam_akhir
            ORDER BY
                k.jam_mulai, k.jam_akhir";

        return $this->db->query($sql)->getResultArray();
    }

    public function get_count()
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(id) AS jml");
        return $builder->get()->getRow();
    }
}
