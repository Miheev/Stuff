<?php

/*
Plugin Name: Huge IT slider
Plugin URI: http://huge-it.com/slider
Description: Huge IT slider is a convenient tool for organizing the images represented on your website into sliders. Each product on the slider is assigned with a relevant slider, which makes it easier for the customers to search and identify the needed images within the slider.
Version: 2.2
Author: http://huge-it.com/
License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/



/*ADDING to HEADER of FRONT END */
	function init_jquery() {
			wp_enqueue_script('jquery');
	}
	add_action('init', 'init_jquery');
		
	add_action( 'admin_enqueue_scripts', 'hugeit_header' );
    function hugeit_header() {
        wp_enqueue_style( 'prefix-style',plugins_url('style/admin.style.css', __FILE__) );
        wp_enqueue_style( 'prefix-style',plugins_url('style/admin.js', __FILE__) );
    }
	

add_action('media_buttons_context', 'add_my_custom_button');


add_action('admin_footer', 'add_inline_popup_content');


function add_my_custom_button($context) {
  

  $img = plugins_url( '/images/post.button.png' , __FILE__ );
  

  $container_id = 'huge_it_slider';
  

  $title = 'Select Huge IT Slider to insert into post';

  $context .= '<a class="button thickbox" title="Select slider to insert into post"    href="#TB_inline?width=400&inlineId='.$container_id.'">
		<span class="wp-media-buttons-icon" style="background: url('.$img.'); background-repeat: no-repeat; background-position: left bottom;"></span>
	Add Slider
	</a>';
  
  return $context;
}

function add_inline_popup_content() {
?>
<script type="text/javascript">
				jQuery(document).ready(function() {
				  jQuery('#hugeitsliderinsert').on('click', function() {
				  	var id = jQuery('#huge_it_slider-select option:selected').val();
				  	window.send_to_editor('[huge_it_slider id="' + id + '"]');
					tb_remove();
				  })
				});
</script>

<div id="huge_it_slider" style="display:none;">
  <h3>Select Huge IT Slider to insert into post</h3>
  <?php 
  	  global $wpdb;
	  $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_itslider_sliders order by id ASC",$id);
			   $shortcodesliders=$wpdb->get_results($query);
			   ?>

 <?php 	if (count($shortcodesliders)) {
							echo "<select id='huge_it_slider-select'>";
							foreach ($shortcodesliders as $shortcodeslider) {
								echo "<option value='".$shortcodeslider->id."'>".$shortcodeslider->name."</option>";
							}
							echo "</select>";
							echo "<button class='button primary' id='hugeitsliderinsert'>Insert Slider</button>";
						} else {
							echo "No slideshows found", "huge_it_slider";
						}
						?>
	
</div>
<?php
}
///////////////////////////////////shortcode update/////////////////////////////////////////////


add_action('init', 'hugesl_do_output_buffer');
function hugesl_do_output_buffer() {
        ob_start();
}
add_action('init', 'slider_lang_load');

function slider_lang_load()
{
    load_plugin_textdomain('sp_slider', false, basename(dirname(__FILE__)) . '/Languages');

}

$ident = 1;

add_action('admin_head', 'huge_it_ajax_func');
function huge_it_ajax_func()
{
    ?>
    <script>
        var huge_it_ajax = '<?php echo admin_url("admin-ajax.php"); ?>';
    </script>
<?php
}

function huge_it_slider_images_list_shotrcode($atts)
{
    extract(shortcode_atts(array(
        'id' => 'no huge_it slider',
    
    ), $atts));
    if (!(is_numeric($atts['id']) || $atts['id'] == 'ALL_CAT'))
        return 'insert numerical or `ALL_CAT` shortcode in `id`';



    return huge_it_cat_images_list($atts['id']);

}


/////////////// Filter slider


function slider_after_search_results($query)
{
    global $wpdb;
    if (isset($_REQUEST['s']) && $_REQUEST['s']) {
        $serch_word = htmlspecialchars(($_REQUEST['s']));

        $query = str_replace($wpdb->prefix . "posts.post_content", gen_string_slider_search($serch_word, $wpdb->prefix . 'posts.post_content') . " " . $wpdb->prefix . "posts.post_content", $query);
    }
    return $query;

}

add_filter('posts_request', 'slider_after_search_results');


