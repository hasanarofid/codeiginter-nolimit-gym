<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMemtrans extends Model
{
    protected $table            = 'membership_trans';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'custid', 'membershipid', 'nominal', 'payment_method', 'payment_date', 'payment_bill', 'expired_date', 'status', 'user', 'payment_type', 'transaction_time', 'transaction_status', 'bank', 'va_number'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function get_data($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function get_by_custid($custid)
    {
        $builder = $this->db->table($this->table);
        $builder->select('membership_trans.*, membership.nama');
        $builder->join('membership', 'membership.id = membership_trans.membershipid', 'left');
        $builder->where('membership_trans.custid', $custid);
        return $builder->get()->getResult();
    }

    public function get_expired($custid)
    {
        $builder = $this->db->table($this->table);
        $builder->select('membership_trans.*, membership.nama');
        $builder->join('membership', 'membership.id = membership_trans.membershipid', 'left');
        $builder->where('membership_trans.custid', $custid);
        $builder->where('membership_trans.status', 1);
        return $builder->get()->getRow();
    }

    public function kadaluarsa($custid)
    {
        $builder = $this->db->table($this->table);
        $builder->select('membership_trans.*, membership.nama');
        $builder->join('membership', 'membership.id = membership_trans.membershipid', 'left');
        $builder->where('membership_trans.custid', $custid);
        $builder->where('membership_trans.status', 1);
        return $builder->get()->getRow();
    }

    public function get_count()
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(id) AS jml");
        $builder->where("DATE_FORMAT(created_at, '%Y') = YEAR(CURRENT_DATE)");
        return $builder->get()->getRow();
    }

    public function earnings_this_month($cabang)
    {
        $b = $this->table($this->table);
        $b->select('SUM(nominal) as total');
        $b->where('MONTH(payment_date) = MONTH(CURDATE())');
        if ($cabang != '%') {
            $b->like('id', $cabang, 'after');
        }

        return $b->get()->getRow();
    }

    public function earnings_this_year($cabang)
    {
        $b = $this->table($this->table);
        $b->select('SUM(nominal) as total');
        $b->where('YEAR(payment_date) = YEAR(CURDATE())');

        if ($cabang != '%') {
            $b->like('id', $cabang, 'after');
        }

        return $b->get()->getRow();
    }

    public function get_pending_request($cabang)
    {
        $v = $this->table($this->table);
        $v->select('COUNT(id) AS jml');
        $v->where('status', 0);

        if ($cabang != '%') {
            $v->like('id', $cabang, 'after');
        }
        return $v->get()->getRow();
    }

    public function get_member_active($cabang)
    {
        $v = $this->table($this->table);
        $v->select('COUNT(id) AS jml');
        $v->where('status', 1);

        if ($cabang != '%') {
            $v->like('id', $cabang, 'after');
        }
        return $v->get()->getRow();
    }


    public function get_member_pending($cabang)
    {
        $v = $this->table($this->table);
        // $v->select('*');
        $v->where('status', 0);

        if ($cabang != '%') {
            $v->like('id', $cabang, 'after');
        }
        return $v->get()->getResult();
    }

    public function get_mem_trans($cabang = null, $start_date = null, $end_date = null)
    {
        $db = db_connect();
        $d = $db->table($this->table . ' m'); // Tambahkan alias 'm' untuk tabel utama
        $d->select("m.id AS idtx, k.id AS custid, k.nama AS nmcust, CONCAT(mc.catname,' ', p.nama) AS pkgname, m.payment_date, m.nominal, m.expired_date, m.status,m.payment_type, c.id AS idcab, c.nama AS nmcab");
        $d->join('customers k', 'k.id = m.custid', 'left');
        $d->join('cabang c', 'c.id = k.kdcab', 'left');
        $d->join('membership p', 'p.id = m.membershipid', 'left');
        $d->join('membership_cat mc', 'mc.catid = p.catid', 'left');

        if ($cabang != '%') {
            $d->where('c.id', $cabang);
        }

        if ($start_date && $end_date) {
            $d->where('m.payment_date >=', $start_date);
            $d->where('m.payment_date <=', $end_date);
        }

        $d->orderBy('m.payment_date', 'desc');

        /**
        // Cetak query SQL sebelum dieksekusi
        echo $d->getCompiledSelect();
        exit; // Hentikan eksekusi agar query dapat dilihat
         */

        return $d->get()->getResult();
    }

    public function get_perpanjangan($cabang = null)
    {
        $db =  db_connect();
        $bd = $db->table($this->table . ' mt');
        $bd->select("c.id AS idcust, b.nama AS cabang, c.nama AS nmcust, c.hp_wa, CONCAT(mc.catname,' ',m.nama) AS pkgname, DATEDIFF(mt.expired_date,now()) AS expired_day, b.id AS branchid");
        $bd->join('customers c', 'c.id = mt.custid', 'left');
        $bd->join('membership m', 'm.id = mt.membershipid', 'left');
        $bd->join('membership_cat mc', 'mc.catid = m.catid', 'left');
        $bd->join('cabang b', 'b.id = c.kdcab', 'left');
        $bd->where('mt.status', 1);

        if ($cabang != '%') {
            $bd->where('b.id', $cabang);
        }

        $bd->where('DATEDIFF(mt.expired_date,now()) <= 14'); // menampilkan mulai 2 minggu 

        $bd->orderBy('DATEDIFF(mt.expired_date,now()) ASC');

        /*
        // Cetak query SQL sebelum dieksekusi
        echo $bd->getCompiledSelect();
        exit; // Hentikan eksekusi agar query dapat dilihat
        */

        return $bd->get()->getResult();
    }

    public function ubah_status($custid, $id, $data)
    {
        $db = db_connect();
        $d = $db->table($this->table);
        $d->where('custid', $custid);
        $d->whereNotIn('id', [$id]);
        $d->update($data);
    }
}
