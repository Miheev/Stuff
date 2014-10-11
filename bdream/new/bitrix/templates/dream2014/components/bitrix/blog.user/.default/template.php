<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;
?>
<? 
	$year = intval((time()-MakeTimeStamp($arResult["User"]["PERSONAL_BIRTHDAY"]))/31556926);
	$country = GetCountryByID($arResult["User"]["PERSONAL_COUNTRY"]);
?>
<br>
<h1 id="pageTitleBlue">
<?$APPLICATION->ShowTitle(false)?>
<div class="blueHr"></div>
</h1>

<?
	$filter = Array("ID"=>$USER->GetID());
	$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), $filter,array("SELECT"=>array("UF_FAVOURIT"))); 
	while ($arUser = $rsUsers->Fetch()) 
	{
	   $favour=$arUser["UF_FAVOURIT"];
	}
	if($favour[0]!=""){?>
		<a href="/personal/favourite.php" class="personalLinkFav"><?=GetMessage("MY_FAV");?></a>
	<?}?>
	
	<?//получим мечту текущего пользователя
global $USER;
$id="";
$arSelect = Array("ID");
$arFilter = Array("IBLOCK_ID"=>2, "PROPERTY_USER"=>$USER->GetID());
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $id=$arFields["ID"];
}
?>
<?if($id==""){?>
<a href="/personal/add_dream.php" class="personalLinkAdd"><?=GetMessage("ADD_DREAM");?></a>
<?}else{?>
<a href="/personal/add_dream.php?edit=Y&CODE=<?=$id?>" class="personalLinkAdd"><?=GetMessage("CHANGE_DREAM");?></a>
<?}?>
<a href="/" class="personalLinkMain"><?=GetMessage("BACK_TO_MAIN");?></a>
<div class="personalImgBlock">
	<?if($arResult["User"]["PERSONAL_PHOTO"]):?>
		<img src ="<?=GetImageResized(CFile::GetPath($arResult["User"]["PERSONAL_PHOTO"]), 188, 188);?>">
	<?else:?>
		<img src ="<?=GetImageResized(SITE_TEMPLATE_PATH."/images/img_user_big.png", 188, 188);?>">
	<?endif;?>
</div>
<div class="personalInfoBlock">
	<span class="personalName">
		<?=$arResult["User"]["NAME"]." ".$arResult["User"]["LAST_NAME"]?>	
	</span>
	<span class="personalControllBtn">
			<a class="personalSetting" href="/personal/profile/"><?=GetMessage("SETTING");?></a>
	</span>
	<br>
	<br>
	
	<span class="personalCityInfo"><?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?></span><br>
	<span class="personalCityInfo"><?=$country.", ".$arResult["User"]["PERSONAL_CITY"];?></span><br>
	<div class="slideBlock">
		<a id="prevSlide" href="#">&lt;</a>
		<div class="list_carousel">
			<ul id="foo2">
			<?
			if($arResult["DREAM"]["PROP"]["PHOTO"]["VALUE"]):
					krsort($arResult["DREAM"]["PROP"]["PHOTO"]["VALUE"]);
					krsort($arResult["DREAM"]["PROP"]["PHOTO"]["PROPERTY_VALUE_ID"]);
					foreach ($arResult["DREAM"]["PROP"]["PHOTO"]["VALUE"] as $key=>$imgId):?>
						<li>
						<div class="dropImg" rel="<?=$arResult["DREAM"]["FIELDS"]["ID"];?>" id="<?=$arResult["DREAM"]["PROP"]["PHOTO"]["PROPERTY_VALUE_ID"][$key];?>"><?=GetMessage("DROP");?></div>
						<a href="<?=CFile::GetPath($imgId);?>" rel="prettyPhoto"><img src="<?=GetImageResized(CFile::GetPath($imgId), 170, 105);?>" width="168px"/></a>
						</li>
					<?endforeach;?>
			<?else:?>
				<div class="loadPhotoText"><?=GetMessage("NOT_DREAM_PHOTO");?></div>
			<?endif;?>
			</ul>
					<div class="clearfix"></div>
		</div>
		<a id="nextSlide" href="#">&gt;</a>
		<div class="addPhoto">+</div>
		<div class="dreamsPhoto">
		<?$APPLICATION->IncludeComponent("bitrix:main.file.input", "dream_photo",
			   array(
			      "INPUT_NAME"=>"DREAM_PHOTO",
			      "MULTIPLE"=>"Y",
			      "MODULE_ID"=>"main",
			      "MAX_FILE_SIZE"=>"",
			      "ALLOW_UPLOAD"=>"I", 
			      "ALLOW_UPLOAD_EXT"=>"",
				  "INPUT_CAPTION"=> GetMessage("SELECT_FILE")
			   ),
			   false
			);?>
		</div>
	</div>
