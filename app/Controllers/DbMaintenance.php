<?php

namespace App\Controllers;

use App\Models\Model_usermenu;

class DbMaintenance extends BaseController
{
    public function list_menus()
    {
        $model = new Model_usermenu();
        $menus = $model->findAll();
        foreach ($menus as $m) {
            echo "ID: {$m['MenuID']} | Name: {$m['Name']} | Link: {$m['Link']} | Level: {$m['Level']}\n";
        }
    }
}
