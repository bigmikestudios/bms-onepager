<?php

/// CUSTOMIZED STUFF FOR THIS PROJECT

// =========================================================================================================== CONSTANTS

define('FACEBOOK_LINK', 'https://www.facebook.com');
define('TWITTER_LINK', 'https://twitter.com');
define('LINKEDIN_LINK', 'https://www.linkedin.com');
define('GOOGLE_LINK', 'https://plus.google.com');
define('HOUZZ_LINK', 'http://www.houzz.com');
define('DATEFORMAT', 'F j, Y');
define('SEND_FEEDBACK_URL', '/crew-feedback/');
define('CLIENT_LOGIN_URL', '/defined_in_custom-inc-php');
define('SEARCH_URL', '/defined_in_custom-inc-php');

// ===================================================================================================== SCRIPTS AND CSS

function bms_add_scripts() {
    $stylesheet_dir = get_template_directory_uri();

    if (!is_admin()) {
        // comment out the next two lines to load the local copy of jQuery
        //wp_deregister_script('jquery');
        //wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', false, '2.1.3');
        //wp_enqueue_script('jquery');
    }

    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Ropa+Sans:400,400italic');

    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');

    wp_enqueue_style('ral-custom-icons', $stylesheet_dir. '/lib/ral-custom-icons/styles.css');

    wp_enqueue_style('socicon', $stylesheet_dir . '/lib/socicon-font-v26/socicon.css');

    wp_register_script('marka', $stylesheet_dir . '/lib/marka-0.3.1/src/js/marka.js', array(), '', true);
    wp_enqueue_script('marka');

    //wp_register_script('fonts-com', 'http://fast.fonts.net/jsapi/4ad115fd-48db-4001-84fa-02680ca2f526.js', array(), '', true);
    //wp_enqueue_script('fonts-com');
    wp_enqueue_style('fonts-com-kit', $stylesheet_dir . '/lib/robert_allan_website-05012016/demo-async.css');

    wp_enqueue_style('mmenu', $stylesheet_dir . '/lib/jQuery.mmenu-master/src/css/jquery.mmenu.css');
    wp_enqueue_style('mmenu-positioning', $stylesheet_dir . '/lib/jQuery.mmenu-master/src/css/extensions/jquery.mmenu.positioning.css');
    wp_register_script('mmenu', $stylesheet_dir . '/lib/jQuery.mmenu-master/src/js/jquery.mmenu.min.js', array(), '', true);
    wp_enqueue_script('mmenu');

    //wp_enqueue_style('swipebox', $stylesheet_dir . '/lib/swipebox-master/src/css/swipebox.min.css');
    //wp_register_script('swipebox', $stylesheet_dir . '/lib/swipebox-master/src/js/jquery.swipebox.min.js', array(), '', true);
    //wp_enqueue_script('swipebox');

    wp_enqueue_style('lightgallery', $stylesheet_dir . '/lib/lightGallery-master/dist/css/lightgallery.min.css');
    wp_register_script('lightgallery', $stylesheet_dir . '/lib/lightGallery-master/dist/js/lightgallery.min.js', array(), '', true);
    wp_enqueue_script('lightgallery');
    wp_register_script('lg-pager', $stylesheet_dir . '/lib/lightGallery-master/dist/js/lg-pager.min.js', array(), '', true);
    wp_enqueue_script('lg-pager');
    wp_register_script('lg-thumbnail', $stylesheet_dir . '/lib/lightGallery-master/dist/js/lg-thumbnail.min.js', array(), '', true);
    wp_enqueue_script('lg-thumbnail');
    wp_register_script('lg-zoom', $stylesheet_dir . '/lib/lightGallery-master/dist/js/lg-zoom.min.js', array(), '', true);
    wp_enqueue_script('lg-zoom');


    //wp_enqueue_style('amber', $stylesheet_dir . '/amber/amber.css');

}
// add_action('init','bms_add_scripts');