function gen_string_slider_search($serch_word, $wordpress_query_post)
{
    $string_search = '';

    global $wpdb;
    if ($serch_word) {
        $rows_slider = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_itslider_sliders WHERE (description LIKE %s) OR (name LIKE %s)", '%' . $serch_word . '%', "%" . $serch_word . "%"));

        $count_cat_rows = count($rows_slider);
        if ($count_cat_rows) {
            $string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_slider id="ALL_CAT" details="1" %\' OR ';
        }
        for ($i = 0; $i < $count_cat_rows; $i++) {
            $string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_slider id="' . $rows_slider[$i]->id . '" details="1" %\' OR ' . $wordpress_query_post . ' LIKE \'%[huge_it_slider id="' . $rows_slider[$i]->id . '" details="1"%\' OR ';
        }


        $rows_slider = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "huge_itslider_sliders WHERE (name LIKE '%" . $serch_word . "%')");
        $count_cat_rows = count($rows_slider);
        for ($i = 0; $i < $count_cat_rows; $i++) {
            $string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_slider id="' . $rows_slider[$i]->id . '" details="0"%\' OR ' . $wordpress_query_post . ' LIKE \'%[huge_it_slider id="' . $rows_slider[$i]->id . '" details="0"%\' OR ';
        }

        $rows_single = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "huge_itslider_images WHERE name LIKE '%" . $serch_word . "%'");

        $count_sing_rows = count($rows_single);
        if ($count_sing_rows) {
            for ($i = 0; $i < $count_sing_rows; $i++) {
                $string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_slider_Product id="' . $rows_single[$i]->id . '"]%\' OR ';
            }

        }
    }
    return $string_search;
}


///////////////////// end filter


add_shortcode('huge_it_slider', 'huge_it_slider_images_list_shotrcode');




function   huge_it_cat_images_list($id)
{
    require_once("slider_front_end.html.php");
    require_once("slider_front_end.php");
    if (isset($_GET['product_id'])) {
        if (isset($_GET['view'])) {
            if ($_GET['view'] == 'huge_itslider') {
                return showPublishedimages_1($id);
            } else {
                return front_end_single_product($_GET['product_id']);
            }
        } else {
            return front_end_single_product($_GET['product_id']);
        }
    } else {
        return showPublishedimages_1($id);
    }
}



function huge_itbox_scripts_method()
{
  
}

add_action('wp_head', 'huge_itbox_scripts_method', 1);


add_filter('admin_head', 'huge_it_cat_ShowTinyMCE');
function huge_it_cat_ShowTinyMCE()
{
    // conditions here
    wp_enqueue_script('common');
    wp_enqueue_script('jquery-color');
    wp_print_scripts('editor');
    if (function_exists('add_thickbox')) add_thickbox();
    wp_print_scripts('media-upload');
    if (version_compare(get_bloginfo('version'), 3.3) < 0) {
        if (function_exists('wp_tiny_mce')) wp_tiny_mce();
    }
    wp_admin_css();
    wp_enqueue_script('utils');
    do_action("admin_print_styles-post-php");
    do_action('admin_print_styles');
}


add_action('admin_menu', 'huge_it_slider_options_panel');
function huge_it_slider_options_panel()
{
    $page_cat = add_menu_page('Theme page title', 'Huge IT slider', 'manage_options', 'sliders_huge_it_slider', 'sliders_huge_it_slider', plugins_url('images/huge_it_sliderLogoHover -for_menu.png', __FILE__));
    add_submenu_page('sliders_huge_it_slider', 'Sliders', 'Sliders', 'manage_options', 'sliders_huge_it_slider', 'sliders_huge_it_slider');
    $page_option = add_submenu_page('sliders_huge_it_slider', 'General options', 'General options', 'manage_options', 'Options_slider_styles', 'Options_slider_styles');
    add_submenu_page( 'sliders_huge_it_slider', 'Licensing', 'Licensing', 'manage_options', 'huge_it_slider_Licensing', 'huge_it_slider_Licensing');
}


/////////////////////             huge_it_slider print styles

//////////////////////////////////////////
//           LICENS
/////////////////////////////////////
function huge_it_slider_Licensing(){
	
	?>
    <div style="width:95%">
    <p>
	This plugin is the non-commercial version of the Huge IT slider. If you want to customize to the styles and colors of your website,than you need to buy a license.
Purchasing a license will add possibility to customize the slider options of the Huge IT slider. 

 </p>
<br /><br />
<a href="http://huge-it.com/slider/" class="button-primary" target="_blank">Purchase a License</a>
<br /><br /><br />
<p>After the purchasing the commercial version follow this steps:</p>
<ol>
	<li>Deactivate Huge IT slider Plugin</li>
	<li>Delete Huge IT slider Plugin</li>
	<li>Install the downloaded commercial version of the plugin</li>
</ol>
</div>
<?php
    
    
	
	}

