<?php
session_start();
header('Content-type: text/html; charset=utf-8');
if (isset($_POST["in"]) && !empty($_POST["in"])):
		require_once($_SERVER['DOCUMENT_ROOT'].'/functions.php');

		$DB = new DB;
		$DB->init();

		if ($DB->checkUser($_POST["lg"],$_POST["pw"]) == true):
			$_SESSION["auth"] = true;
			$_SESSION["time"] = time();
		else:
			unset($_SESSION['auth']);
			unset($_SESSION['time']);
			$_SESSION["error"] = 'login';
			header ("location: /");
		endif;
endif;

if (!empty($_SESSION["appd"])):
	if ($_SESSION["appd"] == 'admin'):
		header ("location: /admin/?page=clients");
	else:
		header ("location: /client/?page=base");
	endif;
endif;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap-theme.css" />
<link type="text/css" rel="stylesheet" href="/handle-style.css" />
<title>Админ-панель</title>
<style>td { height: 40px; } table {margin-top: 100px;}</style>
</head>

<body>

<form action="/" method="post">
<table width="300" align="center">
<tr><td><label for="lg">E-mail:</label></td><td><input type="text" id="lg" name="lg" class="form-control" /></td></tr>
<tr><td><label for="pw">Пароль:</label></td><td><input type="password" id="pw" name="pw" class="form-control" /></td></tr>
<tr><td colspan="2" align="center"><input type="hidden" name="in" value="<?=time()?>" /><input type="submit" value="войти" class="btn btn-default" /></td></tr>
<tr><td colspan="2" align="center"><a href="/pass_reset/">Забыли пароль?</a></td>
</table>
</form>

</body>
</html>
