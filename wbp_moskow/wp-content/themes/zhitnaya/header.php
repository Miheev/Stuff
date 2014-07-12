<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7]>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie6"><![endif]--><!--[if IE 7 ]>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie7"><![endif]--><!--[if IE 8 ]>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie8"><![endif]--><!--[if IE 9 ]>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie9"><![endif]--><!---[if (gt IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="no-ie"><!--<![endif]-->
<html>
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<? /*<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" /> */ ?>

<?php //wp_head(); ?>


    <meta name="viewport" content="width=device-width, maximum-scale=1.0" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700|Open+Sans+Condensed:300,700&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css" />
    <script src="<?php echo get_template_directory_uri(); ?>/js/js.js" language="javascript1.1"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/gallery.js" language="javascript1.1"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/3rdparty/jquery/jquery.js" language="javascript1.1"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/3rdparty/jquery-ui/jquery-ui-1.10.3.min.js" language="javascript1.1"></script>
    <link href="<?php echo get_template_directory_uri(); ?>/3rdparty/jquery-ui/jquery-ui-themes-1.10.3/themes/ui-lightness/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_template_directory_uri(); ?>/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_template_directory_uri(); ?>/css/slider.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_template_directory_uri(); ?>/css/gallery.css" rel="stylesheet" type="text/css"/>
    <link  href="<?php echo get_template_directory_uri(); ?>/css/fotorama.css" rel="stylesheet" />
    <link  href="<?php echo get_template_directory_uri(); ?>/player/video-js/video-js.min.css" rel="stylesheet" />
    <script src="<?php echo get_template_directory_uri(); ?>/js/fotorama.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/player/video-js/video.js"></script>
    <link href="<?php echo get_template_directory_uri(); ?>/css/site_v01.css" rel="stylesheet" type="text/css"/>
    <!--[if IE]><link href="<?php echo get_template_directory_uri(); ?>//css/site.ie.css" rel="stylesheet" type="text/css"/><![endif]-->
    <link href="<?php echo get_template_directory_uri(); ?>/css/reveal.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo get_template_directory_uri(); ?>/js/site.js" language="javascript1.1"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.reveal.min.js" language="javascript1.1"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/slider.js" language="javascript1.1"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.scrollUp.js" language="javascript1.1"></script>
    <link href="<?php echo get_template_directory_uri(); ?>/css/image.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_template_directory_uri(); ?>/css/patches.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_template_directory_uri(); ?>/css/i18n-ru.css" rel="stylesheet" type="text/css"/>
</head>
<body><div class="page">
	<div class="wrap wrap_bar">
    <div class="wrap__inner">
        <div class="bar typo--open-sans-condensed typo--upc">
            <div class="NavRoot">
<? wp_nav_menu(array(
  'menu' => 'Верхнее', // название меню
  'container' => '',
  'container_class' => '',
  'container_id' => '', // id для контейнера
  'menu_class' => 'item', // класс для меню
  'menu_id' => '', // id для меню
)); ?>
	

	<div class="cl"></div>
</div>

            <div class="phone">
                +7 (499) 238-11-07 &nbsp;&nbsp;+7 (499) 238-30-10
            </div>
            <ul class="language list-with-sep-hor">
              <li class="active"><a href="#">Русский</a></li>
                <li ><a href="#">English</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="wrap wrap_header">
    <div class="wrap__inner">
        <div class="header">
            <div class="NavRoot NavRoot_mainMenu">
	<div class="logo"><a href="/"></a></div>
	
<? wp_nav_menu(array(
  'menu' => 'Основное', // название меню
  'container' => '',
  'container_class' => '',
  'container_id' => '', // id для контейнера
  'menu_class' => 'item', // класс для меню
  'menu_id' => '', // id для меню
)); ?>
	
	
	<div class="cl"></div>
</div>

        </div>
    </div>
</div>