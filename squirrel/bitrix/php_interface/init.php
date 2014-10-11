<?
// ������� ���������� ����� ����������� ������ � �������. �� ���� ���������� ��������� ������. � ������ ���� ���������� false, ����� � ������� �������� �� �����. 
// http://dev.1c-bitrix.ru/api_help/sale/sale_events.php
AddEventHandler("sale", "OnBeforeBasketAdd", Array("YenBasket", "BeforeBasketAdd"));

class YenBasket
{
   function BeforeBasketAdd($arFields)
   {
      // ���������� ������
      if(CModule::IncludeModule("iblock"))
      {
         // �������� �������
         $res = CIBlockElement::GetByID($arFields["PRODUCT_ID"]);
         if($ar_res = $res->GetNextElement())
         {
            // �������� �������� ��������-��������
            $COUNT_TO_BASKET = $ar_res->GetProperty("COUNT_TO_BASKET");

            // ����������� ������� �� ������� � ��������� �������� � ��������
            CIBlockElement::SetPropertyValueCode($arFields["PRODUCT_ID"], "COUNT_TO_BASKET", intval($COUNT_TO_BASKET["VALUE"])+1);
         }
      }
   }
}

function Send_reminder()
{
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/include.php");

    // �������� ������, � ������� �������� "Napomnitb" ��������� � �������� "NET" ������������
    $arFilter = Array(
        "ACTIVE"=>"Y",
        "<=CATALOG_QUANTITY"=> "0",
        "!PROPERTY_remind"=> false
    );

    $res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter);

    while($ar_fields = $res->GetNext())
    {
        // ����� "���������" �� ���� ����� �������
        $db_props = CIBlockElement::GetProperty($ar_fields["IBLOCK_ID"], $ar_fields["ID"], array("sort" => "asc"), Array("CODE"=>"remind"));

        if($ar_props = $db_props->Fetch())
        {
            $tok = strtok($ar_props["VALUE"]["TEXT"], "||");
            $i = 0;
            while ($tok)
            {
                // � ������ $rez ��������� �����
                $rez[$i] = $tok;
                $i = $i +1;
                $tok = strtok("||");
            }
        }

        // ��������� ������ ���������� ��� �������� �������
        for ($i = 0; $i < count($rez); $i++)
        {
            $arEventFields = array(
                "EMAIL"        => $rez[$i],
                "PRODUCT"      => $ar_fields["NAME"],
                "LINK"         => $ar_fields["DETAIL_PAGE_URL"],
            );

            // ���������� ���������
            CEvent::SendImmediate("remind_stock", s1, $arEventFields, "N", 26);
        }

        // �������� �������� "Napomnitb"
        $value = "";
        CIBlockElement::SetPropertyValues($ar_fields["ID"], $ar_fields["IBLOCK_ID"], array("VALUE"=>array("TEXT"=>$value, "TYPE"=>"html")), "remind");
    }

    return "Send_reminder();";
}

//CAgent::AddAgent("Send_reminder();");
?>