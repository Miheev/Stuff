<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach($arResult["USER"] as $arUser):?>
<?if($arUser["PERSONAL_PHOTO"]):?>
	<img src="<?=GetImageResized(CFile::GetPath($arUser["PERSONAL_PHOTO"]), 52, 52);?>"/>
<?else:?>
	<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="52" height="52" alt="">
<?endif;?>
	
<?endforeach;?>




