<?
session_start(); ////Minawo ////Itou Kanako //claris -irony ////Tsukishima Kirati -- Babalaika ///Sound Horizon ##symphonic metal
header('Content-type: text/html; charset=utf-8');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');

$DB = new DB;
$DB->init();

$DB->checkValidUser($_SESSION);

$U = $DB->getUserByEmail($_SESSION["appl"]);
if (isset($_GET['find'])) {
    $DB->findTSList($U["ID"], $_POST['key']);
    die();
}

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
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
        		<input type="submit" value="�?зменить пароль" class="btn btn-default" /></td>
        </tr>
    </table>
    </form>
    </fieldset>
<? elseif ($_REQUEST["page"] == 'base'):?>
	<? if ($_REQUEST["act"] == 'add'): ?>
    	<? if ($_REQUEST["step"] == 1): ?>
        	<fieldset><legend> Добавление ТО: Шаг 1 из 3 </legend>
                <ul style="list-style: none;">
                    <li><span style="color: red;"> * </span> Обязательные для заполнения поля</li>
                    <li><span style="color: blue;"> * </span> Группа полей. Можно заполнить только одно</li>
                </ul>
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
                        <td width="33.3333%"><label>�?мя</label><br /><input type="text" name="i" required="required" class="form-control" /></td>
                        <td width="33.3333%"><label>Отчество</label><br /><input type="text" name="o" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>Данные ТС</h3></td>
                    </tr>
                    <tr>
                    	<td><label>Гос. номер</label><br /><input type="text" name="num" required="required" class="form-control" /></td>
                        <td><label>VIN</label><br /><input type="text" name="vin" class="form-control" required="required" /></td>
                        <td><label>Марка</label><br /><input type="text" name="mark" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td><label>Модель</label><br /><input type="text" name="model" required="required" class="form-control" /></td>
                        <td><label>Категория</label><br />
                        	<select name="cat" required="required" class="form-control">
                            	<optgroup label="Категория B">
                                	<option value="M1">Легковой M1</option>
                                    <option value="N1">Грузовой до 3,5т N1</option>
                                </optgroup>
                                <optgroup label="Категория C">
                                	<option value="N2">Грузовой до 12т N2</option>
                                    <option value="N3">Грузовой более 12т N3</option>
                                </optgroup>
                                <optgroup label="Категория D">
                                	<option value="M2">Автобус до 5т M2</option>
                                    <option value="M3">Автобус более 5т M3</option>
                                </optgroup>
                                <optgroup label="Категория E">
                                	<option value="O1">Прицеп не более 750кг O1</option>
                                    <option value="O2">Прицеп не более 3,5т O2</option>
                                    <option value="O3">Прицеп не более 10т O3</option>
                                    <option value="O4">Прицеп более 10т O4</option>
                                </optgroup>
                            </select>
							
                        </td>
                        <td><label>год выпуска</label><br /><input type="text" placeholder="XXXX" name="year" required="required" class="form-control formatter" /></td>
                    </tr>
                    <tr>
                    	<td><label>Шасси/рама <span> * </span></label><br /><input type="text" name="rama" class="form-control" /></td>
                        <td><label>Кузов <span> * </span></label><br /><input type="text" name="kuz" class="form-control" /></td>
                        <td><label>Разрешённая максимальная масса (PMM)</label><br /><input type="text" name="rmm" required="required" class="form-control formatter" /></td>
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
                        <td><label>Масса без нагрузки (МБН)</label><br /><input type="text" name="mbn" required="required" class="form-control formatter" /></td>
                    </tr>
                    <tr>
                    	<td><label>Марка шин</label><br />
                            <select name="tyres" required="required" class="form-control" >
                                <option value="Achilles Tyres">Achilles Tyres</option>
                                <option value="AEOLUS">AEOLUS</option>
                                <option value="Amtel">Amtel</option>
                                <option value="Barum">Barum</option>
                                <option value="BF Goodrich">BF Goodrich</option>
                                <option value="Bridgestone">Bridgestone</option>
                                <option value="Continental">Continental</option>
                                <option value="COOPER">COOPER</option>
                                <option value="Cordiant">Cordiant</option>
                                <option value="Dunlop">Dunlop</option>
                                <option value="Eurotire">Eurotire</option>
                                <option value="Federal">Federal</option>
                                <option value="Firestone">Firestone</option>
                                <option value="Fulda">Fulda</option>
                                <option value="Gislaved">Gislaved</option>
                                <option value="GITI TIRE">GITI TIRE</option>
                                <option value="Goodrich">Goodrich</option>
                                <option value="Goodyear">Goodyear</option>
                                <option value="GT RADIAL">GT RADIAL</option>
                                <option value="Hankook">Hankook</option>
                                <option value="Jinyu">Jinyu</option>
                                <option value="JKtyre">JKtyre</option>
                                <option value="Kelly">Kelly</option>
                                <option value="Kleber">Kleber</option>
                                <option value="Kormoran">Kormoran</option>
                                <option value="Kumho">Kumho</option>
                                <option value="MARSHAL">MARSHAL</option>
                                <option value="MATADOR">MATADOR</option>
                                <option value="Maxxis">Maxxis</option>
                                <option value="MENTOR">MENTOR</option>
                                <option value="Metzeler">Metzeler</option>
                                <option value="Michelin">Michelin</option>
                                <option value="Nankang">Nankang</option>
                                <option value="NEXEN">NEXEN</option>
                                <option value="Nokian">Nokian</option>
                                <option value="Ovation">Ovation</option>
                                <option value="Pirelli">Pirelli</option>
                                <option value="Premiorri">Premiorri</option>
                                <option value="Riken">Riken</option>
                                <option value="Sava">Sava</option>
                                <option value="STARCO">STARCO</option>
                                <option value="Taurus">Taurus</option>
                                <option value="Tigar">Tigar</option>
                                <option value="TM AGROPOWER">TM AGROPOWER</option>
                                <option value="TM DNEPROSHINA">TM DNEPROSHINA</option>
                                <option value="Toyo Tire">Toyo Tire</option>
                                <option value="Trayal">Trayal</option>
                                <option value="TRIANGLE GROUP">TRIANGLE GROUP</option>
                                <option value="Tunga">Tunga</option>
                                <option value="Uniroyal">Uniroyal</option>
                                <option value="Yokohama">Yokohama</option>
                                <option value="Волтайр">Волтайр</option>
                                <option value="Нижнекамскшина">Нижнекамскшина</option>
                            </select>
                        </td>
                        <td><label>Назначение АМ</label><br />
                        	<select name="aim" required="required" class="form-control">
                            	<option value="l">Личный автомобиль</option>
                                <option value="t">Такси</option>
                                <option value="u">Учебный автомобиль</option>
                                <option value="o">Опасный груз</option>
                                <option value="s">Спецтранспорт</option>
                            </select>
							
                        </td>
                        <td><label>Пробег</label><br /><input type="text" name="run" class="form-control" required="required"/></td>
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
                                	<td><label>Серия</label><br /><input type="text" name="dser" required="required" class="form-control formatter" /></td>
                                    <td><label>Номер</label><br /><input type="text" name="dnum"  required="required" class="form-control formatter" /></td>
                                    <td><label>Дата</label><br /><input type="text" name="ddate"  required="required" class="form-control formatter" /></td>
                                </tr>
                                <tr>
                                	<td colspan="3"><label>Кем выдан</label><br /><input type="text" name="bywho" required="required" class="form-control formatter" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>Диагностика</h3></td>
                    </tr>
                    <tr>
                    	<td><label>Дата</label><br /><input type="text" name="diagdate" value="<?=date("d.m.Y")?>" readonly="readonly" class="form-control" /></td>
                        <td><label>Срок действия</label><br />
                            <input type="text" name="diag_srok" class="form-control nocheck" readonly="readonly" value=""/>
