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

    $pusher->trigger($channel, $event, $data);
}
