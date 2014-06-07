<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$color_scheme = array(
		'green'     => __('Green', 'sugarspice'),
		'emerald'   => __('Emerald', 'sugarspice'),
		'mint'      => __('Mint', 'sugarspice'),
		'peach'     => __('Peach', 'sugarspice'),
		'pink'      => __('Pink', 'sugarspice'),
		'red'       => __('Red', 'sugarspice'),
		'violet'    => __('Violet', 'sugarspice'),
		'babyblue'  => __('Baby Blue', 'sugarspice'),
		'orange'    => __('Orange', 'sugarspice'),
		'yellow'    => __('Yellow', 'sugarspice'),
	);
	
	$radio = array("0" => __('No', 'sugarspice'),"1" => __('Yes', 'sugarspice'));

	// Layout Array
	$layout_options = array(
		'excerpt'   => __('Excerpts only', 'sugarspice'),
		'full'      => __('Full posts', 'sugarspice'),
		'firstfull' => __('First post full, rest as excerpts', 'sugarspice'),
	);
	// Multicheck Array
	$meta_data = array(
		'date'      => __('Display date', 'options_framework_theme'),
		'author'    => __('Display author', 'options_framework_theme'),
		'comments'  => __('Display comments', 'options_framework_theme'),
	);

	// Multicheck Defaults
	$meta_defaults = array(
		'date'      => '1',
		'author'    => '1',
		'comments'  => '1',
	);
    
	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'sugarspice'),
		'type' => 'heading');

	$options[] = array(
		'name'      => __('Color scheme', 'sugarspice'),
		'desc'      => __('General color scheme.', 'sugarspice'),
		'id'        => 'main_color',
		'std'       => 'emerald',
		'type'      => 'select',
		'class'     => 'mini',
        'options'   => $color_scheme
    );
    
	$options[] = array(
		'name'      => __('Accent color', 'sugarspice'),
		'desc'      => __('Color of the ribbon and various accents.', 'sugarspice'),
		'id'        => 'accent_color',
		'std'       => 'peach',
		'type'      => 'select',
		'class'     => 'mini',
        'options'   => $color_scheme
    );
            
    $options[] = array( 
        'name'  => __('Custom logo image', 'sugarspice'),
        'desc'  => __('You can upload custom image for your website logo (optional).', 'sugarspice'),
        'id'    => 'logo_image',
        'type'  => 'upload'
    );    

    $options[] = array( 
        'name'  => __('Custom favicon', 'sugarspice'),
        'desc'  => __('Small 16x16px pictures you see beside URL in browser\'s address bar. Image should be named <b>favicon.ico</b>', 'sugarspice'),
        'id'    => 'favicon',
        'type'  => 'upload'
    );    

	$options[] = array(
		'name'    => __('Select Layout option', 'sugarspice'),
		'desc'    => __('This layout will be applied to Home Page.', 'sugarspice'),
		'id'      => 'hp_layout',
        'std'     => 'full',
		'type'    => 'select',
		'options' => $layout_options
    );  

    $options[] = array(
		'name'    => __('Select Layout option', 'sugarspice'),
		'desc'    => __('This layout will be applied to Archive & Category Pages.', 'sugarspice'),
		'id'      => 'ap_layout',
        'std'     => 'excerpt',
		'type'    => 'select',
		'options' => $layout_options
    ); 

	$options[] = array( 
		'name'		=> __('Disable responsive stylesheet', 'sugarspice'),
		'id'		=> 'responsive',
        'desc'		=> __('Setting to "Yes" will make your website unresponsive i.e. look the same on computers and mobile devices.','sugarspice'),
		'std' 		=> 0,
		'type' 		=> 'radio',
		'options'	=> $radio
	);

    $options[] = array(
		'name'      => __('Post meta display options', 'sugarspice'),
		'id'        => 'meta_data',
		'std'       => $meta_defaults,
		'type'      => 'multicheck',
		'options'   => $meta_data,
    );

    $options[] = array( 
        'name'  => __('Post signature image', 'sugarspice'),
        'desc'  => __('Image displayed at the very end of every post.', 'sugarspice'),
        'id'    => 'signature_image',
        'type'  => 'upload'
    );
    
	return $options;
}