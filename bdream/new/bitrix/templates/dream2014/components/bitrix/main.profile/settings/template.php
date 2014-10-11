<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<h3><?=GetMessage('NEW_PASSWOR');?></h3> 
	<table>
		<tr>
			<td><?=GetMessage('NEW_PASSWORD_REQ')?></td>
			<td><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
		</tr>
		<tr>
			<td><?=GetMessage('NEW_PASSWORD_CONFIRM')?></td>
			<td><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></td>
		</tr>
	</table>
<br><br><br> <br> 
<input type="submit" class="saveProfileBtn" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">	
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />


<h1 id="pageTitleBlue"><?=GetMessage("PERSONAL_ACOUNT");?><div class="blueHr"></div></h1>
<a href="/personal/" class="personalLinkMain"><?=GetMessage("BACK");?></a>

<div class="userProfileBlock">
<h3><?=GetMessage("PERSONAL_INFORMATION");?></h3>
<table>
	<tr>
		<td style="padding-top: 18px;"><?=GetMessage('NAME')?></td>
		<td> 
			<lable for="name"><?=GetMessage('NA_RODNOM');?></lable></br>
			<input type="text" id="NAME" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
		</td>
		<td> 
			<lable for="englishName"><?=GetMessage("IN_ENGLISH");?></lable></br>
			<input type="text" id="UF_EN_NAME" name="UF_EN_NAME" maxlength="50" value="<?=$arResult["arUser"]["UF_EN_NAME"]?>" />
		</td>
	</tr>
	<tr>
		<td><?=GetMessage('LAST_NAME')?></td>
		<td> 
			<input type="text" id="LAST_NAME" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
		</td>
		<td> 
			<input type="text" id="UF_EN_LAST_NAME" name="UF_EN_LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["UF_EN_LAST_NAME"]?>" />
		</td>
	</tr>
	<tr>
		<td><?=GetMessage('USER_COUNTRY')?></td>
		<td colspan=2;><?=$arResult["COUNTRY_SELECT"]?></td>
	</tr>
	<tr>
		<td><?=GetMessage('USER_CITY')?></td>
		<td><input type="text" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('USER_PHONE')?></td>
		<td><input type="text" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" /></td>
	</tr>
	<tr>
		<td><?=GetMessage('WEB_SITES');?></td>
		<td>
			<input type="text" name="ADD_WEB" maxlength="255" value="" />	
		</td>
		<td><a href="" class="addPersonalSite"><?=GetMessage('ADD');?></a></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class="userListTd">
			<?if($arResult["arUser"]["UF_WEB"] && count($arResult["arUser"]["UF_WEB"])>0):?>
			<div style="clear: both;"></div>
				<?foreach ($arResult["arUser"]["UF_WEB"] as $key=>$arWeb):?>
					<div class="userSiteList" id="site<?=$key;?>"><?=$arWeb;?>&nbsp;
						<input type="hidden" name="UF_WEB[]" maxlength="255" value="<?=$arWeb;?>" />
					</div>	
				<?endforeach;?>
			<?endif;?>
		</td>
		<td class="userSiteDel">
			<?foreach ($arResult["arUser"]["UF_WEB"] as $key=>$arWeb):?>
				<a href="site<?=$key;?>"><?=GetMessage('DROP');?></a>
			<?endforeach;?>
		</td>
		
	</tr>
	
	
	
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>	
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<tr>
		<td>
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
			<?=$arUserField["EDIT_FORM_LABEL"]?>:</td>
			
			<td colspan=2>
			<?//echo "<pre>";print_r($arUserField);echo "</pre>";?>
			<?if($arUserField["FIELD_NAME"]=="UF_VALUTA"){?>
			<?if($arUserField["VALUE"]!=""){ $notactiv="Y";}else{$notactiv="";}?>
			<div class="evaluateDream">
				<span id="6" class="curencyBtn <?if($arUserField["VALUE"]==6){?>activeCurency<?}?>"><b>$</b></span>
				<span id="4" class="curencyBtn <?if($arUserField["VALUE"]==4){?>activeCurency<?}?>"><b>Р</b></span>
				<span id="7" class="curencyBtn <?if($arUserField["VALUE"]==7){?>activeCurency<?}?>"><b>€</b></span>
				<span id="5" class="curencyBtn <?if($arUserField["VALUE"]==5){?>activeCurency<?}?>"><b>Ұ</b></span>
				<input type="hidden" value="USD" name="UF_VALUTA">	
			</div>
			<?}else{?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
			<?}?>
			</td>
		</tr>
		<?endforeach;?>
	<?if($notactiv!="Y"){?>
	<script type="text/javascript">
	$( document ).ready(function() {

		 $(".curencyBtn").click(function(){
			 $(".curencyBtn").removeClass("activeCurency");
			 $(this).addClass("activeCurency");
			 var getID = $(this).attr("id");
			 $("input[name='UF_VALUTA']").val(getID);
		 });	 	 
	});
	</script>
	<?}?>
	<?endif;?>
