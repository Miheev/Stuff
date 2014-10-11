<? //header("Content-Type: text/html; charset=UTF-8") ?>
<? IncludeTemplateLangFile(__FILE__) ?>
<?
$page_class=trim($APPLICATION->GetCurPage(), '/');
if (empty($page_class))
    $page_class= 'index';
else
    $arParams = array("replace_space"=>"-","replace_other"=>"-");
$page_class = Cutil::translit($page_class,"ru",$arParams);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="x-rim-auto-match" content="none">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="styles.css" media="all">
		<script src="/bitrix/templates/main_test_copy/script/jquery-1.10.0.min.js" type="text/javascript"></script>
		<script src="/bitrix/templates/main_test_copy/script/selectivizr-min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="/bitrix/templates/main_test_copy/script/jcarousel.css" media="all">
		<script src="/bitrix/templates/main_test_copy/script/jquery.jcarousel.js" type="text/javascript"></script>
		<script type="text/javascript" src="/bitrix/templates/main_test_copy/script/jquery.iosslider.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/bitrix/templates/main_test_copy/script/iosslider.css" media="all">	
		<link rel="stylesheet" type="text/css" href="/bitrix/templates/main_test_copy/script/jquery.fancybox.css" media="all">
		<script src="/bitrix/templates/main_test_copy/script/jquery.fancybox.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="/bitrix/templates/main_test_copy/script/jquery.znice.css" media="all">
		<script src="/bitrix/templates/main_test_copy/script/jquery.validate.min.js" type="text/javascript"></script>
		<script src="/bitrix/templates/main_test_copy/script/jquery.znice.validate.js" type="text/javascript"></script>
		<script src="/bitrix/templates/main_test_copy/script/jquery.znice.js" type="text/javascript"></script>
		<script src="/bitrix/templates/main_test_copy/script/modernizr.js" type="text/javascript"></script>
		<script src="/bitrix/templates/main_test_copy/script/jquery.watermark.min.js" type="text/javascript"></script>
		<script src="/bitrix/templates/main_test_copy/script/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="/bitrix/templates/main_test/script/jquery-ui-1.10.3.custom.css" media="all">
		<script src="/bitrix/templates/main_test_copy/script/scr.js" type="text/javascript"></script>
			<!--[if lt IE 9]>
				<script>
				document.createElement('header');
				document.createElement('nav');
				document.createElement('section');
				document.createElement('article');
				document.createElement('aside');
				document.createElement('footer');
				document.createElement('time');
				</script>	
				<script src="js/pie.js" type="text/javascript"></script>
			<![endif]-->
			<!--[if lt IE 8]><script src="js/oldie/warning.js"></script><script>window.onload=function(){e("js/oldie/")}</script><![endif]-->	
		<script type="text/javascript">
		<!-- slide change delay in ms -->
		var sdelay = 5000;

		//slider range settings in catalog filter 
		var valmin = 0;
		var valmax = 300;
	</script>
	<?$APPLICATION->ShowHead()?>
	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body class="<?php echo $page_class; ?>">
		<?$APPLICATION->ShowPanel();?>
	<div class="zHiddenBlock">
	
	</div>
	<header class="header">		
<script>
 jQuery(document).ready(function($) {
if(location.pathname.split("/")[1] != "")
{
    $('.navigation a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active_menu');
}
});
</script>
		<div class="header-top">
	<div class="header-top-dark">
		<div class="mbox">
			<div class="lang">
				<a href="/" class="active">Ru</a>
				<a href="/en/" title="English">En</a>
			</div>
			<div class="search-block">
				<form action="" class="search-form">
					<div class="search-wrap">
						<span class="search-field">
							<input type="text" name="s" class="input-search">
						</span>
						<span class="search-submit">
							<input type="submit" value="">
						</span>
					</div>
				</form>
			</div>
			<a href="#" class="h-favorites">Избранное</a>
			<div class="h-callback u_modal">
				<a href="#" class="h-callback-link u_modal-link" data-umodal="callback">Заказать звонок</a>
				<!-- callback popup -->
<div class="callback-popup u_modal-block" data-umodal="callback" style="display: none; opacity: 1;">
	<a href="#" class="form-close u_modal-close"></a>
	<form action="" method="post" class="popup-form zNice" autocomplete="off" novalidate="novalidate">
		<div class="form-row">
			<span class="zNice-wrap form-input zNice-tInput"><span class="zNice-bg"></span><input type="text" name="name" class="" required="required" placeholder="Имя"></span>
		</div>
		<div class="form-row">
			<span class="zNice-wrap form-input zNice-tInput"><span class="zNice-bg"></span><input type="text" name="phone" class="" required="required" placeholder="Телефон"></span>
		</div>
		<div class="form-row">
			<span class="zNice-wrap form-input zNice-tInput"><span class="zNice-bg"></span><input type="text" name="time" class="" required="required" placeholder="Время звонка"></span>
		</div>
		<div class="form-row">
			<span class="zNice-wrap form-input zNice-tInput"><span class="zNice-bg"></span><input type="text" name="from" class="" required="required" placeholder="Регион"></span>
		</div>
		<div class="form-submit">
			<span class="button "><input type="submit" value="" class=""><span class="ileft">Заказать звонок </span><span class="iright"></span></span>
		</div>
	</form>
</div>			</div>
<!--Geo_ip-->
			<div class="h-list">
 <?php
function getip()
{
if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
$ip = getenv("HTTP_CLIENT_IP");

elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
$ip = getenv("HTTP_X_FORWARDED_FOR");

elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
$ip = getenv("REMOTE_ADDR");

elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
$ip = $_SERVER['REMOTE_ADDR'];

else
$ip = "unknown";

return($ip);
}

