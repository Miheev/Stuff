<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$site_path=SITE_TEMPLATE_PATH;?>
<?if($page!="/"){?>
                    </div>
                </div>
<?}?>
<div class="footer-container">

<footer class="wrapper footer">
                <div class="row">
                    <div class="left">
                        <section>
							<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/incude/agitation.php",
							"EDIT_TEMPLATE" => ""
						),
					false
				);?> 
                            <ul class="menu">
							
<?$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
	"ROOT_MENU_TYPE" => "bottom_agit",	// Тип меню для первого уровня
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	),
	false
);?>
                            </ul>
                        </section>
                        <section>
                            <h3>&nbsp;</h3>
                            <ul class="menu">							
<?$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
	"ROOT_MENU_TYPE" => "bottom_dream",	// Тип меню для первого уровня
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	),
	false
);?>
                            </ul>
                        </section>
                    </div>
					<div class="right">
                        <div class="left">
						<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/incude/social.php",
							"EDIT_TEMPLATE" => ""
						),
					false
				);?> 
                           
                        </div>
                        <div class="right clearfix">
						
						<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/incude/lang.php",
							"EDIT_TEMPLATE" => ""
						),
					false
				);?> 
				
				
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="left">
                        <section>
                            <ul class="menu last_menu">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer", 
	array(
		"ROOT_MENU_TYPE" => "bottom_about",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		)
	),
	false
);?>                            
                            </ul>
                        </section>      
                    </div>
                </div>
                <div class="copyright clearfix">
                    <div class="left">
                        <ul class="menu">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer", 
	array(
		"ROOT_MENU_TYPE" => "bottom_sodeistvie",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		)
	),
	false
);?>
                        </ul>
                    </div>
                    <div class="right">
                        <div class="footer_copyrite">
						<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/incude/copyright.php",
							"EDIT_TEMPLATE" => ""
						),
					false
				);?> 
                           
                        </div>                    
                    </div>
                </div>
            </footer>
			
			
			
				
        </div>


<!--	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
        <!--<script>window.jQuery || document.write('<script src="<?=$site_path?>/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>-->
		
        <!--<script src="<?=$site_path?>/add/chosen/chosen.jquery.min.js"></script>-->
		
        <script src="<?=$site_path?>/add/bxslider/jquery.bxslider.min.js"></script>
        <script src="<?=$site_path?>/add/scpb/progress-circle.js"></script>
		
		
        <script src="<?=$site_path?>/add/nouislider/jquery.nouislider.min.js"></script>
        <script src="<?=$site_path?>/add/kalypto/js/kalypto.min.js"></script>
		
		    <script src="<?=$site_path?>/js/main.js"></script>
        <script src="<?=$site_path?>/js/pager.js"></script>

    
		
    </body>
</html>