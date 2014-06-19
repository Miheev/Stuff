<?
add_theme_support( 'post-thumbnails' ); 
add_theme_support('menus');
add_filter('widget_text', 'do_shortcode');
add_image_size( 'bones-thumb-300', 300, 200, true );
add_image_size( 'bones-thumb-600', 600, 400, true );
?>