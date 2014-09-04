<?php
/**
 * FourHSVTwo functions and definitions
 *
 * @package FourHSVTwo
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'fourhsvtwo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fourhsvtwo_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on FourHSVTwo, use a find and replace
	 * to change 'fourhsvtwo' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fourhsvtwo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fourhsvtwo' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fourhsvtwo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // fourhsvtwo_setup
add_action( 'after_setup_theme', 'fourhsvtwo_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function fourhsvtwo_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fourhsvtwo' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'fourhsvtwo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fourhsvtwo_scripts() {
	wp_enqueue_style( 'fourhsvtwo-style', get_stylesheet_uri() );

	wp_enqueue_script( 'fourhsvtwo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'fourhsvtwo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fourhsvtwo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function my_custom_post_job() {
  $labels = array(
    'name'               => _x( 'Jobs', 'post type general name' ),
    'singular_name'      => _x( 'Jobs', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Job' ),
    'edit_item'          => __( 'Edit Job' ),
    'new_item'           => __( 'New Job' ),
    'all_items'          => __( 'All Jobs' ),
    'view_item'          => __( 'View Job' ),
    'search_items'       => __( 'Search Jobs' ),
    'not_found'          => __( 'No jobs found' ),
    'not_found_in_trash' => __( 'No jobs found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Jobs'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our jobs and job specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'has_archive'   => true,
  );
  register_post_type( 'job', $args ); 
}
add_action( 'init', 'my_custom_post_job' );

//adds link to title
function print_post_title() {
global $post;
$thePostID = $post->ID;
$post_id = get_post($thePostID);
$title = $post_id->post_title;
$perm = get_permalink($post_id);
$post_keys = array(); $post_val = array();
$post_keys = get_post_custom_keys($thePostID);

if (!empty($post_keys)) {
foreach ($post_keys as $pkey) {
if ($pkey=='url1' || $pkey=='title_url' || $pkey=='url_title') {
$post_val = get_post_custom_values($pkey);

}
}
if (empty($post_val)) {
$link = $perm;
} else {



$link = $post_val[0];


$strlink = (string)$link;

$ht = substr($strlink,0,7);
$hts = substr($strlink,0,8);

	if (strcasecmp($ht, "http://") == 0 || strcasecmp($hts, "https://") == 0)
		{$link = $link;}
	else { $link = "http://" . (string)$link;}
}


} else {
$link = $perm;
}
echo '<h1><a href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.' ('.$link.')</a></h1>';
}


//Adds default text to posts
/*
function my_default_post($content)
{
	if (empty($content))
		$content = "Instructions here!";
	return $content;
}

add_filter('the_editor_content', 'my_default_post');
*/


function no_wp_logo_admin_bar_remove() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'no_wp_logo_admin_bar_remove', 0);

//Add login/logout link to naviagation menu
//Requires a created menu be used as primary menu
function add_login_out_item_to_menu( $items, $args ){

	//change theme location with your theme location name
	if( is_admin() ||  $args->theme_location != 'primary' )
		return $items; 

		//change to desired url
	$redirect = site_url();
	if( is_user_logged_in( ) )
		$link = '<a href="' . wp_logout_url( $redirect ) . '" title="' .  __( 'Logout' ) .'">' . __( 'Logout' ) . '</a>';
	else  $link = '<a href="' . wp_login_url( $redirect  ) . '" title="' .  __( 'Login' ) .'">' . __( 'Login' ) . '</a>';

	return $items.= '<li id="log-in-out-link" class="menu-item menu-type-link">'. $link . '</li>';
}add_filter( 'wp_nav_menu_items', 'add_login_out_item_to_menu', 50, 2 );


//Customizing login form
//Login Logo
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/custom-logo.gif);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


//Login Logo Link
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Four Horsemen Founder Society';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//Remove option to add media to posts
function z_remove_media_controls() {
     remove_action( 'media_buttons', 'media_buttons' );
}
 add_action('admin_head','z_remove_media_controls');


//Remove media from the + in the toolbar

 add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );
function remove_wp_nodes() 
{
    global $wp_admin_bar;   
    $wp_admin_bar->remove_node( 'new-media' );
}

//Remove media and tools from dashboard for non-admin users
function remove_menus(){
 
	if (! current_user_can('edit_dashboard')) {
  		remove_menu_page( 'upload.php' );                 //Media
  		remove_menu_page( 'tools.php' );                  //Tools
	}
  
}
add_action( 'admin_menu', 'remove_menus' );

//Remove unwanted modules from post edit screen
function my_remove_meta_boxes() {
 if( !current_user_can('edit_dashboard') ) {
  remove_meta_box('postexcerpt', 'post', 'normal');
  remove_meta_box('trackbacksdiv', 'post', 'normal');
  remove_meta_box('commentstatusdiv', 'post', 'normal');
  remove_meta_box('commentsdiv', 'post', 'normal');
  remove_meta_box('slugdiv', 'post', 'normal');
  remove_meta_box('authordiv', 'post', 'normal');
  remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
  remove_meta_box('categorydiv', 'post', 'normal');
  remove_meta_box('formatdiv', 'post', 'normal');
 }
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );

//convert 0000-00-00 00:00:00 to Month Day, Year
function datetime_convert($datetime) {

$stddatetime = (string) $datetime;

$year = substr($stddatetime, 0,4);
$stdmonth = substr($stddatetime, 5,2);
$day = substr($stddatetime, 8,2);

switch ($stdmonth) {
	case '01':
		$month = "January";
		break;

	case '02':
		$month = "February";
		break;

	case '03':
		$month = "March";
		break;

	case '04':
		$month = "April";
		break;

	case '05':
		$month = "May";
		break;

	case '06':
		$month = "June";
		break;

	case '07':
		$month = "July";
		break;

	case '08':
		$month = "August";
		break;

	case '09':
		$month = "September";
		break;

	case '10':
		$month = "October";
		break;

	case '11':
		$month = "November";
		break;

	case '12':
		$month = "December";
		break;
	
	default:
		$month = "Unknown";
		break;
}

$cvrtdatetime = $month . " " . $day . ", " . $year;

return $cvrtdatetime;

}

//Removes ability to put text content in posts
function remove_box()
{
	if( !current_user_can('edit_dashboard') ) {
    	remove_post_type_support('post', 'editor');
    }
}
add_action("admin_init", "remove_box");


//Sets default screen options
function set_user_metaboxes($user_id=NULL) {
    $post_types= array( 'post' );
    // add any custom post types here:
    // $post_types[]= 'my_custom_post_type';
    foreach ($post_types as $post_type) {

       // These are the metakeys we will need to update
       $meta_key= array(
           'order' => "meta-box-order_$post_type",
           'hidden' => "metaboxhidden_$post_type",
       );

       // So this can be used without hooking into user_register
       if ( ! $user_id)
           $user_id = get_current_user_id(); 

       // Set the default order if it has not been set yet
       if ( ! get_user_option( $meta_key['order'], $user_id ) ) {
           $meta_value = array(
               //'side' => 'submitdiv,formatdiv,categorydiv,postimagediv',
               'normal' => 'postcustom',
               //'advanced' => '',
           );
           update_user_option( $user_id, $meta_key['order'], $meta_value, true );
       }

       // Set the default hiddens if it has not been set yet
       if ( ! get_user_option( $meta_key['hidden'], $user_id ) ) {
           $meta_value = array();
           update_user_option( $user_id, $meta_key['hidden'], $meta_value, true );
       }
    }
 }
 add_action( 'user_register', 'set_user_metaboxes', 10, 1 );