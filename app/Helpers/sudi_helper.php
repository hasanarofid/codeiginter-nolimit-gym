<?php

use App\Models\Model_usergroup;

function get_crud_access($ci, $groupid)
{
    $ci->crud_access = new Model_usergroup();

    $my_crud_access = $ci->crud_access->get_usergroup($groupid);

    return $my_crud_access['crud'];
}
