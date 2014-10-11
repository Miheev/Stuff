<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if(isset($_REQUEST["IMG_ID"]) && $_REQUEST["IMG_ID"]):

$file = CFile::ResizeImageGet($_REQUEST["IMG_ID"], array('width'=>320, 'height'=>320), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>

	<img src="<?=$file['src'];?>" width="<?=$file['width'];?>" height="<?=$file['height'];?>"/>
<?endif;?>
