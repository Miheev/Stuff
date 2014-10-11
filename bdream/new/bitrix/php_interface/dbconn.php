<? define("SHORT_INSTALL_CHECK", true);?><?
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "";
$DBPassword = "";
$DBName = "";
$DBDebug = false;
$DBDebugToFile = false;

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_FILE_PERMISSIONS", 0664);
define("BX_DIR_PERMISSIONS", 0775);
@umask(~BX_DIR_PERMISSIONS);

define("MYSQL_TABLE_TYPE", "INNODB");
define("SHORT_INSTALL", true);
define("VM_INSTALL", true);

define("BX_UTF", true);
define("BX_CRONTAB_SUPPORT", true);
define("BX_COMPRESSION_DISABLED", true);

global $AR_LOL_LANG;
$AR_LOL_LANG = array("ru"=>"Russian", "en"=>"English", "cn"=>"Chinese");

if(isset($_REQUEST["SET_LANG"]) && $_REQUEST["SET_LANG"])
{
	if(array_key_exists($_REQUEST["SET_LANG"], $AR_LOL_LANG))
	{
		define("LANGUAGE_ID", $_REQUEST["SET_LANG"]);
		SetCookie("LOL_LANG_ID", $_REQUEST["SET_LANG"], time()+60*60*24*30, "/");
	}
}
elseif($_COOKIE['LOL_LANG_ID'])
{
	define("LANGUAGE_ID", $_COOKIE['LOL_LANG_ID']);
}


?>
