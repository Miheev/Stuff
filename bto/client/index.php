<?
session_start(); //Minawo //Itou Kanako //claris -irony
header('Content-type: text/html; charset=windows-1251');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');

$DB = new DB;
$DB->init();

$DB->checkValidUser($_SESSION);

if ($_REQUEST["act"] == 'logout'):
	$DB->secureDestroy();
endif;

if ($_REQUEST["page"] == 'settings'):
	if ($_REQUEST["act"] == 'save'):
		$DB->updateClientPass($_REQUEST);
		header ("location: /client/");
	endif;
elseif ($_REQUEST["page"] == 'base'):
	if ($_REQUEST["act"] == 'add' && $_REQUEST["step"] == 3):
		$p = unserialize($_REQUEST["params"]);
		$ea = $DB->addNewTS($p);
	endif;
endif;

$U = $DB->getUserByEmail($_SESSION["appl"]);
if (isset($_GET['find'])) {
    var_dump($_POST['key']);
    $DB->findTSList($U["ID"], $_POST['key']);
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1251">
<title>Панель клиента</title>
<script type="text/javascript" src="/jquery-1.10.2.js"></script>
<script src="/bootstrap-3.1.1-dist/js/bootstrap.js"></script>
<script type="text/javascript" src="/handle-js.js"></script>
<script type="text/JavaScript" src="/jquery.inputmask.js"></script>
<script type="text/JavaScript" src="/jquery.inputmask.date.extensions.js"></script>
<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap-theme.css" />
<link type="text/css" rel="stylesheet" href="/handle-style.css" />

<script type="text/JavaScript">
$(document).ready(function(){
//	function setTODate() {
//		var cat = $("select[name=cat]").val(),
//		    aim = $("select[name=aim]").val(),
//			age = (new Date).getFullYear() - $("input[name=year]").val();
//
//		switch(cat){
//			case 'M2': $("select[name=diag_srok]").val('6m'); console.log("val('6m')"); break;
//			case 'M3': $("select[name=diag_srok]").val('6m'); console.log("val('6m')"); break;
//			case 'N2': $("select[name=diag_srok]").val('12m'); console.log("val('12m')"); break;
//			case 'N3': $("select[name=diag_srok]").val('12m'); console.log("val('12m')"); break;
//			case 'O3': $("select[name=diag_srok]").val('12m'); console.log("val('12m')"); break;
//			case 'O4': $("select[name=diag_srok]").val('12m'); console.log("val('12m')"); break;
//			case 'M1':
//				if(age <= 3) {
//					$("select[name=diag_srok]").val('-');
//					console.log("val('12m')");
//				} else if(age > 3 && age <= 7) {
//					$("select[name=diag_srok]").val('24m');
//
//					var xxx = aim;
//					xxx.setMonth(xxx.getMonth() + 24);
//					console.log(xxx);
//					$("input[name=diag_until]").val(xxx);
//				} else {
//					$("select[name=diag_srok]").val('12m');
//				}
//			break;
//			case 'N1':
//				if(age <= 3) {
//					$("select[name=diag_srok]").val('-');
//					console.log("val('12m')");
//				} else if(age > 3 && age <= 7) {
//					$("select[name=diag_srok]").val('24m');
//				} else {
//					$("select[name=diag_srok]").val('12m');
//				}
//			break;
//			case 'O1':
//				if(age <= 3) {
//					$("select[name=diag_srok]").val('-');
//					console.log("val('12m')");
//				} else if(age > 3 && age <= 7) {
//					$("select[name=diag_srok]").val('24m');
//				} else {
//					$("select[name=diag_srok]").val('12m');
//				}
//			break;
//			case 'O2':
//				if(age <= 3) {
//					$("select[name=diag_srok]").val('-');
//					console.log("val('12m')");
//				} else if(age > 3 && age <= 7) {
//					$("select[name=diag_srok]").val('24m');
//				} else {
//					$("select[name=diag_srok]").val('12m');
//				}
//			break;
//
//		}
//
//
//		console.log(cat);
//
//	}
//
//	setTODate();
//
//	$("select[name=cat], select[name=aim]").change(function(){
//		setTODate();
//	});
//	$("input[name=year]").change(function(){
//		setTODate();
//	});
	
});
</script>
</head>

<body>
<div class="navbar navbar-default" role="navigation">
    <div class="nav-header">
        Вход выполнен как: <?=$DB->formatFIO($U);?>
        [<?=$U["email"]?>]
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li <?=((substr_count($_SERVER['REQUEST_URI'], 'page=base') > 0) ? 'class="active"' : '')?>><a href="/client/?page=base">База ТО</a></li>
            <li><a href="/client/?page=analysis">Отчеты</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li <?=((substr_count($_SERVER['REQUEST_URI'], 'page=settings') > 0) ? 'class="active"' : '')?>><a href="/client/?page=settings">Настройки</a></li>
            <li><a href="/client/?act=logout">Выйти</a></li>
        </ul>
        
    </div>
</div>

<? if ($_REQUEST["page"] == 'settings'): ?>
    <fieldset><legend> Настройки учетной записи </legend>
    <form action="/client/" method="post" >
    <table cellpadding="5" cellspacing="0" border="0">
        <tr class="form-group">
            <td><label for="pass">Текущий пароль:</label></td>
            <td><input type="password" id="pass" name="pass" class="form-control" /></td>
        </tr>
        <tr>
            <td><label for="npass1">Новый пароль:</label></td>
            <td><input type="password" id="npass1" name="npass1" class="form-control" /></td>
        </tr>
        <tr>
            <td><label for="npass2">Подтверждение:</label></td>
            <td><input type="password" id="npass2" name="npass2" class="form-control" /></td>
        </tr>
        <tr>
        	<td colspan="2" align="center">
        		<input type="hidden" name="act" value="save" />
        		<input type="hidden" name="page" value="settings" />
        		<input type="submit" value="Изменить пароль" class="btn btn-default" /></td>
        </tr>
    </table>
    </form>
    </fieldset>
<? elseif ($_REQUEST["page"] == 'base'):?>
	<? if ($_REQUEST["act"] == 'add'): ?>
    	<? if ($_REQUEST["step"] == 1): ?>
        	<fieldset><legend> Добавление ТО: Шаг 1 из 3 </legend>
            	<form action="/client/"  method="post">
            	<style>
	            	#tostepone td {
		            	padding: 15px 20px;
	            	}
            	</style>
				<table cellpadding="5" cellspacing="0" border="0" id="tostepone" style="width:80%;margin:0 auto;margin-bottom:50px;">
                	<tr>
                    	<td colspan="3"><h3>Данные собственника ТС</h3></td>
                    </tr>
                    <tr>
                    	<td width="33.3333%"><label>Фамилия</label><br /><input type="text" name="f" required="required" class="form-control" /></td>
                        <td width="33.3333%"><label>Имя</label><br /><input type="text" name="i" required="required" class="form-control" /></td>
                        <td width="33.3333%"><label>Отчество</label><br /><input type="text" name="o" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>Данные ТС</h3></td>
                    </tr>
                    <tr>
                    	<td><label>Гос. номер</label><br /><input type="text" name="num" required="required" class="form-control" /></td>
                        <td><label>VIN</label><br /><input type="text" name="vin" class="form-control" /></td>
                        <td><label>Марка</label><br /><input type="text" name="mark" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td><label>Модель</label><br /><input type="text" name="model" required="required" class="form-control" /></td>
                        <td><label>Категория</label><br />
                        	<select name="cat" required="required" class="form-control">
                            	<optgroup label="Категория B">
                                	<option value="M1">Легковой</option>
                                    <option value="N1">Грузовой до 3,5т</option>
                                </optgroup>
                                <optgroup label="Категория C">
                                	<option value="N2">Грузовой до 12т</option>
                                    <option value="N3">Грузовой более 12т</option>
                                </optgroup>
                                <optgroup label="Категория D">
                                	<option value="M2">Автобус до 5т</option>
                                    <option value="M3">Автобус более 5т</option>
                                </optgroup>
                                <optgroup label="Категория E">
                                	<option value="O1">Прицеп не более 750кг</option>
                                    <option value="O2">Прицеп не более 3,5т</option>
                                    <option value="O3">Прицеп не более 10т</option>
                                    <option value="O4">Прицеп более 10т</option>
                                </optgroup>
                            </select>
							
                        </td>
                        <td><label>год выпуска</label><br /><input type="text" placeholder="XXXX" name="year" required="required" class="form-control formatter" /></td>
                    </tr>
                    <tr>
                    	<td><label>Шасси/рама</label><br /><input type="text" name="rama" class="form-control" /></td>
                        <td><label>Кузов</label><br /><input type="text" name="kuz" class="form-control" /></td>
                        <td><label>РММ</label><br /><input type="text" name="rmm" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td><label>Тип тормозной системы</label><br />
                        	<select name="breaks" required="required" class="form-control" >
                            	<option value="g">Гидравлический</option>
                                <option value="p">Пневматический</option>
                                <option value="m">Механический</option>
                                <option value="k">Комбинированный</option>
                                <option value="o">Отсутствует</option>
                            </select>
							
                        </td>
                        <td><label>Тип топлива</label><br />
                        	<select name="oil" required="required" class="form-control" >
                            	<option value="b">Бензин</option>
                                <option value="d">Дизельное топливо</option>
                                <option value="s">Сжатый газ</option>
                                <option value="g">Сжиженый газ</option>
                                <option value="o">Без топлива</option>
                            </select>
							
                        </td>
                        <td><label>МБН</label><br /><input type="text" name="mbn" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td><label>Марка шин</label><br /><input type="text" name="tyres" required="required" class="form-control" /></td>
                        <td><label>Назначение АМ</label><br />
                        	<select name="aim" required="required" class="form-control">
                            	<option value="l">Личный автомобиль</option>
                                <option value="t">Такси</option>
                                <option value="u">Учебный автомобиль</option>
                                <option value="o">Опасный груз</option>
                                <option value="s">Спецтранспорт</option>
                            </select>
							
                        </td>
                        <td><label>Пробег</label><br /><input type="text" name="run" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><label>Примечание</label><br /><textarea class="form-control" style="width:100%" rows="4" name="addon"></textarea></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>Данные о регистрации ТС</h3></td>
                    </tr>
                    <tr>
                    	<td valign="top"><label>Регистрационный документ</label><br /><br />
                        	<select name="doc" required="required" class="form-control">
                            	<option value="pts">ПТС</option>
                                <option value="srts">СРТС</option>
                            </select>
							
						</td>
                        <td colspan="2">
                        	<table border=0 style="width:100%;">
                            	<tr>
                                	<td><label>Серия</label><br /><input type="text" name="dser" required="required" class="form-control" /></td>
                                    <td><label>Номер</label><br /><input type="text" name="dnum"  required="required" class="form-control" /></td>
                                    <td><label>Дата</label><br /><input type="text" name="ddate"  required="required" class="form-control" /></td>
                                </tr>
                                <tr>
                                	<td colspan="3"><label>Кем выдан</label><br /><input type="text" name="bywho" required="required" class="form-control" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>Диагностика</h3></td>
                    </tr>
                    <tr>
                    	<td><label>Дата</label><br /><input type="text" name="diagdate" value="<?=date("d.m.Y")?>" disabled="disabled" class="form-control" /></td>
                        <td><label>Срок действия</label><br />
                        	<select name="diag_srok" class="form-control" disabled="disabled">
	                        	<option value="6m">&lt;6 месяцев</option>
                                <option value="12m">12 месяцев</option>
                                <option value="24m">24 месяца</option>
                            </select>
							
                        </td>
                        <td><label>Действительна до</label><br /><input type="text" name="diag_until" class="form-control" disabled="disabled" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><label>Стоимость процедуры</label><br /><input type="text" name="diag_cost" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3" align="center">
                    		<input type="hidden" name="page" value="base" />
                    		<input type="hidden" name="act" value="add" />
                    		<input type="hidden" name="step" value="2" />
                    		<input type="submit" value="Далее" class="btn btn-default" />
                    	</td>
                    </tr>
                </table>
                </form>
            </fieldset>
            <style>
                input.invalid {
                    border-color: #E9322D !important;
                    -webkit-box-shadow: 0 0 6px #F8B9B7 !important;
                    -moz-box-shadow: 0 0 6px #f8b9b7 !important;
                    box-shadow: 0 0 6px #F8B9B7 !important;
                    color: #B94A48 !important;
                }
            </style>
            <script type="text/javascript" src="/jquery.formatter.min.js"></script>
            <script type="text/JavaScript">
                $(document).ready(function(){
                    $('input[type="text"]').not('.formatter').on('input', function() {
                        if ($(this).val().length < 5) {
                            if (!$(this).hasClass('invalid'))
                                $(this).addClass('invalid');
                        } else
                        if ($(this).hasClass('invalid'))
                            $(this).removeClass('invalid');
                    });

                    $('input[type="submit"]').attr('disabled', 'disabled');
                    setTimeout(function tmr() {
                        tmp= false;
                        $('input[type="text"]').not('.formatter').each(function(){
                            if ($(this).hasClass('invalid')) {
                                tmp= true;
                                $('input[type="submit"]').attr('disabled', 'disabled');
                                return;
                            }
                        });
                        if (tmp) setTimeout(tmr, 3000);
                        else $('input[type="submit"]').removeAttr('disabled');
                    }, 5000);

                    cat= {
                        c1: ['M1', 'N1', '01', '02'],
                        c2: ['N2', 'N3', '03', '04'],
                        c3: ['M2', 'M3']
                    }

                    curdate= new Date();
                    curyear= curdate.getUTCFullYear();
                    tmp= $('input[name="diagdate"]').val().split('.');
                    startdate = new Date(parseInt(tmp[2]), parseInt(tmp[1]), parseInt(tmp[0]));
                    deltayear= 0;
                    enddate= 0;

                    $('select[name="diag_srok"]').prepend('<option value="0m" selected="selected">Не требуется</option>');

                    setTimeout(function tmr2(){
                        year= parseInt($('input[name="year"]').val());
                        if (!isNaN(year)) {
                            d= curyear-year;
                            row= $('select[name="cat"]').val();

                            tmp= 0;
                            if (cat.c1.indexOf(row) != -1)
                                tmp= 1;
                            else if (cat.c2.indexOf(row) != -1)
                                tmp= 2;
                            else if (cat.c3.indexOf(row) != -1)
                                tmp= 3;

                            switch (tmp) {
                                case 1:
                                    if (d < 3) deltayear= 'не требуется';
                                    else if (d < 8) deltayear= 24;
                                    else if (d > 7) deltayear= 12;
                                    break;
                                case 2: deltayear= 12; break;
                                case 3: deltayear= 6; break;
                            }
                            if (!isNaN(deltayear)) {
                                enddate = new Date(new Date(startdate).setMonth(startdate.getMonth()+deltayear));
                                $('select[name="diag_srok"] option').eq(0).text(deltayear);
                                $('input[name="diag_until"]').val(enddate.getUTCDate() +'.'+ enddate.getUTCMonth() +'.'+enddate.getUTCFullYear());
                            } else {
                                $('select[name="diag_srok"] option').eq(0).text(deltayear);
                                $('input[name="diag_until"]').val('');
                            }
                        }
                        console.log(deltayear);
                        console.log(enddate);
                        setTimeout(tmr2, 3000);
                    }, 5000);

                });
            </script>
        <? elseif ($_REQUEST["step"] == 2): unset($_REQUEST["step"]); $p = serialize($_REQUEST); ?>
        	<fieldset><legend> Добавление ТО: Шаг 2 из 3 </legend>
            	<form action="/client/"  method="post">
                	<table cellpadding="5" cellspacing="0" border="0">
                    	<tr>
                        	<td>Код ЕАИСТО: </td>
                            <td><input type="text" name="eaisto" value="" id="eaisto" disabled="disabled" /></td>
                        </tr>
                        <tr>
                        	<td colspan="2" align="center"><input type="hidden" name="page" value="base" /><input type="hidden" name="act" value="add" /><input type="hidden" name="step" value="3" /><input type="hidden" name="params" value='<?=$p?>' /><input type="submit" value="Присвоить" /></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        <? elseif ($_REQUEST["step"] == 3): unset($_REQUEST["step"]); $p = serialize($_REQUEST);?>
        	<fieldset><legend> Добавление ТО: Шаг 3 из 3 </legend>
            	<h4>Информация добавлена.</h4>
                <h4>Присвоенный код: <?=$ea?></h4>
                <a href="/print/?id=<?=$ea?>" target="_blank">Распечатать карточку ТС</a><br />
				<a href="/client/?page=base">Вернуться с списку авто</a>				
            </fieldset>
        <? endif; ?>
    <? elseif ($_REQUEST["act"] == 'add_tch'): ?>
        <fieldset><legend> Добавление ТЧ</legend>
            <form action="/print/tch.php"  method="post">
                <table cellpadding="5" cellspacing="0" border="0">
                    <tr>
                        <td>ФИО: </td>
                        <td><input type="text" name="fio" value="<?php echo $U["f"].' '.$U["i"].' '.$U["o"]; ?>" id="fio" /></td>
                    </tr>
                    <tr>
                        <td>Ваш адрес: </td>
                        <td><input type="text" name="address" value="" id="address" placeholder="г. ВЛАДИВОСТОК, ул. ВОСТРЕЦОВА, д. 6В, кв.90"/></td>
                    </tr>
                    <tr>
                        <td>Код ЕАИСТО вашего заказа: </td>
                        <td><input type="text" name="tch_eaisto" value="" id="tch_eaisto" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Далее" /></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    <? else: ?>
	
    <fieldset style="width:80%;margin:0 auto;display:block;" class="form-inline"><legend> Действия </legend>
    <div class="row">
    	<div class="col-md-6 text-center">
    		<a class="btn btn-default"  href="/client/?page=base&act=add&step=1">Добавить ТО</a>
    	</div>
    	<div class="col-md-6 text-center">
			Поиск ТО: <input type="text" class="form-control" /> <input type="submit" value="поиск" class="form-control btn btn-default find-btn" />
    	</div>
    </div>
    </fieldset><br />
    <div style="width:80%;margin:0 auto;">
        </fieldset><br />
        <script type="text/javascript">
            $('.find-btn').click(function(){
                $.post('/client/index.php?find', {key: $('.find-key').val()}, function(data, status){
                    console.log(status);
                    if (status == 'success') {
                        $('.ts-list+table').remove();
                        $('.ts-list').after(data);

                        console.log(data);
                    } else
                        console.log('Find Post: Server Error');
                });
            });
        </script>
    <legend class="ts-list">Список ТО:</legend>
    <? $DB->getTSList($U["ID"]) ?>
	<? endif; ?>
	
	
	
	
	<? elseif ($_REQUEST["page"] == 'analysis'): ?>
	
	<script>
		$(document).ready(function(){
			$('input.date').inputmask();
			
			var fullsum = 0;
			$(".table-analysis .cost").each(function(){
				cost = parseInt($(this).text());
				if($.isNumeric( cost )) {
					fullsum = fullsum + cost;
				}
				$(".table-analysis .fullsum").text(fullsum + " P.");
			});
		});
	</script>
	<fieldset style="width:80%; margin: 0 auto;">
		<legend>Отчеты:</legend>
		<form action="/client/?page=analysis" class="form-inline" method="post">
		<table class="table table-striped" >
			<tr>
				<td width="25%">Категория:<br/>
					<select name="cat" class="form-control">
							<option value="0">Все</option>
                    	<optgroup label="Категория B">
                        	<option value="M1">Легковой</option>
							<option value="N1">Грузовой до 3,5т</option>
                        </optgroup>
                        <optgroup label="Категория C">
                        	<option value="N2">Грузовой до 12т</option>
                            <option value="N3">Грузовой более 12т</option>
                        </optgroup>
                        <optgroup label="Категория D">
                        	<option value="M2">Автобус до 5т</option>
                            <option value="M3">Автобус более 5т</option>
                        </optgroup>
                        <optgroup label="Категория E">
                        	<option value="O1">Прицеп не более 750кг</option>
                            <option value="O2">Прицеп не более 3,5т</option>
                            <option value="O3">Прицеп не более 10т</option>
                            <option value="O4">Прицеп более 10т</option>
                        </optgroup>
					</select>
				</td>
				<td>Период:<br/>
					<div>
						<input class="date form-control" placeholder="C" type="text" name="fromdate" value="<?=$_REQUEST['fromdate']?>" data-inputmask="'alias': 'dd.mm.yyyy'"> - <input placeholder="По" class="date form-control" type="text" name="todate" value="<?=$_REQUEST['todate']?>" data-inputmask="'alias': 'dd.mm.yyyy'">
					</div>
				</td>
				<td align="center" style="vertical-align:middle;">
					<input type="submit" value="Сформировать" name="filter" class="btn btn-default" />
				</td>
			</tr>
		</table>
		</form>
	</fieldset>
    </div>
    
	<div style="width:80%; margin: 0 auto;">
		<? $DB->getClientAnalysis($_REQUEST,$_SESSION); ?>
	</div>
	
<? endif; ?>

</body>
</html>