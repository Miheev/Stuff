<?php
/*
Plugin Name: Popup with fancybox
Description: This plugin allows you to create lightweight JQuery fancy box popup window in your blog with custom content. In the admin interface we can easily configure popup size and timeout. In this popup we can display any content such as Video, Image, Advertisement and much more.
Author: Gopi Ramasamy
Version: 1.3
Plugin URI: http://www.gopiplus.com/work/2013/08/08/popup-with-fancybox-wordpress-plugin/
Author URI: http://www.gopiplus.com/work/2013/08/08/popup-with-fancybox-wordpress-plugin/
Donate link: http://www.gopiplus.com/work/2013/08/08/popup-with-fancybox-wordpress-plugin/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

global $wpdb, $wp_version;
define("Popupwfb_Table", $wpdb->prefix . "popupwith_fancybox");
define('Popupwfb_FAV', 'http://www.gopiplus.com/work/2013/08/08/popup-with-fancybox-wordpress-plugin/');

if ( ! defined( 'POPUPWFB_BASENAME' ) )
	define( 'POPUPWFB_BASENAME', plugin_basename( __FILE__ ) );
	
if ( ! defined( 'POPUPWFB_PLUGIN_NAME' ) )
	define( 'POPUPWFB_PLUGIN_NAME', trim( dirname( POPUPWFB_BASENAME ), '/' ) );
	
if ( ! defined( 'POPUPWFB_PLUGIN_URL' ) )
	define( 'POPUPWFB_PLUGIN_URL', WP_PLUGIN_URL . '/' . POPUPWFB_PLUGIN_NAME );
	
if ( ! defined( 'POPUPWFB_ADMIN_URL' ) )
	define( 'POPUPWFB_ADMIN_URL', get_option('siteurl') . '/wp-admin/options-general.php?page=popup-with-fancybox' );

if (!session_id())
{
	session_start();
}

function popupwfb( $Popupwfb_group = "", $Popupwfb_id = "" )
{
	global $wpdb;
	$Popupwfb_session = get_option('Popupwfb_session');
	$display = "NO";
	if($Popupwfb_session == "NO")
	{
		$display = "YES";
	}
	else if($Popupwfb_session == "YES" && isset($_SESSION['popup-with-fancybox']) <> "YES")
	{
		$display = "YES";
	}
	else if($Popupwfb_session == "YES" && isset($_SESSION['popup-with-fancybox']) == "YES")
	{
		$display = "NO";
	}

	if($display == "YES")
	{
		$ArrInput = array();
		$ArrInput["group"] = $Popupwfb_group;
		$ArrInput["id"] = $Popupwfb_id;
		echo Popupwfb_shortcode( $ArrInput );
	}
}

function Popupwfb_shortcode( $atts ) 
{
	global $wpdb;
	
	// [popupwfancybox group="GROUP1" id="1"]
	if ( ! is_array( $atts ) )
	{
		return '';
	}
	$Popupwfb_group = isset($atts['group']) ? $atts['group'] : '';
	$Popupwfb_id = isset($atts['id']) ? $atts['id'] : '';
	
	$sSql = "select * from ".Popupwfb_Table." where Popupwfb_status = 'YES'";
	if($Popupwfb_group <> "" && $Popupwfb_id <> "")
	{
		$sSql = $sSql . " and Popupwfb_group='$Popupwfb_group'";
		$sSql = $sSql . " and Popupwfb_id=$Popupwfb_id";	
	}
	else if($Popupwfb_group <> "" && $Popupwfb_id == "")
	{
		$sSql = $sSql . " and Popupwfb_group='$Popupwfb_group'";
	}
	else if($Popupwfb_group == "" && $Popupwfb_id <> "")
	{
		$sSql = $sSql . " and Popupwfb_id=$Popupwfb_id";
	}
	
	$sSql = $sSql . " and ( Popupwfb_expiration >= NOW() or Popupwfb_expiration = '0000-00-00 00:00:00' )";
	$sSql = $sSql . " Order by rand()";
	$sSql = $sSql . " LIMIT 0,1";

	$Popupwfb = "";
	$data = $wpdb->get_results($sSql);
	if ( ! empty($data) ) 
	{
		$data = $data[0];
		$Popupwfb_id = $data->Popupwfb_id;
		$Popupwfb_width = stripslashes($data->Popupwfb_width);
		$Popupwfb_timeout = stripslashes($data->Popupwfb_timeout);
		$Popupwfb_title = stripslashes($data->Popupwfb_title);
		$Popupwfb_content = stripslashes($data->Popupwfb_content);
		
		if(!is_numeric($Popupwfb_width)) { $Popupwfb_width = 500 ;}
		if(!is_numeric($Popupwfb_timeout)) { $Popupwfb_timeout = 3000 ;}

		$Popupwfb = $Popupwfb.'<script language="javascript" type="text/javascript">';
		$Popupwfb = $Popupwfb.' function PopupWithFancybox(){ jQuery(document).ready(function() { jQuery.fancybox(addText); }); }';
		$Popupwfb = $Popupwfb." setTimeout('PopupWithFancybox()', ".$Popupwfb_timeout.");";
		$Popupwfb = $Popupwfb.'</script>';

		$Popupwfb = $Popupwfb.'<div id="simple-popup-with-fancybox" style="display: none;">';
			$Popupwfb = $Popupwfb.'<div class="fancybox-content-inside" style="width:'.$Popupwfb_width.'px">';
				$Popupwfb = $Popupwfb. nl2br(stripslashes($Popupwfb_content));
			$Popupwfb = $Popupwfb.'</div>';
		$Popupwfb = $Popupwfb.'</div>';

		$Popupwfb = $Popupwfb.'<script language="javascript" type="text/javascript">';
		$Popupwfb = $Popupwfb." addText = document.getElementById('simple-popup-with-fancybox').innerHTML;";
		$Popupwfb = $Popupwfb.'</script>';
		
		$_SESSION['popup-with-fancybox'] = "YES";
	}
	else
	{
		// $Popupwfb = "No popup record found.";
		// No records available.
	}
	return $Popupwfb;
}

function Popupwfb_install() 
{
	global $wpdb, $wp_version;
	if($wpdb->get_var("show tables like '". Popupwfb_Table . "'") != Popupwfb_Table) 
	{
		$sSql = "CREATE TABLE IF NOT EXISTS ". Popupwfb_Table . " (";
		$sSql = $sSql . "Popupwfb_id INT NOT NULL AUTO_INCREMENT ,";
		$sSql = $sSql . "Popupwfb_width int(11) NOT NULL default '500' ,";
		$sSql = $sSql . "Popupwfb_timeout int( 11 ) NOT NULL default '3000' ,";
		$sSql = $sSql . "Popupwfb_title VARCHAR( 1024 ) NOT NULL default 'Sample popup' ,";
		$sSql = $sSql . "Popupwfb_content TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,";
		$sSql = $sSql . "Popupwfb_group VARCHAR( 20 ) NOT NULL default 'GROUP1' ,";
		$sSql = $sSql . "Popupwfb_status VARCHAR( 3 ) NOT NULL default 'YES' ,";
		$sSql = $sSql . "Popupwfb_expiration datetime NOT NULL default '0000-00-00 00:00:00' ,";
		$sSql = $sSql . "Popupwfb_starttime datetime NOT NULL default '0000-00-00 00:00:00' ,";
		$sSql = $sSql . "Popupwfb_extra1 VARCHAR( 1024 ) NOT NULL default '' ,";
		$sSql = $sSql . "Popupwfb_extra2 VARCHAR( 1024 ) NOT NULL default '' ,";
		$sSql = $sSql . "PRIMARY KEY ( `Popupwfb_id` )";
		$sSql = $sSql . ") ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		$wpdb->query($sSql);
		
		$sSql = "";	
		$con = '<h2>Live demo</h2>';
		$con = $con . ' <div style="height:10px;"></div>';
		$con = $con . ' <p><img style="margin: 5px;text-align:left;float:left;" title="" src="http://www.gopiplus.com/work/wp-content/uploads/pluginimages/img/gopiplus.com-popup.png" alt=""> This is live demo for <strong>Popup with fancybox</strong> wordpress plugin. This plugin allows you to create lightweight JQuery fancy box popup window in your blog with custom content. In the admin interface we can easily configure popup size and timeout (i.e. show popup window based on timeout after page load). In this popup we can display any content such as <strong style="color:#0066CC;">Video, Image, Advertisement</strong> and much more.</p>';
		$con = $con . ' <div style="height:10px;"></div>';
		$con = $con . ' <p>In the admin we have standard wordpress HTML editor to create the popup message. So that we can customize the messages easily. also we have option to set <strong>expiration time</strong> for popup window. and we have option to display popup once per session, so that the popup never appear again if user navigate to another page.</p>';
		$con = $con . ' <div style="height:10px;"></div>';
		$con = $con . ' <p align="right"><span><a href="http://www.gopiplus.com/work/2013/08/08/popup-with-fancybox-wordpress-plugin/">Refresh</a></span> || <span><a href="http://www.gopiplus.com/work/wordpress-plugin-download/">Download</a></span></p>';

		$IsSql = "INSERT INTO `". Popupwfb_Table . "` (`Popupwfb_content`)"; 
		$sSql = $IsSql . " VALUES ('".$con."');";
		$wpdb->query($sSql);
	}
	add_option('Popupwfb_group', "GROUP1");
	add_option('Popupwfb_session', "NO");
}

function Popupwfb_widget($args) 
{
	global $wpdb;
	$Popupwfb_session = get_option('Popupwfb_session');
	$display = "NO";
	if($Popupwfb_session == "NO")
	{
		$display = "YES";
	}
	else if($Popupwfb_session == "YES" && isset($_SESSION['popup-with-fancybox']) <> "YES")
	{
		$display = "YES";
	}
	else if($Popupwfb_session == "YES" && isset($_SESSION['popup-with-fancybox']) == "YES")
	{
		$display = "NO";
	}

	if($display == "YES")
	{
		extract($args);
		$Popupwfb_group = get_option('Popupwfb_group');
		popupwfb($Popupwfb_group = $Popupwfb_group);
	}
}
	
function Popupwfb_control() 
{
	echo '<p>';
	_e('Check official website for more information', 'popupwfb');
	?> <a target="_blank" href="<?php echo Popupwfb_FAV; ?>"><?php _e('click here', 'popupwfb'); ?></a></p><?php
}

function Popupwfb_widget_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget( __('Popup with fancybox', 'popupwfb'), __('Popup with fancybox', 'popupwfb'), 'Popupwfb_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control(__('Popup with fancybox', 'popupwfb'), array( __('Popup with fancybox', 'popupwfb'), 'widgets'), 'Popupwfb_control');
	} 
}

function Popupwfb_deactivation() 
{
	delete_option( 'Popupwfb_group' ); 
	delete_option( 'Popupwfb_session' ); 
}

function Popupwfb_admin()
{
	global $wpdb;
	$current_page = isset($_GET['ac']) ? $_GET['ac'] : '';
	switch($current_page)
	{
		case 'edit':
			include('pages/content-management-edit.php');
			break;
		case 'add':
			include('pages/content-management-add.php');
			break;
		case 'set':
			include('pages/content-setting.php');
			break;
		default:
			include('pages/content-management-show.php');
			break;
	}
}

function Popupwfb_add_to_menu() 
{
	add_options_page(__('Popup with fancybox', 'popupwfb'), __('Popup with fancybox', 'popupwfb'), 'manage_options', 'popup-with-fancybox', 'Popupwfb_admin' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'Popupwfb_add_to_menu');
}

function Popupwfb_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_script('jquery');
		wp_enqueue_style( 'jquery.fancybox', get_option('siteurl').'/wp-content/plugins/popup-with-fancybox/inc/jquery.fancybox.css');
		wp_enqueue_script('jquery.fancybox', get_option('siteurl').'/wp-content/plugins/popup-with-fancybox/inc/jquery.fancybox.js');
	}
}  

function Popupwfb_textdomain() 
{
	  load_plugin_textdomain( 'popupwfb', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action('plugins_loaded', 'Popupwfb_textdomain');
add_shortcode( 'popupwfancybox', 'Popupwfb_shortcode' );
add_action('wp_enqueue_scripts', 'Popupwfb_add_javascript_files');
add_action("plugins_loaded", "Popupwfb_widget_init");
register_activation_hook(__FILE__, 'Popupwfb_install');
register_deactivation_hook(__FILE__, 'Popupwfb_deactivation');
add_action('init', 'Popupwfb_widget_init');
?>