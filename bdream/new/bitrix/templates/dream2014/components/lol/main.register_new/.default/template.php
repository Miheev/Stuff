<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="bx-auth-profile">
<h1 id="pageTitleBlue"><?=GetMessage("AUTH_REGISTER")?><div class="blueHr"></div></h1>

<div class="bx-auth">
<?if($USER->IsAuthorized()):?>

<?localRedirect("/personal/");?>
<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
<div class="step1Text regPage">
<br>
<div style="clear: both"></div>
<br>
	<div class="userProfileBlock">
	<h3>Личные данные</h3>
	<table>
		<tr>
			<td><?=GetMessage("REGISTER_FIELD_NAME")?></td>
			<td><?=GetMessage("REGISTER_FIELD_LAST_NAME")?></td>
		</tr>
		<tr>
			<td>
				<lable>На родном языке</lable><br>
				<input type="text" name="REGISTER[NAME]"  id="NAME" maxlength="50" value="<?=$arResult["VALUES"]["NAME"]?>" class="bx-auth-input need" />
			</td>
			<td><br>
				<input type="text" name="REGISTER[LAST_NAME]" id="LAST_NAME" maxlength="50" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" class="bx-auth-input need" />
			</td>
		</tr>
		<tr>
			<td>
				<lable>На английском</lable><br>
				<input type="text" name="REGISTER[UF_EN_NAME]" id="UF_EN_NAME" maxlength="50" value="<?=$arResult["VALUES"]["UF_EN_NAME"]?>" class="bx-auth-input need" />
			</td>
			<td><br>
				<input type="text" name="REGISTER[UF_EN_LAST_NAME]" id="UF_LAST_NAME" maxlength="50" value="<?=$arResult["VALUES"]["UF_EN_LAST_NAME"]?>" class="bx-auth-input need" />
			</td>
		</tr>
		<tr>
			<td colspan="2" style="color: red;"><input type="checkbox" <?if($arResult["VALUES"]["UF_SHOW_LAST_NAME"]):?> checked="checked"<?endif;?> value="1" name ="REGISTER[UF_SHOW_LAST_NAME]" id="onlyAdmin"><lable for="onlyAdmin">Фамилия видна только администрации</lable></td>
		</tr>
		<tr>
			<td colspan="2">
				Страна:<br>
				<input type="text" name="REGISTER[PERSONAL_COUNTRY]" value="<?=$arResult["VALUES"]["PERSONAL_COUNTRY"]?>" id=COUNTRY class="need" style="width: 300px;">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				Город:<br>
				<input type="text" name="REGISTER[PERSONAL_CITY]" value="<?=$arResult["VALUES"]["PERSONAL_CITY"]?>" id="CITY" class="need" style="width: 300px;">
			</td>	
		</tr>
		<tr>
			<td>
				Дата рождения:<br>
				<?
				$APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'',
					array(
						'SHOW_INPUT' => 'Y',
						'FORM_NAME' => 'bform',
						'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
						'INPUT_VALUE' => $arResult["VALUES"]["PERSONAL_BIRTHDAY"],
						'SHOW_TIME' => 'N'
					),
					null,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</td>
			<td>
				Пол:<br>
				<select name="REGISTER[PERSONAL_GENDER]">
					<option <?if($arResult["VALUES"]["PERSONAL_GENDER"]=="M"):?> selected="selected"<?endif?> value="M">Муж.</option>
					<option <?if($arResult["VALUES"]["PERSONAL_GENDER"]=="F"):?> selected="selected"<?endif?> value="F">Жен.</option>
				</select>
			</td>		
		</tr>
		<tr>
			<td>
				Вебсайты:<br>

				<input type="text" name="ADD_WEB" maxlength="255" value="" />	
			</td>
			<td>
				<br><a href="" class="addPersonalSite">Прикрепить</a>
			</td>
		</tr>
		<tr>
		
		<td class="webSiteName">
			
		</td>
		<td class="userSiteDel">
		
		</td>
		
	</tr>
		<tr>
			<td colspan="2">
				Контакты:<br>
				<span style="color: red; font-size: 11px;">Видимые только для администрации</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" >Телефон:<input type="text" name="REGISTER[PERSONAL_PHONE]" maxlength="50" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"];?>" class="bx-auth-input" /></td>	
		</tr>
		<tr>
			<td colspan="2">Skype:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="REGISTER[UF_SKYPE]" maxlength="50" value="<?=$arResult["VALUES"]["UF_SKYPE"];?>" class="bx-auth-input" /></td>	
		</tr>
	</table>
	</div>
	<div class="userProfileBlock">
	<table class="rigt_table">
		<tr>
			<td>
				<?=GetMessage("REGISTER_FIELD_LOGIN")?><span class="starrequired">*</span>
				<br>
				<input type="text" name="REGISTER[LOGIN]" maxlength="255" value="<?=$arResult["VALUES"]["LOGIN"]?>" class="bx-auth-input need" />
			</td>
			<td>
				<?=GetMessage("REGISTER_FIELD_EMAIL")?><span class="starrequired">*</span>
				<br>
				<input type="text" name="REGISTER[EMAIL]" maxlength="255" value="<?=$arResult["VALUES"]["EMAIL"]?>" class="bx-auth-input" />
			</td>
			<td rowspan="2">
			</td>
		</tr>
		<tr>
			<td>
				<?=GetMessage("REGISTER_FIELD_PASSWORD")?><span class="starrequired">*</span>
				<br>
				<input type="password" name="REGISTER[PASSWORD]" maxlength="50" value="<?=$arResult["VALUES"]["PASSWORD"]?>" class="bx-auth-input need" />
			</td>
			<td>
				<?=GetMessage("REGISTER_FIELD_CONFIRM_PASSWORD");?><span class="starrequired">*</span>
				<br>
				<input type="password" name="REGISTER[CONFIRM_PASSWORD]" maxlength="50" value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" class="bx-auth-input need" />
			</td>
		</tr>
	</table>
	
	<div style="clear: both;"></div>
	
		<h3>Загрузить фото</h3>
			<?$APPLICATION->IncludeComponent("bitrix:main.file.input", "profile_avatar",
			   array(
			      "INPUT_NAME"=>"USER_PHOTO",
			      "MULTIPLE"=>"Y",
			      "MODULE_ID"=>"main",
			      "MAX_FILE_SIZE"=>"",
			      "ALLOW_UPLOAD"=>"I", 
			      "ALLOW_UPLOAD_EXT"=>"",
				  "INPUT_CAPTION"=> "Выбрать файл"
			   ),
			   false
			);?>
			<br>
			<?if(isset($_REQUEST["PHOTO"]) && $_REQUEST["PHOTO"]):?>
				<div class="miniPhoto">
					<span>Миниатюра</span>
					<div><img src="<?=$_REQUEST["PHOTO"];?>"></div>	
				</div>
			<?else:?>
				<div class="miniPhoto" style="display: none;">
					<span>Миниатюра</span>
					<div></div>
					<input type="button" class="cropImg" value="Сохранить изменения"/>		
				</div>
			<?endif;?>
			
			
				<div class="bigPhoto">
					<img src="<?=$_REQUEST["PHOTO"]?>" style="width: 320px;">
					<input type='hidden' name='PHOTO' value='<?=$_REQUEST["PHOTO"]?>' />
				</div>
		<?/*?>
	<div style="clear: both;"></div>	
	<h3>О себе</h3>
	<a class="aboutPersonalTranslate" style="margin-left: 60px;" href="javascript:void(0)" rel="">Автоперевод</a>
	<div style="clear: both;"></div>	
	<lable class="langLable">Ru</lable>
	<textarea style="width: 490px; height: 100px; float: left;" id="aboutRu" name="ABOUT_RU"><?=$_REQUEST["ABOUT_RU"];?></textarea>
	<div style="clear: both"></div><br>
	<lable class="langLable">En</lable>
	<textarea style="width: 490px; height: 100px; float: left;" id="aboutEn" name="ABOUT_EN"><?=$_REQUEST["ABOUT_EN"];?></textarea>
	<?//*/?>
	
	
	<div style="clear: both;"></div>
	<div class="captha">
	<br>
		<? /*CAPTCHA */
		if ($arResult["USE_CAPTCHA"] == "Y"):?>
			<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="192" height="auto" alt="CAPTCHA" />
		<?endif;?>
		<div style="clear: both;"></div>
		<br>
		<span class="starrequired">*</span><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<br>	
		<input type="text" name="captcha_word" maxlength="50" value="" class="need" />
						
	</div>
	
