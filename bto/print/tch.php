<?php
session_start();
header('Content-type: text/html; charset=windows-1251');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');
//require($ROOT.'/mpdf/mpdf.php');
require($ROOT."/pdf/dompdf/dompdf_config.inc.php");

setlocale(LC_ALL, 'ru_RU');

$DB = new DB;
$DB->init();

$DB->checkValidUser($_SESSION);

$U = $DB->getUserByEmail($_SESSION["appl"]);

$eaid=$_REQUEST["id"];

$DB->printTSList($U["ID"] , $eaid);

if($U["ID"] != $eaid["owner"] AND $U["ID"] != 1) {
    header ("location: /");
}

$date= new DateTime($eaid['ddate']);
$$dd = $date->format('d');
$$yy = $date->format('y');;
$$mm = $date->format('m');;
$addr= $_REQUEST['address'];
$fio= $U['f'].' '.$U['i'].' '.$U['o'];


$html= <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1251">
    <title>Документ без названия</title>
    <style type="text/css">
	    table {width: 100%;}
	    td: {border: 1px solid #e4e0ef !important; font-size: 12px;}
</style>
</head>

<body>

<table border="0" cellpadding="0" cellspacing="0" style="width:675px;" width="675">
<colgroup>
    <col span="2">
    <col>
    <col>
    <col span="40">
</colgroup>
<tbody>
<tr height="13">
    <td colspan="3" height="13" style="height:13px;width:179px;">
        Извещение
    </td>
    <td style="width:16px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td colspan="7" style="width:84px;">
        Форма № ПД-4
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
    <td style="width:12px;">
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="39">
        ООО «Тех-эксперт»
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="39">
        наименование получателя платежа
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="10">
        7729725022
    </td>
    <td colspan="9">
        
    </td>
    <td colspan="20">
        40702810200520001952
    </td>
    <td>
        
    </td>
</tr>
<tr height="13">
    <td height="13" style="height:13px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="10">
        ИНН получателя платежа
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="20">
        (номер счета получателя платежа)
    </td>
    <td>
        
    </td>
</tr>
<tr height="10">
    <td height="10" style="height:11px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        в
    </td>
    <td colspan="26">
        ОАО «БАНК УРАЛСИБ» г. Москва
    </td>
    <td colspan="3">
        БИК
    </td>
    <td colspan="9">
        044525787
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="26">
        (наименование банка получателя платежа)
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="19">
        Номер кор./сч. банка получателя платежа:
    </td>
    <td colspan="20">
        30101810100000000787
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="15">
        За Техосмотр по договору №
    </td>
    <td colspan="8">

    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="14">
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="23">
        (наименование платежа)
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="14">
        (номер лицевого счета (код) плательщика)
    </td>
    <td>
        
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="9">
        Ф.И.О. плательщика
    </td>
    <td colspan="30">
       $fio
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td colspan="3" height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td colspan="9">
        Адрес плательщика:
    </td>
    <td colspan="30">
<!--   addr     -->
    </td>
    <td>
        
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="7">
        Сумма платежа
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        руб.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        коп.
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="9">
        Сумма платы за<br /> услуги
    </td>
    <td colspan="4">
        
    </td>
    <td colspan="2">
        руб.
    </td>
    <td colspan="2">
        
    </td>
    <td colspan="2">
        коп.
    </td>
    <td>
        
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="3">
        Итого
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        руб.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        коп.
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        "
    </td>
    <td colspan="3">
        $dd
    </td>
    <td>
        "
    </td>
    <td colspan="7">
        $mm
    </td>
    <td colspan="2">
        20
    </td>
    <td colspan="2">
        $yy
    </td>
    <td colspan="2">
        г.
    </td>
    <td>
        
    </td>
</tr>
<tr height="5">
    <td height="5" style="height:6px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="18">
    <td colspan="3" height="13" style="height:13px;">
        Кассир
    </td>
    <td>
        
    </td>
    <td colspan="39" syule="">
        С условиями приема указанной в платежном документе суммы, в.ч. с суммой взимаемой
    </td>
    <td>
        
    </td>
</tr>
<tr height="13">
    <td height="13" style="height:13px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="17">
        платы за услуги банка, ознакомлен <br/>и согласен
    </td>
    <td colspan="10">
        Подпись плательщика:
    </td>
    <td colspan="12">
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="10">
    <td height="10" style="height:10px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td colspan="3" height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="7">
        Форма № ПД-4
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="15">
    <td height="15" style="height:15px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="39">
        ООО «Тех-эксперт»
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="39">
        наименование получателя платежа
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="10">
        7729725022
    </td>
    <td colspan="9">
        
    </td>
    <td colspan="20">
        40702810200520001952
    </td>
    <td>
        
    </td>
</tr>
<tr height="13">
    <td height="13" style="height:13px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="10">
        ИНН получателя платежа
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="20">
        (номер счета получателя платежа)
    </td>
    <td>
        
    </td>
</tr>
<tr height="10">
    <td height="10" style="height:11px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        в
    </td>
    <td colspan="26">
        ОАО «БАНК УРАЛСИБ» г. Москва
    </td>
    <td colspan="3">
        БИК
    </td>
    <td colspan="9">
        044525787
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="26">
        (наименование банка получателя платежа)
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="19">
        Номер кор./сч. банка получателя платежа:
    </td>
    <td colspan="20">
        30101810100000000787
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="15">
        За Техосмотр по договору №
    </td>
    <td colspan="8">

    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="14">
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="23">
        (наименование платежа)
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="14">
        номер лицевого счета (код) плательщика
    </td>
    <td>
        
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="9">
        Ф.И.О. плательщика
    </td>
    <td colspan="30">
        $fio
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td colspan="3" height="17" style="height:17px;">
        
    </td>
    <td>
        
    </td>
    <td colspan="9">
        Адрес плательщика:
    </td>
    <td colspan="30">
<!--        <!--addr-->
    </td>
    <td>
        
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="7">
        Сумма платежа
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        руб.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        коп.
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="9">
        Сумма платы за<br/> услуги
    </td>
    <td colspan="4">
        
    </td>
    <td colspan="2">
        руб.
    </td>
    <td colspan="2">
        
    </td>
    <td colspan="2">
        коп.
    </td>
    <td>
        
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td colspan="3">
        Итого
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        руб.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        коп.
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        "
    </td>
    <td colspan="3">
        $dd
    </td>
    <td>
        "
    </td>
    <td colspan="7">
        $mm
    </td>
    <td colspan="2">
        20
    </td>
    <td colspan="2">
        $yy
    </td>
    <td colspan="2">
        г.
    </td>
    <td>
        
    </td>
</tr>
<tr height="17">
    <td colspan="3" height="17" style="height:17px;">
        Квитанция
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
    <td>
        
    </td>
</tr>
<tr height="13">
    <td colspan="3" height="13" style="height:13px;">
        
    </td>
    <td>
        
    </td>
    <td colspan="39">
        С условиями приема указанной в платежном документе суммы, в.ч. с суммой взимаемой
    </td>
    <td>
        
    </td>
</tr>
<tr height="13">
    <td colspan="3" height="13" style="height:13px;">
        Кассир
    </td>
    <td>
        
    </td>
    <td colspan="17">
        платы за услуги банка, ознакомлен<br/> и согласен
    </td>
    <td colspan="10">
        Подпись плательщика:
    </td>
    <td colspan="12">
        
    </td>
    <td>
        
    </td>
</tr>
</tbody>
</table>


</body></html>
EOT;


//$mpdf = new mPDF('utf-8', 'A4', '8', '', 5, 5, 5, 5, 5, 5); /*задаем формат, отступы и.т.д.*/
//$mpdf->charset_in = 'cp1251'; /*не забываем про русский*/
//
//$stylesheet = file_get_contents($ROOT.'/print/tch.css'); /*подключаем css*/
//$mpdf->WriteHTML($stylesheet, 1);
//
//$mpdf->list_indent_first_level = 0;
//$mpdf->WriteHTML($html, 2); /*формируем pdf*/
//$mpdf->Output('mpdf.pdf', 'I');

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('bto_tch.pdf'); // Выводим результат (скачивание)
$output = $dompdf->output();

?>