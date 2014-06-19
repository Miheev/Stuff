<?php
$host="localhost";
$user="root";
$pass="mintsql";
$dbname="webprocrm";
// $dbname="phprbac";
$adapter="pdo_sqlite";
// $adapter="pdo_mysql";
#TODO: test on sqlite


{
	jf::$DB=new mysqli($host,$user,$pass,$dbname);
	if(jf::$DB->connect_errno==1049);
		InstallMySQLi($host,$user,$pass,$dbname);
}
function GetSQLs($dbms)
{
	$sql=file_get_contents(__DIR__."/sql/{$dbms}.sql");
	$sql=str_replace("PREFIX_",jf::TablePrefix(),$sql);
	return explode(";",$sql);
}
function InstallPDOMySQL($host,$user,$pass,$dbname)
{
	$sqls=GetSQLs("mysql");
	$db=new PDO("mysql:host={$host};",$user,$pass);
	$db->query("CREATE DATABASE {$dbname}");
	$db->query("USE {$dbname}");
	if (is_array($sqls))
		foreach ($sqls as $query)
		$db->query($query);
	jf::$DB=new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
	jf::$RBAC->Reset(true);
}
function InstallPDOSQLite($host,$user,$pass,$dbname)
{
	jf::$DB=new PDO("sqlite:{$dbname}",$user,$pass);
	$sqls=GetSQLs("sqlite");
	if (is_array($sqls))
		foreach ($sqls as $query)
		jf::$DB->query($query);
	jf::$RBAC->Reset(true);
}
function InstallMySQLi($host,$user,$pass,$dbname)
{
	$sqls=GetSQLs("mysql");
	$db=new mysqli($host,$user,$pass);
	$db->query("CREATE DATABASE {$dbname}");
	$db->select_db($dbname);
	if (is_array($sqls))
		foreach ($sqls as $query)
		$db->query($query);
	jf::$DB=new mysqli($host,$user,$pass,$dbname);
	jf::$RBAC->Reset(true);
}