<div style="clear: both;"></div>
	
<input type="submit" class="regBtn regNextBtn" name="register_submit_button" value="Зарегистрироваться"/>

</div>
<div style="clear: both;"></div>	
</div>
</div>	
</form>

<script>
  $(function() {
 
	 $("#COUNTRY").autocomplete({
			 source: function( request, response ) {
			        $.get("/personal/ajax_location.php",
					    {search:request.term, type:"country"},
					    function( data ) {
					        	  response(data);
					    },
			        	"json"
			        )
			 }
	});
	 $("#CITY").autocomplete({
		 source: function( request, response ) {
		        $.get("/personal/ajax_location.php",
				    {search:request.term, type:"city"},
				    function( data ) {
				        	  response(data);
				    },
		        	"json"
		        )
		 }
	});
});
</script>
<?CJSCore::Init(array('translit'));?>
<script type="text/javascript">
function checkControll(obj)
{
	var error = 0;
	obj.parents("div.regPage").find(".need").each(function (i) {
		
		if($(this).val()=="" || $(this).val()=="undefined")
		{
			$(this).css("border", "1px solid red");
			error++;
		}
	else
		{
			$(this).css("border", "1px solid #E5E5E5");
		}
	});
	if(error!=0)
	{
		return false;
	}
	else
	{
		return true;
	}
	
	
}
		