// ============================================================================================================ INCLUDES


// ================================================================================================ CHANGE EXCERPT LENGTH

function custom_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// ================================================================================================ HELPER - HEX TO RGBA

// =================================================================================================== CUSTOM POST TYPES



// =================================================================================================== CUSTOM TAXONOMIES


// ===================================================================================================== Add CSS to head

function ral_nav_menu_css_class($classes, $item, $args, $depth) {
    $classes[] = "title-".sanitize_title($item->title);
    $classes[] = "depth-".$depth;
    // trace($classes);
    return $classes;
}
add_filter('nav_menu_css_class', 'ral_nav_menu_css_class', 10, 4);



// ============================================================================================ SHORTCODE: SHARE BUTTONS

function bms_share_links_func() {
    global $post;
    $the_title = get_the_title($post);

       // $img = get_post_thumbnail_url($post->ID, 'full');
    //  trace($img);

    $img = get_template_directory_uri().'/img/logo.png';
    if (has_post_thumbnail($post->ID))
        $img = get_post_thumbnail_url($post->ID);

    $return='';
    $return.='<div class="meta">';
    $return.='<p class="share-links">Share: <br>';
    $return.='<a href="mailto:?&subject='. urlencode($the_title).' at '.urlencode(get_bloginfo('blog_title')).'&body=I%20thought%20you%20might%20be%20interested%20in%20this:%20'. urlencode(" ".$the_title." ".get_permalink()).'" target="_blank">';
    $return.='<span class="glyphicon glyphicon-envelope"></span>';
    $return.='</a>';
    $return.=' <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='. urlencode(get_permalink()).'"><span class="socicon-facebook"> </span></a>';
    $return.=' <a target="_blank" href="https://twitter.com/home?status='. urlencode(" ".$the_title." ".get_permalink()).'"><span class="socicon-twitter"> </span></a>';
    $return.=' <a target="_blank" href="https://plus.google.com/share?url='. urlencode(get_permalink()).'"><span class="socicon-google"> </span></a>';
    $return.=' <a target="_blank" href="https://pinterest.com/pin/create/button/?url='. urlencode(get_permalink()).'&media='. urlencode($img).'&description="><span class="socicon-pinterest"> </span></a>';
    $return.='</p>';
    $return.='</div>';
    return $return;
}
// add_shortcode('bms_share_links','bms_share_links_func');

// ============================================================================================= SHORTCODE: SOCIAL ICONS

function df_social_icons_func()
{
    ob_start();
    ?>
    <ul class="social-icons-list">
        <li class="facebook">
            <a href="<?php echo FACEBOOK_LINK; ?>" target="_blank">
                <span class="sr-only">Facebook</span>
                <span class="socicon-facebook"></span>
            </a>
        </li>
        <li class="twitter">
            <a href="<?php echo TWITTER_LINK; ?>" target="_blank">
                <span class="sr-only">Twitter</span>
                <span class="socicon-twitter"></span>
            </a>
        </li>
        <li class="googleplus">
            <a href="<?php echo GOOGLE_LINK; ?>" target="_blank">
                <span class="sr-only">Google+</span>
                <span class="socicon-google"></span>
            </a>
        </li>
        <li class="houzz">
            <a href="<?php echo HOUZZ_LINK; ?>" target="_blank">
                <span class="sr-only">Houzz</span>
                <span class="socicon-houzz"></span>
            </a>
        </li>
    </ul>
    <?php
    $return = ob_get_clean();
    $return = str_replace(array("\r", "\n"), '', $return);
    return $return;
}
// add_shortcode('df_social_icons', 'df_social_icons_func');


function bms_icon_func($atts) {
    $a = shortcode_atts( array(
        'class' => 'something'
    ), $atts);
    return "<i class='".$a['class']."'></i>";
}
add_shortcode('bms_icon', 'bms_icon_func');