function sliders_huge_it_slider()
{

    require_once("sliders.php");
    require_once("sliders.html.php");
    if (!function_exists('print_html_nav'))
        require_once("slider_function/html_slider_func.php");


    if (isset($_GET["task"]))
        $task = $_GET["task"]; 
    else
        $task = '';
    if (isset($_GET["id"]))
        $id = $_GET["id"];
    else
        $id = 0;
    global $wpdb;
    switch ($task) {

        case 'add_cat':
            add_slider();
            break;
			case 'popup_posts':
            if ($id)
                popup_posts($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "huge_itslider_sliders");
                popup_posts($id);
            }
            break;
        case 'edit_cat':
            if ($id)
                editslider($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "huge_itslider_sliders");
                editslider($id);
            }
            break;

        case 'save':
            if ($id)
                apply_cat($id);
        case 'apply':
            if ($id) {
                apply_cat($id);
                editslider($id);
            } 
            break;
        case 'remove_cat':
            removeslider($id);
            showslider();
            break;
        default:
            showslider();
            break;
    }


}


function Options_slider_styles()
{

    require_once("slider_Options.php");
    require_once("slider_Options.html.php");
    if (isset($_GET['task']))
        if ($_GET['task'] == 'save')
            save_styles_options();
    showStyles();


}

/**
 * Huge IT Widget
 */
class Huge_it_Widget extends WP_Widget {


	public function __construct() {
		parent::__construct(
	 		'Huge_it_Widget', 
			'Huge IT Slider', 
			array( 'description' => __( 'Huge IT Slider', 'huge_it_slider' ), ) 
		);
	}

	
	public function widget( $args, $instance ) {
		extract($args);

		if (isset($instance['slider_id'])) {
			$slider_id = $instance['slider_id'];

			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $before_widget;
			if ( ! empty( $title ) )
				echo $before_title . $title . $after_title;

			echo do_shortcode("[huge_it_slider id={$slider_id}]");
			echo $after_widget;
		}
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['slider_id'] = strip_tags( $new_instance['slider_id'] );
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}


	public function form( $instance ) {
		$selected_slider = 0;
		$title = "";
		$sliders = false;

		if (isset($instance['slider_id'])) {
			$selected_slider = $instance['slider_id'];
		}

		if (isset($instance['title'])) {
			$title = $instance['title'];
		}

        

        
		?>
		<p>
			
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<label for="<?php echo $this->get_field_id('slider_id'); ?>"><?php _e('Select Slider:', 'huge_it_slider'); ?></label> 
				<select id="<?php echo $this->get_field_id('slider_id'); ?>" name="<?php echo $this->get_field_name('slider_id'); ?>">
				
				<?php
				 global $wpdb;
				$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_itslider_sliders ");
				$rowwidget=$wpdb->get_results($query);
				foreach($rowwidget as $rowwidgetecho){
				
				selected
				?>
					<option <?php if($rowwidgetecho->id == $instance['slider_id']){ echo 'selected'; } ?> value="<?php echo $rowwidgetecho->id; ?>"><?php echo $rowwidgetecho->name; ?></option>

					<?php } ?>
				</select>

		</p>
		<?php 
	}
}

add_action('widgets_init', 'register_Huge_it_Widget');  

function register_Huge_it_Widget() {  
    register_widget('Huge_it_Widget'); 
}

//////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
//////////////////////////////////////////////////////               Activate Slider                     ///////////////////////////////////////////////////////
//////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
//////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////


