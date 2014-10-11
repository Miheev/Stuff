<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? 
if(count($arResult["ITEMS"])>0):

$year = intval((time()-MakeTimeStamp($arResult["USER"]["PERSONAL_BIRTHDAY"]))/31556926);

$country = GetCountryByID($arResult["USER"]["PERSONAL_COUNTRY"]);
?>
<aside class="left">
                <div class="true-dreams">
                <article>
						
						<?foreach($arResult["ITEMS"] as $arItem){?>
                        <div class="about">
                            <div class="img">
							
							<?if($arItem["DETAIL_PICTURE"]["SRC"]!=""){?>
				<?
				$renderImage = CFile::ResizeImageGet(
					$arItem["DETAIL_PICTURE"],
					Array("width" => "259", "height" => "132"),
					BX_RESIZE_IMAGE_EXACT
					);
				?>
					<img src="<?=$renderImage["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
				<?}else if($arItem["PREVIEW_PICTURE"]["SRC"]!=""){?>
				<?
				$renderImage = CFile::ResizeImageGet(
					$arItem["PREVIEW_PICTURE"],
					Array("width" => "259", "height" => "132"),
					BX_RESIZE_IMAGE_EXACT
					);
				?>
					<img src="<?=$renderImage["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
				<?}else if($arUser["USER_INFO"]["PERSONAL_PHOTO"]){?>
				<?
				$renderImage = CFile::ResizeImageGet(
					$arResult["USER"]["PERSONAL_PHOTO"],
					Array("width" => "259", "height" => "132"),
					BX_RESIZE_IMAGE_EXACT
					);
				?>
					<img src="<?=$renderImage["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
					
				<?}else{?>
					<img src="/bitrix/templates/dreams_start/images/img_user.jpg" width="259" height="132"  alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>">
				<?}?>
				</div>
                            <span class="tbd">TurboDreams</span>
                        </div>
						
						<?global $AR_CUR_SIMBOL;	
						CModule::IncludeModule("sale");
						$dbAccountCurrency = CSaleUserAccount::GetList(
								array(),
								array("USER_ID" => $arItem["PROPERTIES"]["USER"]["VALUE"]),
								false,
								false,
								array("CURRENCY")
						);
						if($arAccountCurrency = $dbAccountCurrency->Fetch())
						{
							$simbol = $AR_CUR_SIMBOL[$arAccountCurrency["CURRENCY"]];
						}
						else
						{
							$simbol = $AR_CUR_SIMBOL["USD"];
						}
						if($arItem["PROPERTIES"]["TURBO_YET"]["VALUE"]):
							$yet = $arItem["PROPERTIES"]["TURBO_YET"]["VALUE"];
						else:
							$yet = 0;
						endif;
						if($arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"]):
							$need = $arItem["PROPERTIES"]["TURBO_NEED"]["VALUE"];
						else:
							$need = 0;
						endif;
						if($yet<$need)
						{
							$persent = round($yet*100/$need);
						}
						else 
						{
							$persent = 100;
						}
						?>
		
		
						<div class="needs clearfix">
                            <div class="left">
                                <div class="radial-progress" data-to="<?=$persent;?>">
                                    <div class="circle">
                                        <div class="mask full">
                                            <div class="fill"></div>
                                        </div>
                                        <div class="mask half">
                                            <div class="fill"></div>
                                            <div class="fill fix"></div>
                                        </div>
                                        <div class="shadow"></div>
                                    </div>
                                    <div class="inset">
                                        <div class="percentage"><span><?=$persent;?></span>%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <p>Требуется</p>
                                <h3><?=number_format($need, 0, ',', ' ' );?> <?=$simbol;?></h3>
                                <p>Собрано <?=$persent;?>%</p>
                                <p><?=number_format($yet, 2, ',', ' ' );?> <?=$simbol;?></p>
                            </div>
                        </div>
						<?}?>
                        
                </article>
                </div>
				<?global $USER;if ($USER->IsAuthorized()){?>
                <div class="bookmark">
                    <a class="abutton" href="javascript:void(0);">В Избранное</a>
                </div>
					<?}?>
                <div id="fixblock" >
                    <section>
                        <h3>Фильтр</h3>
						
	<form action="" method="POST">
		<div class="checkboxes">
                            <span class="block-label">По действиям</span>

							
		<?$i=0;foreach ($arResult["ACTIONS"] as $actions):?>
			<span class="chk">
				<input type="checkbox" <?if(in_array($actions["INFO"]['ID'], $_POST["filter_actions"])):?> checked<?endif;?> name="filter_actions[]" value="<?=$actions["INFO"]['ID'];?>"/>
			</span>
			<span class="label"> <?=$actions["INFO"]["NAME"]?></span>
			<?$i++;
			if($i%3==0){?>

			<?}?>
		<?endforeach;?>

        </div>		
								
		<span>Имя</span>		
		<input type="text" name="name"  placeholder="<?=GetMessage("NAME");?>" value="<?=htmlspecialcharsEx($_POST["name"]);?>">
		
        <span>Фамилия</span>
		<input type="text" name="last_name"  placeholder="<?=GetMessage("LAST_NAME");?>" value="<?=htmlspecialcharsEx($_POST["last_name"]);?>">
		
        <span>Страна</span>
		<input type="text" name="country" id="country" placeholder="<?=GetMessage("COUNTRY");?>" value="<?=htmlspecialcharsEx($_POST["country"]);?>">
		
        <span>Город</span>
		<input type="text" name="city" id="city" placeholder="<?=GetMessage("CITY");?>" value="<?=htmlspecialcharsEx($_POST["city"]);?>">
		
		
		<input type="hidden" name="SET_FILTER" value="Y">
		
		
		
                        <div class="buttons">
							<input type="submit" value="Найти" class="abutton find" style="border:none;"/>
							<?if($_POST["SET_FILTER"]):?>
								<a class="abutton reset" href="/realization/">Сброс</a>
							<?endif;?>
                        </div>

	</form>
	
	
	
                        

                        
                    </section>
                </div>
            </aside>
            <div class="center">
			
			
			

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?$id = $arItem["ID"];?>
	
	
	<?//echo "<pre>";print_R($arItem);echo "</pre>";?>
	<div class="main_left_img">
                    <div class="left_img_footer">
                        <div class="img_footer_head">
                            <div class="img_footer_name"><?=$arResult["USER"]["NAME"];?> <?=$arResult["USER"]["LAST_NAME"];?> <?=$year." ".ruDecline($year,GetMessage("YEAR"),GetMessage("YEARS"),GetMessage("LET"));?> лет</div>
                            <div class="img_footer_country"><?=$country.", ".$arResult["USER"]["PERSONAL_CITY"];?></div>
                        </div>
						<?if(count($arUser["UF_WEB"])>0):?>
                        <div class="img_footer_website">Веб сайты:&nbsp;
						<?foreach ($arResult["USER"]["UF_WEB"] as $key=>$arWeb):
							$cropString = mb_substr($arResult["USER"]["UF_WEB"][$key], 0, 30);
							if (mb_strlen($arResult["USER"]["UF_WEB"][$key]) > 30) {
								$cropString .= '...';
							}?>
							<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a> 
						<?endforeach;?>						
						</div>
						<?endif;?>
                    </div>
                </div>
                <div class="main_left_news">
                    <div class="left_news_name like-it">Мечта
                    </div>
                    <div class="left_news_content">
						<?=$arItem["DETAIL_TEXT"];?>
						<?//=$arItem["PROPERTIES"]["ENGLISH_DETAIL_TEXT"]["~VALUE"]["TEXT"];?>					
                    </div>
                </div>
                <div class="main_left_news last">
                    <div class="left_news_name">О себе</div>
                    <div class="left_news_content">
						<?=$arItem["PROPERTIES"]["ABOUT_ME"]["VALUE"]["TEXT"];?>	</div>
                </div>
                <div class="flip-block admin">
                    <h3>Слово администрации</h3>
                    <div class="content">
                        <div class="subject">
                            <div class="left_news_name">Тема сообщения</div>
                            <div class="date">Дата: 
                            <?=$arItem["PROPERTIES"]["ADMIN_DESCRIPT"]["TIMESTAMP_X"];?></div>
                        </div>
                        <div class="text">
                            <?=$arItem["PROPERTIES"]["ADMIN_DESCRIPT"]["VALUE"]["TEXT"];?>
                        </div>
                        <a class="abutton" href="javascript:void(0);">Задать вопрос</a>
                    </div>
                </div>
				
				<? 
				$helpCount = count($arResult["ACTIONS"]);
				$inCol = ceil($helpCount/2);
				$i = 0;$j = 1;?>
			
                <div class="flip-block arrived">
				<h3>Уже достигнуто</h3>
                    <div class="content clearfix">
                        <div class="left">
			<?foreach ($arResult["ACTIONS"] as $actions):?>
			
				<div><?=GetMessage("HELP");?><?=mb_strtolower($actions["INFO"]["NAME"]);?>: <span><?=$actions["COUNT"]?> <?=GetMessage("CHEL");?></span></div>
				<?$i++;$j++;?>		
				<?if($i%3==0){?>
                        </div>
                        <div class="right">
				<?}?>	
			<?endforeach;?>
                        </div>
                    </div>					
                </div>
	<input type="hidden" name="" class="helpDreamId" value ="<?=$id;?>"/>
<?endforeach;?>



                
				
				

	
	
	
                <div class="flip-block action">
                    <h3><?=GetMessage("ACTION");?></h3>
                    <div class="content">
                        <div class="checkboxes clearfix">	
                            <span>По действиям</span>
                            <div class="column">	
	<?$i = 0;$j = 1;?>
	<?foreach ($arResult["ACTIONS"] as $actions):?>
			
				<input type="checkbox" name="dream" class="helpOption" value="<?=$actions["INFO"]['ID'];?>" style="display: none;"><a href="#" class="toggle"></a> 
				<span><?=$actions["INFO"]["NAME"]?></span>
			
		<?$i++;$j++;?>	
				<?if($i%3==0){?>
                        </div>
                        <div class="column">
				<?}?>	
	<?endforeach;?>	
                        </div>
                    </div>
                    <div class="txt-label">Ваш комментарий</div>
                        <textarea rows="10" cols="85" name="comment" class="helpComment" placeholder="<?=GetMessage("YOUR_COMMENT");?>"></textarea>
                        <a class="abutton addComment" href="javascript:void(0);">Отправить</a>
                </div>
            </div>

<?/*?>

	<a href="" class="realLink tabBtn"><?=GetMessage("PAYS");?></a>
	<a href="" class="realLink tabBtn" style="display: none;"><?=GetMessage("ACTION");?></a>
	<div class="realFiltrenHead"><?=GetMessage("FILTER");?></div>
<?

<script>
$(function() {
	 $(".descript_tab_btn").click(function(){
		 var getClass = $(".descript_tab_btn").attr("href");
		 if(getClass=="in_english")
		 {
			 $(this).text("In English");
			 $(this).attr("href", "in_native_language");
			 $(".in_english").show();
			 $(".in_native_language").hide();
			 
		 }

		 if(getClass=="in_native_language")
		 {
			 $(this).text("In native language");
			 $(this).attr("href", "in_english");
			 $(".in_english").hide();
			 $(".in_native_language").show();
		 }
		 return false;
	 });
});
</script>
<script>
$(function() {
$("#country").autocomplete({
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
$("#city").autocomplete({
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

    var showOrHide = false;
    $(".tabBtn").click(function(){	
 		   if(showOrHide)
 		   {
 			  showOrHide = false;
 			  $(".realAction").show();
    		  $(".realPay").hide();
 		   }
 		   else
 		   {
 			  showOrHide = true; 
 			  $(".realAction").hide();
 	   		  $(".realPay").show(); 
 		   }
 		  
 		  $(".tabBtn").show();
		  $(this).hide();

		return false;
    });
});</script> 
*/?>
<?else:?>
<p><?=GetMessage("NOT_USERS");?></p>
<?endif;?>
