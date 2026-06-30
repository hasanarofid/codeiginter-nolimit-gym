<?php

use Pusher\Pusher;

function sendPusherNotification($channel, $event, $data)
{
    $config = new \Config\Pusher();

    $pusher = new Pusher(
        $config->authKey,
        $config->secret,
        $config->appId,
        $config->options
    );

    // Save to database
    $db = \Config\Database::connect();
    $db->table('notifications')->insert([
        'kdcab'      => $data['kdcab'] ?? '%',
        'title'      => $data['title'] ?? 'Notification',
        'message'    => $data['message'] ?? '',
        'link'       => $data['link'] ?? '#',
        'is_read'    => 0,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    $pusher->trigger($channel, $event, $data);
}
