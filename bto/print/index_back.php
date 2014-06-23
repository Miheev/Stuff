<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
session_start();
header('Content-type: text/html; charset=windows-1251');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');

$DB = new DB;
$DB->init();

$DB->checkValidUser($_SESSION);

$U = $DB->getUserByEmail($_SESSION["appl"]);

$eaid=$_REQUEST["id"];

$DB->printTSList($U["ID"] , $eaid);

if($U["ID"] != $eaid["owner"] AND $U["ID"] != 1) {
	header ("location: /");
}
?>

<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1251">
<title>�������� ��� ��������</title>
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
<table border="1" style="border: 0; border-spacing: 0px;width: 100%;font-size: 11px;">
  <tbody><tr>
    <td colspan="9" align="center" style="border: 0;"><strong>��������������� �����</strong></td>
  </tr>
  <tr>
    <td colspan="9" align="center" style="border: 0;"><strong>Certificate of periodic technical inspection</strong></td>
  </tr>
  <tr>
    <td colspan="5" style="    border: 0;"><strong>��������������� �����</strong></td>
    <td colspan="4" style="    border: 0;"><strong>���� �������� ��</strong></td>
  </tr>
  <tr>
    <td colspan="5">  <? echo ($eaid[eaisto]);?> </td>
    <td colspan="4" >   <? echo ($eaid[unt]);?> </td>
  </tr>
  <tr>
    <td colspan="9" style=" border: 0; ">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"> <strong>�������� ������������ �������/����� ������������ �������: </strong></td>
    <td colspan="5"> <strong>��� ����������� ������ �01174, �����-���������, ���������� �����, �. 262</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong> ��������� ��������</strong></td>
    <td width="73">X</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="2"><strong>��������� ��������</strong></td>
    <td width="7" style="
    width: 30px;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>��������������� ���� ��:</strong></td>
    <td colspan="2"><? echo ($eaid[gnum]);?></td>
    <td colspan="2"><strong>�����, ������ ��:</strong></td>
    <td colspan="3"><? echo ($eaid[mark]);?>&nbsp;,&nbsp;<? echo ($eaid[model]);?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>VIN:</strong></td>
    <td colspan="2"><? echo ($eaid[vin]);?></td>
    <td colspan="2"><strong>��������� ��:</strong></td>
    <td colspan="3"><? echo ($cat);?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>����� ����:</strong></td>
    <td colspan="2"><? echo ($eaid[rama]);?></td>
    <td colspan="2" rowspan="2"><strong>��� ������� ��:</strong></td>
    <td colspan="3" rowspan="2"><? echo ($eaid[year]);?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>����� ������:</strong></td>
    <td colspan="2"><? echo ($eaid[kuz]);?></td>
  </tr>
  <tr>
    <td colspan="3"><strong>���� ��� ��� (�����, �����, ����� ���, �����):</strong></td>
    <td colspan="6"><? echo $doc; ?>   �����: <? echo($eaid[ser]);?>  �����: <? echo($eaid[num]);?> �����: <? echo($eaid[data]);?>  <? echo($eaid[bywho]);?></td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
">&nbsp;</td>
  </tr>
  </tbody>
  </table>
  <table border="1" style="border: 0; border-spacing: 0px;font-size: 8px;line-height: 7px;">
  
  <tbody><tr>
    <td width="30"><strong>�</strong></td>
    <td colspan="2"><strong>��������� � ����������, ������������� �&nbsp;������������ ��������� ��� ���������� ������������ �������</strong></td>
    <td width="30"><strong>�</strong></td>
    <td colspan="2"><strong>��������� � ����������, ������������� �&nbsp;������������ ��������� ��� ���������� ������������ �������</strong></td>
    <td width="30"><strong>�</strong></td>
    <td colspan="2"><strong>��������� � ����������, ������������� �&nbsp;������������ ��������� ��� ���������� ������������ �������</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>I.&nbsp;��������� �������</strong></td>
    <td width="30">22</td>
    <td width="297">������� � ������������ ��� � ���������� ������� � ������, ��������������� ������������</td>
    <td width="1">&nbsp;</td>
    <td width="30">42</td>
    <td width="310">����������������� ������� ������ �������� ��������� � ������� �������� �������</td>
    <td style="
    width: 60px;
