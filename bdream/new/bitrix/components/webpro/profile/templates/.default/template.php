<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
$country = GetCountryByID($arResult["USER_PERSONAL_COUNTRY"]);
$year = intval((time()-MakeTimeStamp($arResult["USER_PERSONAL_BIRTHDAY"]))/31556926);
	
	?>
<div class="center">
            <div class="main_left_menu">
               <?$APPLICATION->IncludeComponent("bitrix:menu", "profile_menu1", Array(
					"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
						"MENU_CACHE_TYPE" => "N",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
					),
					false
				);?>
            </div>
			
					
						
					
            <div class="main_left_img">
                <div class="left">
                    <img src="<?=CFile::GetPath($arResult["USER_PHOTO"])?>">
                </div>
                <div class="right left_img_footer">
                    <div class="img_footer_head"> 
						<div class="img_footer_name"><?=$arResult["USER_NAME"]." ".$arResult["USER_LAST_NAME"];?> <?=$year." ".ruDecline($year,"год","года","лет");?></div>
						<div class="img_footer_country"><?=$country.", ".$arResult["USER_PERSONAL_CITY"];?></div>
					</div>
					<?if(count($arResult["USER_WEB"])>0):?>
                    <div class="img_footer_website"><?=GetMessage('WEB_SITES');?>&nbsp;
							<?foreach ($arResult["USER_WEB"] as $key=>$arWeb):
								$cropString = mb_substr($arWeb, 0, 30);
								if (mb_strlen($key) > 30) {
									$cropString .= '...';
									}?>
								<a href="<?="http://".str_replace("http://", "", $arWeb);?>"><?=$cropString;?></a>,&nbsp; 
							<?endforeach;?>						
					</div>
					<?endif;?>
                </div>
            </div>
            <div class="main_left_news">
                <div class="left_news_name">О себе</div>
                <div class="left_news_content"><?=$arResult["ABOUT"]?></div>
            </div>
            <div class="main_left_news last">
				<? if ($arResult["DREAM_COUNT"] ==0) {?>
					<div class="dream_h">Мечта</div>
					<div class="left_news_content">У Вас ещё нет мечты, скорей добавте её, чтобы о ней узнали все.</div>
					<div class="btn-more">
						<a href="/personal/dream/">Создать мечту</a>
					</div>
				<? } ?>
            </div>
        </div>
		<aside class="right">
            <div class="flip-block pocket">
                <h3>Мой кошелёк</h3>
                <div class="content">
                    <div class="balance"><?=$arResult["MONEY"]?></div>
                    <a class="abutton" href="/personal/add_money.php">Пополнить</a>
                </div>
            </div>
        </aside>
