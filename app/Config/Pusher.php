<?php

namespace Config;

class Pusher
{
    public $options = [
        'cluster' => 'ap1', // Ganti sesuai cluster aplikasi Anda
        'useTLS' => true,
    ];

    public $authKey = '56dbcda0648861a7ea6c';      // Ganti dengan APP_KEY Pusher Anda
    public $secret = '71719e9e417dd7cbf910';   // Ganti dengan APP_SECRET Pusher Anda
    public $appId = '1904623';        // Ganti dengan APP_ID Pusher Anda
}