function huge_it_slider_activate()
{
    global $wpdb;

/// creat database tables



    $sql_huge_itslider_params = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_itslider_params`(
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(50) 
CHARACTER SET utf8 NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
 `description` text CHARACTER SET utf8 NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 NOT NULL,
  
 PRIMARY KEY (`id`)
 
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ";

    $sql_huge_itslider_images = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_itslider_images` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
 `slider_id` varchar(200) ,
 `description` text,
  `image_url` text,
  `sl_url` varchar(128) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(4) unsigned DEFAULT NULL,
  `published_in_sl_width` tinyint(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5";

    $sql_huge_itslider_sliders = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_itslider_sliders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sl_height` int(11) unsigned DEFAULT NULL,
  `sl_width` int(11) unsigned DEFAULT NULL,
  `pause_on_hover` text,
  `slider_list_effects_s` text,
  `description` text,
  `param` text,
  `ordering` int(11) NOT NULL,
  `published` tinyint(4) unsigned DEFAULT NULL,
  
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ";




    $table_name = $wpdb->prefix . "huge_itslider_params";
    $sql_1 = <<<query1
INSERT INTO `$table_name` (`name`, `title`,`description`, `value`) VALUES
( 'slider_crop_image', 'Slider crop image', 'Slider crop image', 'resize'),
( 'slider_title_color', 'Slider title color', 'Slider title color', 'ffffff'),
( 'slider_title_font_size', 'Slider title font size', 'Slider title font size', '14'),
( 'slider_description_color', 'Slider description color', 'Slider description color', 'ffffff'),
( 'slider_description_font_size', 'Slider description font size', 'Slider description font size', '13'),
( 'slider_title_position', 'Slider title position', 'Slider title position', 'right-top'),
( 'slider_description_position', 'Slider description position', 'Slider description position', 'right-bottom'),
( 'slider_title_border_size', 'Slider Title border size', 'Slider Title border size', '0'),
( 'slider_title_border_color', 'Slider title border color', 'Slider title border color', 'ffffff'),
( 'slider_title_border_radius', 'Slider title border radius', 'Slider title border radius', '5'),
( 'slider_description_border_size', 'Slider description border size', 'Slider description border size', '0'),
( 'slider_description_border_color', 'Slider description border color', 'Slider description border color', 'ffffff'),
( 'slider_description_border_radius', 'Slider description border radius', 'Slider description border radius', '5'),
( 'slider_slideshow_border_size', 'Slider slideshow border size', 'Slider slideshow border size', '0'),
( 'slider_slideshow_border_color', 'Slider slideshow border color', 'Slider slideshow border color', 'ffffff'),
( 'slider_slideshow_border_radius', 'Slider slideshow border radius', 'Slider slideshow border radius', '0'),
( 'slider_navigation_type', 'Slider navigation type', 'Slider navigation type', '1'),
( 'slider_navigation_position', 'Slider navigation position', 'Slider navigation position', 'bottom'),
( 'slider_title_background_color', 'Slider title background color', 'Slider title background color', '000000'),
( 'slider_description_background_color', 'Slider description background color', 'Slider description background color', '000000'),
( 'slider_title_transparent', 'Slider title has background', 'Slider title has background', 'checked'),
( 'slider_description_transparent', 'Slider description has background', 'Slider description has background', 'checked'),
( 'slider_slider_background_color', 'Slider slider background color', 'Slider slider background color', 'ffffff'),
( 'slider_dots_position', 'slider dots position', 'slider dots position', 'top'),
( 'slider_active_dot_color', 'slider active dot color', '', 'ffffff'),
( 'slider_dots_color', 'slider dots color', '', '000000');


query1;

    $table_name = $wpdb->prefix . "huge_itslider_images";
    $sql_2 = "
INSERT INTO 

`" . $table_name . "` (`id`, `slider_id`, `name`, `description`, `image_url`, `sl_url`, `ordering`, `published`) VALUES
(1, '1', '',  '', '" . plugins_url("Front_images/slides/slide1.jpg", __FILE__) . "', 'http://huge-it.com',  1, 1),
(2, '1', 'Simple Usage',  '', '" . plugins_url("Front_images/slides/slide2.jpg", __FILE__) . "', 'http://huge-it.com',  2, 1),
(3, '1', 'Huge-IT Slider',  'The slider allows having unlimited amount of images with their titles and descriptions. The slider uses autogenerated shortcodes making it easier for the users to add it to the custom location.', '" . plugins_url("Front_images/slides/slide3.jpg", __FILE__) . "', 'http://huge-it.com',  3, 1)";


    $table_name = $wpdb->prefix . "huge_itslider_sliders";


    $sql_3 = "

INSERT INTO `$table_name` (`id`, `name`, `sl_height`, `sl_width`, `pause_on_hover`, `slider_list_effects_s`, `description`, `param`, `ordering`, `published`) VALUES
(1, 'My First Slider', '375', '600', 'on', 'random', '4000', '700', '1', '1')";




    $wpdb->query($sql_huge_itslider_params);
    $wpdb->query($sql_huge_itslider_images);
    $wpdb->query($sql_huge_itslider_sliders);


    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_itslider_params")) {
        $wpdb->query($sql_1);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_itslider_images")) {
      $wpdb->query($sql_2);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_itslider_sliders")) {
      $wpdb->query($sql_3);
    }


}


register_activation_hook(__FILE__, 'huge_it_slider_activate');




if (get_bloginfo('version') >= 3.1) {

    add_action('plugins_loaded', 'slider');

} else {
    slider();
}

function slider()
{
    global $wpdb;
	
	

	$product = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_sliders", ARRAY_A);
    $isUpdate = 0;
	foreach ($product as $prod) {
        if ($prod['Field'] == 'published' && $prod['Type'] == 'tinyint(4) unsigned') {
            $isUpdate = 1;
            break;
        }
    }
	if ($isUpdate) {
	$wpdb->query("ALTER TABLE `wp_huge_itslider_sliders` MODIFY `published` text");
	$wpdb->query("UPDATE ".$wpdb->prefix."huge_itslider_sliders SET published = '300' WHERE id = 1 ");
	}

	}




