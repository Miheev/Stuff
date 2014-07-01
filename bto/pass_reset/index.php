<?
session_start();
header('Content-type: text/html; charset=utf-8');
if (!empty($_SESSION["appd"])):
	if ($_SESSION["appd"] == 'admin'):
		header ("location: /admin/");
	else:
		header ("location: /client/");
	endif;
endif;
if (isset($_POST["lg"]) && !empty($_POST["lg"])):
	require_once($_SERVER['DOCUMENT_ROOT'].'/functions.php');
		
	$DB = new DB;
	$DB->init();
		
	if ($DB->resetPass($_POST["lg"]) == true):
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap.css" />
				<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap-theme.css" />
				<link type="text/css" rel="stylesheet" href="/handle-style.css" />
				<title>�����-������</title>
				<style>td { height: 40px; } table {margin-top: 100px;}</style>
			</head>
			<body>
				<form action="/" method="post">
					<table width="400" align="center">
						<tr><td class="success" align="center">������ ������ �� ��� email.</td></tr>
						<tr><td align="center"><a href="/">�� �������</a></td></tr>
					</table>
				</form>
			</body>
		</html>
		<?
	else:
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap.css" />
				<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap-theme.css" />
				<link type="text/css" rel="stylesheet" href="/handle-style.css" />
				<title>�����-������</title>
				<style>td { height: 40px; } table {margin-top: 100px;}</style>
			</head>
			<body>
					<table width="400" align="center">
						<tr><td class="danger" align="center">������������ � ����� email �� ����������.</td></tr>
						<tr><td align="center"><a href="/pass_reset/">���������</a></td></tr>
					</table>
			</body>
		</html>
		<?
	endif;
else:?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="/bootstrap-3.1.1-dist/css/bootstrap-theme.css" />
		<link type="text/css" rel="stylesheet" href="/handle-style.css" />
		<title>�����-������</title>
		<style>td { height: 40px; } table {margin-top: 100px;}</style>
	</head>
	<body>
		<form action="/pass_reset/" method="post">
			<table width="300" align="center">
				<tr><td colspan="2" align="center">�������������� ������</td></tr>
				<tr><td><label for="lg">E-mail:</label></td><td><input type="text" id="lg" name="lg" class="form-control" /></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" value="�����������" class="btn btn-default" /></td></tr>
			</table>
		</form>
	</body>
</html>
<?endif;?>