<!--                        	<select name="diag_srok" class="form-control" disabled="disabled">-->
<!--                                <option value="0m">Не требуется</option>-->
<!--	                        	<option value="6m">&lt;6 месяцев</option>-->
<!--                                <option value="12m">12 месяцев</option>-->
<!--                                <option value="24m">24 месяца</option>-->
<!--                            </select>-->
							
                        </td>
                        <td><label>Действительна до</label><br /><input type="text" name="diag_until" class="form-control nocheck" readonly="readonly" value=""/></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><label>Стоимость процедуры</label><br /><input type="text" name="diag_cost" required="required" class="form-control" /></td>
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
            <div id="empty-alert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="empty-alert-title" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="empty-alert-title">Вы заполнили не все поля!</h3>
                        </div>
                        <div class="modal-body">
                            <p>Пожалуйста, заполните все обязательные поля! </p>
                            <p>Вы можете указать только одно из следующих полей: VIN, рама/шасси или кузов</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
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
                    $('body').animate({scrollTop: $('.navbar.navbar-default').position().top},1000);

                    $('input[type="text"]').each(function(){
                        if ($(this).attr('required')) {
                            label= $(this).parent().find('label');
                            text= label.text().trim();
                            label.empty();
                            label.append(text+ '<span> * </span>');
                            label.find('span').css('color', 'red');
                        }
                    });
                    $('input[name="vin"], input[name="rama"], input[name="kuz"]').parent().find('label>span').css('color', 'blue');

                    $('input[type="text"]').not('.formatter').on('input', function() {
                        if ($(this).val().length < 3) {
                            if (!$(this).hasClass('invalid'))
                                $(this).addClass('invalid');
                        } else
                        if ($(this).hasClass('invalid'))
                            $(this).removeClass('invalid');

                        if ($(this).attr('name') == 'vin' || $(this).attr('name') == 'rama' || $(this).attr('name') == 'kuz')
                            if ($('input[name="vin"]').val().length > 3 || $('input[name="rama"]').val().length > 3 || $('input[name="kuz"]').val().length > 3) {
                                $('input[name="vin"], input[name="rama"], input[name="kuz"]').removeClass('invalid');
                                $('input[name="vin"]').removeAttr('required');
                            } else
                                $('input[name="vin"]').attr('required', 'required');

                    });

                    $('input[name="dser"]').on('input', function(){
                            tmp= $(this).val().replace(/[\sA-Z-a-z]/g, '');
                            $(this).val(tmp.substr(0,4));
                    });
                    $('input[name="bywho"]').on('input', function(){
                        tmp= $(this).val().replace(/[A-Z-a-z]/g, '');
                        $(this).val(tmp);
                    });
                    $('input[name="dnum"]').on('input', function(){
                            tmp= $(this).val().replace(/[\D]/g, '');
                            $(this).val(tmp.substr(0,4));
                    });
                    $('input[name="rmm"]').on('input', function(){
                        tmp= $(this).val().replace(/[\D]/g, '');
                        //$(this).val( (tmp.substr(0,4) > 1000)? 1000: tmp.substr(0,4));
                        $(this).val(tmp.substr(0,5));
                    });
                    $('input[name="mbn"]').on('input', function(){
                        tmp= $(this).val().replace(/[\D]/g, '');
                        //$(this).val( (tmp.substr(0,5) > 2500)? 2500: tmp.substr(0,5));
                        $(this).val( tmp.substr(0,5));
                    });
                    $('input[name="year"]').on('input', function(){
                        tmp= $(this).val().replace(/[\D]/g, '');
                        tmp= tmp.substr(0,4);
                        if (tmp > curyear)
                            $(this).val(curyear);
                        else
                            $(this).val(tmp);
                    })
                        .change(function(){
                        if ($(this).val().length < 4) $(this).val('');
                        alert('Пожалуйста укажите полный год');
                    });

                    $('input[name="ddate"]').formatter({
                        'pattern': '{{99}}.{{99}}.{{9999}}',
                        'persistent': false
                    });
