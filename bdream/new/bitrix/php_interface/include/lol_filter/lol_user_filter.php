<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? 
/*class LolSelectUser
{
	function filterFromParams($IBLOCK_ID, $USER_NAME=false, $USER_LAST_NAME=false, $COUNTRY_ID=false, $CITY_ID=false)
	{
		global $DB;
		if(intval($IBLOCK_ID)<1)
			return false;
		
		$strSql = "SELECT";
		$strSql = "	SELECT e.ID
					FROM b_iblock_element e
					WHERE e.IBLOCK_ID=".$IBLOCK_ID."
					LEFT JOIN b_user u ON u.d_id = d.id ";
		
		$db_res = $DB->Query($strSql);
	}
}*/
?>