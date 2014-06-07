<?php
/**
 * @package Customizer
 * @version 0.7
 */

function customizer_shortcode( $atts ) {	
	extract( shortcode_atts( array(
		'id' => '',
		'default' => '',
	), $atts ) );

	if ( $id ) {
		return get_option($id);
	} else {
		return "<em>Please provide a parameter, for example <strong>id='my_option_name'</strong> </em>";
	}

}
add_shortcode('customizer', 'customizer_shortcode');