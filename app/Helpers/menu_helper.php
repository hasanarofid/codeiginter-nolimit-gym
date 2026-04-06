<?php

use App\Models\Model_usermenu;

function get_menu($ci, $user)
{
    $ci->user_menu = new Model_usermenu();
    $get_parent = $ci->user_menu->get_menu($user);

    $i = 1;
    foreach ($get_parent as $parent) {
        //echo "$parent->Name, $parent->Link";
        // $exp_id = explode(" ", strtolower($parent->Name));
        // $ids = implode("", $exp_id);

        if ($parent->Sub == 0) {
            $properties = 'class="nav-link" href="' . $parent->Link . '"';
        } else {
            $properties = 'class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropMenu' . $parent->MenuID . '" aria-expanded="true" aria-controls="controlLabel' . $parent->MenuID . '"';
        }
        $active = $i == 1 ? ' active' : '';

        echo '
        <li class="nav-item ' . $active . '">
            <a ' . $properties . '>
                <i class="' . $parent->Icon . ' fa-fw"></i>
                <span>' . $parent->Name . '</span>
            </a>';

        $childs = $ci->user_menu->get_child($parent->MenuID, $user);
        if ($childs) {
            echo '<div id="dropMenu' . $parent->MenuID . '" class="collapse" aria-labelledby="menuLabel' . $parent->MenuID . '" data-parent="#accordionSidebar">';
            echo '<div class="bg-white py-2 collapse-inner rounded">';

            foreach ($childs as $child) {
                echo '<a class="collapse-item" href="' . $child->Link . '">' . $child->Name . '</a>';
            }
            echo '</div>';
            echo '</div>';
        }

        echo '</li>';

        $i++;
    }
}
