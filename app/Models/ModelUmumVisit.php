<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUmumVisit extends Model
{
    protected $table            = 'nonmember_visit';
    protected $primaryKey       = 'idx';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['idx', 'nama', 'cabang', 'locker', 'handuk', 'user', 'created_at', 'updated_at', 'deleted_at', 'nominal', 'payment_method', 'paket_id'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callback untuk sebelum insert
    protected $beforeInsert = ['removeUpdatedAt'];

    public function get_visitor($cabang)
    {
        if ($cabang != '%') {
            $this->where('cabang', $cabang);
        }
        return $this->findAll();
    }

    // Fungsi untuk menghapus updated_at saat insert
    protected function removeUpdatedAt(array $data)
    {
        if (isset($data['data']['updated_at'])) {
            unset($data['data']['updated_at']);
        }
        return $data;
    }

    public function get_umum_trans($cabang = null, $start_date = null, $end_date = null)
    {
        $db = db_connect();
        $d = $db->table($this->table . ' m'); // Tambahkan alias 'm' untuk tabel utama
        $d->select("m.idx AS idtx, m.nama AS nmcust, CONCAT(mc.catname,' ', p.nama) AS pkgname, m.created_at, m.nominal, m.payment_method, c.id AS idcab, c.nama AS nmcab");
        $d->join('cabang c', 'c.id = m.cabang', 'left');
        $d->join('membership p', 'p.id = m.paket_id', 'left');
        $d->join('membership_cat mc', 'mc.catid = p.catid', 'left');

        if ($cabang != '%') {
            $d->where('c.id', $cabang);
        }

        if ($start_date && $end_date) {
            $d->where('DATE(m.created_at) >=', $start_date);
            $d->where('DATE(m.created_at) <=', $end_date);
        }

        $d->orderBy('DATE(m.created_at)', 'desc');

        /**
        // Cetak query SQL sebelum dieksekusi
        echo $d->getCompiledSelect();
        exit; // Hentikan eksekusi agar query dapat dilihat
         */

        return $d->get()->getResult();
    }
}
