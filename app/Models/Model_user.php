<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_user extends Model
{
    protected $table        = 'user';
    protected $primaryKey   = 'UserID';
    protected $returnType   = "object";
    // protected $useTimestamps = true;
    protected $allowedFields = ['UserID', 'Password', 'Nama', 'UserGroup', 'LastActivity', 'LastIP', 'CurrentActivity', 'CurrentIP', 'CreatedDate', 'CreatedBy', 'Ket', 'kdcab', 'token', 'token_created_at'];

    public function get_user($userid = false)
    {
        if ($userid == false) {
            return $this->findAll();
        }

        return $this->where(['UserID' => $userid])->first();
    }
    
    public function hitung_user($userid){
        $bld = $this->table($this->table);
        $bld->where('UserID', $userid);
        return $bld->get()->getNumRows();
    }

    function get_login($username)
    {
        $builder = $this->table($this->table);
        $builder->where('UserID', $username);
        return $builder->get()->getRow();
    }

    // lupa password untuk member

    public function getByToken($token)
    {
        return $this->where(['token' => $token])->first();
    }

    public function updatePassword($email, $token, $newPassword)
    {
        // Update password berdasarkan email
        return $this->db->table($this->table) // Ganti 'users' dengan nama tabel Anda
            ->where('UserID', $email)
            ->where('token', $token)
            ->update(['Password' => $newPassword]);
    }
}