</div>
<div class="personalMoneyBlock">
<span><?=GetMessage("YOUR_CURRENT_AT_SITE");?></span>
<?
global $AR_CUR_SIMBOL;
$arCurSimbol = $AR_CUR_SIMBOL;
/*CModule::IncludeModule("currency");
$lcur = CCurrency::GetList(($by="SORT"), ($order1="asc"), LANGUAGE_ID);
while($lcur_res = $lcur->Fetch())
{
	
}*/
?>

<?CModule::IncludeModule("sale");
$dbAccountCurrency = CSaleUserAccount::GetList(
        array(),
        array("USER_ID" => $USER->GetID())    
    );
if($arAccountCurrency = $dbAccountCurrency->Fetch())
{
	 echo "<b>".$arCurSimbol[$arAccountCurrency["CURRENCY"]]."</b><br>";
	 echo "<span style='line-height: 45px;'>".GetMessage("IN_YOUR_ACOUNT")." ".round($arAccountCurrency["CURRENT_BUDGET"], 2)." ".$arCurSimbol[$arAccountCurrency["CURRENCY"]]." <a href='/personal/add_money.php' class='addMoney'>".GetMessage('ADD_MONY_ACOUNT')."</a></span>";
}
else 
{
	echo "<b>".$arCurSimbol[$arAccountCurrency["CURRENCY"]]."</b><br>";
	echo "<span style='line-height: 45px;'>".GetMessage("IN_YOUR_ACOUNT")." 0 <a href='/personal/add_money.php' class='addMoney'>".GetMessage('ADD_MONY_ACOUNT')."</a></span>";
}
?>

	<br><br>
	<?if (CModule::IncludeModule("blog")):
		$arUserBlog = CBlog::GetByOwnerID($arResult["User"]["ID"]);
	endif;?>
	
	<a href="/blogs/<?=$arUserBlog["URL"];?>/"><?=GetMessage("USER_BLOG");?></a><br><br>
	
	<span><?=GetMessage("WEB_SITES");?></span><br>
	<div class="userWebSiteListShow">
	<?foreach ($arResult["arUser"]["UF_WEB"] as $key=>$arWeb):
	
	$cropString = mb_substr($arResult["User"]["~UF_WEB"][$key], 0, 30);
	if (mb_strlen($arResult["User"]["~UF_WEB"][$key]) > 30) {
		$cropString .= '...';
	}
	?>
		<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a><br>
	<?endforeach;?>
	</div>
	<br>
	<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>

