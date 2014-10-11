<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Наши контакты");
?><div class="column width-list">
	<div class="block-name-content">
		<?php
$tmp= explode(' ',$APPLICATION->GetTitle(false));
?>
 <span class="black"><?=$tmp[0]?></span> <span class="green"><?=$tmp[1]?></span>
	</div>
	<div class="content">
		 <div class="kontakt_form">
            <p> Наши контакты </p>
			<div class="phone">8 (800) 333-67-76</div>
			<div class="skype">alexxx_bo</div>
            <div class="email"><a href="mailto:info@webpro.su">info@webpro.su</a></div>
			<p> Наши реквизиты </p>
			<div class="rekviz">
				<div>ИП Божко Алексей Евгеньевич</div>
				<div><span>Адрес:</span> 680000, г. Хабаровск, ул. Льва Толстого 22, оф 217б</div>
				<div><span>ИНН:</span> 280602866266</div>
				<div><span>ОГРН:</span> 314281317600012</div>
				<div><span>Р/с:</span> 40802810920000000477</div>
				<div><span>БИК:</span> 040813770</div>
				<div><span>К/с:</span> 30101810800000000770</div>
				<div><span>Банк:</span> ФИЛИАЛ "ХАБАРОВСКИЙ" ОАО "АЛЬФА-БАНК"</div>
			</div>
		</div>
<div class="forma-contact">
		<div class="forma-vopros">
			<div class="head-forma">
				 Задать вопрос
			</div>
			<div class="form-content">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"template4",
	Array(
		"WEB_FORM_ID" => "9",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "/blagodarnost/blagodarnost7.php",
		"EDIT_URL" => "result_edit.php",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID")
	)
);?>
			</div>
		</div>
</div>
<br><br><br><br>
	</div>
</div>
<div class="karta">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view",
	"",
	Array(
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:48.487848090889365;s:10:\"google_lon\";d:135.06801752051948;s:12:\"google_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:136:\"Веб студия \"Webpro\" улица Льва Толстого, 22, Хабаровск, Хабаровский край, Россия\";s:3:\"LON\";d:135.06909370422;s:3:\"LAT\";d:48.488169121368;}}}",
		"MAP_WIDTH" => "2000",
		"MAP_HEIGHT" => "250",
		"CONTROLS" => array("SMALL_ZOOM_CONTROL","TYPECONTROL","SCALELINE"),
		"OPTIONS" => array("ENABLE_SCROLL_ZOOM","ENABLE_DBLCLICK_ZOOM","ENABLE_DRAGGING","ENABLE_KEYBOARD"),
		"MAP_ID" => ""
	)
);?>
</div>
 <br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>