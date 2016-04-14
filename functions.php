<?php



// =============================================================================

//////////////////////////
//
// THEME CONFIGURATION & CONSTANTS
//
//////////////////////////

// for recommended and required plugins...
require 'inc/required-recommended-plugins.inc.php';

// for ACF Options page...
require 'inc/acf_options.inc.php';

// for ACF Flexible Content Blocks site...
require 'inc/blocks.inc.php';

// custom development particular to this client
require 'inc/custom.inc.php';

// move admin bar to the bottom. This is useful if you are using off-canvas menus...
// require 'inc/move-admin-bar-to-bottom.inc.php';

// change default thumbnail sizes to work better with bootstrap:

add_action( 'after_setup_theme', 'bones_theme_setup' );
function bones_theme_setup() {
    add_image_size( 'max', 1440 );
    add_image_size( 'lg', 1170 );
    add_image_size( 'md', 940 );
    add_image_size( 'sm', 720 );
}

// ============================================================================================ DEBUGGING WHEN LOGGED IN

/*
THIS WILL SET A COOKIE FOR WP-CONFIG ON THE NEXT RELOAD FROM THIS SERVER, FOR THE NEXT 24 HOURS.

FOR THIS TO WORK, COPY/PASTE THE FOLLOWING INTO WP-CONFIG:

if ( isset( $_COOKIE['wp_hebqohub_debug'] ) && 'on' === $_COOKIE['wp_hebqohub_debug'] ) {
	define( 'WP_DEBUG', true );
} else {
	define( 'WP_DEBUG', false );
}

*/

function bms_admin_debug( $user_login, $user )
{
    if ( in_array( 'administrator', $user->roles ) ) {
        setcookie('wp_hebqohub_debug', 'on', (time()+3600), "/");
    }
}
add_action( 'wp_login', 'bms_admin_debug', 10, 2 );

// =============================================================================

add_action( 'after_setup_theme', 'bms_custom_setup' );

if ( ! function_exists( 'bms_custom_setup' ) ):
    function bms_custom_setup() {

        // This old thing...
        add_theme_support( 'menus');
        add_theme_support( 'post-thumbnails' );

    }
endif; // bms_custom_setup

// =============================================================================

//////////////////////////
//
// HELPER
//
//////////////////////////

// =============================================================================

// trace, for the troubleshootin'
function trace($arg) {
    $ts = "";
    $type = gettype($arg);
    switch ($type) {
        case ("boolean") :
            $ts = ($arg) ? "true" : "false";
            break;
        case ("integer") :
        case ("double") :
        case ("float") :
        case ("string") :
            $ts = $arg;
            break;
        case ("array") :
        case ("object") :
            $ts = print_r($arg, true);
            break;
        default :
            $ts = "type: $type";
            break;
    }
    error_log($ts);
    print "<pre>";
    print $ts;
    print "</pre>";

    global $wpdb;
    $table_name = $wpdb->prefix."bms_trace";

    if( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
        if ( ! empty( $wpdb->charset ) )
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        if ( ! empty( $wpdb->collate ) )
            $charset_collate .= " COLLATE $wpdb->collate";

        $sql = "CREATE TABLE " . $table_name . " (
			`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`date_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			`description` longtext NOT NULL,
			PRIMARY KEY (`id`)
		) $charset_collate;";
        $wpdb->query($sql);
    }

    $wpdb->insert( $table_name, array('description'=>$ts) );
}

// =============================================================================

// return the url of a featured image, given the post's id and desired size

function get_post_thumbnail_url ($post_id, $size="full")
{
    $thumb_id = get_post_thumbnail_id($post_id);
    $thumb = wp_get_attachment_image_src($thumb_id, $size);
    return ($thumb['0']);
}

// =============================================================================

// return HTML markup for a responsive image based on the custom CSS defined in this theme

function image_div( $image, $frame_size = "square") {
    ob_start();
    ?>
    <?php if (is_int($image)): ?>
        <div class="image media-id-<?php echo $image; ?>">
    <?php else: ?>
        <div class="image" style="background-image: url(<?php echo $image; ?>)">
    <?php endif; ?>
            <img src="<?php echo get_stylesheet_directory_uri()."/img/transparent_$frame_size.png"; ?>" />
        </div>
    <?php if(is_int($image)): ?>
        <style type="text/css">
            .image.media-id-<?php echo $image; ?> {
                background-image: url(<?php $sm = wp_get_attachment_image_src($image, "sm"); echo $sm[0]; ?>);
            }
            @media screen and ( min-width: 992px ) {
                .image.media-id-<?php echo $image; ?> {
                    background-image: url(<?php $md = wp_get_attachment_image_src($image, "md"); echo $md[0]; ?>);
                }
            }
            @media screen and ( min-width: 1200px ) {
                .image.media-id-<?php echo $image; ?> {
                    background-image: url(<?php $lg = wp_get_attachment_image_src($image, "lg"); echo $lg[0]; ?>);
                }
            }
        </style>
    <?php endif;
    $return = ob_get_clean();
    return $return;
}

// =============================================================================

//////////////////////////
//
// HOOKS and FILTERS
//
//////////////////////////

// =============================================================================

// add scripts
function my_scripts_method() {
    $stylesheet_dir = get_bloginfo('stylesheet_directory');

    wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array('jquery'), '1.9.1', true);
    // we need the jquery library for bootsrap js to function
    wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), true); // all the bootstrap javascript goodness
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');

    // uncomment to use local bootstrap stuff
    //wp_register_script( 'bootstrap', $stylesheet_dir.'/bootstrap/js/bootstrap.min.js');
    //wp_enqueue_script( 'bootstrap' );



    wp_register_script( 'script', $stylesheet_dir.'/js/script.js');
    wp_enqueue_script( 'script' );

    wp_enqueue_style('style-less', $stylesheet_dir . '/less/style.css');

}
//add_action('wp_enqueue_scripts', 'my_scripts_method');


// removing dashboard widgets
function bms_custom_remove_dashboard_widgets() {
    global $wp_meta_boxes;

    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

}
add_action('wp_dashboard_setup', 'bms_custom_remove_dashboard_widgets' );

// =============================================================================

//////////////////////////
//
// SHORTCODES
//
//////////////////////////

// =============================================================================

function button($atts )
{
    $atts = shortcode_atts(array(
        'href' => site_url(),
        'label' => "click here!",
        'class' => "btn btn-default",
        'new' => false,
    ), $atts, 'button');
    $return = "<a class='btn ".$atts['class']."' href='".$atts['href']."'";
    if ($atts['new']) $return .= " target='_blank'";
    $return .= ">".$atts['label']."</a>";
    return $return;
}
add_shortcode( 'button', 'button' );

// =============================================================================

