  Наши новогодние подарки к новому году отличаются широким ассортиментов и интересными подарочными упаковками, которые разрабатываются дизайнерами. Подарочная упаковка немаловажный элемент, так как она дарит новогоднее настроение своей красотой, яркостью и индивидуальностью. 
<br />
 
<div align="center"> 
  <br />
 </div>
<?if($arParams["USE_FILTER"]=="Y"):?>
<script>
<? /* ?>
$(function() {
$( "#slider-range" ).slider({
  range: true,
  min: 0,
  max: 500,
  values: [ 75, 300 ],
  slide: function( event, ui ) {
    // $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    $( "#<? echo $arParams["FILTER_NAME"]; ?>_cf_1_LEFT" ).val( ui.values[ 0 ] );
    $( "#<? echo $arParams["FILTER_NAME"]; ?>_cf_1_RIGHT" ).val( ui.values[ 1 ] );
    }
  });
  $( "#<? echo $arParams["FILTER_NAME"]; ?>_cf_1_LEFT" ).val( ui.values[ 0 ] );
  $( "#<? echo $arParams["FILTER_NAME"]; ?>_cf_1_RIGHT" ).val( ui.values[ 1 ] );
  // $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});
<? */ ?>
</script>
    <?$APPLICATION->IncludeComponent(
        "castlerock:castlerock.catalog.filter",
        "filtr",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
            "FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
             "PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
            "PRICE_CODE" => $arParams["FILTER_PRICE_CODE"],
            "OFFERS_FIELD_CODE" => $arParams["FILTER_OFFERS_FIELD_CODE"],
            "OFFERS_PROPERTY_CODE" => $arParams["FILTER_OFFERS_PROPERTY_CODE"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        ),
        $component
    );
    ?>
 
<?endif?>

<?
global ${$arParams["FILTER_NAME"]};
// echo "1111<pre>"; print_r(${$arParams["FILTER_NAME"]}); echo "</pre>2222";
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"sections",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]
	),
	$component
);
?> 
<div align="center"><b><h2>Новогодние подарки для всех и для каждого!</h2></b></div>
Все мы, с огромным нетерпением ждём 31 декабря — день, когда в каждом доме накрыт красивый стол, в воздухе витает аромат мандаринов и хвои, а под наряженной ёлкой теснятся новогодние подарки и сладости. И так хочется, чтобы часы поскорей пробили полночь — поднять бокалы с игристо - золотым шампанским, зажечь бенгальские огни и радоваться вместе грядущему году со всем миром.

На нашем сайте расположен каталог, который порадует лёгкостью и простотой в навигации. Он имеет красивое красочное оформление, которое сопровождается подробной информацией о конкретно - выбранном продукте. В каталоге размещены такие виды сладостей как: шоколадные конфеты, пряники, крендельки, шоколад, рулеты, кексы, карамель и многое другое, что поможет Вам в составлении и в подборе новогоднего подарка. Ко всему прочему, с помощью каталога также можно составить подарок по индивидуальному заказу, а именно: подобрать определенные сладости, определиться с конфигурацией подарка, а так же подобрать ему красочную, новогоднюю упаковку.<br>
<br><div align="center"><b><h2>Оригинальные новогодние подарки</h2></b></div><br>
Основными направлениями деятельности компании «Белочка» являются:<br>

-производство сладких новогодних подарков для детей (мы принимаем заказы на детские утренники, на праздники в школе и садике, посвященные Новому году);<br>

-разработка и производство подарочной упаковки новогодних подарков;<br>


-подбор вкуснейших конфет (подбор конфет от известных и качественных производителей России, Украины и Польши);<br>


-реализация и поставка новогодних подарков крупным фирмам, организациям;<br>


-осуществление заказов для сотрудников на корпоративные новогодние праздники.<br><br>


Одним словом всё то - что обеспечит Вам и вашим деткам шоколадное настроение на все новогодние праздники.

Новогодние подарки для детей никак не могут обойтись без сладких наборов компании «Белочка», т.к. они совмещают в себе не только символ Новогодних праздников, но и обеспечат улыбки на лице каждого, кому будет преподнесен такой волшебный подарочек!

Мы предлагаем новогодние подарки детям, оформленные в красочной и стильной упаковке из различных материалов (картон, текстиль, жесть и другие). Помимо придуманных нами упаковок, Вы можете придумать свое собственное оформление, чем лишь еще больше удивите и обрадуете обладателя подарка.

Мы реализуем новогодние подарки не только для детишек, но и принимаем заказы на сладкие наборы , составленные из продукции ведущих кондитерских фабрик России, Украины и Польши.

Новогодние подарки для детей от кондитерского дома «Белочка» - великолепный выбор, ведь каждый набор тщательно составляется с учетом вкусовых пристрастий ребенка.

Новогодний подарок к новогодним праздникам от производителя «Белочка» отличаются от множества других производителей тем, что мы со всей щепетильностью готовы подойти к Вашему заказу, каждый заказчик может рассчитывать : на профессиональный подход , на оказание помощи при выборе подарка. Любой Ваш вопрос или затруднения не останутся без внимания, а менеджер-консультант свяжется с Вами, посоветует и ответит на все интересующие и возникшие вопросы.

Мы очень "мобильная" компания и наш ассортимент - всего лишь маленькая часть того огромного количества идей и воплощений, которые мы сможем реализовать вместе с Вами!

 
<strong> 
  <p align="center">Уважаемые господа покупатели!</p>
 
  <p align="center">Обращаем ваше внимание, что вы можете заказать доставку выбранных Вами подарков по г. Мо<strong><strong><strong><strong></strong></strong></strong>скве и Подмосковью (от 700 руб). Доставка осуществляется до двери подъезда. Подъем на этаж отдельно оговаривается Вами с водителем.</strong></p>
 
  <p align="center">Мы готовы привезти Ваши подарки в другие города (цена договорная).</p>
 
  <p align="center">Для вашего удобства все необходимые <strong><strong></strong></strong>вопросы вы можете задать по телефонам :</p>
 
  <p align="center"> <b>(495) 672-83-95 </b> 
    <br />
   </p>
 
  <p align="center">(495) 543-96-02 (Доб 115 , 116 )</p>
 
  <p align="center">(495) 672-56-03 
    <br />
   </p>
 
  <p align="center"><?
if ($_SERVER['REQUEST_URI'] == "/newyear/")
echo '<br/><img id="bxid_661673" style="padding: 2px; width: 100%; height: 2px;" src="/bitrix/images/fileman/htmledit2/break_page.gif" __bxtagname="hr"  /><br/>
';
?>  </p>
 <hr /> 
  <br />
 
  <p align="center"><strong>По любым вопросам вы можете связаться с нашими менеджерами:</strong></p>
 
  <div align="center"> <a href="http://www.icq.com/whitepages/cmd.php?uin=362164136&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=362164136&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=362164136&amp;action=message" >362164136</a> Наталья <a href="http://www.icq.com/whitepages/cmd.php?uin=635902973&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=635902973&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=635902973&amp;action=message" >635902973</a> Светлана <a href="http://www.icq.com/whitepages/cmd.php?uin=421842808&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=421842808&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=421842808&amp;action=message" >421842808</a> Елена <a href="http://www.icq.com/whitepages/cmd.php?uin=621111200&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=621111200&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=621111200&amp;action=message" >621111200</a> Татьяна 
    <br />
   </div>
 
  <p> <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"breat",
	Array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?> 
    <br />
   </p>
 
  <p> 
    <br />
   </p>
 </strong> 