<a class="nameEdit" href="javascript:void(0)"><?=GetMessage("EDIT");?></a>
<div style="clear: both;"></div>
	<h3 class="personalTitle">
		<?=GetMessage("SHORT_NAME_DREAM");?>
		<span style="line-height: 22px; font-weight: normal;" class="spanText"><?=$arResult["DREAM"]["FIELDS"]["NAME"];?></span>
		<span class="spanInput"><input type="text" style="width: 415px;" class="nameEditInput" value="<?=$arResult["DREAM"]["FIELDS"]["NAME"];?>"></span>
	</h3>
	<div style="clear: both;"></div>
	<h3 class="personalTitle">
		<?=GetMessage("RATING_FOR_TURBO_DREAM");?>
		<span style="line-height: 22px; font-weight: normal;" class="spanTextTurbo"><?=$arResult["DREAM"]["PROP"]["TURBO_NEED"]["VALUE"];?></span>
		<span class="spanInput"><input type="text" style="width: 100px; text-align: center;" class="turboEditInput" value="<?=$arResult["DREAM"]["PROP"]["TURBO_NEED"]["VALUE"];?>"></span>
		&nbsp;<?=$arCurSimbol[$arAccountCurrency["CURRENCY"]];?>
	</h3>
	<script>
	$(document).ready(function(){
		var getName = "<?=$arResult["DREAM"]["FIELDS"]["NAME"];?>";
		var getTurbo = "<?=$arResult["DREAM"]["PROP"]["TURBO_NEED"]["VALUE"];?>";
		$(".nameEdit").click(function(){
			var getNewName = $(".nameEditInput").val();
			var getNewTurbo =  $(".turboEditInput").val();
			
			if($(this).hasClass("active"))
			{
				$(this).removeClass("active");
				$(this).text("Редактировать");
				if(getNewName!=getName || getNewTurbo!=getTurbo)
				{
					$.ajax({
						  type: "POST",
						  url: "/personal/save_edit.php",
						  data: "ACTION=SAVE_NAME&NAME="+getNewName+"&TURBO="+getNewTurbo,
						  success: function(data){
							if(data=="OK")
							{
								$(".spanText").text(getNewName);
								$(".spanTextTurbo").text(getNewTurbo);
								
								$(".nameEditInput").val(getNewName);
								$(".turboEditInput").val(getNewTurbo);
								
								$(".spanInput").hide();
								$(".spanText").show();	
								$(".spanTextTurbo").show();	
							}
						  }
						});
				}
				else
				{
					$(".spanInput").hide();
					$(".spanText").show();	
					$(".spanTextTurbo").show();	
					$(".nameEditInput").val(getName);
					$(".turboEditInput").val(getTurbo);
				}
				
			}
			else
			{
				$(this).addClass("active");
				$(this).text("Сохранить");
				$(".spanInput").show();
				$(".spanText").hide();
				$(".spanTextTurbo").hide();	
			}
		});
		
	});
	</script>