</table>

	
</div>
<div class="userProfileBlock">
<h3><?=GetMessage('LOAD_PHOTO');?></h3>
<?$APPLICATION->IncludeComponent("bitrix:main.file.input", "profile_avatar",
   array(
      "INPUT_NAME"=>"USER_PHOTO",
      "MULTIPLE"=>"N",
      "MODULE_ID"=>"main",
      "MAX_FILE_SIZE"=>"1572864",
      "ALLOW_UPLOAD"=>"I", 
      "ALLOW_UPLOAD_EXT"=>"",
	  "INPUT_CAPTION"=> "Выбрать файл"
   ),
   false
);?>
<br>
<div class="miniPhoto">
	<span><?=GetMessage('MINI_PHOTO');?></span>
	<div>
	<?if($arResult["arUser"]["PERSONAL_PHOTO"]):
		$src = CFile::GetPath(intval($arResult["arUser"]["PERSONAL_PHOTO"]));?>
		<img src="<?=GetImageResized($src, 188,188);?>"/>
	<?endif;?>
	</div>
	<input type="button" class="cropImg" style="display:none;" value="<?=GetMessage('SAVE');?>"/>		
</div>
<div class="bigPhoto">
	<?if($arResult["arUser"]["PERSONAL_PHOTO"]):?>
		<img src="<?=$src;?>" style="width: 320px;"/>
	<?endif;?>
</div>
</div>

<input type="hidden" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>"/>
<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>"/>
<div style="clear: both;"></div>
<br><br>

</div> 
<?CJSCore::Init(array('translit'));?>
<script>
var oldValue = '';
function transliterate(from, to)
{
		var from = document.getElementById(from);
		var to = document.getElementById(to);
		if(from && to && oldValue != from.value)
		{
			BX.translit(from.value, {
				'max_len' : 10000,
				'change_case' : '',
				'replace_space' : ' ',
				'replace_other' : '',
				'delete_repeat_replace' : false,
				'use_google' : true,
				'callback' : function(result){to.value = result; setTimeout('transliterate()', 250); }
			});
			oldValue = from.value;
		}
}	
$(document).ready(function(){
	$('#NAME').focusout(function(){
		 if($(this).val().length>0)
		 {
			 transliterate("NAME", "UF_EN_NAME");
		 }
	});
	$('#LAST_NAME').focusout(function(){
		if($(this).val().length>0)
		{
			transliterate("LAST_NAME", "UF_EN_LAST_NAME");
		}
	});


  $("a.addPersonalSite").click(function(){
		var site = $("input[name=ADD_WEB]").val();
		$("input[name=ADD_WEB]").val("");
		if(site)
		{	
			var countSite = $("div.userSiteList").length+1;
			var content = "<div class='userSiteList' id='site"+countSite+"'>"+site+"&nbsp;<input type='hidden' name='UF_WEB[]' value='"+site+"' /></div>";
			
			if(countSite==1)
			{
				$("td.userListTd").append(content);	
			}
			else
			{
				$("div.userSiteList").last().after(content);	
			}	
			
			$("td.userSiteDel").append("<a href='site"+countSite+"'><?=GetMessage('DROP');?></a>");
		}
		return false;
	});
	$("td.userSiteDel").on("click", "a", function(){
		var getID = $(this).attr("href");
		$("#"+getID).remove();
		$(this).remove();
		return false;
	});
});
</script>