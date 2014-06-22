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
<title>������ �������</title>
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
        ���� �������� ���: <?=$DB->formatFIO($U);?>
        [<?=$U["email"]?>]
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li <?=((substr_count($_SERVER['REQUEST_URI'], 'page=base') > 0) ? 'class="active"' : '')?>><a href="/client/?page=base">���� ��</a></li>
            <li><a href="/client/?page=analysis">������</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li <?=((substr_count($_SERVER['REQUEST_URI'], 'page=settings') > 0) ? 'class="active"' : '')?>><a href="/client/?page=settings">���������</a></li>
            <li><a href="/client/?act=logout">�����</a></li>
        </ul>
        
    </div>
</div>

<? if ($_REQUEST["page"] == 'settings'): ?>
    <fieldset><legend> ��������� ������� ������ </legend>
    <form action="/client/" method="post" >
    <table cellpadding="5" cellspacing="0" border="0">
        <tr class="form-group">
            <td><label for="pass">������� ������:</label></td>
            <td><input type="password" id="pass" name="pass" class="form-control" /></td>
        </tr>
        <tr>
            <td><label for="npass1">����� ������:</label></td>
            <td><input type="password" id="npass1" name="npass1" class="form-control" /></td>
        </tr>
        <tr>
            <td><label for="npass2">�������������:</label></td>
            <td><input type="password" id="npass2" name="npass2" class="form-control" /></td>
        </tr>
        <tr>
        	<td colspan="2" align="center">
        		<input type="hidden" name="act" value="save" />
        		<input type="hidden" name="page" value="settings" />
        		<input type="submit" value="�������� ������" class="btn btn-default" /></td>
        </tr>
    </table>
    </form>
    </fieldset>
