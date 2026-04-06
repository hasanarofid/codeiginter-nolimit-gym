<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_usergroup extends Model
{
    protected $table        = 'user_group';
    protected $primaryKey   = 'groupid';
    protected $returnType   = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['groupid', 'nama', 'urut', 'dashboard_path', 'crud', 'created_at', 'updated_at', 'deleted_at'];

    function get_group($groupid = false)
    {
        if ($groupid == false) {
            return $this->findAll();
        }

        return $this->where(['groupid' => $groupid])->first();
    }
}
