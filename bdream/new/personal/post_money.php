<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");?>
<?if(	isset($_REQUEST["SUM"]) && $_REQUEST["SUM"]
	&& 	isset($_REQUEST["TYPE"]) && $_REQUEST["TYPE"]
	&& 	isset($_REQUEST["DREAM_ID"]) && $_REQUEST["DREAM_ID"]
):?>
<?
	if(intval($_REQUEST["SUM"])<=0)
	{
		return false;
	}
	
	global $USER;
	CModule::IncludeModule("sale");
	$dbAccountCurrency = CSaleUserAccount::GetList(
			array(),
			array("USER_ID" => $USER->GetID())
	);
	if($arAccountCurrency = $dbAccountCurrency->Fetch())
	{
		if($arAccountCurrency["CURRENT_BUDGET"]<$_REQUEST["SUM"])
		{
			echo "no_money";
		}
		else
		{
			CModule::IncludeModule("iblock");
			$arSelect = Array("ID", "NAME", "PROPERTY_USER", "PROPERTY_TURBO_YET", "PROPERTY_TURBO_NEED", "PROPERTY_MONEY_DREAM");
			$arFilter = Array("IBLOCK_ID"=>2, "ID"=>intval($_REQUEST["DREAM_ID"]));
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			if($ob = $res->Fetch())
			{
				if($ob["PROPERTY_USER_VALUE"])
				{
					$dbAccountRecipient = CSaleUserAccount::GetList(
							array(),
							array("USER_ID" => intval($ob["PROPERTY_USER_VALUE"]))
					);
					if($arAccountRecipient = $dbAccountRecipient->Fetch())
					{
						
						if($arAccountRecipient["CURRENCY"]!=$arAccountCurrency["CURRENCY"])
						{
							$sumMoney = CCurrencyRates::ConvertCurrency($_REQUEST["SUM"],$arAccountCurrency["CURRENCY"],$arAccountRecipient["CURRENCY"]);
						}
						else
						{
							$sumMoney = $_REQUEST["SUM"];
						}
				
						$arFields = array();
						$arFields["USER_ID"] = $USER->GetID();
						$arFields["AMOUNT"] = $_REQUEST["SUM"];
						$arFields["CURRENCY"] = $arAccountCurrency["CURRENCY"];
						$arFields["DEBIT"] = "N";
						
						if($_REQUEST["TYPE"]==9)
						{
							$arFields["NOTES"] = "Перечисление на счёт TurboDreams пользователя ID=".$ob["PROPERTY_USER_VALUE"];
						}
						elseif($_REQUEST["TYPE"]==8)
						{
							$arFields["NOTES"] = "Перечисление на счёт Мечты пользователя ID=".$ob["PROPERTY_USER_VALUE"];
						}
						$arFields["EMPLOYEE_ID"] = $USER->GetID();
						$arFields["TRANSACT_DATE"] = ConvertTimeStamp(time(), "FULL");
						
						CSaleUserTransact::Add($arFields);
						
						$arFields = array();
						$arFields["USER_ID"] = $USER->GetID();
						$arFields["CURRENT_BUDGET"] = $arAccountCurrency["CURRENT_BUDGET"]-$_REQUEST["SUM"];
						CSaleUserAccount::Update($arAccountCurrency["ID"],$arFields);
						
						$el = new CIBlockElement;
						
						$PROP = array();
						$PROP["PAY"] = $_REQUEST["SUM"];  
						$PROP["DREAM"] = $_REQUEST["DREAM_ID"];
						if($_REQUEST["PRIVAT"]=="Y")   
						{
							$PROP["PRIVAT"] = 7;
						}
						$PROP["TYPE"] = $_REQUEST["TYPE"];
						$PROP["CURRENCY"] = $arAccountCurrency["CURRENCY"];
						
						
						
						$arLogArray = Array(
								"MODIFIED_BY"    => $USER->GetID(),
								"IBLOCK_SECTION_ID" => false,         
								"IBLOCK_ID"      => 7,
								"PROPERTY_VALUES"=> $PROP,
								"NAME"           => $USER->GetFullName(),
								"ACTIVE"         => "Y"
						);
						
						$el->Add($arLogArray);
						
					
					
						if($_REQUEST["TYPE"]==9)
						{
							$totalSum = $ob["PROPERTY_TURBO_YET_VALUE"]+$sumMoney;
							CIBlockElement::SetPropertyValues(intval($_REQUEST["DREAM_ID"]), 2, $totalSum, "TURBO_YET");
							
							if($ob["PROPERTY_TURBO_YET_VALUE"]<$ob["PROPERTY_TURBO_NEED_VALUE"])
							{
								$persent = round($totalSum*100/$ob["PROPERTY_TURBO_NEED_VALUE"]);
							}
							else
							{
								$persent = 100;
							}
							CIBlockElement::SetPropertyValues(intval($_REQUEST["DREAM_ID"]), 2, $persent, "INDICATOR");
						}
						elseif($_REQUEST["TYPE"]==8)
						{
							$totalSum = $ob["PROPERTY_MONEY_DREAM_VALUE"]+$sumMoney;
							CIBlockElement::SetPropertyValues(intval($_REQUEST["DREAM_ID"]), 2, $sumMoney, "MONEY_DREAM");
						}
						
						echo "OK";
					}
				}
			}
		}	
	}	
?>
<?endif;?>