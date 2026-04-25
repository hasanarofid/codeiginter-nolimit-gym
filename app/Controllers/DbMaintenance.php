<?php
namespace App\Controllers;
use Config\Database;

class DbMaintenance extends BaseController {
    public function cleanMenu() {
        $db = Database::connect();
        $db->query("UPDATE menu SET Active = 0 WHERE MenuID IN ('0301', '0302')");
        echo "Menu cleanup successful. IDs 0301 and 0302 deactivated.";
    }
}
