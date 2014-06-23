<?php
session_start();
header('Content-type: text/html; charset=windows-1251');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');
require($ROOT.'/mpdf/mpdf.php');

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
    <title>�������� ��� ��������</title>
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
        &nbsp;���������
    </td>
    <td style="width:16px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td colspan="7" style="width:84px;">
        ����� � ��-4
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
    <td style="width:12px;">
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="39">
        ��� ����-�������
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="39">
        ������������ ���������� �������
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="10">
        7729725022
    </td>
    <td colspan="9">
        &nbsp;
    </td>
    <td colspan="20">
        40702810200520001952
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="13">
    <td height="13" style="height:13px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="10">
        ��� ���������� �������
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="20">
        (����� ����� ���������� �������)
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="10">
    <td height="10" style="height:11px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        �
    </td>
    <td colspan="26">
        ��� ����� �������� �. ������
    </td>
    <td colspan="3">
        ���
    </td>
    <td colspan="9">
        044525787
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="26">
        (������������ ����� ���������� �������)
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="19">
        ����� ���./��. ����� ���������� �������:
    </td>
    <td colspan="20">
        30101810100000000787
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="15">
        �� ��������� �� �������� �&nbsp;
    </td>
    <td colspan="8">

    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="14">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="23">
        (������������ �������)
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="14">
        (����� �������� ����� (���) �����������)
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="9">
        �.�.�. �����������
    </td>
    <td colspan="30">
       $fio
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td colspan="3" height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="9">
        ����� �����������:
    </td>
    <td colspan="30">
<!--   addr     -->
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="7">
        ����� �������
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="9">
        ����� ����� ��<br /> ������
    </td>
    <td colspan="4">
        &nbsp;
    </td>
    <td colspan="2">
        ���.
    </td>
    <td colspan="2">
        &nbsp;
    </td>
    <td colspan="2">
        ���.
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="3">
        �����
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
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
        �.
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="5">
    <td height="5" style="height:6px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="18">
    <td colspan="3" height="13" style="height:13px;">
        ������
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="39" syule="">
        � ��������� ������ ��������� � ��������� ��������� �����, �.�. � ������ ���������
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="13">
    <td height="13" style="height:13px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="17">
        ����� �� ������ �����, ���������� <br/>� ��������
    </td>
    <td colspan="10">
        ������� �����������:
    </td>
    <td colspan="12">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="10">
    <td height="10" style="height:10px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td colspan="3" height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="7">
        ����� � ��-4
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="15">
    <td height="15" style="height:15px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="39">
        ��� ����-�������
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="39">
        ������������ ���������� �������
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="10">
        7729725022
    </td>
    <td colspan="9">
        &nbsp;
    </td>
    <td colspan="20">
        40702810200520001952
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="13">
    <td height="13" style="height:13px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="10">
        ��� ���������� �������
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="20">
        (����� ����� ���������� �������)
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="10">
    <td height="10" style="height:11px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        �
    </td>
    <td colspan="26">
        ��� ����� �������� �. ������
    </td>
    <td colspan="3">
        ���
    </td>
    <td colspan="9">
        044525787
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="26">
        (������������ ����� ���������� �������)
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="19">
        ����� ���./��. ����� ���������� �������:
    </td>
    <td colspan="20">
        30101810100000000787
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="15">
        �� ��������� �� �������� �
    </td>
    <td colspan="8">

    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="14">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="12">
    <td height="12" style="height:12px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="23">
        (������������ �������)
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="14">
        ����� �������� ����� (���) �����������
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="9">
        �.�.�. �����������
    </td>
    <td colspan="30">
        $fio
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td colspan="3" height="17" style="height:17px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="9">
        ����� �����������:
    </td>
    <td colspan="30">
<!--        <!--addr-->
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="7">
        ����� �������
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="9">
        ����� ����� ��<br/> ������
    </td>
    <td colspan="4">
        &nbsp;
    </td>
    <td colspan="2">
        ���.
    </td>
    <td colspan="2">
        &nbsp;
    </td>
    <td colspan="2">
        ���.
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="18">
    <td height="18" style="height:19px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="3">
        �����
    </td>
    <td colspan="4">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td colspan="3">

    </td>
    <td colspan="2">
        ���.
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
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
        �.
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="17">
    <td colspan="3" height="17" style="height:17px;">
        ���������
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="13">
    <td colspan="3" height="13" style="height:13px;">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="39">
        � ��������� ������ ��������� � ��������� ��������� �����, �.�. � ������ ���������
    </td>
    <td>
        &nbsp;
    </td>
</tr>
<tr height="13">
    <td colspan="3" height="13" style="height:13px;">
        ������
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="17">
        ����� �� ������ �����, ����������<br/> � ��������
    </td>
    <td colspan="10">
        ������� �����������:
    </td>
    <td colspan="12">
        &nbsp;
    </td>
    <td>
        &nbsp;
    </td>
</tr>
</tbody>
</table>


</body></html>
EOT;


$mpdf = new mPDF('utf-8', 'A4', '8', '', 5, 5, 5, 5, 5, 5); /*������ ������, ������� �.�.�.*/
$mpdf->charset_in = 'cp1251'; /*�� �������� ��� �������*/

$stylesheet = file_get_contents($ROOT.'/print/tch.css'); /*���������� css*/
$mpdf->WriteHTML($stylesheet, 1);

$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($html, 2); /*��������� pdf*/
$mpdf->Output('mpdf.pdf', 'I');
?>
\