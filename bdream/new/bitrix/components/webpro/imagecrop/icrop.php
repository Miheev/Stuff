<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/add/SimpleImage/SimpleImage.php');

    if (isset($_POST['crop'])) {
//        require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

        $img = new abeautifulsite\SimpleImage($_SERVER["DOCUMENT_ROOT"].$_POST['src']);

//        $rr= dirname(dirname($_SERVER["DOCUMENT_ROOT"].$_POST['src']));
        $path_parts = pathinfo($_SERVER["DOCUMENT_ROOT"].$_POST['src']);

        $x2= intval($_POST['x'])+intval($_POST['width']);
        $y2= intval($_POST['y'])+intval($_POST['height']);

        $img->crop(intval($_POST['x']), intval($_POST['y']), $x2, $y2);
        $img->resize(intval($_POST['scale_width']), intval($_POST['scale_height']));
        $img->save($_SERVER["DOCUMENT_ROOT"].'/upload/member/'.$path_parts['basename']);

        $out= array('imgpath'=>$_SERVER["DOCUMENT_ROOT"].'/upload/member/'.$path_parts['basename']);

        $user = new CUser;
        $arFile = CFile::MakeFileArray($out['imgpath']);
        $arFile['del'] = "Y";
        $arFile['old_file'] = intval($_POST['fid']);
        $field= array('PERSONAL_PHOTO'=>$arFile);
        $user->Update($USER->GetID(), $field);
//        $user->Update($USER->GetID(), array('PERSONAL_PHOTO'=>intval($_POST['fid'])));
        $strError = $user->LAST_ERROR;

        $out['UID']= $USER->GetID();
        $out['fid']= $_POST['fid'];
        $out['PERSONAL_PHOTO']= $strError;
        $outstr= json_encode($out);
//        $outstr= $_SERVER["DOCUMENT_ROOT"].'/upload/member/'.$path_parts['basename'];
        echo $outstr;
        exit();
    }
?>