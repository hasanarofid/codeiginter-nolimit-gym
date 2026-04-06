<?php

namespace App\Controllers;

class NotificationController extends BaseController
{
    /**
     * Contoh penggunaan pusher untuk notifikasi
     */
    public function sendNotification()
    {
        $title = $this->request->getPost('title');
        $message = $this->request->getPost('message');

        $data = [
            'title' => $title,
            'message' => $message,
        ];

        sendPusherNotification('my-channel', 'my-event', $data);

        return $this->response->setJSON(['status' => 'success']);
    }
}