">&nbsp;</td>
  </tr>
  <tr>
    <td width="30" style="
    width: 60px !important;
">1</td>
    <td width="276">������������ ����������� ������������� ���������� � ������������ ����������</td>
    <td width="30">&nbsp;</td>
    <td colspan="3"><strong>IV. ���������������� � ���������������</strong></td>
    <td width="30">43</td>
    <td>����������������� ���������� ����������� ������ � ������� ���������� ���������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">2</td>
    <td>������������ �������� ��������� ��� ������������� ����������� </td>
    <td width="30">&nbsp;</td>
    <td width="30" style="
    width: 60px;
">23</td>
    <td>������� ���������������� � �������� ��������������� ��������� ������</td>
    <td style="
    width: 60px;
">&nbsp;</td>
    <td width="30" style="
    width: 60px;
">44</td>
    <td>����������������� ��������� �������, �������� ����������� ��������� ������, ������� ���������� ������� � ������������ �� ������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">3</td>
    <td>����������������� ������� ��������� ������� ����������� � �������������� ��������� �������� � ������ ���������� (���������������) ���������� </td>
    <td width="30">&nbsp;</td>
    <td width="30">24</td>
    <td>����������� ���������������� ������ �������� � ���� ������� ������</td>
    <td>&nbsp;</td>
    <td width="30">45</td>
    <td>������� ���������������� ��������� ����������� �������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">4</td>
    <td>���������� ������ ������� ������� �� �������� ��������� �����</td>
    <td width="30">&nbsp;</td>
    <td width="30">25</td>
    <td>����������������� ����������������� � ����������������</td>
    <td>&nbsp;</td>
    <td width="30">46</td>
    <td>������� ����������� ��������� ������� � �������� �� �������� �� �������������. ����������� ���������� ������� � ��������� �������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">5</td>
    <td>���������� ���������� ��������� ��������, ��������� ������������� ������������� ��� ���������� � �������������� ��������� �������</td>
    <td width="30">&nbsp;</td>
    <td colspan="3"><strong>V. ���� � ������</strong></td>
    <td width="30">47</td>
    <td>������� ������ � ������� �������� ���������, ������������ �� ������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">6</td>
    <td>���������� ��������, �������� ������� ������������� ��� �����������</td>
    <td width="30">&nbsp;</td>
    <td width="30">26</td>
    <td>������������ ������ ������� ���������� ��� ������������� �����������</td>
    <td>&nbsp;</td>
    <td width="30">48</td>
    <td>����������������� ��������������� �����, ������ � �������������� ���������� ��������-�������� ����������. ���������� ������� ����������� ������� ���������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">7</td>
    <td>���������� ������������ ����������� ��������� �������������</td>
    <td width="30">&nbsp;</td>
    <td width="30">27</td>
    <td>���������� ��������� ������������� ��� � ������������</td>
    <td>&nbsp;</td>
    <td width="30">49</td>
    <td>������� ��������������� ����������������� �������������� � ��������� �������� (�� ����������� ���������) � ��������, �� ������������� ������� ��������� �������� </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">8</td>
    <td>���������� ������ ���������� ���������� ������� ���������� �������</td>
    <td width="30">&nbsp;</td>
    <td width="30">28</td>
    <td>������� ���� ������ ��� ���� ��������� ������ � ������� �����</td>
    <td>&nbsp;</td>
    <td width="30">50</td>
    <td>������������ �������� (�� ����������� ��������� � ���������) ��������� �����������, �������������� ������� ����� ����� � ���������, ����������� ������ � �������� � ������� �����������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">9</td>
    <td>����������� ������� ������������ � �������� ��������� ������</td>
    <td width="30">&nbsp;</td>
    <td width="30">29</td>
    <td>���������� ������ �� ������ � ������� �����</td>
    <td>&nbsp;</td>
    <td width="30">51</td>
    <td>���������� ����������� ����� � ����������� ������-������� ����������� � ������� ������ ��� ����������� � �������� ������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">10</td>
    <td>���������� ��������� ��������� ������� ��� ���������, ������ � ������� ���� �����������</td>
    <td width="30">&nbsp;</td>
    <td width="30">30</td>
    <td>���������� ������� ��������� ����� � �������� ��������� ��������� � ������ �����</td>
    <td>&nbsp;</td>
    <td width="30">52</td>
    <td>����������� ������-�������� ������������ �������� ����������� ����������� ������ ������� ��������� ���������� � �����</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">11</td>
    <td>������������ � ����� �������������� ������� ��������������� ���������� ������� �����������</td>
    <td width="30">&nbsp;</td>
    <td width="30">31</td>
    <td>��������� ��� �� ������������ �������� � ������������ � ������������</td>
    <td>&nbsp;</td>
    <td width="30">53</td>
    <td>������������ ��������� ������������� ������� ��������� ������������� �����������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>II. ������� ����������</strong></td>
    <td colspan="3"><strong>VI. ��������� � ��� �������</strong></td>
    <td width="30">54</td>
    <td>��������� ������������ ������� ���������� ������� ������������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">12</td>
    <td>����������������� ��������� �������� ����������. ��������� ��������� ������ ��� �������� �������� ������</td>
    <td width="30">&nbsp;</td>
    <td width="30"><p>32</p></td>
    <td>������������ ���������� ������������ ������� � ������������ ����� ������������ ������� ������������� �����������</td>
    <td>&nbsp;</td>
    <td width="30">55</td>
    <td>������� ����� ��������� ���������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">13</td>
    <td>���������� ����������������� �������� �������� ������ � ���������� �������� ���������� �� ������������ ��������� ��� ���������� ���������</td>
    <td width="30">&nbsp;</td>
    <td width="30">33</td>
    <td>���������� ���������� � ������������ ������� � ������� �������</td>
    <td>&nbsp;</td>
    <td width="30">56</td>
    <td>������� �� ����� ���� ��������������� ������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">14</td>
    <td>���������� ���������� ���������� �������� ���������� ����� � ������� ����������</td>
    <td width="30">&nbsp;</td>
    <td width="30">34</td>
    <td>����������������� �������� ��������� � ��������� ���������� �������</td>
    <td>&nbsp;</td>
    <td width="30">57</td>
    <td>������� �������������, ��������������� ������������� �����������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">15</td>
    <td>���������� ����������� � ������ ������������� ������� ��������� ������� ������� � ������� �������� ���������</td>
    <td width="30">&nbsp;</td>
    <td width="30">35</td>
    <td>������������� ������� ������� ������������ �������, ���������� �� ����. ������������ ������� �������� ������������� �����������</td>
    <td>&nbsp;</td>
    <td width="30">58</td>
    <td>�������� ��������� �������� � ���������, ��������� ������, �������������� �������, �������, ������������� � ����������� �������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">16</td>
    <td>���������� ������ ���������� ����������, ������ � ������ �������� � ������� ��������� � ������� ������� </td>
    <td width="30">&nbsp;</td>
    <td width="30">36</td>
    <td>������������ ������ ������ ���� ��������� �������</td>
    <td>&nbsp;</td>
    <td width="30">59</td>
    <td>����������������� ���������� ����������� �������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">17</td>
    <td>���������� ���������, �������������� ������� �������� ������, �� ��������������� ������������</td>
    <td width="30">&nbsp;</td>
    <td colspan="3"><strong>VII. ������ �������� �����������</strong></td>
    <td width="30">60</td>
    <td>������� ����������� ������������� ���������, ���������� ������������� �����������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>III. ������� �������� �������</strong></td>
    <td width="30">37</td>
    <td>������� ������ ������� ���� � ������������ � ������������</td>
    <td>&nbsp;</td>
    <td width="30">61</td>
    <td>������������ ������������ ����������� �������� �� ������� ���������� ���������� �� ������� ����� ���������� ������� (�������-��������) ������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">18</td>
    <td>������������ ��������� ��������� � �������� ������������ ������������� �����������</td>
    <td width="30">&nbsp;</td>
    <td width="30">38</td>
    <td>���������� �������������� ��������� ��� ��������, �������������� ���������� � ����� ��������. ������������ ������ ������ � ������� ����� ��������� ������ ������������� �����������</td>
    <td>&nbsp;</td>
    <td width="30">62</td>
    <td>����������������� ��������� ��������� ������, ������� � ��������� �������-��������� ��������� ������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">19</td>
    <td>���������� ���������� ������������� �������� ��������</td>
    <td width="30">&nbsp;</td>
    <td width="30">39</td>
    <td>������������ ����� ���������������� ��������� ������, �������� ������� ������ � ������ �������� ������</td>
    <td>&nbsp;</td>
    <td width="30">63</td>
    <td>����������������� ���������� ������� � ��������� ���� � ���������� ������������� ��������� ����</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">20</td>
    <td>����������������� � ����� ������ �������� ����������</td>
    <td width="30">&nbsp;</td>
    <td width="30">40</td>
    <td>���������� ������ �� �������� ������ � ���� ������� ������������� ����������������</td>
    <td>&nbsp;</td>
    <td width="30">64</td>
    <td>������������ ������������ ����� � ������� ��������� ������</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="30">21</td>
    <td>������������ ����� ����������� � ���� ����� ��� ������������� �����������</td>
    <td width="30">&nbsp;</td>
    <td width="30">41</td>
    <td>����������������� ������ ������ ������, ������, ���������� ����������� � ����������� ��������� �������, ���������� �������� � ������ ��������� ������, ��������������� ����������</td>
    <td>&nbsp;</td>
    <td width="30">65</td>
    <td>��������� ��������������� ��������������� ������ � ������������ � ������������</td>
    <td>&nbsp;</td>
  </tr>
  </tbody>
  </table>
  <table border="1" style="border: 0; border-spacing: 0px;font-size: 11px;width: 100%;">
  <tbody>
  <tr>
    <td colspan="9" align="right" style="
    border: 0;