$ip=getip();
$typeData = 'json';
$url = "http://api.sypexgeo.net/$typeData/$ip";
$data = @file_get_contents($url);
if($data){
    $dataDecode = json_decode($data);
	$res=0;
	if($dataDecode->city->name_ru == "Москва") $res=1;
	if($dataDecode->city->name_ru == "Санкт-Петербург") $res=2;
	if($dataDecode->city->name_ru == "Алматы") $res=3;
	switch($res)
	{
		case 1:
		echo '<a class="h-list-item active">';
		echo '<span class="city">Москва: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		echo '<a class="h-list-item">';
		echo '<span class="city">Санкт-Петербург: </span>';
		echo '<span class="phone">+7 (495)<img> <span>789-34-04</span></span>';
		echo '</a>';
		echo '<a class="h-list-item">';
		echo '<span class="city">Алматы: </span>';
		echo '<span class="phone">+7 (495)<span>789-34-04</span></span>';
		echo '</a>';
		break;
		case 2:
		echo '<a class="h-list-item">';
		echo '<span class="city">Москва: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		echo '<a class="h-list-item active">';
		echo '<span class="city">Санкт-Петербург: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		break;
		case 3:
		echo '<a class="h-list-item">';
		echo '<span class="city">Москва: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		echo '<a class="h-list-item">';
		echo '<span class="city">Санкт-Петербург: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		echo '<a class="h-list-item active">';
		echo '<span class="city">Алматы: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		break;
		case 0:
		echo '<a class="h-list-item active">';
		echo '<span class="city">Москва: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		echo '<a class="h-list-item">';
		echo '<span class="city">Санкт-Петербург: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		echo '<a class="h-list-item">';
		echo '<span class="city">Алматы: </span>';
		echo '<span class="phone">+7 (495) <span>789-34-04</span></span>';
		echo '</a>';
		break;
	}
}
else
{
		echo '<a class="h-list-item active">';
		echo '<span class="city">Москва: </span>';
		echo '<a><span class="phone">+7 (495) <span>789-34-04</span></a></span>';
		echo '</a>';
		echo '<a class="h-list-item">';
		echo '<span class="city">Санкт-Петербург: </span>';
		echo '<a><span class="phone">+7 (495) <span>789-34-04</span></a></span>';
		echo '</a>';
		echo '<a class="h-list-item">';
		echo '<span class="city">Алматы: </span>';
		echo '<a><span class="phone">+7 (495) <span>789-34-04</span></a></span>';
		echo '</a>';
}
?>
			</div>
		</div>
	</div>
	<div class="header-top-navbar">
		<div class="mbox">
			<a href="/" class="logo">
				<img src="/bitrix/templates/main_test/img/logo.png" alt="">
				<span class="vfix"></span>
			</a>
			<nav class="mainmenu" role="navigation">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"horizontal_multilevel2", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y"
	),
	false
);?>
			</nav>
		</div>
	</div>
</div><!-- slider -->
<div class="sliderbox"> 	 	
<!--<div class="iosslider" style="position: relative; top: 0px; left: 0px; overflow: hidden; z-index: 1; -webkit-perspective: 1000px; -webkit-backface-visibility: hidden; width: 1903px; height: 827px;"> 		 		
    <div class="slider" style="position: relative; cursor: -webkit-grab; -webkit-perspective: 0; -webkit-backface-visibility: hidden; -webkit-transform: matrix(1, 0, 0, 1, -5688, 0); width: 3806px;"> 			 			
      <div class="slide" style="-webkit-backface-visibility: hidden; position: absolute; top: 0px; -webkit-transform: matrix(1, 0, 0, 1, 3806, 0); width: 1903px;">--> 				 				
	<img src="/bitrix/templates/main_test/img/t_slide1.jpg" style="width:100%;"  /> 				 
<!--<span class="vfix"></span> 				 			-->
<div class="slide-text-pos">
	<div class="hleb_krosh">
		<div class="hleb">
			<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"",
			Array(),
			false
			);?>
		</div>
	</div>

	<div class="slide-text">
		<div class="slide-text-name">В "Магазине Деревянных Домов" <font>Маki Houses</font></div>
		<div class="slide-text-content"><p>Вы можете выбрать и построить дома  из более, чем 500 проектов.</p><p>В течении 10 лет успешной работы, мы построили десятки домов и выбрали лучших<br>
			производителей деревянных домо-комплектов.</p><p>Сейчас,  являясь дилером этих заводов, мы проектируем, поставляем по цене завода<br> и строим  под ключ деревянные дома в России и за рубежом.</p>
		</div>
		<a class="slide-text-bottom-pod">Подробнее</a></div>
	</div>

      <!--<div class="slide" hidden;="" position:="" absolute;="" top:="" 0px;="" -webkit-transform:="" matrix(1,="" 0,="" 1,="" 5709,="" 0);="" width:="" 1903px;&quot;&gt;="">							 		 		<img id="bxid_537722" src="/bitrix/templates/main_test/img/t_slide1.jpg"  /> 		<span class="vfix"></span> 				 	
        <div class="slide-text">фывфывфывфывфывфвыфвфы</div>
       </div>--> 
</div>
  <!--<div class="slideSelectors"> 
    <div class="item" style="cursor: pointer;"></div>

    <div class="item selected" style="cursor: pointer;"></div>
   </div>

  <div class="sliderNav slide-prev" style="cursor: pointer;"><span></span></div>

  <div class="sliderNav slide-next" style="cursor: pointer;"><span></span></div>-->



</header>

<div class="main">
<!--#WORKAREA-->
	