//                    $('input[name="ddate"]').change(function(e){
//                        e.preventDefault();
//                        e.stopPropogation();

                            if ($(this).val().length < 5) $(this).val('');
                            alert('Пожалуйста укажите полную дату');
                        });

                    $('input[type="submit"]').attr('disabled', 'disabled');
                    cobj= $('input[type="text"]').not('.formatter').not('.nocheck');
                    cobj.change(function () {
                        console.log(88888);
                        tmp= false;
                        cobj.each(function(){
                            if ($(this).hasClass('invalid')) {
                                tmp= true;
                                if ($('input[type="submit"]').attr('disabled') != 'disabled')
                                    $('input[type="submit"]').attr('disabled', 'disabled');
                                return;
                            }
                        });
                        console.log(tmp);
                        if (!tmp) $('input[type="submit"]').removeAttr('disabled');
                    });

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
                                $('input[name="diag_srok"]').val(deltayear+'m');

                                dd= enddate.getUTCDate() + '';
                                mm= enddate.getUTCMonth() + '';
                                $('input[name="diag_until"]').val(
                                    ( (dd.length > 1)? dd : '0'+dd )+'.'+
                                    ( (mm.length > 1)? mm : '0'+mm )+'.'+
                                        enddate.getUTCFullYear());
                            } else {
                                $('input[name="diag_srok"]').val('0m');
                                $('input[name="diag_until"]').val('');
                            }
                        }
//                        console.log(deltayear);
//                        console.log(enddate);
                        setTimeout(tmr2, 3000);
                    }, 5000);

                });
            </script>
        <? elseif ($_REQUEST["step"] == 2): unset($_REQUEST["step"]); $p = serialize($_REQUEST); ?>
        	<fieldset><legend> Добавление ТО: Шаг 2 из 3 </legend>
            	<form action="/client/"  method="post">
                	<table cellpadding="5" cellspacing="0" border="0">
                    	<tr>
                        	<td>Код ЕА�?СТО: </td>
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
            	<h4>�?нформация добавлена.</h4>
                <h4>Присвоенный код: <?=$ea?></h4>
                <a href="/print/?id=<?=$ea?>" target="_blank">Распечатать карту ТС</a><br />
				<a href="/client/?page=base">Вернуться с списку авто</a>				
            </fieldset>
        <? endif; ?>
    <? elseif ($_REQUEST["act"] == 'add_tch'): ?>
        <fieldset><legend> Добавление ТЧ</legend>
            <form action="/print/tch.php"  method="post">
                <table cellpadding="5" cellspacing="0" border="0">
                    <tr>
                        <td>Ф�?О: </td>
                        <td><input type="text" name="fio" value="<?php echo $U["f"].' '.$U["i"].' '.$U["o"]; ?>" id="fio" /></td>
                    </tr>
                    <tr>
                        <td>Ваш адрес: </td>
                        <td><input type="text" name="address" value="" id="address" placeholder="г. ВЛАД�?ВОСТОК, ул. ВОСТРЕЦОВА, д. 6В, кв.90"/></td>
                    </tr>
                    <tr>
                        <td>Код ЕА�?СТО вашего заказа: </td>
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
			Поиск ТО: <input type="text" class="form-control find-key" /> <input type="submit" value="поиск" class="form-control btn btn-default find-btn" />
    	</div>
    </div>
    </fieldset><br />
    <div style="width:80%;margin:0 auto;">
        </fieldset><br />
        <script type="text/javascript">
            $(document).ready(function(){
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