<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(		
		"SET_TITLE" => Array(),
		"CACHE_TIME"  =>  Array("DEFAULT"=>3600),
		"MAIL_TYPE" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("MAKI_ORDER_PARAMETER_MAIL_TYPE"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
	),
);

?>
