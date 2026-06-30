<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_notification extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kdcab', 'title', 'message', 'link', 'is_read', 'created_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function getUnreadCount($kdcab)
    {
        $builder = $this->builder();
        $builder->where('is_read', 0);
        if ($kdcab != '%') {
            $builder->where('kdcab', $kdcab);
        }
        return $builder->countAllResults();
    }

    public function getUnreadNotifications($kdcab, $limit = 5)
    {
        $builder = $this->builder();
        $builder->where('is_read', 0);
        if ($kdcab != '%') {
            $builder->where('kdcab', $kdcab);
        }
        $builder->orderBy('created_at', 'DESC');
        if ($limit > 0) {
            $builder->limit($limit);
        }
        return $builder->get()->getResult();
    }

    public function getAllNotifications($kdcab)
    {
        $builder = $this->builder();
        if ($kdcab != '%') {
            $builder->where('kdcab', $kdcab);
        }
        $builder->orderBy('created_at', 'DESC');
        return $builder->get()->getResult();
    }

    public function markAllAsRead($kdcab)
    {
        $builder = $this->builder();
        if ($kdcab != '%') {
            $builder->where('kdcab', $kdcab);
        }
        $builder->where('is_read', 0);
        return $builder->update(['is_read' => 1]);
    }
}
