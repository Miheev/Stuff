<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказать дом | MAKI HOUSES - Магазин Деревянных Домов");
?> 

 
<? //'<h1>Заказать дом</h1><p>Вы можете заказать строительство деревянного дома, отправив нам сообщение с пожеланиями по заказу. В письме укажите название дома, который Вы выбрали в наших каталогах: <a href="/countryhouse/ikihirsi/houses/" target="_self" title="Каталог домов Ikihirsi" >дома Ikihirsi </a> или <a href="/countryhouse/greenside/houses/" target="_self" title="Каталог домов Гринсайд" >дома Гринсайд </a>. Либо опишите требования и пожелания, на основе которых мы подберем для Вас наиболее подходящего поставщика домов и проекты домов. Мы ответим в течение суток.</p>' ?>
 
<p><?$APPLICATION->IncludeComponent(
	"maki:order.house",
	".default",
	Array(
		"SET_TITLE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"MAIL_TYPE" => "LEAF_HOUSE_ORDER"
	)
);?></p>
 
<p></p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>