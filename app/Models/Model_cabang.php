<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_cabang extends Model
{
    protected $table        = 'cabang';
    protected $primaryKey   = 'id';
    // protected $returnType   = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nama', 'alamat', 'telp', 'hp', 'email', 'sosmed', 'kota', 'bank_name', 'bank_rek', 'bank_acc_an'];
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'nama' => 'required|max_length[255]',
        'telp' => 'required|max_length[20]',
        'alamat' => 'required',
        'kota' => 'required',
        'hp'   => 'required|max_length[20]',
        'email' => 'required|valid_email',
        'bank_name' => 'required',
        'bank_rek' => 'required',
        'bank_acc_an' => 'required'
    ];

    public function get_cabang($id = false)
    {
        if ($id == '%') {
            $this->orderBy('id', 'DESC');
            return $this->findAll();
        } else if ($id != '%') {
            $this->where(['id' => $id]);
            $this->orderBy('id', 'DESC');
            return $this->findAll();
        }
    }

    public function get_kota()
    {
        $builder = $this->db->table($this->table);
        $builder->distinct('kota');
        $builder->groupBy('kota');
        $builder->orderBy('kota', 'ASC');

        return $builder->get()->getResult();
    }

    public function get_detail($id)
    {
        $builder = $this->db->table($this->table);
        // $builder->select("*");
        $builder->where('id', $id);
        return $builder->get()->getRow();
    }

    public function get_count()
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(id) AS jml");
        return $builder->get()->getRow();
    }
}
