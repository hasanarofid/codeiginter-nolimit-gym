<?php

use App\Models\Model_usermenu;

function get_menu($ci, $user)
{
    $ci->user_menu = new Model_usermenu();
    $get_parent    = $ci->user_menu->get_menu($user);

    $currentUrl = current_url();

    foreach ($get_parent as $parent) {
        $childs = $ci->user_menu->get_child($parent->MenuID, $user);

        // Cek apakah URL saat ini cocok dengan parent atau salah satu child-nya
        $parentLink  = base_url(ltrim($parent->Link, '/'));
        $isActive    = str_starts_with($currentUrl, $parentLink) && $parent->Link !== '';
        $hasActiveChild = false;

        if ($childs) {
            foreach ($childs as $child) {
                $childLink = base_url(ltrim($child->Link, '/'));
                if (str_starts_with($currentUrl, $childLink) && $child->Link !== '') {
                    $hasActiveChild = true;
                    break;
                }
            }
        }

        $isParentActive = $isActive || $hasActiveChild;
        $activeClass    = $isParentActive ? ' active' : '';

        if ($parent->Sub == 0) {
            $properties = 'class="nav-link' . ($isParentActive ? ' active' : '') . '" href="' . $parent->Link . '"';
        } else {
            $collapseClass = $isParentActive ? 'collapse show' : 'collapse';
            $properties    = 'class="nav-link' . ($isParentActive ? '' : ' collapsed') . '" href="#" data-toggle="collapse" data-target="#dropMenu' . $parent->MenuID . '" aria-expanded="' . ($isParentActive ? 'true' : 'false') . '" aria-controls="controlLabel' . $parent->MenuID . '"';
        }

        echo '
        <li class="nav-item' . $activeClass . '">
            <a ' . $properties . '>
                <i class="' . $parent->Icon . ' fa-fw"></i>
                <span>' . $parent->Name . '</span>
            </a>';

        if ($childs) {
            $collapseClass = $isParentActive ? 'collapse show' : 'collapse';
            echo '<div id="dropMenu' . $parent->MenuID . '" class="' . $collapseClass . '" aria-labelledby="menuLabel' . $parent->MenuID . '" data-parent="#accordionSidebar">';
            echo '<div class="bg-white py-2 collapse-inner rounded">';

            foreach ($childs as $child) {
                $childLink        = base_url(ltrim($child->Link, '/'));
                $isChildActive    = str_starts_with($currentUrl, $childLink) && $child->Link !== '';
                $childActiveClass = $isChildActive ? ' active' : '';
                echo '<a class="collapse-item' . $childActiveClass . '" href="' . $child->Link . '">' . $child->Name . '</a>';
            }

            echo '</div>';
            echo '</div>';
        }

        echo '</li>';
    }
}
