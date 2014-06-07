<?php
/**
 * @package Customizer
 * @version 0.7
 */
/*
Plugin Name: Customizer
Plugin URI: http://wp-customizer.com/
Description: Customizer extends functionality of Customize feature introduced in WordPress 3.4. Allows adding and editing Theme Customization Sections directly from the Customize Panel.
Author: Sławomir Amielucha
Version: 0.7
Author URI: http://amielucha.com/
*/

// Add settings link on plugins page of admin panel
function customizer_link($links, $file) {
	static $this_plugin;

  if (!$this_plugin) { $this_plugin = plugin_basename(__FILE__); }
	if ($file == $this_plugin) { $settings_link = '<a href="options-general.php?page=customizer_options_panel">Settings</a>';
  	array_unshift($links, $settings_link);
	}
	return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links", 'customizer_link', 10, 2 );

//Get Plugin Settings
require 'customizer_options.php';

add_action( 'customize_controls_enqueue_scripts', 'customizer_init' );
//available hooks: customize_register, customize_controls_init, customize_controls_enqueue_scripts, wp_ajax_customize_save

function customizer_init() {

	//get Customizer options
	$options = get_option('customizer_options');

	//include customizer.css, customizer.js, jQuery UI extensions
	if ( !isset($options['disable_customizer']) || $options['disable_customizer'] != 'on' ) {
		wp_enqueue_style( 'customizer_css', plugins_url() . '/customizer/customizer.css' );
		wp_enqueue_script( 'jquery_cookie', plugins_url() . '/customizer/jquery.cookie.js', array( 'jquery' ), '20120520', true );
		wp_enqueue_script( 'jquery_validate', plugins_url() . '/customizer/jquery.validate.js', array( 'jquery' ), '20120531', true );
		wp_enqueue_script( 'suggest');
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-sortable');

		wp_enqueue_script( 'customizer_js', plugins_url() . '/customizer/customizer.js', array( 'jquery' ), '20120520', true );
	}
}

// + add new section
add_action ('customize_register','customizer_section_add'); 

function customizerGetPrioritiesCookie($item){
	if (isset($_COOKIE['customizerPriority'])){
		if ( property_exists( $priority = json_decode( stripslashes( $_COOKIE['customizerPriority'] ) ), $item ) ) {
			return $priority->$item;
		}
	}
}

function customizer_section_add($wp_customize) {
	$options = get_option( "customizer_array" );
	
	if($options){
		foreach ($options as $key=>$o) {

				//If option is serialized
				if ( isset( $o["id1"] ) && isset( $o["prefix1"] ) && $o["prefix1"] !='undefined' ) {
					$option_name = $o["prefix1"].'['.$o["id1"].']';
				} else {
					if( isset( $o["id1"] ) ) { $option_name = $o["id1"]; }
				}

				if ( isset ( $o["id"] ) && isset ( $o["action"] ) && isset ( $o["title"] ) && $o["action"] == 's' && $o["title"] && $o["id"] !='undefined' && $o["title"] !='undefined' ) {									// it means that you create a new section ( or modify existing )
					
					if ( $cake = customizerGetPrioritiesCookie($o["id"]) ){
						$prio = $cake;
						if ( $cake != $o["priority"] ) {
							// update priority when it's been changed
							$options[$key]["priority"] = $cake;
						}
					} else {
						$prio = $o["priority"];
					}

					$wp_customize->add_section( $o["id"], array(
						'title'          => $o["title"],
						'priority'       => $prio,
						'description'       => $o["desc"],
					) );
				} else if ( isset ( $o["action"] ) && $o["action"] == 'c' ):

				/*$wp_customize->add_setting(  $o["id"].$o["id1"], array(
					// @todo: replace with a new accept() setting method
					// 'sanitize_callback' => 'sanitize_hexcolor',
					'theme_supports' => array( 'custom-header', 'header-text' ),
					'type'           => 'option',
					'default'        => 'off',
					'capability'     => 'edit_theme_options',
				) );*/

				/* Add Controls of the selected type */
				/* CHECKBOX */
				if (get_option( $option_name )) {
					$default = get_option( $option_name );
				} else $default = '';

				if ( isset ( $o["type1"] ) ):

				if ( $o["type1"] == 'checkbox' ) {

					$wp_customize->add_setting(  $option_name, array(
						'type'           => 'option',
						/*'default'        => '',*/
						'capability'     => 'edit_theme_options',
					) );

					$wp_customize->add_control( $o["id1"], array(
							'priority' => 11,
							'settings' => $option_name,
							'label'    => sanitize_text_field($o["label1"]),
							'section'  => $o["id"],
							'type'     => 'checkbox',
						) );

				/* TEXT */
				} elseif ( $o["type1"] == 'text' ) {

					$wp_customize->add_setting(  $option_name, array(
						'type'           		=> 'option',
						'capability'     		=> 'edit_theme_options',
						'sanitize_callback' => 'sanitize_text_field',
					) );

					$wp_customize->add_control( $o["id1"], array(
							'priority' => 11,
							'settings' => $option_name,
							'label'    => stripslashes(sanitize_text_field($o["label1"])),
							'section'  => $o["id"],
							'type'     => 'text',
						) );
				
				/* RADIO and SELECT */
				} elseif ( $o["type1"] == 'radio' || $o["type1"] == 'select' ) {

					$typevals = explode(",", $o["typeval1"]);
					$typevals_processed = array();
					foreach ( $typevals as $typeval ) {
						//Process the lengthy string:
						if (strpos($typeval, ':') !== false) {
							$typeval   = explode(":",$typeval);
							$typeval_l = trim($typeval[0]);
							$typeval_r = trim($typeval[1]);
							$typevals_processed[$typeval_l] = $typeval_r;
						} else {
							$typeval = trim($typeval);
							$typevals_processed[$typeval] = $typeval;
						}
					}

					$wp_customize->add_setting(  $option_name, array(
						'type'           => 'option',
						'capability'     => 'edit_theme_options',
					) );

					$wp_customize->add_control( $o["id1"], array(
							'priority' => 11,
							'settings' => $option_name,
							'label'    => stripslashes(sanitize_text_field($o["label1"])),
							'section'  => $o["id"],
							'type'     => $o["type1"],
							'choices'    => $typevals_processed,
						) );

				/* IMAGE */
				} elseif ( $o["type1"] == 'image' ){
					$wp_customize->add_setting(  $option_name, array(
						'type'           => 'option',
						'capability'     => 'edit_theme_options',
					) );

					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $o["id1"], array(
						'priority' => 11,
						'label'   => stripslashes(sanitize_text_field($o["label1"])),
						'section' => $o["id"],
						'settings'   => $option_name,
					) ) );

				/* COLOR PICKER */
				} elseif ( $o["type1"] == 'color' ){
					$wp_customize->add_setting(  $option_name, array(
						'type'           => 'option',
						'default'        => '#BADA55',
						'capability'     => 'edit_theme_options',
					) );

					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $o["id1"], array(
						'priority' => 11,
						'label'   => stripslashes(sanitize_text_field($o["label1"])),
						'section' => $o["id"],
						'settings'   => $option_name,
					) ) );

				}
				endif;
				endif;
		}

		// save options...
		update_option( "customizer_array", $options );
	}
}

function customizer_ajax_link() {
	$value = plugins_url()."/customizer/customizer_ajax.php";

	// send a cookie
	setcookie("customizerCookie",$value, time()+3600*24);
}
add_action( 'customize_controls_enqueue_scripts', 'customizer_ajax_link' );

require 'customizer_shortcodes.php';