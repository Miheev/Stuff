<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("������� - �������");
?><span class="callme_viewform" style="cursor: pointer;"><img src="http://konditerka.com/images/pricepng.jpg" title="�������� ������" alt="�� ��� ����������"  />�� ��� ������� ����������� , ��� ���� ����� �������� ���������� ����� , ��������� ����� � �� ������� ��� ��� �� e-mail .</span> 
<div style="text-align: center;"> 
  <br />
 </div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"sections",
	Array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "2",
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
);?> 
<br />
 
<p> 
  <br />
 </p>
 � ������ ������� ��������� ������� ������ ������������ ������� , �� ��������� ������ �� �������<a href="http://www.konditerka.com/newyear/" > ������� ���������� ��������.</a><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>