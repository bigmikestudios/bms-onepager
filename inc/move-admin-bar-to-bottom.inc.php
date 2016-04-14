<?php

///////////////////////////
// MOVE ADMIN BAR BOTTOM //
///////////////////////////
function admin_bar_bottom() {
    echo
    '<style type="text/css" media="screen">

    html { margin-top: 0px !important; }
    * html body { margin-top: 0px !important; }
    @media screen and ( max-width: 782px ) {
        html { margin-top: 0px !important; }
        * html body { margin-top: 0px !important; }
        #wpadminbar { display: none; }
    }
    #wpadminbar {
        top:auto !important;
        bottom:0;
    }
</style>';
}

// check if admin bar is enabled for the current user
if ( is_admin_bar_showing() )
{
// call styling into the <head>
    add_action( 'wp_head', 'admin_bar_bottom', 9999 );
}