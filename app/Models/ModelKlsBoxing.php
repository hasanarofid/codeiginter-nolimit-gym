<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKlsBoxing extends Model
{
    protected $table            = 'kelas_boxing';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'kdcab', 'nama', 'hari', 'jam_mulai', 'jam_akhir', 'trainer', 'created_at', 'updated_at', 'deleted_at', 'user'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_boxing($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function jadwal_boxing($id = false, $cabang = false)
    {
        $builder =  $this->db->table($this->table);

        $builder->select("kelas_boxing.id, kelas_boxing.nama, kelas_boxing.hari, kelas_boxing.jam_mulai, kelas_boxing.jam_akhir, kelas_boxing.kdcab, kelas_boxing.trainer, cabang.nama AS nmcab, trainer.nama AS nmtrainer");
        $builder->join('cabang', 'cabang.id = kelas_boxing.kdcab', 'left');
        $builder->join('trainer', 'trainer.id = kelas_boxing.trainer', 'left');

        if (($cabang != false) && ($cabang != '%')) {
            $builder->where('cabang.id', $cabang);
        }

        if ($id == false) {
            $builder->orderBy('kelas_boxing.id', 'DESC');
            return $builder->get()->getResultArray();
        } else {
            $builder->where('kelas_boxing.id', $id);
            return $builder->get()->getRow();
        }
    }

    // start halaman home
    public function tabel_bothai($cabang)
    {
        $sql = "SELECT 
                ROW_NUMBER() OVER () AS No,
                CONCAT(b.jam_mulai, ' - ', b.jam_akhir) AS Waktu,
                MAX(CASE WHEN b.hari = 'Senin' THEN CONCAT( '<h4>',b.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Senin,
                MAX(CASE WHEN b.hari = 'Selasa' THEN CONCAT('<h4>',b.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Selasa,
                MAX(CASE WHEN b.hari = 'Rabu' THEN CONCAT('<h4>',b.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Rabu,
                MAX(CASE WHEN b.hari = 'Kamis' THEN CONCAT('<h4>',b.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Kamis,
                MAX(CASE WHEN b.hari = 'Jumat' THEN CONCAT('<h4>',b.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Jumat,
                MAX(CASE WHEN b.hari = 'Sabtu' THEN CONCAT('<h4>',b.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Sabtu,
                MAX(CASE WHEN b.hari = 'Minggu' THEN CONCAT('<h4>',b.nama, '</h4><br /> ', t.nama) ELSE '' END) AS Minggu
            FROM 
                kelas_boxing b
            LEFT JOIN 
                trainer t ON b.trainer = t.id
            WHERE b.kdcab = '$cabang'
            GROUP BY 
                b.jam_mulai, b.jam_akhir
            ORDER BY
                b.jam_mulai, b.jam_akhir";

        return $this->db->query($sql)->getResultArray();
    }
    // end halaman home

    public function get_count()
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(id) AS jml");
        return $builder->get()->getRow();
    }
}
