<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_usermenu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'MenuID';
    // protected $returnType = 'object';
    protected $allowedFields = ['MenuID', 'Name', 'Icon', 'Seq', 'Level', 'Active', 'Public', 'Link'];
    //protected $useTimestamps = true;

    function get_all($menuid = false)
    {
        if ($menuid == false) {
            return $this->orderBy('MenuID', 'ASC')->findAll();
        }

        return $this->where(['MenuID' => $menuid])->first();
    }

    public function get_menu($user)
    {
        $builder = $this->db->table($this->table);
        $builder->select("menu.MenuID,Name,Link,Icon,fnGetSubMenuCount(MenuID) Sub");
        $builder->where('Level', 1);
        $builder->where('Active', 1);
        $builder->where("(fnGetUserMenuAccess ('$user',MenuID) >= 1 OR fnGetSubMenuAccessCount('$user',MenuID)>=1)");
        $builder->where("fnGetSubMenuAccessCount('$user',MenuID)>=CASE WHEN fnGetSubMenuCount(MenuID)>0 THEN 1 ELSE 0 END");
        $builder->orderBy('Seq');

        return $builder->get()->getResult();
    }

    public function get_child($menuid, $user)
    {
        $builder = $this->db->table($this->table);
        $builder->select("MenuID,Name,Link,Icon,fnGetSubMenuCount(MenuID) Sub");
        $builder->where("LEFT(MenuID,2)='$menuid'");
        $builder->where('Level', 2);
        $builder->where('Active', 1);
        $builder->where("(fnGetUserMenuAccess ('$user',MenuID) >= 1  OR fnGetSubMenuAccessCount('$user',MenuID)>=1)");
        $builder->where("fnGetSubMenuAccessCount('$user',MenuID)>=CASE WHEN fnGetSubMenuCount(MenuID)>0 THEN 1 ELSE 0 END");
        $builder->orderBy('Seq');

        return $builder->get()->getResult();
    }

    public function get_usermenu()
    {
        $builder = $this->db->table('usermenu');
        $builder->select('menu.MenuID, menu.Name, userid');
        $builder->join('menu', 'menu.MenuID = usermenu.menuid', 'left');

        return $builder->get()->getResult();
    }

    public function insert_usermenu($data)
    {
        $builder = $this->db->table('usermenu');
        $builder->insert($data);
    }
}
