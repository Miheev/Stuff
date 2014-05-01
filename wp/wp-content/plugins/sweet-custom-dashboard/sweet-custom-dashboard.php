<?php
/*
Plugin Name: Sweet Custom Dashboard
Plugin URL: http://remicorson.com/sweet-custom-dashboard
Description: A nice plugin to create your custom dashboard page
Version: 0.1
Author: Remi Corson
Author URI: http://remicorson.com
Contributors: corsonr
Text Domain: rc_scd
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// plugin folder url
if(!defined('RC_SCD_PLUGIN_URL')) {
	define('RC_SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/

class rc_sweet_custom_dashboard {
 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
 
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
	
		add_action('admin_menu', array( &$this,'rc_scd_register_menu') );
		add_action('load-index.php', array( &$this,'rc_scd_redirect_dashboard') );
 
	} // end constructor
 
	function rc_scd_redirect_dashboard() {
	
		if( is_admin() ) {
			$screen = get_current_screen();
			
			if( $screen->base == 'dashboard' ) {

				wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );
				
			}
		}

	}
	
	
	
	function rc_scd_register_menu() {
		add_dashboard_page( 'Custom Dashboard', 'Custom Dashboard', 'read', 'custom-dashboard', array( &$this,'rc_scd_create_dashboard') );
	}
	
	function rc_scd_create_dashboard() {
        $pdir= plugins_url();
       // <link rel='stylesheet' href="$pdir/bootstrap/css/bootstrap.nocf.css" media='all' />
    //<script src="$pdir/bootstrap/js/bootstrap.min.js"></script>

        //    wp_register_script( 'no-js', get_stylesheet_directory_uri() . '/library/js/no-js.js', array( 'jquery' ), '');
//    //adding scripts file in the footer
//    wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
//    wp_enqueue_script( 'jquery' );
//    wp_enqueue_script( 'no-js' );
    wp_register_style( 'bootstrap-css', $pdir.'/bootstrap/css/bootstrap.nocf.css', array(), '', 'all' );
    wp_enqueue_style( 'bootstrap-css' );

    wp_register_script( 'bootstrap-js', $pdir . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '');
    wp_register_script( 'admin-js', $pdir . '/sweet-custom-dashboard/admin.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-js' );

		include_once( 'custom_dashboard.php'  );
	}

 
}
 
// instantiate plugin's class
$GLOBALS['sweet_custom_dashboard'] = new rc_sweet_custom_dashboard();

?>