<? elseif ($_REQUEST["page"] == 'base'):?>
	<? if ($_REQUEST["act"] == 'add'): ?>
    	<? if ($_REQUEST["step"] == 1): ?>
        	<fieldset><legend> ���������� ��: ��� 1 �� 3 </legend>
            	<form action="/client/"  method="post">
            	<style>
	            	#tostepone td {
		            	padding: 15px 20px;
	            	}
            	</style>
				<table cellpadding="5" cellspacing="0" border="0" id="tostepone" style="width:80%;margin:0 auto;margin-bottom:50px;">
                	<tr>
                    	<td colspan="3"><h3>������ ������������ ��</h3></td>
                    </tr>
                    <tr>
                    	<td width="33.3333%"><label>�������</label><br /><input type="text" name="f" required="required" class="form-control" /></td>
                        <td width="33.3333%"><label>���</label><br /><input type="text" name="i" required="required" class="form-control" /></td>
                        <td width="33.3333%"><label>��������</label><br /><input type="text" name="o" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>������ ��</h3></td>
                    </tr>
                    <tr>
                    	<td><label>���. �����</label><br /><input type="text" name="num" required="required" class="form-control" /></td>
                        <td><label>VIN</label><br /><input type="text" name="vin" class="form-control" /></td>
                        <td><label>�����</label><br /><input type="text" name="mark" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td><label>������</label><br /><input type="text" name="model" required="required" class="form-control" /></td>
                        <td><label>���������</label><br />
                        	<select name="cat" required="required" class="form-control">
                            	<optgroup label="��������� B">
                                	<option value="M1">��������</option>
                                    <option value="N1">�������� �� 3,5�</option>
                                </optgroup>
                                <optgroup label="��������� C">
                                	<option value="N2">�������� �� 12�</option>
                                    <option value="N3">�������� ����� 12�</option>
                                </optgroup>
                                <optgroup label="��������� D">
                                	<option value="M2">������� �� 5�</option>
                                    <option value="M3">������� ����� 5�</option>
                                </optgroup>
                                <optgroup label="��������� E">
                                	<option value="O1">������ �� ����� 750��</option>
                                    <option value="O2">������ �� ����� 3,5�</option>
                                    <option value="O3">������ �� ����� 10�</option>
                                    <option value="O4">������ ����� 10�</option>
                                </optgroup>
                            </select>
							
                        </td>
                        <td><label>��� �������</label><br /><input type="text" placeholder="XXXX" name="year" required="required" class="form-control formatter" /></td>
                    </tr>
                    <tr>
                    	<td><label>�����/����</label><br /><input type="text" name="rama" class="form-control" /></td>
                        <td><label>�����</label><br /><input type="text" name="kuz" class="form-control" /></td>
                        <td><label>���</label><br /><input type="text" name="rmm" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td><label>��� ��������� �������</label><br />
                        	<select name="breaks" required="required" class="form-control" >
                            	<option value="g">��������������</option>
                                <option value="p">��������������</option>
                                <option value="m">������������</option>
                                <option value="k">���������������</option>
                                <option value="o">�����������</option>
                            </select>
							
                        </td>
                        <td><label>��� �������</label><br />
                        	<select name="oil" required="required" class="form-control" >
                            	<option value="b">������</option>
                                <option value="d">��������� �������</option>
                                <option value="s">������ ���</option>
                                <option value="g">�������� ���</option>
                                <option value="o">��� �������</option>
                            </select>
							
                        </td>
                        <td><label>���</label><br /><input type="text" name="mbn" required="required" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td><label>����� ���</label><br /><input type="text" name="tyres" required="required" class="form-control" /></td>
                        <td><label>���������� ��</label><br />
                        	<select name="aim" required="required" class="form-control">
                            	<option value="l">������ ����������</option>
                                <option value="t">�����</option>
                                <option value="u">������� ����������</option>
                                <option value="o">������� ����</option>
                                <option value="s">�������������</option>
                            </select>
							
                        </td>
                        <td><label>������</label><br /><input type="text" name="run" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><label>����������</label><br /><textarea class="form-control" style="width:100%" rows="4" name="addon"></textarea></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>������ � ����������� ��</h3></td>
                    </tr>
                    <tr>
                    	<td valign="top"><label>��������������� ��������</label><br /><br />
                        	<select name="doc" required="required" class="form-control">
                            	<option value="pts">���</option>
                                <option value="srts">����</option>
                            </select>
							
						</td>
                        <td colspan="2">
                        	<table border=0 style="width:100%;">
                            	<tr>
                                	<td><label>�����</label><br /><input type="text" name="dser" required="required" class="form-control" /></td>
                                    <td><label>�����</label><br /><input type="text" name="dnum"  required="required" class="form-control" /></td>
                                    <td><label>����</label><br /><input type="text" name="ddate"  required="required" class="form-control" /></td>
                                </tr>
                                <tr>
                                	<td colspan="3"><label>��� �����</label><br /><input type="text" name="bywho" required="required" class="form-control" /></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="3"><h3>�����������</h3></td>
                    </tr>
                    <tr>
                    	<td><label>����</label><br /><input type="text" name="diagdate" value="<?=date("d.m.Y")?>" disabled="disabled" class="form-control" /></td>
                        <td><label>���� ��������</label><br />
                        	<select name="diag_srok" class="form-control" disabled="disabled">
	                        	<option value="6m">&lt;6 �������</option>
                                <option value="12m">12 �������</option>
                                <option value="24m">24 ������</option>
                            </select>
							
                        </td>
                        <td><label>������������� ��</label><br /><input type="text" name="diag_until" class="form-control" disabled="disabled" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3"><label>��������� ���������</label><br /><input type="text" name="diag_cost" class="form-control" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3" align="center">
                    		<input type="hidden" name="page" value="base" />
                    		<input type="hidden" name="act" value="add" />
                    		<input type="hidden" name="step" value="2" />
                    		<input type="submit" value="�����" class="btn btn-default" />
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

                    $('select[name="diag_srok"]').prepend('<option value="0m" selected="selected">�� ���������</option>');

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
                                    if (d < 3) deltayear= '�� ���������';
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
        	<fieldset><legend> ���������� ��: ��� 2 �� 3 </legend>
            	<form action="/client/"  method="post">
                	<table cellpadding="5" cellspacing="0" border="0">
                    	<tr>
                        	<td>��� ������: </td>
                            <td><input type="text" name="eaisto" value="" id="eaisto" disabled="disabled" /></td>
                        </tr>
                        <tr>
                        	<td colspan="2" align="center"><input type="hidden" name="page" value="base" /><input type="hidden" name="act" value="add" /><input type="hidden" name="step" value="3" /><input type="hidden" name="params" value='<?=$p?>' /><input type="submit" value="���������" /></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        <? elseif ($_REQUEST["step"] == 3): unset($_REQUEST["step"]); $p = serialize($_REQUEST);?>
        	<fieldset><legend> ���������� ��: ��� 3 �� 3 </legend>
            	<h4>���������� ���������.</h4>
                <h4>����������� ���: <?=$ea?></h4>
                <a href="/print/?id=<?=$ea?>" target="_blank">����������� �������� ��</a><br />
				<a href="/client/?page=base">��������� � ������ ����</a>				
            </fieldset>
        <? endif; ?>
    <? elseif ($_REQUEST["act"] == 'add_tch'): ?>
        <fieldset><legend> ���������� ��</legend>
            <form action="/print/tch.php"  method="post">
                <table cellpadding="5" cellspacing="0" border="0">
                    <tr>
                        <td>���: </td>
                        <td><input type="text" name="fio" value="<?php echo $U["f"].' '.$U["i"].' '.$U["o"]; ?>" id="fio" /></td>
                    </tr>
                    <tr>
                        <td>��� �����: </td>
                        <td><input type="text" name="address" value="" id="address" placeholder="�. �����������, ��. ����������, �. 6�, ��.90"/></td>
                    </tr>
                    <tr>
                        <td>��� ������ ������ ������: </td>
                        <td><input type="text" name="tch_eaisto" value="" id="tch_eaisto" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="�����" /></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    <? else: ?>
	
    <fieldset style="width:80%;margin:0 auto;display:block;" class="form-inline"><legend> �������� </legend>
    <div class="row">
    	<div class="col-md-6 text-center">
    		<a class="btn btn-default"  href="/client/?page=base&act=add&step=1">�������� ��</a>
    	</div>
    	<div class="col-md-6 text-center">
			����� ��: <input type="text" class="form-control" /> <input type="submit" value="�����" class="form-control btn btn-default find-btn" />
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
    <legend class="ts-list">������ ��:</legend>
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
		<legend>������:</legend>
		<form action="/client/?page=analysis" class="form-inline" method="post">
		<table class="table table-striped" >
			<tr>
				<td width="25%">���������:<br/>
					<select name="cat" class="form-control">
							<option value="0">���</option>
                    	<optgroup label="��������� B">
                        	<option value="M1">��������</option>
							<option value="N1">�������� �� 3,5�</option>
                        </optgroup>
                        <optgroup label="��������� C">
                        	<option value="N2">�������� �� 12�</option>
                            <option value="N3">�������� ����� 12�</option>
                        </optgroup>
                        <optgroup label="��������� D">
                        	<option value="M2">������� �� 5�</option>
                            <option value="M3">������� ����� 5�</option>
                        </optgroup>
                        <optgroup label="��������� E">
                        	<option value="O1">������ �� ����� 750��</option>
                            <option value="O2">������ �� ����� 3,5�</option>
                            <option value="O3">������ �� ����� 10�</option>
                            <option value="O4">������ ����� 10�</option>
                        </optgroup>
					</select>
				</td>
				<td>������:<br/>
					<div>
						<input class="date form-control" placeholder="C" type="text" name="fromdate" value="<?=$_REQUEST['fromdate']?>" data-inputmask="'alias': 'dd.mm.yyyy'"> - <input placeholder="��" class="date form-control" type="text" name="todate" value="<?=$_REQUEST['todate']?>" data-inputmask="'alias': 'dd.mm.yyyy'">
					</div>
				</td>
				<td align="center" style="vertical-align:middle;">
					<input type="submit" value="������������" name="filter" class="btn btn-default" />
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