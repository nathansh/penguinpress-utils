<?php
/**
 * @package penguinpress-utils
 */
/*
Plugin Name: PenguinPress Utilities
Description: Utilities to help other content plugins
Version: 1.0-alpha
Author: Nathan Shubert-Harbison
Author URI: http://nathansh.com
Text Domain: penguinpress-utils
*/


/**
 * Load utility library
 *
 */
require_once 'includes/utility.php';

// Fire an action on utilities loaded
do_action( 'penguinpress-utils/utilities-loaded' );


/**
 * Load font awesome in the admin
 *
 */
add_action( 'admin_init', function() {

	wp_register_style( 'pputils_fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_enqueue_style( 'pputils_fontawesome' );

} );


/**
 * Remove links to default 'post' type
 *
 * @package pp
 * @subpackage util
 *
 */
function pp_hide_post_type() {
	echo '<style>#menu-posts, #wp-admin-bar-new-post, #menu-comments { display: none; }</style>';
}

add_action( 'admin_head', 'pp_hide_post_type' );
