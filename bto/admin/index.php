<?
session_start(); ////Demetori
header('Content-type: text/html; charset=windows-1251');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');

$DB = new DB;
$DB->init();

$DB->checkValidUser($_SESSION);

if ($_REQUEST["act"] == 'logout'):
	$DB->secureDestroy();
endif;

if ($_SESSION["appd"] <> 'admin'):
	$DB->secureDestroy();
endif;

if (isset($_GET['find'])) {
    //$DB->findAdminTSList($_POST['key']);
    $DB->findClientsList($_POST['key']);
    die();
}
if ($_REQUEST["page"] == 'constants'):
	if ($_REQUEST["act"] == 'write'):
		$DB->addNewConstant($_REQUEST);
		header('location: /admin/?page=constants');
	elseif ($_REQUEST["act"] == 'rewrite'):
		$DB->rewriteConstant($_REQUEST);
		header('location: /admin/?page=constants');
	elseif ($_REQUEST["act"] == 'delete'):
		$DB->deleteConstant($_REQUEST["ID"]);
		header('location: /admin/?page=constants');
	endif;
elseif ($_REQUEST["page"] == 'clients'):
	if ($_REQUEST["act"] == 'write'):
		$DB->addNewClient($_REQUEST);
		header ('location: /admin/?page=clients');
	elseif ($_REQUEST["act"] == 'rewrite'):
		$DB->rewriteClient($_REQUEST);
		header ('location: /admin/?page=clients');
	elseif ($_REQUEST["act"] == 'delete'):
		$DB->deleteClient($_REQUEST["ID"]);
		header ('location: /admin/?page=clients');
	endif;
elseif ($_REQUEST["page"] == 'settings'):
	if ($_REQUEST["act"] == 'save'):
		$DB->updateClientPass($_REQUEST);
		header ("location: /admin/");
	endif;
endif;

