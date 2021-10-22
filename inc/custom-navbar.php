<?php

class space_material_walker_nav_menu extends Walker_Nav_menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $object      = $item->object;
    	$type        = $item->type;
    	$title       = $item->title;
    	$description = $item->description;
    	$permalink   = $item->url;

        $active_class = '';
        if( in_array('current-menu-item', $item->classes) ) {
            $active_class = 'active';
        }

        $dropdown_class = '';
        $dropdown_link_class = '';
        if( $args->walker->has_children && $depth == 0 ) {
            $dropdown_class = 'dropdown';
            $dropdown_link_class = 'dropdown-toggle';
        }

        $output .= "<li class='nav-item $active_class $dropdown_class " .  implode(" ", $item->classes) . "'>";

        if( $args->walker->has_children && $depth == 0 ) {
            $output .= '<a href="' . esc_url($permalink) . '" class="dropdown-item ' . $dropdown_link_class . '" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownMenuLink" role="button">';
        }
        else {
            $output .= '<a href="' . esc_url($permalink) . '" class="dropdown-item">';
        }

        /*submenu*/

        $output .= $title;

        if( $description != '' && $depth == 0 ) {
            $output .= '<small class="description">' . $description . '</small>';
        }

        $output .= '</a>';
    }

    function start_lvl( &$output, $depth=0, $args = array() ){
        $submenu = ($depth > 0) ? ' dropdown-submenu' : '';
        $output .= "<ul class='dropdown-menu dropdown-primary $submenu depth_$depth' aria-labelledby='navbarDropdownMenuLink'>";

        $output2 .= "<ul class='dropdown-menu dropdown-submenu $submenu depth_$depth'>";
    }

}