">�������� �������</td>
  </tr>
  <tr>
    <td colspan="9" align="center" style="
    border: 0;
"><strong>���������� ����������������</strong></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>���������, �� ������� ����������� ��������������</strong></td>
    <td colspan="3" rowspan="2" align="center"><strong>����� ��������������� �����</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>������ �������</strong></td>
    <td align="center"><strong>��������� ��������</strong></td>
    <td align="center"><strong>������� �������</strong></td>
    <td colspan="3" align="center"><strong>������������ ���������</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" style="
    border: 0;
"><strong>������������� ����������</strong></td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>������� �������� (����, ������, �������)</strong></td>
    <td colspan="4" align="center"><strong>���������� �������������� ���������� (� ��������� ������������ ���������)</strong></td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="3" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"><strong>����������</strong></td>
  </tr>
  <tr>
    <td colspan="9" style="
    height: 40px;
">&nbsp;</td>
  </tr>
  
  
  <tr style="
">
    <td colspan="9" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9" align="center"> <strong>������ ������������� ��������</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>����� ��� ��������:</strong></td>
    <td colspan="2"><? echo ($eaid[mbn]);?></td>
    <td colspan="2"><strong>����������� ������������ �����:</strong></td>
    <td colspan="3"><? echo ($eaid[rmm]);?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>��� �������:</strong></td>
    <td colspan="2"><? echo ($oil); ?></td>
    <td colspan="2"><strong>������ ��:</strong></td>
    <td colspan="3"><? echo ($eaid[run]);?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>��� ��������� �������:</strong></td>
    <td colspan="2"><? echo ($breaks); ?></td>
    <td colspan="5" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>����� ���:</strong></td>
    <td colspan="2"><? echo ($eaid[tyres]);?></td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>���������� � �����������/������������� ������������ ������������� ��������</strong></td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td>��������</td>
    <td colspan="2">����������</td>
  </tr>
  <tr>
    <td colspan="2">Results of the roadworthiness inspection</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td> Passed</td>
    <td colspan="2">Failed</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>������ ��������������� �����, ��������� ��������� ��������:</strong></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr style="
    height: 40px;
">
    <td colspan="6">&nbsp;</td>
    
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>����: </strong></td>
    <td colspan="4"><? echo ($eaid[ddate]);?></td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>�.�.�. ������������ ��������</strong></td>
    <td colspan="4">�������  �.�.</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>�������</strong></td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td colspan="3"><strong>������</strong></td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Signature</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td colspan="3">Stamp</td>
    <td style="
    border: 0;
">&nbsp;</td>
    <td style="
    border: 0;
">&nbsp;</td>
  </tr>
</tbody></table>


</body></html>