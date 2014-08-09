<?
define("NO_KEEP_STATISTIC", true);
define('NO_AGENT_CHECK', true);
define("NO_AGENT_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define('DisableEventsCheck', true);

use \Bitrix\Main\Loader as Loader;

if (isset($_REQUEST['SITE_ID']) && !empty($_REQUEST['SITE_ID']))
{
	$strSiteID = substr((string)$_REQUEST['SITE_ID'], 0, 2);
	if ($strSiteID != '')
		define('SITE_ID', $strSiteID);
}
else
{
	die();
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (check_bitrix_sessid())
{
	if(
		isset($_REQUEST["IBLOCK_ID"])
		&& isset($_REQUEST["ELEMENT_ID"])
		&& isset($_SESSION["IBLOCK_CATALOG_COMMENTS_PARAMS_".$_REQUEST["IBLOCK_ID"]."_".$_REQUEST["ELEMENT_ID"]])
	)
	{
		$commParams = $_SESSION["IBLOCK_CATALOG_COMMENTS_PARAMS_".$_REQUEST["IBLOCK_ID"]."_".$_REQUEST["ELEMENT_ID"]];
	}
	else
	{
		$commParams = array();
	}

	if(!empty($commParams) && is_array($commParams))
	{
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.comments",
			"",
			$commParams,
			false
		);
	}
}

die();
?>