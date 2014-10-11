<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Участники");
?>


<aside class="left">
                <div class="widthfix">&nbsp;</div>				
                <div id="fixblock" class="turboFilterWrap" style="width: 226px;">
				<form action="/member/index.php" class="filterForm" action="GET">
                    <section>
                        <h3>Поиск по людям</h3>
                        <span>Имя</span>
                        <input type="text" placeholder="Введите имя" autocomplete name="name"  value="<?=htmlspecialcharsEx($_GET["name"]);?>"/>
                        <span>Фамилия</span>
                        <input type="text" placeholder="Введите фамилию" autocomplete name="last_name" value="<?=htmlspecialcharsEx($_GET["last_name"]);?>"/>
                        <span>Страна</span>
                        <input type="text" placeholder="Введите страну" autocomplete value="<?=htmlspecialcharsEx($_GET["country"]);?>" name="country" id="country"/>
                        <span>Город</span>
                        <input type="text" placeholder="Введите город" autocomplete value="<?=htmlspecialcharsEx($_GET["city"]);?>" name="city" id="city"/>
                    </section>
                    <section>
                        <h3>Поиск по мечте</h3>
                        <input type="text" placeholder="Введите мечту" autocomplete name="dream_datail" value="<?=htmlspecialcharsEx($_GET["dream_datail"]);?>"/>
                        <span>Процент накопления</span>	
                        <div class="range">
                            <input type="text"  value="<?=htmlspecialcharsEx($_GET["indicator_min"]);?>" class="range-in" name="indicator_min"/>
                            <div class="range-inner">
                                <div>
                                    <div class="range-1"></div>
                                </div>
                            </div>
                            <input type="text" value="<?=htmlspecialcharsEx($_GET["indicator_max"]);?>" class="range-out" name="indicator_max"/>
                        </div>
                        <div class="checkboxes">
                            <span>Статус мечты</span>	
								<?$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>2, "CODE"=>"STATE"));
								while($enum_fields = $property_enums->GetNext())
								{?>
									<input type="radio" value="<?=$enum_fields["ID"];?>" name="dream" <?if($enum_fields["ID"]==$_GET["dream"]){?>checked<?}?> />
									<span> <?=$enum_fields["VALUE"]?></span>
								<?}?>							
                        </div>						
						<input type="hidden" name="SET_FILTER" value="Y">
						<input class="abutton" type="submit" value="Искать">
						<?if($_GET["SET_FILTER"]):?>
							&nbsp;<a class="abutton" href="/member/">Сброс</a>
						<?endif;?>		
                    </section>
				</form>
                </div>
            </aside>
            <div class="center">
                <section class="true-dreams">
                    <header class="clearfix">
                        <ul class="menu clearfix">
                            <li><a class="h3 <?if($_GET["sorting"]=="" || $_GET["sorting"]=="all"){?>active<?}?>" href="/member/?sorting=all">Все</a></li>
                            <li><a class="h3 <?if($_GET["sorting"]=="week"){?>active<?}?>" href="/member/?sorting=week">Новые за неделю</a></li>
                            <li><a class="h3 <?if($_GET["sorting"]=="popular"){?>active<?}?>" href="/member/?sorting=popular">Популярные на <span class="tbd">TurboDreams</span></a></li>
                            <li><a class="h3 <?if($_GET["sorting"]=="voting"){?>active<?}?>" href="/member/?sorting=voting">Голосуют</a></li>
                        </ul>
                    </header>
					
					

<?$APPLICATION->IncludeFile("/member/ajax.php");?>
 </section>
 
 
<?	if($_GET["sorting"]=="popular"){
		$sort="SHOW_COUNTER";
		$ord="desc";
	}		
		
	$arFilter = $GLOBALS["arrFilter"];
	$arFilter["IBLOCK_ID"] = '2';
	$arFilter["ACTIVE"] = 'Y';
	
	$res = CIBlockElement::GetList(Array($sort=>$ord), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$id[]=$arFields["ID"];		
	}
	$cnt=count($id);?> 
 <?if($cnt>20){?>
 
                    <div class="dreams-more ">
                        <a href="#" class="show-more">Показать больше</a>
                    </div>
 <?}?>
  

            </div>
	
<div style="clear:both;"></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>