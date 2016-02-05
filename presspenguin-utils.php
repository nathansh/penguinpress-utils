<?php
/**
 * @package press-penguin-utils
 */
/*
Plugin Name: PressPenguin Utilities
Description: Utilities to help other content plugins
Version: 1.0-alpha
Author: Nathan Shubert-Harbison
Author URI: http://nathansh.com
Text Domain: press-penguin-utils
*/


define( 'PP_UTILS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PP_UTILS__PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/**
 * Utility functions
 */
require_once PP_UTILS__PLUGIN_DIR . '/includes/utility.php';


/**
 * Load font awesome in the admin
 */
add_action( 'admin_init', function() {
	wp_register_style( 'pputils_fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'pputils_fontawesome' );
} );


/**
 * Remove links to default 'post' type
 */
add_action('admin_head', function() {
?>
<style>#menu-posts, #wp-admin-bar-new-post, #menu-comments { display: none; }</style>
<?php });
