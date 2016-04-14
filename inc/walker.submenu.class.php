<?php

class Walker_Submenu extends Walker_Nav_Menu {
    public $current_branch = array();
    public $display_current = false;


    // Set the properties of the element which give the ID of the current item and its parent
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

    /*
    */
    // Displays start of a level. E.g '<ul>'
    // @see Walker::start_lvl()
    function start_lvl(&$output, $depth=0, $args=array()) {
        //trace($args);
        $output .= "\n<ul>\n";
    }

    // Displays end of a level. E.g '</ul>'
    // @see Walker::end_lvl()
    function end_lvl(&$output, $depth=0, $args=array()) {
        $output .= "</ul>\n";
    }

    // Displays start of an element. E.g '<li> Item Name'
    // @see Walker::start_el()
    function start_el(&$output, $item, $depth=0, $args=array()) {

        // do we print this?

        if ($item->menu_item_parent == 0) $this->current_branch = array();

        $display_this = false;
        if ($item->current_item_ancestor) { $display_this = true; }
        if ($item->current_item_parent) $display_this = true;
        if ($item->current) $display_this = true;
        if ($display_this) $this->current_branch[] = $item->ID;
        if (in_array($item->menu_item_parent, $this->current_branch)) $display_this = true;
        if (in_array($item->ID, $this->current_branch)) $display_this = true;

        if ($display_this) $output .= "<li class='".implode(" ", $item->classes)."'><a href='".$item->url."'>".esc_attr($item->title)."</a>";
        $this->display_current = $display_this;

        //if (!$display_this) trace ($item->menu_item_parent);
    }

    // Displays end of an element. E.g '</li>'
    // @see Walker::end_el()
    function end_el(&$output, $item, $depth=0, $args=array()) {
        if ($this->display_current) $output .= "</li>\n";
        $this->display_current = false;
    }
}