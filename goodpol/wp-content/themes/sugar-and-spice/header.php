<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Sugar & Spice
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php if ( of_get_option( 'favicon' ) ) echo '<link rel="shortcut icon" href="'.esc_url( of_get_option( 'favicon' ) ).'" />'; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="header" class="site-header" role="banner">
		<div class="site-branding">

        <?php if (of_get_option('logo_image')) : ?>
        
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-img"><img src="<?php echo esc_attr( of_get_option('logo_image') ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
            
        <?php else : ?>

        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        
        <?php endif; ?>
        
		</div>
        <div id="nav-wrapper">
            <div class="ribbon-left"></div>
            <nav id="main-nav" class="main-navigation" role="navigation">
                <div class="skip-link"><a class="screen-reader-text" href="#content"><?php _e( 'Skip to content', 'sugarspice' ); ?></a></div>
                <?php 
                if(has_nav_menu('primary')){
                    wp_nav_menu( array( 
                        'theme_location'=> 'primary', 
                        'container'     => false,
                        'menu_id'       => 'nav',
                        'fallback_cb'   => 'wp_page_menu' 
                    ) ); 
                } else {
                ?>
                    <ul id="nav">
                        <?php wp_list_pages('title_li='); ?>
                    </ul>
                <?php
                }
                ?>
            </nav><!-- #site-navigation -->
            <div class="ribbon-right"></div>
        </div>
	</header><!-- #header -->

	<div id="main" class="site-main">
 