<div style="clear: both;"></div>
<br>
<div class="dreamInfoWrap">
	<div class="personalAbout">
	<h3 class="personalTitle"><?=GetMessage("ABOUT_ME");?></h3>
		<span class="personalControllBtn">
			<a class="personalEdit" href="personalEdit_ABOUT_ME" rel="ABOUT_ME"><?=GetMessage("EDIT");?></a>
		</span>
		<div style="clear: both;"></div>
		<span class="personalEdit_ABOUT_ME_nature"><?=$arResult["DREAM"]["PROP"]["ABOUT_ME"]["~VALUE"]["TEXT"];?></span>
		<div id="personalEdit_ABOUT_ME" style="display: none;">
		<form action="" method="POST" class="ABOUT_ME_FORM">
			<?if(CModule::IncludeModule("fileman"))
				{
				$LHE = new CLightHTMLEditor;
				                        $LHE->Show(array(
				                        'id' => "ABOUT_ME_INPUT",
										'width' => '465px',
										'height' => '250px',
										'inputName' => "ABOUT_ME",
										'content' => "<div style='width: 435px;'>".$arResult["DREAM"]["PROP"]["ABOUT_ME"]["~VALUE"]["TEXT"]."</div>",
										'bUseFileDialogs' => false,
										'BBCode' => false,
				                        'bFloatingToolbar' => false,
				                        'bArisingToolbar' => false,
				                        'toolbarConfig' => array(
				                        /*'Bold', 'Italic', 'Underline', 'RemoveFormat','ForeColor',
				                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'*/
				                           ),
				                    ));
				} 
			?>
		</form>
		</div>
	</div>
	<div class="personalDream">
	<h3 class="personalTitle"><?=GetMessage("MY_DREAM");?></h3>	
		<span class="personalControllBtn">
			<a class="personalEdit" href="personalEdit_DETAIL_TEXT" rel="DETAIL_TEXT"><?=GetMessage("EDIT");?></a>
		</span>
		<div style="clear: both;"></div>
		<span class="personalEdit_DETAIL_TEXT_nature"><?=$arResult["DREAM"]["FIELDS"]["~DETAIL_TEXT"];?></span>
		<div id="personalEdit_DETAIL_TEXT" style="display: none;">
			<form action="" method="POST" class="DETAIL_TEXT_FORM">
			<?if(CModule::IncludeModule("fileman"))
				{
				$LHE = new CLightHTMLEditor;
				                        $LHE->Show(array(
				                        'id' => "DETAIL_TEXT_INPUT",
										'width' => '465px',
										'height' => '250px',
										'inputName' => "DETAIL_TEXT",
										'content' => "<div style='width: 435px;'>".$arResult["DREAM"]["FIELDS"]["~DETAIL_TEXT"]."</div>",
										'bUseFileDialogs' => false,
										'BBCode' => false,
				                        'bFloatingToolbar' => false,
				                        'bArisingToolbar' => false,
				                        'toolbarConfig' => array(
				                        /*'Bold', 'Italic', 'Underline', 'RemoveFormat','ForeColor',
				                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'*/
				                           ),
				                    ));
				} 
			?>
		</form>
		</div>	
	</div>
	
	<div style="clear: both;"></div>
	<br>
	<div class="personalAbout">
	<h3 class="personalTitle">About:</h3>
		<span class="personalControllBtn">
			<a class="personalTranslate" href="personalEdit_ENGLISH_ABOUT_ME" rel="ENGLISH_ABOUT_ME"><?=GetMessage("AUTO_TRANSLATE");?></a>
			<a class="personalEdit" href="personalEdit_ENGLISH_ABOUT_ME" rel="ENGLISH_ABOUT_ME"><?=GetMessage("EDIT");?></a>
		</span>
		<div style="clear: both;"></div>
		<span class="personalEdit_ENGLISH_ABOUT_ME_nature" id="personalEdit_ENGLISH_ABOUT_ME_nature"><?=$arResult["DREAM"]["PROP"]["ENGLISH_ABOUT_ME"]["~VALUE"]["TEXT"];?></span>
		<div id="personalEdit_ENGLISH_ABOUT_ME" style="display: none;">
			<form action="" method="POST" class="ENGLISH_ABOUT_ME_FORM">
			<?if(CModule::IncludeModule("fileman"))
				{
				$LHE = new CLightHTMLEditor;
				                        $LHE->Show(array(
				                        'id' => "ENGLISH_ABOUT_ME_INPUT",
										'width' => '465px',
										'height' => '250px',
										'inputName' => "ENGLISH_ABOUT_ME",
										'content' => "<div style='width: 435px;'>".$arResult["DREAM"]["PROP"]["ENGLISH_ABOUT_ME"]["~VALUE"]["TEXT"]."</div>",
										'bUseFileDialogs' => false,
										'BBCode' => false,
				                        'bFloatingToolbar' => false,
				                        'bArisingToolbar' => false,
				                        'toolbarConfig' => array(
				                        /*'Bold', 'Italic', 'Underline', 'RemoveFormat','ForeColor',
				                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'*/
				                           ),
				                    ));
				} 
			?>
		</form>
		</div>	
		
		<div style="clear: both;"></div>
	</div>	
	<div class="personalDream">
	<h3 class="personalTitle">My dream:</h3>	
		<span class="personalControllBtn">
			<a class="personalTranslate" href="personalEdit_ENGLISH_DETAIL_TEXT" rel="ENGLISH_DETAIL_TEXT"><?=GetMessage("AUTO_TRANSLATE");?></a>
			<a class="personalEdit" href="personalEdit_ENGLISH_DETAIL_TEXT" rel="ENGLISH_DETAIL_TEXT"><?=GetMessage("EDIT");?></a>
		</span>
		<div style="clear: both;"></div>
		<span class="personalEdit_ENGLISH_DETAIL_TEXT_nature" id="personalEdit_ENGLISH_DETAIL_TEXT_nature"><?=$arResult["DREAM"]["PROP"]["ENGLISH_DETAIL_TEXT"]["~VALUE"]["TEXT"];?></span>
		<div id="personalEdit_ENGLISH_DETAIL_TEXT" style="display: none;">
			<form action="" method="POST" class="ENGLISH_DETAIL_TEXT_FORM">
			<?if(CModule::IncludeModule("fileman"))
				{
				$LHE = new CLightHTMLEditor;
				                        $LHE->Show(array(
				                        'id' => "ENGLISH_DETAIL_TEXT_INPUT",
										'width' => '465px',
										'height' => '250px',
										'inputName' => "ENGLISH_DETAIL_TEXT",
										'content' => "<div style='width: 435px;'>".$arResult["DREAM"]["PROP"]["ENGLISH_DETAIL_TEXT"]["~VALUE"]["TEXT"]."</div>",
										'bUseFileDialogs' => false,
										'BBCode' => false,
				                        'bFloatingToolbar' => false,
				                        'bArisingToolbar' => false,
				                        'toolbarConfig' => array(
				                        /*'Bold', 'Italic', 'Underline', 'RemoveFormat','ForeColor',
				                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'*/
				                           ),
				                    ));
				} 
			?>
		</form>
		</div>	
	</div>
	
	
