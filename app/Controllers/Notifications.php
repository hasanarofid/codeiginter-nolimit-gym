<?php

namespace App\Controllers;

use App\Models\Model_notification;

class Notifications extends BaseController
{
    protected $modelnotification;

    public function __construct()
    {
        $this->modelnotification = new Model_notification();
    }

    public function index()
    {
        $data = [
            'title' => 'Notifications',
            'notifications' => $this->modelnotification->getAllNotifications($this->user_cabang),
        ];

        return view('modules/notifications/index', $data);
    }

    public function readAll()
    {
        $this->modelnotification->markAllAsRead($this->user_cabang);
        
        session()->setFlashdata('pesan', '<div class="alert alert-success">Semua notifikasi telah ditandai sebagai dibaca.</div>');
        return redirect()->back();
    }
}
