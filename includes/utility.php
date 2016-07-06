<?php


/**
 * Print a variable with `print_r()` and `<pre>` tags
 *
 * @package pp
 * @subpackage utility
 *
 */
if ( !function_exists( 'pre_var' ) ) {
	function pre_var( $var ) {
		echo '<pre>';
			print_r( $var );
		echo '</pre>';
	}
}


/**
 * Return a plugin slug
 *
 * @package pp
 * @subpackage utility
 *
 * @return string A string that'll work as a plugin slug
 *
 */
function pp_plugin_slug( $path = '' ) {

	$parts = array_filter( explode( '/', $path ) );
	return end( $parts );

}


/**
 * Custom icon images for menu items, printed in the head in admin
 *
 * @package pp
 * @subpackage utility
 *
 * @param array $args Array of params
 *
 * ```
 * 		pp_post_type_icon( array(
 *			'menu_class' => '.menu-icon-widget', // CSS selector for the nav icon
 *			'icon' => '/path/to/image.svg', // normal image
 *			'icon_hover' => '/path/to/hover/image.sv' // path to image to use on hover
 *		) );
 * ```
 *
 */
function pp_post_type_icon( $supplied_args = array() ) {

	// Get the args
	$args = wp_parse_args( $supplied_args, array() );
?>
	<style>
		.<?php echo $args['menu_class']; ?> div.wp-menu-image { opacity: .7; }
		.<?php echo $args['menu_class']; ?> div.wp-menu-image:before { content: ''; background: url(<?php echo $args['icon']; ?>) no-repeat center center; }
		.<?php echo $args['menu_class']; ?>:hover div.wp-menu-image { opacity: 1; }
		.<?php echo $args['menu_class']; ?>:hover div.wp-menu-image:before { content: ''; background: url(<?php echo $args['icon_hover']; ?>) no-repeat center center; }
		.<?php echo $args['menu_class']; ?>.wp-menu-open:hover div.wp-menu-image:before { content: ''; background: url(<?php echo $args['icon']; ?>) no-repeat center center; }
		.<?php echo $args['menu_class']; ?>.wp-menu-open div.wp-menu-image { opacity: 1; }
	</style>
<?php
}


/**
 * Check if the site is a local development site. Useful for excluding Google Analytics on local.
 *
 * @package pp
 * @subpackage utility
 *
 * @todo make this more bullet proof, also exclude staging.
 *
 * @return bool
 *
 */
function pp_is_local() {
	return $_SERVER['SERVER_ADDR'] == '127.0.0.1';
}


/**
 * Print the return value of a template function
 *
 * @package pp
 * @subpackage utility
 *
 * @param string $function Function name
 * @param mixed $parameters Function parameters, optional
 */
if ( ! function_exists( 'pp_print_function' ) ) {

	function pp_print_function( $function, $paramters = array() ) {

		if ( is_array( $paramters ) ) {
			$params = $paramters;
		} else {
			$params = array( $paramters );
		}

		$output = call_user_func_array( $function, $params );

		if ( $output ) {
			echo $output;
		}

	}

}


/**
 * Return the markup of a widget
 *
 * @package pp
 * @subpackage utility
 *
 * @link https://codex.wordpress.org/Function_Reference/the_widget WordPress documentation for the_widget()
 *
 * @param string $widget options at https://codex.wordpress.org/Function_Reference/the_widget
 * @param array|string $instance  options at https://codex.wordpress.org/Function_Reference/the_widget
 * @param array|string $args options at https://codex.wordpress.org/Function_Reference/the_widget
 *
 * @return string Markup for widget
 *
 */
if( ! function_exists( 'pp_get_the_widget' ) ){

	function pp_get_the_widget( $widget, $instance = '', $args = '' ){

		ob_start();

		the_widget( $widget, $instance, $args );

		return ob_get_clean();

	}

}


/**
 * Take an array of unsorted item and return a multi-dimensional array with the
 * items grouped by a supplied top-level array key.
 *
 * @package pp
 * @subpackage utility
 *
 * @param array $array The array to sort
 * @param string $key Top level array key to sort by.
 *
 * @return array Sorted array
 *
 */
function pp_group_array( $array, $key ) {

	// Bail if the data is bad
	if ( ! is_array( $array ) ) {
		return $array;
	}

	// Sorted array to build as we go
	$sorted_items = array();

	// If we encounter a bad item, just bail on the whole thing
	$should_bail = false;

	// Loop through itmes
	foreach ( $array as $item ) {

		// If this isn't an array or isn't an object, bail
		if ( ! is_array( $item ) && ! is_object( $item ) ) {
			$should_bail = true;
		}

		// Create the key to use
		$key_to_use = is_array( $item ) ? $item[ $key ] : $item->$key;

		// If we don't have a key to use, bail
		if ( $key_to_use === false ) {
			$should_bail = true;
		}

		// If this is the firrst time encountering this key, create a new array item in our grouping array
		if ( ! isset( $sorted_items[ $key_to_use ] ) ) {
			$sorted_items[ $key_to_use ] = array();
		}

		// Add this item to the appropriate nested array
		$sorted_items[ $key_to_use ][] = $item;

	}

	if ( $should_bail ) {
		return $array;
	} else {
		return $sorted_items;
	}

}
