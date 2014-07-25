<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_MAKI_DESC_HOUSE"),
	"DESCRIPTION" => GetMessage("T_MAKI_DESC_HOUSE_DESC"),
	"ICON" => "/images/eaddform.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "Makihouse",
		"NAME" => GetMessage("T_MAKI"),
		"CHILD" => array(
			"ID" => "MakiForms",
			"NAME" => GetMessage("T_MAKI_FORMS"),
		),
	),
);

?>