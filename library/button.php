<?php


function button_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'container' => false,
		'url' => '',
		'class' => '',
		'target' => '_top',
		'download' => false
	), $atts );

	$return = '';
	if ( !empty( $a['url'] ) && !empty( $content ) ) {
		if ( !empty( $a['container'] ) ) {
			$return .= '<div class="buttons">';
		}
		$return .= '<a href="' . $a['url'] . '" class="btn ' . $a['class'] . '" target="' . $a['target'] . '"' . ( !empty( $a['download'] ) ? ' download="' . $a['download'] . '"' : '' ) . '>' . $content . '</a>';
		if ( !empty( $a['container'] ) ) {
			$return .= '</div>';
		}
		return $return;
	}
}
add_shortcode( 'button', 'button_shortcode' );




// hooks your functions into the correct filters
function btn_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
		return;
	}

	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'btn_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'btn_register_mce_button' );
	}
}
add_action('admin_head', 'btn_add_mce_button');



// register new button in the editor
function btn_register_mce_button( $buttons ) {
	array_push( $buttons, 'btn_mce_button' );
	return $buttons;
}



// declare a script for the new button
// the script will insert the shortcode on the click event
function btn_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['btn_mce_button'] = get_stylesheet_directory_uri() .'/js/editor/button.js';
	return $plugin_array;
}

