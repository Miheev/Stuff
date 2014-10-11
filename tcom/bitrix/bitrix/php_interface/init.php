<?

AddEventHandler("sale", "OnSaleStatusOrder", "StatusUpdate" );
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnBeforeUserUpdate", "OnBeforeUserUpdateHandler");

function StatusUpdate($ORDER_ID, $val){
    CModule::IncludeModule('sale');
    CModule::IncludeModule('catalog');

    if($GLOBALS['USER']->isAdmin())
       if ($val == 'S'){

        #$arFilter = array('ID' => $ORDER_ID);
        #$rsOrder = CSaleOrder::GetList(array('ID' => 'DESC'), $arFilter);
        #$arOrder = $rsOrder->Fetch();

        #$db_order = CSaleOrder::GetList(array("DATE_UPDATE" => "DESC"), array("ID" => $ORDER_ID));
        #$arOrder = $db_order->Fetch();

        // $dbOrder = CSaleBasket::GetList(array(), array("ORDER_ID" => $ORDER_ID));
        // $arOrder = $dbOrder->Fetch();

        // echo "<pre>";
        // print_r($arOrder);
        // echo "</pre>";

        #$dbProducts = CCatalogStoreProduct::GetList(array(), array("ID" => $arOrder["PRODUCT_ID"]));        
        // $dbProducts = CCatalogProduct::GetByID(9642);        
        // while($arProduct = $dbProducts->Fetch()){
        //     echo "<pre>";
        //     print_r($arProduct);
        //     echo "</pre>";
        // } 


        // $ID = 9642;
        // $ar_res = CCatalogProduct::GetByID($ID);
        // echo "<br>Товар с кодом ".$ID." имеет следующие параметры:<pre>";
        // print_r($ar_res);
        // echo "</pre>";



      
       
       }
}

function OnBeforeUserUpdateHandler(&$arFields)
{
    $arFields["LOGIN"] = $arFields["EMAIL"];
    return $arFields;
}

?>