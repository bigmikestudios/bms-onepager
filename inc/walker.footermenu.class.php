<?php

class Walker_Footermenu extends Walker_Nav_Menu {

    // Set the properties of the element which give the ID of the current item and its parent
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    var $current_column = 0;

    // Displays start of a level. E.g '<ul>'
    // @see Walker::start_lvl()
    function start_lvl(&$output, $depth=0, $args=array()) {
        //$output .= "\n<!-- start level -->\n";
    }
    // Displays end of a level. E.g '</ul>'
    // @see Walker::end_lvl()
    function end_lvl(&$output, $depth=0, $args=array()) {
        // $output .= "<!-- end level -->\n";
    }

    // Displays start of an element. E.g '<li> Item Name'
    // @see Walker::start_el()
    function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {
        if ($item->title =="DIVIDER") {
            //
            $this->current_column++;
            $output .= "\n</div>\n<!-- DIVIDER -->\n<div class='divider column column-$this->current_column'>\n";
        } else {
            if ($item->menu_item_parent == 0) {
                if ($this->current_column != 0) {
                    $output .= "</div>\n";
                    $output .= "<!-- END COLUMN $this->current_column -->\n";
                }
                $this->current_column++;
                $output .= "<!-- START COLUMN $this->current_column -->\n";
                $output .= "<div class='column column-$this->current_column'>\n";
            }
            //$item->classes[] = "column-$this->current_column";
            $item->classes[] = "menu-item";

            $item->classes = apply_filters( 'nav_menu_css_class', array_filter( $item->classes ), $item, $args, $depth );

            $output .= "\t<div class='".implode(" ", $item->classes)."'><a href='".$item->url."'>".esc_attr($item->title)."</a></div>\n";
        }
        //if (!$display_this) trace ($item->menu_item_parent);
    }

    // Displays end of an element. E.g '</li>'
    // @see Walker::end_el()
    function end_el(&$output, $item, $depth=0, $args=array()) {
        //if ($this->display_current) $output .= "</div>\n";
        //$this->display_current = false;
    }
/**/
}