<?php

/**
 * Setting up the pointers array
 *
 * @since 3.0.0
 *
 * @return	array
 */
function mb_pointers() {
	$dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
	$prefix = BAVOTASAN_THEME_CODE . str_replace( '.', '', BAVOTASAN_THEME_VERSION ) . '_';

	$theme_options_pointer_content = '<h3>' . __( 'Theme Options', 'magazine-basic' ) . '</h3>';
	$theme_options_pointer_content .= '<p>' . sprintf( __( 'The greatest thing about %s is all of its amazing theme options. Take total control over the look and feel of your site with a few clicks.', 'magazine-basic'), '<strong>Magazine Basic</strong>' ) . '</p>';

	return array(
		$prefix . 'theme_options' => array(
			'content' => $theme_options_pointer_content,
			'anchor_id' => '#wp-admin-bar-customize_magazine_basic',
			'edge' => 'top',
			'align' => 'left',
			'active' => ( ! in_array( $prefix . 'theme_options', $dismissed ) )
		),
	);
}

/**
 * Pointers conditional check
 *
 * @since 3.0.0
 *
 * @return	boolean
 */
function mb_pointers_check() {
	$mb_pointers = mb_pointers();
	foreach ( $mb_pointers as $pointer => $array ) {
		if ( $array['active'] )
			return true;
	}
}

add_action( 'admin_enqueue_scripts', 'mb_pointers_header' );
/**
 * Add tooltip pointers to show off certain elements in the admin
 *
 * This function is attached to the 'admin_enqueue_scripts' action hook.
 *
 * @since 3.0.0
 */
function mb_pointers_header() {
	if ( mb_pointers_check() ) {
		add_action( 'admin_print_footer_scripts', 'mb_pointers_footer' );

		wp_enqueue_script( 'wp-pointer' );
		wp_enqueue_style( 'wp-pointer' );
	}
}

/**
 * Add tooltip pointer script to admin footer
 *
 * This function is attached to the 'admin_print_footer_scripts' action hook.
 *
 * @since 3.0.0
 */
function mb_pointers_footer() {
	$mb_pointers = mb_pointers();
	?>
<script>
/* <![CDATA[ */
( function($) {
	<?php
	foreach ( $mb_pointers as $pointer => $array ) {
		if ( $array['active'] ) {
			?>
		    $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
		        content: '<?php echo $array['content']; ?>',
		        position: {
		            edge: '<?php echo $array['edge']; ?>',
		            align: '<?php echo $array['align']; ?>'
		        },
		        close: function() {
		            $.post( ajaxurl, {
		                pointer: '<?php echo $pointer; ?>',
		                action: 'dismiss-wp-pointer'
		            } );
		        }
		    } ).pointer( 'open' );
	    	<?php
	    }
	}
	?>
} )(jQuery);
/* ]]> */
</script>
	<?php
}