<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
$APPLICATION->SetPageProperty("title", "Белочка - Сладкие Подарки");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "N");

?> 
<div style="text-align: left;"> 
  <br />
 </div>
 
<div style="text-align: left;"><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"sections",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "5",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(),
		"SECTION_USER_FIELDS" => array(),
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y"
	)
);?></div>
 
<div style="text-align: left;"> 
  <br />
 </div>
 
<div style="text-align: left;"> 
  <div> 
    <br />
   </div>
 </div>
 <span class="callme_viewform" style="cursor: pointer;"><img src="http://konditerka.com/images/pricepng.jpg" title="Обратный звонок" alt="мы вам перезвоним"  /> </span> 
<div>Узнать актуальную цену на популярные шоколадные наборы ( &quot;Вдохновение&quot;,Ferrero Rocher,Raffaello и др.) вы можете по телефонам 543-96-02 , 543-96-03 или через он-лайн форму ( выше ) . 
  <br />

  <div><span class="callme_viewform" style="cursor: pointer;">
      <div style="text-align: left;"> </div>
     
      <p align="center" style="text-align: left;"><strong></strong> Представляем каталог &quot;сладких подарков&quot; который состоит из различных кондитерских наборов к праздникам 8 марта , 1 сентября и другим. Наборы предназначенные к новому году , находятся в отдельном <a href="http://www.konditerka.com/newyear/" >каталоге подарков</a>.</p>
     
      <p></p>
     
      <p> </p>
     
      <p></p>
     </span></div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>