<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="main-container">
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
	
	<pre><?//print_r ($arResult);?></pre>
  <div class="main wrapper clearfix"> 
	<form method="post" name="form1" class="img-crop-form" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="lang" value="<?=LANG?>" />
	<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
		<div class="center"> 
		  <div class="profile-node">
              <? $APPLICATION->IncludeComponent( "webpro:imagecrop", "", array('width'=>108, 'height'=>108));?>
		   
			<div class="name clearfix"> 
				<?ShowError($arResult["strProfileError"]);?>
				<?
					if ($arResult['DATA_SAVED'] == 'Y')
					ShowNote(GetMessage('PROFILE_DATA_SAVED'));
				?>
			  <div class="row clearfix"> 
				<div class="item"> <span class="label"><?=GetMessage('NAME')?></span> <input type="text" id="NAME" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" /> </div>
			   
				<div class="item"> <span class="label"><?=GetMessage('LAST_NAME')?></span> <input type="text" id="LAST_NAME" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /> </div>
			   </div>
			 
			  <div class="row clearfix"> 
				<div class="item"> <span class="label"><?=GetMessage("IN_ENGLISH_NAME");?></span> <input type="text" id="UF_EN_NAME" name="UF_EN_NAME" maxlength="50" value="<?=$arResult["arUser"]["UF_EN_NAME"]?>" /> </div>
			   
				<div class="item"> <span class="label"><?=GetMessage('IN_ENGLISH_LAST_NAME')?></span> <input type="text" id="UF_EN_LAST_NAME" name="UF_EN_LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["UF_EN_LAST_NAME"]?>" /> </div>
			   </div>
			 
			  <p><?=GetMessage('NAME_LAST_NAME_COM')?></p>
			 </div>
		   
			<div class="birth"> 
				<span class="label"><?=GetMessage("USER_BIRTHDAY_DT")?> (<?=$arResult["DATE_FORMAT"]?>):</span> 
				<?
				$APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'',
					array(
						'SHOW_INPUT' => 'Y',
						'FORM_NAME' => 'form1',
						'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
						'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
						'SHOW_TIME' => 'N'
					),
					null,
					array('HIDE_ICONS' => 'Y')
				);

				//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
				?> 
			</div>
		   
			
			<div class="about"> <span class="label">О себе</span> <textarea name="UF_ABOUT" rows="5"><?=$arResult["arUser"]["UF_ABOUT"]?></textarea> 
			  <p>Мы предлагаем Вам написать краткое описание о себе, если вы напишите более 300 символов, это будет отлично смотреться на Вашей странице.</p>
			 </div>
		   </div>
		 </div>
	   <aside class="right"> 
		  <div class="profile-node"> 
			<div class="location"> <span class="label"><?=GetMessage('USER_PLACE')?></span> 
			
				<?=GetMessage('USER_COUNTRY')?><br>
				<?=$arResult["COUNTRY_SELECT"]?><br>
			
				<?=GetMessage('USER_CITY')?><br>
				<input type="text" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" /><br>
			  <p><?=GetMessage('USER_PLACE_SELECT')?></p>
			 </div>
		   	
			<div class="sites"> <span class="label"><?=GetMessage('WEB_SITES');?></span> <input type="text" name="ADD_WEB" maxlength="255" value="" /><a href="" class="abutton addPersonalSite"><?=GetMessage('ADD');?></a>
			  <p><?=GetMessage('WEB_SITES_COM');?></p>
			 
			  <div class="social userListTd">
				<?if($arResult["arUser"]["UF_WEB"] && count($arResult["arUser"]["UF_WEB"])>0):?>
					<?foreach ($arResult["arUser"]["UF_WEB"] as $key=>$arWeb):?>
						<div class="input userSiteList" id="site<?=$key;?>">
							<input type="text" name="UF_WEB[]" maxlength="255" autocomplete="" value="<?=$arWeb;?>" /><a href="site<?=$key;?>"></a>
						</div>	
					<?endforeach;?>
				<?endif;?>
			   </div>
			 </div>		   
			<div class="buttons"> <input type="submit" class="abutton saveProfileBtn" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>"> </div>
		   </div>
		 </aside>
		</form>
	</div>
<!-- #main -->
 </div>
	
<div class="bx-auth-profile profile-node">


<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>

<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />


<table>
	
	
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
		
		
	</tr>
</table>



<input type="submit" class="saveProfileBtn" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">	
</form>
</div>
<div class="userProfileBlock profile-node">
    <h3><?=GetMessage('LOAD_PHOTO');?></h3>
    <form id="dream-crop" class="dream-crop-form" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?//$APPLICATION->IncludeComponent("bitrix:main.file.input", "profile_avatar",
//   array(
//      "INPUT_NAME"=>"USER_PHOTO",
//      "MULTIPLE"=>"N",
//      "MODULE_ID"=>"main",
//      "MAX_FILE_SIZE"=>"1572864",
//      "ALLOW_UPLOAD"=>"I",
//      "ALLOW_UPLOAD_EXT"=>"",
//	  "INPUT_CAPTION"=> "Выбрать файл"
//   ),
//   false
//);?>
    <? $APPLICATION->IncludeComponent( "webpro:dreamphoto", "", array('width'=>1024, 'height'=>768));?>
    </form>
<br>
</div>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
    <input type="hidden" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>"/>
    <input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>"/>
</form>
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
			var content = "<div class='userSiteList' id='site"+countSite+"'><input type='text' name='UF_WEB[]' maxlength='255' autocomplete='' value='"+site+"' /><a href='site"+countSite+"'></div>";
			
			if(countSite==1)
			{
				$(".userList").append(content);	
			}
			else
			{
				$("div.userSiteList").last().after(content);	
			}	
			
			$(".userSiteDel").append("<a href='site"+countSite+"'><?=GetMessage('DROP');?></a>");
		}
		return false;
	});
	$(".userSiteDel").on("click", "a", function(event){
	event.preventDefault();
		var getID = $(this).attr("href");
		$("#"+getID).remove();
		$(this).remove();
		return false;
	});
});
</script>