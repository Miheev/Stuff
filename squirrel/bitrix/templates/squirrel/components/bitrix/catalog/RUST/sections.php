  ���� ���������� ������� � ������ ���� ���������� ������� ������������� � ����������� ����������� ����������, ������� ��������������� �����������. ���������� �������� ������������ �������, ��� ��� ��� ����� ���������� ���������� ����� ��������, �������� � �����������������.�
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
?>�
<div align="center"><b><h2>���������� ������� ��� ���� � ��� �������!</h2></b></div>
��� ��, � �������� ����������� ��� 31 ������� � ����, ����� � ������ ���� ������ �������� ����, � ������� ������ ������ ���������� � ����, � ��� ���������� ����� �������� ���������� ������� � ��������. � ��� �������, ����� ���� �������� ������� ������� � ������� ������ � ������� - ������� ����������, ������ ����������� ���� � ���������� ������ ��������� ���� �� ���� �����.

�� ����� ����� ���������� �������, ������� �������� �������� � ��������� � ���������. �� ����� �������� ��������� ����������, ������� �������������� ��������� ����������� � ��������� - ��������� ��������. � �������� ��������� ����� ���� ��������� ���: ���������� �������, �������, ����������, �������, ������, �����, �������� � ������ ������, ��� ������� ��� � ����������� � � ������� ����������� �������. �� ����� �������, � ������� �������� ����� ����� ��������� ������� �� ��������������� ������, � ������: ��������� ������������ ��������, ������������ � ������������� �������, � ��� �� ��������� ��� ���������, ���������� ��������.<br>
<br><div align="center"><b><h2>������������ ���������� �������</h2></b></div><br>
��������� ������������� ������������ �������� �������� ��������:<br>

-������������ ������� ���������� �������� ��� ����� (�� ��������� ������ �� ������� ���������, �� ��������� � ����� � ������, ����������� ������ ����);<br>

-���������� � ������������ ���������� �������� ���������� ��������;<br>


-������ ���������� ������ (������ ������ �� ��������� � ������������ �������������� ������, ������� � ������);<br>


-���������� � �������� ���������� �������� ������� ������, ������������;<br>


-������������� ������� ��� ����������� �� ������������� ���������� ���������.<br><br>


����� ������ �� �� - ��� ��������� ��� � ����� ������ ���������� ���������� �� ��� ���������� ���������.

���������� ������� ��� ����� ����� �� ����� �������� ��� ������� ������� �������� ��������, �.�. ��� ��������� � ���� �� ������ ������ ���������� ����������, �� � ��������� ������ �� ���� �������, ���� ����� ����������� ����� ��������� ���������!

�� ���������� ���������� ������� �����, ����������� � ��������� � �������� �������� �� ��������� ���������� (������, ��������, ����� � ������). ������ ����������� ���� ��������, �� ������ ��������� ���� ����������� ����������, ��� ���� ��� ������ ������� � ��������� ���������� �������.

�� ��������� ���������� ������� �� ������ ��� �������, �� � ��������� ������ �� ������� ������ , ������������ �� ��������� ������� ������������ ������ ������, ������� � ������.

���������� ������� ��� ����� �� ������������� ���� �������� - ������������ �����, ���� ������ ����� ��������� ������������ � ������ �������� ����������� �������.

���������� ������� � ���������� ���������� �� ������������� �������� ���������� �� ��������� ������ �������������� ���, ��� �� �� ���� �������������� ������ ������� � ������ ������, ������ �������� ����� ������������ : �� ���������������� ������ , �� �������� ������ ��� ������ �������. ����� ��� ������ ��� ����������� �� ��������� ��� ��������, � ��������-����������� �������� � ����, ���������� � ������� �� ��� ������������ � ��������� �������.

�� ����� "���������" �������� � ��� ����������� - ����� ���� ��������� ����� ���� ��������� ���������� ���� � ����������, ������� �� ������ ����������� ������ � ����!

 
<strong> 
  <p align="center">��������� ������� ����������!</p>
 
  <p align="center">�������� ���� ��������, ��� �� ������ �������� �������� ��������� ���� �������� �� �. ��<strong><strong><strong><strong></strong></strong></strong>���� � ����������� (�� 700 ���). �������� �������������� �� ����� ��������. ������ �� ���� �������� ������������� ���� � ���������.</strong></p>
 
  <p align="center">�� ������ �������� ���� ������� � ������ ������ (���� ����������).</p>
 
  <p align="center">��� ������ �������� ��� ����������� <strong><strong></strong></strong>������� �� ������ ������ �� ��������� :</p>
 
  <p align="center"> <b>(495) 672-83-95�</b> 
    <br />
   </p>
 
  <p align="center">(495) 543-96-02 (��� 115 , 116 )</p>
 
  <p align="center">(495) 672-56-03 
    <br />
   </p>
 
  <p align="center"><?
if ($_SERVER['REQUEST_URI'] == "/newyear/")
echo '<br/><img id="bxid_661673" style="padding: 2px; width: 100%; height: 2px;" src="/bitrix/images/fileman/htmledit2/break_page.gif" __bxtagname="hr"  /><br/>
';
?>� </p>
 <hr /> 
  <br />
 
  <p align="center"><strong>�� ����� �������� �� ������ ��������� � ������ �����������:</strong></p>
 
  <div align="center"> <a href="http://www.icq.com/whitepages/cmd.php?uin=362164136&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=362164136&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=362164136&amp;action=message" >362164136</a> ������� <a href="http://www.icq.com/whitepages/cmd.php?uin=635902973&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=635902973&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=635902973&amp;action=message" >635902973</a> �������� <a href="http://www.icq.com/whitepages/cmd.php?uin=421842808&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=421842808&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=421842808&amp;action=message" >421842808</a> ����� <a href="http://www.icq.com/whitepages/cmd.php?uin=621111200&amp;action=message" title="ICQ" ><img border="0" src="http://status.icq.com/online.gif?icq=621111200&amp;img=5"  /></a> <a href="http://www.icq.com/whitepages/cmd.php?uin=621111200&amp;action=message" >621111200</a> ������� 
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