$( document ).ready(function() {
	$("#REGISTER[PERSONAL_BIRTHDAY]").addClass("need");
	$(".regBtn").not("input.regBtn").click(function(){
	
		if(checkControll($(this)) || $(this).hasClass("regPrevBtn"))
		{
			var getShowClass = $(this).attr("href");
			$(".regPage").hide();
			$(getShowClass).show();
		}
		
		return false;
	});
});

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
		else
		{
			setTimeout('transliterate()', 250);
		}

}
$(document).ready(function(){
	$("input.regBtn").click(function(){
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		var email = $("input[name='REGISTER[EMAIL]']").val();
		if(pattern.test(email))
		{
			$("input[name='REGISTER[EMAIL]']").css("border", "1px solid #E5E5E5");
		}
		else
		{
			$("input[name='REGISTER[EMAIL]']").css("border", "1px solid red");
		}
		return checkControll($(this));
	});
  $("a.addPersonalSite").click(function(){

	  	var pattern = /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
		var site = $("input[name=ADD_WEB]").val();
		if(pattern.test(site))
		{
			$("input[name=ADD_WEB]").val("");
			if(site)
			{	
				var countSite = $("div.userSiteList").length+1;
				var content = "<div class='userSiteList' id='site"+countSite+"'>"+site+"&nbsp;<input type='hidden' name='UF_WEB[]' value='"+site+"' /></div>";
				if($("div.userSiteList").length==0)
				{
					$(".webSiteName").append(content);
					$("td.userSiteDel").append("<a href='site"+countSite+"'>Удалить</a>");
				}
				else
				{
					$("div.userSiteList").last().after(content);
					$("td.userSiteDel").append("<a href='site"+countSite+"'>Удалить</a>");
				}
				
			}
		}
		return false;
	});
	$("td.userSiteDel").on("click", "a", function(){
		var getID = $(this).attr("href");
		$("#"+getID).remove();
		$(this).remove();
		return false;
	});
	 $("div.wrapStep div").click(function(){
			var getIdName = this.id;
			
			 if(checkControll($(this)) || $(this).parent(".wrapStep").children("#step3").hasClass("activeStep"))
			 {
				 	$(this).parent().parent().hide();
					$("."+getIdName+"Text").show();	
			 } 
			
	 });

	 $(".curencyBtn").click(function(){
		 $(".curencyBtn").removeClass("activeCurency");
		 $(this).addClass("activeCurency");
		 var getID = $(this).attr("id");
		 $("input[name='CURRENCY_ID']").val(getID);
	 });	
	 $(".regNextBtn[href='.step2Text']").click(function(){
		 $('.addPersonalSite').trigger('click');
		 $('.cropImg').trigger('click');
	 });


	 $(".personalTranslate").click(function(){
			transliterate(getTextID+"_nature", getTextID+"_nature", getProp);
			return false;
		});

	 $('#NAME').focusout(function(){
		 if($(this).val().length>0)
		 {
			 transliterate("NAME", "UF_EN_NAME");
		 }
	 });
	 $('#LAST_NAME').focusout(function(){
		if($(this).val().length>0)
		{
			transliterate("LAST_NAME", "UF_LAST_NAME");
		}
	 });	 
	
	$(".regPersonalTranslate").click(function(){
		transliterate("aboutDreamRu", "aboutDreamEn");
		return false;
	});	 
	$(".aboutPersonalTranslate").click(function(){
		transliterate("aboutRu", "aboutEn");
		return false;
	});	 	 
});
</script>
<?endif?>