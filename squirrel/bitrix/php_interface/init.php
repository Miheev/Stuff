<?
// событие вызывается перед добавлением товара к корзину. на вход передаются параметры товара. в случае если возвращает false, товар в корзину добавлен не будет. 
// http://dev.1c-bitrix.ru/api_help/sale/sale_events.php
AddEventHandler("sale", "OnBeforeBasketAdd", Array("YenBasket", "BeforeBasketAdd"));

class YenBasket
{
   function BeforeBasketAdd($arFields)
   {
      // Подключаем модуль
      if(CModule::IncludeModule("iblock"))
      {
         // Получаем элемент
         $res = CIBlockElement::GetByID($arFields["PRODUCT_ID"]);
         if($ar_res = $res->GetNextElement())
         {
            // Получаем значение свойства-счетчика
            $COUNT_TO_BASKET = $ar_res->GetProperty("COUNT_TO_BASKET");

            // Увеличиваем счетчик на единицу и сохраняем значение в свойстве
            CIBlockElement::SetPropertyValueCode($arFields["PRODUCT_ID"], "COUNT_TO_BASKET", intval($COUNT_TO_BASKET["VALUE"])+1);
         }
      }
   }
}

function Send_reminder()
{
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/include.php");

    // Выбираем товары, у которых свойство "Napomnitb" заполнено и свойство "NET" отрицательно
    $arFilter = Array(
        "ACTIVE"=>"Y",
        "<=CATALOG_QUANTITY"=> "0",
        "!PROPERTY_remind"=> false
    );

    $res = CIBlockElement::GetList(Array("SORT"=>"ASC", "PROPERTY_PRIORITY"=>"ASC"), $arFilter);

    while($ar_fields = $res->GetNext())
    {
        // Далее "пробегаем" по всем таким товарам
        $db_props = CIBlockElement::GetProperty($ar_fields["IBLOCK_ID"], $ar_fields["ID"], array("sort" => "asc"), Array("CODE"=>"remind"));

        if($ar_props = $db_props->Fetch())
        {
            $tok = strtok($ar_props["VALUE"]["TEXT"], "||");
            $i = 0;
            while ($tok)
            {
                // В массив $rez сохраняем мэйлы
                $rez[$i] = $tok;
                $i = $i +1;
                $tok = strtok("||");
            }
        }

        // Формируем нужные переменные для почтовых событий
        for ($i = 0; $i < count($rez); $i++)
        {
            $arEventFields = array(
                "EMAIL"        => $rez[$i],
                "PRODUCT"      => $ar_fields["NAME"],
                "LINK"         => $ar_fields["DETAIL_PAGE_URL"],
            );

            // Отправляем сообщение
            CEvent::SendImmediate("remind_stock", s1, $arEventFields, "N", 26);
        }

        // Обнуляем свойство "Napomnitb"
        $value = "";
        CIBlockElement::SetPropertyValues($ar_fields["ID"], $ar_fields["IBLOCK_ID"], array("VALUE"=>array("TEXT"=>$value, "TYPE"=>"html")), "remind");
    }

    return "Send_reminder();";
}

//CAgent::AddAgent("Send_reminder();");
?>