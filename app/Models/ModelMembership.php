<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMembership extends Model
{
    protected $table            = 'membership';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nama', 'nominal', 'expired', 'deskripsi', 'user', 'catid', 'kota','deleted_at'];

    // protected bool $allowEmptyInserts = false;

    // // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => 'required|max_length[100]',
        'catid' => 'required',
        'kota' => 'required',
        'nominal' => 'required|integer',
        'expired' => 'required|integer',
    ];
    protected $validationMessages   = [
        'nama' => [
            'required' => '{field} harus di isi',
            'max_length' => 'Karakter {field} tidak boleh lebih dari {value}'
        ],
        'catid' => [
            'required' => '{field} harus di pilih',
        ],
        'kota' => [
            'required' => '{field} harus di pilih',
        ],
        'nominal' => [
            'required' => '{field} harus di isi',
            'integer' => '{field} menggunakan angka bulat'
        ],
        'expired' => [
            'required' => '{field} harus di isi',
            'integer' => '{field} menggunakan angka bulat'
        ]
    ];
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

    public function get_membership($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function get_membership_public()
    {
        $this->where('id !=', 'MBS1024001'); // kecuali pervisit (MBS1024001)
        return $this->findAll();
    }

    public function get_mem_by_cat($idcat)
    {
        $this->whereNotIn('expired', [0]);
        $this->where('catid', $idcat);
        return $this->findAll();
    }

    public function get_cat_pkg($kota)
    {
        $builder = $this->db->query("SELECT membership.catid, membership_cat.catname 
                    FROM membership, membership_cat
                    WHERE
                    membership.catid = membership_cat.catid
                    AND
                    membership.deleted_at IS NULL
                    AND
                    membership.kota = '$kota'
                    GROUP BY membership.catid
                    ORDER BY membership.catid ASC");
        return $builder->getResultArray();
    }

    public function package_by_cat_kota($cat, $kota)
    {
        $builder = $this->db->query("SELECT membership.catid, membership_cat.catname, membership.nama, membership.kota, membership.nominal, membership.expired, membership.deskripsi  
                    FROM membership, membership_cat
                    WHERE
                    membership.catid = membership_cat.catid
                    AND
                    membership.deleted_at IS NULL
                    AND
                    membership.kota =  '$kota'
                    AND
                    membership.catid = $cat");
        return $builder->getResultArray();
    }

    public function get_join_paket()
    {
        $builder = $this->db->table($this->table);
        $builder->select("membership.id, membership.nama, membership.kota, membership.nominal, membership.expired, membership.deskripsi, membership_cat.catname");
        $builder->join('membership_cat', 'membership_cat.catid = membership.catid', 'left');
        $builder->where('membership.deleted_at IS NULL');
        $builder->orderBy('membership.id', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function get_count()
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(id) AS jml");
        return $builder->get()->getRow();
    }

    public function pkgByKota($kota)
    {
        $builder = $this->db->table($this->table);
        $builder->select('membership.id, membership.nama, membership.nominal,membership_cat.catname AS category');
        $builder->join('membership_cat', 'membership_cat.catid = membership.catid', 'left');
        $builder->where('membership.kota', $kota);
        $builder->where('membership.expired != 0');
        $builder->where('membership.deleted_at IS NULL');
        return $builder->get()->getResultArray();
    }

    public function pkgPervisit($kota)
    {
        $builder = $this->db->table($this->table);
        $builder->select("membership.id, CONCAT(membership_cat.catname,' ', membership.nama, ' - ',membership.kota) AS paket, membership.nominal");
        $builder->join('membership_cat', 'membership_cat.catid = membership.catid', 'left');
        $builder->where('membership.kota', $kota);
        $builder->where('membership.expired = 0');
        $builder->where('membership.deleted_at IS NULL');
        return $builder->get()->getResultArray();
    }
}
