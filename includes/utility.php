<?php

if ( !function_exists('pre_var') ) {
	function pre_var($var) {
		echo '<pre>';
			print_r($var);
		echo '</pre>';
	}
}


/**
 * Custom icon images for menu items
 */
function pp_post_type_icon ( $supplied_args = array() ) {

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
