<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");?>
<?

$users=$_POST["user"];
$id=$_POST["id"];
$favour=array();
$filter = Array("ID"=>$users);
	$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), $filter,array("SELECT"=>array("UF_FAVOURIT"))); 
	while ($arUser = $rsUsers->Fetch()) 
	{
	   $favour=$arUser["UF_FAVOURIT"];
	}
if($key = array_search($id, $favour))
{
unset($favour[$key]);
}
	
$user = new CUser;
$fields = Array( 
"UF_FAVOURIT" => array($favour), 
); 

$user->Update($users, $fields);
$strError .= $user->LAST_ERROR;
echo $strError;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>