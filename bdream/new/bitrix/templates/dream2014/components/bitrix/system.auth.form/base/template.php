<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if ($arResult["FORM_TYPE"] == "login"):


?>
	<p><a href="<?=$arParams['PROFILE_URL']?>" class="signin"><?=GetMessage("AUTH_LOGIN")?></a></p>
<?
	if($arResult["NEW_USER_REGISTRATION"] == "Y")
	{
?>
		<a href="/auth/reg/" class="signup"><?=GetMessage("AUTH_REGISTER")?></a>
<?
	}
?>
<?
else:

$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

if($arUser["PERSONAL_PHOTO"]):
?>
<a href="<?=$arResult['PROFILE_URL']?>"><img src='<?=GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 44, 44);?>' width="44" height="44" alt=""></a>        
<?
else:?>
<a href="<?=$arResult['PROFILE_URL']?>"><img src='<?=SITE_TEMPLATE_PATH."/images/img_user.jpg";?>' width="44" height="44" alt=""></a>        
<?
endif;
		$name = trim($USER->GetFullName());
	if (strlen($name) <= 0)
		$name = $USER->GetLogin();?>
	<p class="name"><?= htmlspecialcharsEx($name);?></p>
	<p class="personal"><a href="<?=$arResult['PROFILE_URL']?>"><?=GetMessage("AUTH_LOGIN_PERSONAL");?></a></p>
	<a href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>" class="logout"><?=GetMessage("AUTH_LOGOUT_BUTTON");?></a>
<?
endif;
?>