</div>
<div style="clear: both;"></div>

<br><br>
<?CJSCore::Init(array('translit'));?>
<script>
$('#foo2').carouFredSel({
		auto: false,
		prev: '#prevSlide',
		next: '#nextSlide'
	});


$(document).ready(function(){
	$(".dropImg").click(function(){
		var obj = $(this);
		var getID = obj.attr("rel");
		var getProp = obj.attr("id");
		
		if(getID && getProp)
		{
			if (confirm("<?=GetMessage("ARE_YOU_SURE_DROP_FILE");?>")) {
				$.ajax({
					  type: "POST",
					  url: "/personal/drop_photo.php",
					  data: "ELEMENT_ID="+getID+"&PROP_ID="+getProp,
					  success: function(data){
						 obj.parent("li").remove();
						 $('#foo2').carouFredSel({
								auto: false,
								prev: '#prevSlide',
								next: '#nextSlide'
							});
					  }
					});
			}
		}
	});
});


$("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});	

function fvoid(data)
{
	jsAjaxUtil.CloseLocalWaitWindow();
}
var oldValue = '';
$(".personalTranslate").click(function(){
	var getTextID = $(this).attr("href");
	var getProp = $(this).attr("rel");
	transliterate(getTextID+"_nature", getTextID+"_nature", getProp);
	return false;
});

function transliterate(from, to, getProp)
{
		var from = $("#"+from);
		var to = $("#"+to);
		if(from && to && oldValue != from.text())
		{
			BX.translit(from.text(), {
				'max_len' : 900000,
				'change_case' : 'L',
				'replace_space' : ' ',
				'replace_other' : false,
				'delete_repeat_replace' : false,
				'use_google' : true,
				'callback' : function(result){
					to.text(result); 
					$.ajax({
	                    url:     "/personal/save_translate.php",
	                    type:     "POST", 
	                    dataType: "html",
	                    data: 'PROP='+getProp+'&PROP_TEXT='+result, 
	                    success: function(response) 
	                    { 
							
	                    } 
					});   
					setTimeout('transliterate()', 250); 
					}
			});
			oldValue = from.text();
		}
		else
		{
			setTimeout('transliterate()', 250);
		}
}
$(document).ready(function(){
	$(".addPhoto").click(function(){
		$(".file-input input[type='file']").trigger('click');
	});

	$(".dreamsPhoto").change(function(){
		if($(this).val())
		{
			
		}
	});


	$(".nameEdit").click(function(){
		
	});
	
});
</script>