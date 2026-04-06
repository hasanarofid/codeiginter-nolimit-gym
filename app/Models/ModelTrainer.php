<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTrainer extends Model
{
    protected $table            = 'trainer';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'kdcab', 'jenis', 'nama', 'alamat', 'hp', 'foto'];

    // protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // // Validation
    protected $validationRules      = [
        'kdcab' => 'required',
        'nama' => 'required|max_length[100]',
        'jenis' => 'required',
        'alamat' => 'required',
        'hp' => 'required|max_length[20]',
    ];
    protected $validationMessages   = [
        'kdcab' => [
            'required' => '{field} Harus di isi',
        ],
        'nama' => [
            'required' => '{field} Harus di isi',
            'maxlength' => 'Panjang karakter {field} max {value}',
        ],
        'jenis' => [
            'required' => '{field} Harus di pilih',
        ],
        'alamat' => [
            'required' => '{field} Harus di isi'
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

    public function get_trainer($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function get_jenis($jenis = false)
    {

        return $this->where(['jenis' => $jenis])->findAll();
    }

    public function get_trainer_oncab($kdcab = false, $jenis = false)
    {
        $build = $this->db->table($this->table);
        $build->select("trainer.id, trainer.nama, trainer.jenis, trainer.hp, trainer.foto, cabang.nama AS nmcab");
        $build->join('cabang', 'trainer.kdcab = cabang.id', 'left');
        if ($kdcab != '%') {
            $build->where('cabang.id', $kdcab);
        }
        $build->where('trainer.deleted_at IS NULL');

        if ($jenis != false) {
            $build->where('trainer.jenis', $jenis);
        }
        return $build->get()->getResultArray();
    }

    public function get_count()
    {
        $builder = $this->db->table($this->table);
        $builder->select("COUNT(id) AS jml");
        return $builder->get()->getRow();
    }
}
