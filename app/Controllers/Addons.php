<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAddons;

class Addons extends BaseController
{
    protected $modeladdon;

    public function __construct()
    {
        $this->modeladdon = new ModelAddons();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Addon',
            'addons' => $this->modeladdon->get_addon(),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        return view('modules/addon/addon_list', $data);
    }
}
