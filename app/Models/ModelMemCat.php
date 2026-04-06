<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMemCat extends Model
{
    protected $table            = 'membership_cat';
    protected $primaryKey       = 'catid';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['catid', 'catname', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'catname' => 'required|is_unique[membership_cat.catname]|max_length[50]'
    ];
    protected $validationMessages   = [
        'catname' => [
            'required' => 'Harus di isi',
            'is_unique' => '{value} sudah ada, ganti nama lain',
            'max_length' => 'Max 25 karakter'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function get_category($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['catid' => $id])->first();
    }
}
