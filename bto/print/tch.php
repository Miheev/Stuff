<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
session_start();
header('Content-type: text/html; charset=windows-1251');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');

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

/*
 * $_POST['fio']
 * $_POST['address']
 * $_POST['tch_eaisto']
 * */
//if (isset($_REQUEST['fio']) && isset($_REQUEST['address']) && isset($_REQUEST['tch_eaisto']) &&
//    !empty($_REQUEST['fio']) && !empty($_REQUEST['address']) && !empty($_REQUEST['tch_eaisto'])) {
//
//    $date= new DateTime($eaid['ddate']);
//    $eaid=$_REQUEST["id"];
//
//    $DB->printTSList($U["ID"] , $eaid);
//    $DB->printTSList($U["ID"] , $eaid);
//
//    $d_table=mysql_query("SELECT * FROM tch WHERE eaisto='".$_POST['tch_eaisto']."'");
//    if (!mysql_num_rows($d_table)) // ���� ������� ����-�� ���� ������
//    {
//        mysql_query("INSERT INTO tch VALUES ('', '".$_REQUEST['address']."', '".$_POST['tch_eaisto']."')");
//    }
//} else
//    die('���������� ��������� ������������ �����');
?>

<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1251">
    <title>�������� ��� ��������</title>

    <style class="before-after">
        table td{border: 1px solid #e4e0ef;}
    </style>
</head>

<body>

<? switch ($eaid["cat"]):
    case 'M1':
    case 'N1': $cat = '��������� B ('.$i["cat"].')'; break;
    case 'N2':
    case 'N3': $cat = '��������� C ('.$i["cat"].')'; break;
    case 'M2':
    case 'M3': $cat = '��������� D ('.$i["cat"].')'; break;
    case 'O1':
    case 'O2':
    case 'O3':
    case 'O4': $cat = '��������� E ('.$i["cat"].')'; break;
endswitch;
switch ($eaid["doc"]):
    case 'pts': $doc= '���'; break;
    case 'srts': $doc= '����'; break;
endswitch;
switch ($eaid["oil"]):
    case 'b': $oil= '������'; break;
    case 'd': $oil= '��������� �������'; break;
    case 's': $oil= '������ ���'; break;
    case 'g': $oil= '�������� ���'; break;
    case 'o': $oil= '��� �������'; break;
endswitch;
switch ($eaid["breaks"]):
    case 'g': $breaks= '��������������'; break;
    case 'p': $breaks= '��������������'; break;
    case 'm': $breaks= '������������'; break;
    case 'k': $breaks= '���������������'; break;
    case 'o': $breaks= '�����������'; break;
endswitch;

?>

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
        <?php echo $U['f'].' '.$U['i'].' '.$U['o']; ?>
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
<!--        --><?php //echo $_REQUEST['address']; ?>
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
        ����� ����� �� ������
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
        <?php echo $date->format('d'); ?>
    </td>
    <td>
        "
    </td>
    <td colspan="7">
        <?php echo $date->format('m'); ?>
    </td>
    <td colspan="2">
        20
    </td>
    <td colspan="2">
        <?php echo $date->format('y'); ?>
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
<tr height="13">
    <td colspan="3" height="13" style="height:13px;">
        ������
    </td>
    <td>
        &nbsp;
    </td>
    <td colspan="39">
        � ��������� ������ ��������� � ��������� ��������� �����, �.�. � ������ ��������� �����&nbsp;&nbsp;
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
        �� ������ �����, ���������� � ��������
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
        <?php echo $U['f'].' '.$U['i'].' '.$U['o']; ?>
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
<!--        --><?php //echo $_REQUEST['address']; ?>
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
        ����� ����� �� ������
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
        <?php echo $date->format('d'); ?>
    </td>
    <td>
        "
    </td>
    <td colspan="7">
        <?php echo $date->format('m'); ?>
    </td>
    <td colspan="2">
        20
    </td>
    <td colspan="2">
        <?php echo $date->format('y'); ?>
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
        � ��������� ������ ��������� � ��������� ��������� �����, �.�. � ������ ��������� �����&nbsp;&nbsp;
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
        �� ������ �����, ���������� � ��������
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