$U = $DB->getUserByEmail($_SESSION["appl"]);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1251">
<title>������ ��������������</title>
<script type="text/javascript" src="/jquery-1.10.2.js"></script>
<script src="/bootstrap-3.1.1-dist/js/bootstrap.js"></script>
<script type="text/javascript" src="/handle-js.js"></script>
<script type="text/JavaScript" src="/jquery.inputmask.js"></script>
<script type="text/JavaScript" src="/jquery.inputmask.date.extensions.js"></script>
<script type="text/JavaScript" src="/jquery.tablesorter.min.js"></script>
<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap-theme.css" />
<link type="text/css" rel="stylesheet" href="/handle-style.css" />
<link rel="stylesheet" type="text/css" href="/blue/style.css" />
<script>
		$(document).ready(function(){
			 $("#clients").tablesorter({
			 	headers: { 9: { sorter: false} }
			 }); 
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
            <li <?=((substr_count($_SERVER['REQUEST_URI'], 'page=clients') > 0) ? 'class="active"' : '')?>><a href="/admin/?page=clients">�������</a></li>
            <li><a href="/admin/?page=base">���� ��</a></li>
            <li <?=((substr_count($_SERVER['REQUEST_URI'], 'page=constants') > 0) ? 'class="active"' : '')?>><a href="/admin/?page=constants">�����������</a></li>
            <li><a href="/admin/?page=analysis">������</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li <?=((substr_count($_SERVER['REQUEST_URI'], 'page=settings') > 0) ? 'class="active"' : '')?>><a href="/admin/?page=settings">���������</a></li>
            <li><a href="/admin/?act=logout">�����</a></li>
        </ul>
        
    </div>
</div>

<? if ($_REQUEST["page"] == 'clients'): ?>
	<? if ($_REQUEST["act"] == 'add'): ?>
    <fieldset><legend> ���������� ������� </legend>
    	<form action="/admin/" method="post">
    	<table cellpadding="5" cellspacing="0" border="0">
        	<tr>
            	<td>�������:</td>
            	<td><input type="text" name="f" class="form-control"/></td>
            </tr>
            <tr>
            	<td>���:</td>
            	<td><input type="text" name="i" class="form-control"/></td>
            </tr>
            <tr>
            	<td>��������:</td>
            	<td><input type="text" name="o" class="form-control"/></td>
            </tr>
            <tr>
            	<td>�����������:</td>
            	<td><input type="text" name="org" class="form-control"/></td>
            </tr>
            <tr>
            	<td>�������:</td>
            	<td><input type="text" name="phone" class="form-control"/></td>
            </tr>
            <tr>
            	<td>�����:</td>
            	<td><input type="text" name="city" class="form-control"/></td>
            </tr>
            <tr>
            	<td>��� ���������:</td>
            	<td><? $DB->getConstantSelectbox() ?></td>
            </tr>
            <tr>
            	<td>E-mail:</td>
            	<td><input type="text" name="email" class="form-control"/></td>
            </tr>
            <tr>
            	<td>������:</td>
            	<td class="form-inline"><input type="text" name="pass" id="pass" class="form-control"/> <input class="form-control btn btn-default" type="button" value=" ... " onclick="generatePassword();" style="width:35px;" /></td>
            </tr>
            <tr>
            	<td colspan="2" class="form-inline"><input type="checkbox" value="cont" id="cont" style="width:30px;" class="checkbox" /> <label for="cont">��������� � �������� ��� ������ �������</label></td>
            </tr>
            <tr>
            	<td colspan="2" align="center" ><input type="hidden" name="page" value="clients" /><input type="hidden" name="act" value="write" /><input type="submit" class="form-control btn btn-default" value="���������" /></td>
            </tr>
        </table>
        </form>
    </fieldset>
	<? elseif ($_REQUEST["act"] == 'add_tch'): ?>
	<? elseif ($_REQUEST["act"] == 'edit'):
		$I = $DB->getUserByID($_REQUEST["ID"]);
	?>
    <fieldset><legend> �������������� ������� </legend>
    	<form action="/admin/" method="post">
    	<table cellpadding="5" cellspacing="0" border="0">
        	<tr>
            	<td>�������:</td>
            	<td><input type="text" name="f" value="<?=$I["f"]?>" class="form-control"/></td>
            </tr>
            <tr>
            	<td>���:</td>
            	<td><input type="text" name="i" value="<?=$I["i"]?>" class="form-control"/></td>
            </tr>
            <tr>
            	<td>��������:</td>
            	<td><input type="text" name="o" value="<?=$I["o"]?>" class="form-control"/></td>
            </tr>
            <tr>
            	<td>�����������:</td>
            	<td><input type="text" name="org" value="<?=$I["org"]?>" class="form-control"/></td>
            </tr>
            <tr>
            	<td>�������:</td>
            	<td><input type="text" name="phone" value="<?=$I["phone"]?>" class="form-control"/></td>
            </tr>
            <tr>
            	<td>�����:</td>
            	<td><input type="text" name="city" value="<?=$I["city"]?>" class="form-control"/></td>
            </tr>
            <tr>
            	<td>��� ���������:</td>
            	<td><? $DB->getConstantSelectbox() ?></td>
            </tr>
            <tr>
            	<td>E-mail:</td>
            	<td><input type="text" name="email" value="<?=$I["email"]?>" class="form-control"/></td>
            </tr>
            <tr>
            	<td>������:</td>
            	<td class="form-inline"><input type="text" name="pass" id="pass" disabled="disabled" class="form-control"/> 
            	<input type="button" class="form-control btn btn-default" value=" ... " onclick="generatePassword();" style="width:35px;" /></td>
            </tr>
            <tr>
            	<td colspan="2" align="center">
            		<input type="hidden" name="page" value="clients" />
            		<input type="hidden" name="act" value="rewrite" />
            		<input type="hidden" name="ID" value="<?=$_REQUEST["ID"]?>" />
            		<input type="submit" value="��������" class="form-control btn btn-default" />
            	</td>
            </tr>
        </table>
        </form>
    </fieldset>
    <? else: ?>
    <div style="width:80%;margin:0 auto;">
    <fieldset class="form-inline"><legend> �������� </legend>
    <a href="/admin/?page=clients&act=add">�������� �������</a><br /><br />
    ����� �������: <input type="text" class="form-control find-key" /> <input type="submit" value="�����" class="find-btn form-control btn btn-default" />
    </fieldset><br />
        <script type="text/javascript">
            $('.find-btn').click(function(){
                $.post('/admin/index.php?find', {key: $('.find-key').val()}, function(data, status){
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
    <legend class="ts-list">������ ��������:</legend>
    <? $DB->getClientsList() ?>
    </div>
    <? endif; ?>
<? elseif ($_REQUEST["page"] == 'constants'): ?>
	<? if ($_REQUEST["act"] == 'add'): ?>
    <fieldset><legend> ���������� ���� ��� </legend>
    	<form action="/admin/" method="post">
    	<table cellpadding="5" cellspacing="0" border="0" id="prices">
        	<tr>
            	<td>�������� ����:</td>
                <td><input type="text" name="name" /></td>
            </tr>
            <tr>
            	<td><select name="cat[0]">
	                <option value="A">��������� A</option>
                	<option value="B">��������� �</option>
                    <option value="C">��������� �</option>
                    <option value="D">��������� D</option>
                    <option value="E">��������� E</option>
                   	</select>
                 </td>
                <td><input type="text" placeholder="����" name="price[0]" /></td>
            </tr>
            <tr>
            	<td colspan="2" align="center"><a href="javascript:void(0)" onclick="addTableRow($('#prices'));">�������� ���������</a></td>
            </tr>
            <tr>
            	<td colspan="2" align="center"><input type="hidden" name="page" value="constants" /><input type="hidden" name="act" value="write" /><input type="submit" value="�������� ��� ���" /></td>
            </tr>
        </table>    
        </form>
    </fieldset>
    <? elseif ($_REQUEST["act"] == 'edit'): 
		$i = $DB->getConstantsArray($_REQUEST["ID"]);
	?>
    <fieldset><legend> �������������� ���� ��� </legend>
    	<form action="/admin/" method="post">
    	<table cellpadding="5" cellspacing="0" border="0" id="prices">
        	<tr>
            	<td>�������� ����:</td>
                <td><input type="text" name="name" value="<?=$i["name"]?>" /></td>
            </tr>
            <? foreach ($i["cats"] as $k=>$v): ?>
            <tr>
            	<td><select name="cat[<?=$k?>]">
                	<option value="B" <?=(($v["value"]=='B') ? 'selected': '')?>>��������� �</option>
                    <option value="C" <?=(($v["value"]=='C') ? 'selected': '')?>>��������� �</option>
                    <option value="D" <?=(($v["value"]=='D') ? 'selected': '')?>>��������� D</option>
                    <option value="E" <?=(($v["value"]=='E') ? 'selected': '')?>>��������� E</option>
                   	</select></td>
                <td><input type="text" placeholder="����" name="price[<?=$k?>]" value="<?=$i["costs"][$k]?>" /></td>
            </tr>
            <? endforeach; ?>
            <tr>
            	<td colspan="2" align="center"><a href="javascript:void(0)" onclick="addTableRow($('#prices'));">�������� ���������</a></td>
            </tr>
            <tr>
            	<td colspan="2" align="center"><input type="hidden" name="page" value="constants" /><input type="hidden" name="ID" value="<?=$_REQUEST["ID"]?>" /><input type="hidden" name="act" value="rewrite" /><input type="submit" value="�������� ��� ���" /></td>
            </tr>
        </table>    
        </form>
        <script type="text/javascript">
			var rowNumber = <?=$i["num"]-1?>
		</script>
    </fieldset>
    <? else: ?>
	<h2>������ ������������:</h2>
    
    <fieldset><legend> ���� ��� </legend>
    	<a href="/admin/?page=constants&act=add">�������� �����</a>
        <hr align="center" width="100%" />
        <? $DB->getConstants() ?>
    </fieldset>
    <? endif; ?>

    <? elseif ($_REQUEST["page"] == 'settings'): ?>
    <fieldset><legend> ��������� ������� ������ </legend>
    <form action="/admin/" method="post">
    <table cellpadding="5" cellspacing="0" border="0">
        <tr>
            <td>������� ������:</td>
            <td><input type="password" name="pass" /></td>
        </tr>
        <tr>
            <td>����� ������:</td>
            <td><input type="password" name="npass1" /></td>
        </tr>
        <tr>
            <td>�������������:</td>
            <td><input type="password" name="npass2" /></td>
        </tr>
        <tr>
        	<td colspan="2" align="center"><input type="hidden" name="act" value="save" /><input type="hidden" name="page" value="settings" /><input type="submit" value="�������� ������" /></td>
        </tr>
    </table>
    </form>
    </fieldset>
<? elseif ($_REQUEST["page"] == 'base'): ?>
	<h2 class="ts-list">������ ��:</h2>
	
	<?	$DB->getAdminTSList(); ?>

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
		<form action="/admin/?page=analysis" class="form-inline" method="post">
		<table class="table table-striped" >
			<tr>
				<td width="25%">������:<br/>
					<? $DB->getAdminAnalysis_ClientsList($_REQUEST); ?>
				</td>
				<td>������:<br/>
					<div>
						<input class="date form-control" type="text" name="fromdate" value="<?=$_REQUEST['fromdate']?>" data-inputmask="'alias': 'dd.mm.yyyy'"> - <input class="date form-control" type="text" name="todate" value="<?=$_REQUEST['todate']?>" data-inputmask="'alias': 'dd.mm.yyyy'">
					</div>
				</td>
				<td align="center" style="vertical-align:middle;">
					<input type="submit" value="������������" name="filter" />
				</td>
			</tr>
		</table>
		</form>
	</fieldset>
	
	<div style="width:80%; margin: 0 auto;">
		<? $DB->getAdminAnalysis($_REQUEST); ?>
	</div>
<? endif; ?>

</body>
</html>