<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript">
	$(function() {
		$(".popup_anch").simplePopup();
	});
</script>
<a class="popup_anch" id="h_order" href="#"><?/*=$arParams["HREF_TEXT"]*/?></a>

<div class="popup_body"></div>
<div class="popup">
	<a href="#" class="popup_close"></a>
	<div>
		<p class="head"><?=$arParams["HEAD_TEXT"]?></p>
		<div class="mcallback">
			<?if(!empty($arResult["ERROR_MESSAGE"])) {
				ShowError($arResult["ERROR_MESSAGE"]);
			}
			if(strlen($arResult["OK_MESSAGE"]) > 0) {?>
				<div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div>
			<? } ?>

			<form action="<?=$APPLICATION->GetCurPage()?>" method="POST">
			<?=bitrix_sessid_post()?>
				<div class="mf-name">
					<div class="mf-text">
						<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
					</div>
					<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
				</div>
				<div class="mf-tel">
					<div class="mf-text">
						<?=GetMessage("MFT_TEL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("TEL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
					</div>
					<input type="text" name="user_tel" value="<?=$arResult["AUTHOR_TEL"]?>">
				</div>
				<div class="mf-time">
					<div class="mf-text">
						<?=GetMessage("MFT_TIME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("TIME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
					</div>
					<input type="text" name="user_time" value="<?=$arResult["AUTHOR_TIME"]?>">
				</div>
				<div class="mf-region">
					<div class="mf-text">
						<?=GetMessage("MFT_REGION")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("REGION", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
					</div>
					<input type="text" name="user_region" value="<?=$arResult["AUTHOR_REGION"]?>">
				</div>
				<input type="submit" name="submit" value="">
			</form>
		</div>
	</div>
</div>
