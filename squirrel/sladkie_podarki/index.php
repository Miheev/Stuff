<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
$APPLICATION->SetPageProperty("title", "������� - ������� �������");
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
 <span class="callme_viewform" style="cursor: pointer;"><img src="http://konditerka.com/images/pricepng.jpg" title="�������� ������" alt="�� ��� ����������"  /> </span> 
<div>������ ���������� ���� �� ���������� ���������� ������ ( &quot;�����������&quot;,Ferrero Rocher,Raffaello � ��.) �� ������ �� ��������� 543-96-02 , 543-96-03 ��� ����� ��-���� ����� ( ���� ) .�
  <br />

  <div><span class="callme_viewform" style="cursor: pointer;">
      <div style="text-align: left;"> </div>
     
      <p align="center" style="text-align: left;"><strong></strong>������������� ������� &quot;������� ��������&quot; ������� ������� �� ��������� ������������ ������� � ���������� 8 ����� , 1 �������� � ������. ������ ��������������� � ������ ���� , ��������� � ���������<a href="http://www.konditerka.com/newyear/" >�������� ��������</a>.</p>
     
      <p></p>
     
      <p> </p>
     
      <p></p>
     </span></div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>