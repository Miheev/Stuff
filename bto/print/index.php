<?
session_start();
header('Content-type: text/html; charset=utf-8');
$ROOT = $_SERVER['DOCUMENT_ROOT'];
require($ROOT.'/functions.php');
//require($ROOT.'/mpdf/mpdf.php');
require($ROOT."/pdf/dompdf/dompdf_config.inc.php");

$DB = new DB;
$DB->init();

$DB->checkValidUser($_SESSION);

$U = $DB->getUserByEmail($_SESSION["appl"]);

$eaid=$_REQUEST["id"];

$DB->printTSList($U["ID"] , $eaid);

if($U["ID"] != $eaid["owner"] AND $U["ID"] != 1) {
    header ("location: /");
}


switch ($eaid["cat"]):
    case 'M1':
    case 'N1': $cat = 'Категория B ('.$i["cat"].')'; break;
    case 'N2':
    case 'N3': $cat = 'Категория C ('.$i["cat"].')'; break;
    case 'M2':
    case 'M3': $cat = 'Категория D ('.$i["cat"].')'; break;
    case 'O1':
    case 'O2':
    case 'O3':
    case 'O4': $cat = 'Категория E ('.$i["cat"].')'; break;
endswitch;
switch ($eaid["doc"]):
    case 'pts': $doc= 'ПТС'; break;
    case 'srts': $doc= 'СРТС'; break;
endswitch;
switch ($eaid["oil"]):
    case 'b': $oil= 'Бензин'; break;
    case 'd': $oil= 'Дизельное топливо'; break;
    case 's': $oil= 'Сжатый газ'; break;
    case 'g': $oil= 'Сжиженый газ'; break;
    case 'o': $oil= 'Без топлива'; break;
endswitch;
switch ($eaid["breaks"]):
    case 'g': $breaks= 'Гидравлический'; break;
    case 'p': $breaks= 'Пневматический'; break;
    case 'm': $breaks= 'Механический'; break;
    case 'k': $breaks= 'Комбинированный'; break;
    case 'o': $breaks= 'Отсутствует'; break;
endswitch;


$tmp= $DB->getParamByCat($eaid["cat"]);
if (!empty($tmp))
    $topar=$tmp['list'];
else
    $topar='';

function par_out($pos) {
    global $topar;
    $id= strpos($topar, ','.$pos.',');
    if ($id !== false) {
        $topar= str_replace(','.$pos.',', ',', $topar);
        return '+';
    }
    return '-';
}

$eaisto= $eaid['eaisto'];
$unt= $eaid['unt'];
$unt= str_replace('.', '', $unt);
$unt_char= str_split($unt);
$gnum= $eaid['gnum'];
$model= $eaid['model'];
$mark= $eaid['mark'];
$rama= $eaid['rama'];
$vin= $eaid['vin'];
$year= $eaid['year'];
$kuz= $eaid['kuz'];
$ser= $eaid['ser'];
$num= $eaid['num'];
$data= $eaid['data'];
$buywho= $eaid['bywho'];
$data_buy_who= $data.' '.$buywho;
$mbn= $eaid['mbn'];
$rmm= $eaid['rmm'];
$run= $eaid['run'];
$tures= $eaid['turns'];
$ddata= $eaid['ddata'];
$ddata_char= str_split($ddata);

$hhh= 10;
$pars= array(20,203,243,223);

$cross_img= dirname(__FILE__) . DIRECTORY_SEPARATOR . 'passed.jpg';

$html="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'><head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Документ без названия</title>
    <style type='text/css'>
        /*table {width: 100% !important;}*/
        /*table {width: 750px !important; vertical-align: top !important;}*/
        /*tr {width: 100% !important;}*/
        /*td {width: auto !important;}*/
        /*td {height: auto !important;}*/

        body { vertical-align: top;}
        td+td {border-left: none !important;}
        td {border-top: none !important;}
        .td-top {border-top: 1px solid black !important;}
        .table-list td {padding-top: 2px; padding-bottom: 2px}
        .table-list2 td {padding-top: 2px; padding-bottom: 2px}
        .td-date {padding-left: 2px; padding-right: 2px;}

        @page {
            margin: 0.5cm 1cm 0.5cm 1cm;
        }


    </style>
</head>

<body>

<table border='1' style='border: 0; border-spacing: 0px;width: 100%;font-size: 10px; vertical-align: top;'>
    <tbody>
    <tr><td  colspan='730'  align='right' style='border: 0; text-align: right'>Лицевая сторона</td></tr>
    <tr><td align='center'  colspan='730' style='    border: 0; font-size: 16px;'>
    <div><strong>Диагностическая карта</strong></div>
    <div><strong>Certificate of periodic technical inspection</strong></div>
    </td></tr>
    <tr>
        <td align='center'  colspan='500' style='    border: 0; font-size: 14px;'><strong>Регистрационный номер</strong></td>
        <td align='left'  colspan='200' style='    border: 0; font-size: 14px; padding-left: 30px;'><strong>Срок действия до</strong></td>
    </tr>
    <tr>
        <td colspan='50' style='border: 0; '></td>
        <td colspan='350' align='center' style='border-left: 1px solid black !important; letter-spacing: 10px;'  class='td-top'>  $eaisto </td>
        <td colspan='80' style='border: 0; '></td>

        <td colspan='30' align='center' style='border-left: 1px solid black !important;'  class='td-top'>$unt_char[0]</td>
        <td colspan='30' align='center'  class='td-top'>$unt_char[1]</td>
        <td colspan='30' align='center'  class='td-top'>$unt_char[2]</td>
        <td colspan='30' align='center'  class='td-top'>$unt_char[3]</td>
        <td colspan='30' align='center'  class='td-top'>$unt_char[4]</td>
        <td colspan='30' align='center'  class='td-top'>$unt_char[5]</td>
        <td colspan='30' align='center'  class='td-top'>$unt_char[6]</td>
        <td colspan='30' align='center'  class='td-top'>$unt_char[7]</td>

        <td  colspan='45' style='border: 0; '></td>
    </tr>
 <tr>
        <td colspan='9' style=' border: 0; '></td>
    </tr>
    <tr>
        <td colspan='250'  class='td-top'> <strong>Оператор технического осмотра/пункт технического осмотра: </strong></td>
        <td colspan='510' class='td-top'> <strong>ООО Диагностика сервис №01174, Санкт-Петербург, Приморское шоссе, д. 262</strong></td>
    </tr>
    <tr>
        <td colspan='150'><strong> Первичная проверка</strong></td>
        <td colspan='25' align='center' style='padding-left: 5px; padding-right: 5px;'>X</td>
        <td colspan='380'></td>
        <td colspan='150'><strong>Повторная проверка</strong></td>
        <td colspan='25' style='padding-left: 10px; padding-right: 10px;'></td>
    </tr>
    <tr>
        <td colspan='150'><strong>Регистрационный знак ТС:</strong></td>
        <td colspan='165'>$gnum</td>
        <td colspan='100'><strong>Марка, модель ТС:</strong></td>
        <td colspan='315'>$mark, $model</td>
    </tr>
    <tr>
        <td colspan='115'><strong>VIN:</strong></td>
        <td colspan='200'>$vin</td>
        <td colspan='100'><strong>Категория ТС:</strong></td>
        <td colspan='315'>$cat</td>
    </tr>
    <tr>
        <td colspan='115'><strong>Номер рамы:</strong></td>
        <td colspan='200'>$rama</td>
        <td colspan='100' rowspan='2'><strong>Год выпуска ТС:</strong></td>
        <td colspan='315' rowspan='2'>$year</td>
    </tr>
    <tr>
        <td colspan='115'><strong>Номер кузова:</strong></td>
        <td colspan='200'>$kuz</td>
    </tr>
    <tr>
        <td colspan='210'><strong>СРТС или ПТС (серия, номер, выдан кем, когда):</strong></td>
        <td colspan='550'>$doc   Серия: $ser  Номер: $num Выдан: $data_buy_who</td>
    </tr>
    <tr>
        <td colspan='9' style='
    border: 0;
'></td>
    </tr>
    </tbody>
</table>

<table border='1' class='table-list' style='border: 0; border-spacing: 0px;font-size: 8px;line-height: 7px; width: 100%; text-align: center; padding-top:5px;'>

<tbody>
<tr>
    <td colspan='".$pars[0]."'   class='td-top'><strong>№</strong></td>
    <td colspan='".$pars[3]."'  class='td-top'><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
    <td colspan='".$pars[0]."'   class='td-top'><strong>№</strong></td>
    <td colspan='".$pars[3]."'  class='td-top'><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
    <td colspan='".$pars[0]."'   class='td-top'><strong>№</strong></td>
    <td colspan='".$pars[3]."'  class='td-top'><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
</tr>
<tr>
    <td colspan='".$pars[2]."'><strong>I.Тормозные системы</strong></td>
    <td colspan='".$pars[0]."'>22</td>
    <td colspan='".$pars[1]."'>Наличие и расположение фар и сигнальных фонарей в местах, предусмотренных конструкцией</td>
    <td colspan='".$pars[0]."'>".par_out(22)."</td>
    <td colspan='".$pars[0]."'>42</td>
    <td colspan='".$pars[1]."'>Работоспособность запоров бортов грузовой платформы и запоров горловин цистерн</td>
    <td colspan='".$pars[0]."'>".par_out(42)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>1</td>
    <td colspan='".$pars[1]."'>Соответствие показателей эффективности торможения и устойчивости торможения</td>
    <td colspan='".$pars[0]."'>".par_out(1)."</td>
    <td colspan='".$pars[2]."'><strong>IV. Стеклоочистители и стеклоомыватели</strong></td>
    <td colspan='".$pars[0]."'>43</td>
    <td colspan='".$pars[1]."'>Работоспособность аварийного выключателя дверей и сигнала требования остановки</td>
    <td colspan='".$pars[0]."'>".par_out(43)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>2</td>
    <td colspan='".$pars[1]."'>Соответствие разности тормозных сил установленным требованиям </td>
    <td colspan='".$pars[0]."'>".par_out(2)."</td>
    <td colspan='".$pars[0]."'>23</td>
    <td colspan='".$pars[1]."'>Наличие стеклоочистителя и форсунки стеклоомывателя ветрового стекла</td>
    <td colspan='".$pars[0]."'>".par_out(23)."</td>
    <td colspan='".$pars[0]."'>44</td>
    <td colspan='".$pars[1]."'>Работоспособность аварийных выходов, приборов внутреннего освещения салона, привода управления дверями и сигнализации их работы</td>
    <td colspan='".$pars[0]."'>".par_out(44)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>3</td>
    <td colspan='".$pars[1]."'>Работоспособность рабочей тормозной системы автопоездов с пневматическим тормозным приводом в режиме аварийного (автоматического) торможения </td>
    <td colspan='".$pars[0]."'>".par_out(3)."</td>
    <td colspan='".$pars[0]."'>24</td>
    <td colspan='".$pars[1]."'>Обеспечение стеклоомывателем подачи жидкости в зоны очистки стекла</td>
    <td colspan='".$pars[0]."'>".par_out(24)."</td>
    <td colspan='".$pars[0]."'>45</td>
    <td colspan='".$pars[1]."'>Наличие работоспособного звукового сигнального прибора</td>
    <td colspan='".$pars[0]."'>".par_out(45)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>4</td>
    <td colspan='".$pars[1]."'>Отсутствие утечек сжатого воздуха из колесных тормозных камер</td>
    <td colspan='".$pars[0]."'>".par_out(4)."</td>
    <td colspan='".$pars[0]."'>25</td>
    <td colspan='".$pars[1]."'>Работоспособность стеклоочистителей и стеклоомывателей</td>
    <td colspan='".$pars[0]."'>".par_out(25)."</td>
    <td colspan='".$pars[0]."'>46</td>
    <td colspan='".$pars[1]."'>Наличие обозначений аварийных выходов и табличек по правилам их использования. Обеспечение свободного доступа к аварийным выходам</td>
    <td colspan='".$pars[0]."'>".par_out(46)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>5</td>
    <td colspan='".$pars[1]."'>Отсутствие подтеканий тормозной жидкости, нарушения герметичности трубопроводов или соединений в гидравлическом тормозном приводе</td>
    <td colspan='".$pars[0]."'>".par_out(5)."</td>
    <td colspan='".$pars[2]."'><strong>V. Шины и колеса</strong></td>
    <td colspan='".$pars[0]."'>47</td>
    <td colspan='".$pars[1]."'>Наличие задних и боковых защитных устройств, соответствие их нормам</td>
    <td colspan='".$pars[0]."'>".par_out(47)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>6</td>
    <td colspan='".$pars[1]."'>Отсутствие коррозии, грозящей потерей герметичности или разрушением</td>
    <td colspan='".$pars[0]."'>".par_out(6)."</td>
    <td colspan='".$pars[0]."'>26</td>
    <td colspan='".$pars[1]."'>Соответствие высоты рисунка протектора шин установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(26)."</td>
    <td colspan='".$pars[0]."'>48</td>
    <td colspan='".$pars[1]."'>Работоспособность автоматического замка, ручной и автоматической блокировки седельно-сцепного устройства. Отсутствие видимых повреждений сцепных устройств</td>
    <td colspan='".$pars[0]."'>".par_out(48)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>7</td>
    <td colspan='".$pars[1]."'>Отсутствие механических повреждений тормозных трубопроводов</td>
    <td colspan='".$pars[0]."'>".par_out(7)."</td>
    <td colspan='".$pars[0]."'>27</td>
    <td colspan='".$pars[1]."'>Отсутствие признаков непригодности шин к эксплуатации</td>
    <td colspan='".$pars[0]."'>".par_out(27)."</td>
    <td colspan='".$pars[0]."'>49</td>
    <td colspan='".$pars[1]."'>Наличие работоспособных предохранительных приспособлений у одноосных прицепов (за исключением роспусков) и прицепов, не оборудованных рабочей тормозной системой </td>
    <td colspan='".$pars[0]."'>".par_out(49)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>8</td>
    <td colspan='".$pars[1]."'>Отсутствие трещин остаточной деформации деталей тормозного привода</td>
    <td colspan='".$pars[0]."'>".par_out(8)."</td>
    <td colspan='".$pars[0]."'>28</td>
    <td colspan='".$pars[1]."'>Наличие всех болтов или гаек крепления дисков и ободьев колес</td>
    <td colspan='".$pars[0]."'>".par_out(28)."</td>
    <td colspan='".$pars[0]."'>50</td>
    <td colspan='".$pars[1]."'>Оборудование прицепов (за исключением одноосных и роспусков) исправным устройством, поддерживающим сцепную петлю дышла в положении, облегчающем сцепку и расцепку с тяговым автомобилем</td>
    <td colspan='".$pars[0]."'>".par_out(50)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>9</td>
    <td colspan='".$pars[1]."'>Исправность средств сигнализации и контроля тормозных систем</td>
    <td colspan='".$pars[0]."'>".par_out(9)."</td>
    <td colspan='".$pars[0]."'>29</td>
    <td colspan='".$pars[1]."'>Отсутствие трещин на дисках и ободьях колес</td>
    <td colspan='".$pars[0]."'>".par_out(29)."</td>
    <td colspan='".$pars[0]."'>51</td>
    <td colspan='".$pars[1]."'>Отсутствие продольного люфта в беззазорных тягово-сцепных устройствах с тяговой вилкой для сцепленного с прицепом тягача</td>
    <td colspan='".$pars[0]."'>".par_out(51)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>10</td>
    <td colspan='".$pars[1]."'>Отсутствие набухания тормозных шлангов под давлением, трещин и видимых мест перетирания</td>
    <td colspan='".$pars[0]."'>".par_out(10)."</td>
    <td colspan='".$pars[0]."'>30</td>
    <td colspan='".$pars[1]."'>Отсутствие видимых нарушений формы и размеров крепежных отверстий в дисках колес</td>
    <td colspan='".$pars[0]."'>".par_out(30)."</td>
    <td colspan='".$pars[0]."'>52</td>
    <td colspan='".$pars[1]."'>Обеспечение тягово-сцепными устройствами легковых автомобилей беззазорной сцепки сухарей замкового устройства с шаром</td>
    <td colspan='".$pars[0]."'>".par_out(52)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>11</td>
    <td colspan='".$pars[1]."'>Расположение и длина соединительных шлангов пневматического тормозного привода автопоездов</td>
    <td colspan='".$pars[0]."'>".par_out(11)."</td>
    <td colspan='".$pars[0]."'>31</td>
    <td colspan='".$pars[1]."'>Установка шин на транспортное средство в соответствии с требованиями</td>
    <td colspan='".$pars[0]."'>".par_out(31)."</td>
    <td colspan='".$pars[0]."'>53</td>
    <td colspan='".$pars[1]."'>Соответствие размерных характеристик сцепных устройств установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(53)."</td>
</tr>
<tr>
    <td colspan='".$pars[2]."'><strong>II. Рулевое управление</strong></td>
    <td colspan='".$pars[2]."'><strong>VI. Двигатель и его системы</strong></td>
    <td colspan='".$pars[0]."'>54</td>
    <td colspan='".$pars[1]."'>Оснащение транспортных средств исправными ремнями безопасности</td>
    <td colspan='".$pars[0]."'>".par_out(54)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>12</td>
    <td colspan='".$pars[1]."'>Работоспособность усилителя рулевого управления. Плавность изменения усилия при повороте рулевого колеса</td>
    <td colspan='".$pars[0]."'>".par_out(12)."</td>
    <td colspan='".$pars[0]."'><p>32</p></td>
    <td colspan='".$pars[1]."'>Соответствие содержания загрязняющих веществ в отработавших газах транспортных средств установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(32)."</td>
    <td colspan='".$pars[0]."'>55</td>
    <td colspan='".$pars[1]."'>Наличие знака аварийной остановки</td>
    <td colspan='".$pars[0]."'>".par_out(55)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>13</td>
    <td colspan='".$pars[1]."'>Отсутствие самопроизвольного поворота рулевого колеса с усилителем рулевого управления от нейтрального положения при работающем двигателе</td>
    <td colspan='".$pars[0]."'>".par_out(13)."</td>
    <td colspan='".$pars[0]."'>33</td>
    <td colspan='".$pars[1]."'>Отсутствие подтекания и каплепадения топлива в системе питания</td>
    <td colspan='".$pars[0]."'>".par_out(33)."</td>
    <td colspan='".$pars[0]."'>56</td>
    <td colspan='".$pars[1]."'>Наличие не менее двух противооткатных упоров</td>
    <td colspan='".$pars[0]."'>".par_out(56)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>14</td>
    <td colspan='".$pars[1]."'>Отсутствие превышения предельных значений суммарного люфта в рулевом управлении</td>
    <td colspan='".$pars[0]."'>".par_out(14)."</td>
    <td colspan='".$pars[0]."'>34</td>
    <td colspan='".$pars[1]."'>Работоспособность запорных устройств и устройств перекрытия топлива</td>
    <td colspan='".$pars[0]."'>".par_out(34)."</td>
    <td colspan='".$pars[0]."'>57</td>
    <td colspan='".$pars[1]."'>Наличие огнетушителей, соответствующих установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(57)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>15</td>
    <td colspan='".$pars[1]."'>Отсутствие повреждения и полная комплектность деталей крепления рулевой колонки и картера рулевого механизма</td>
    <td colspan='".$pars[0]."'>".par_out(15)."</td>
    <td colspan='".$pars[0]."'>35</td>
    <td colspan='".$pars[1]."'>Герметичность системы питания транспортных средств, работающих на газе. Соответствие газовых баллонов установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(35)."</td>
    <td colspan='".$pars[0]."'>58</td>
    <td colspan='".$pars[1]."'>Надежное крепление поручней в автобусах, запасного колеса, аккумуляторной батареи, сидений, огнетушителей и медицинской аптечки</td>
    <td colspan='".$pars[0]."'>".par_out(58)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>16</td>
    <td colspan='".$pars[1]."'>Отсутствие следов остаточной деформации, трещин и других дефектов в рулевом механизме и рулевом приводе </td>
    <td colspan='".$pars[0]."'>".par_out(16)."</td>
    <td colspan='".$pars[0]."'>36</td>
    <td colspan='".$pars[1]."'>Соответствие нормам уровня шума выпускной системы</td>
    <td colspan='".$pars[0]."'>".par_out(36)."</td>
    <td colspan='".$pars[0]."'>59</td>
    <td colspan='".$pars[1]."'>Работоспособность механизмов регулировки сидений</td>
    <td colspan='".$pars[0]."'>".par_out(59)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>17</td>
    <td colspan='".$pars[1]."'>Отсутствие устройств, ограничивающих поворот рулевого колеса, не предусмотренных конструкцией</td>
    <td colspan='".$pars[0]."'>".par_out(17)."</td>
    <td colspan='".$pars[2]."'><strong>VII. Прочие элементы конструкции</strong></td>
    <td colspan='".$pars[0]."'>60</td>
    <td colspan='".$pars[1]."'>Наличие надколесных грязезащитных устройств, отвечающих установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(60)."</td>
</tr>
<tr>
    <td colspan='".$pars[2]."'><strong>III. Внешние световые приборы</strong></td>
    <td colspan='".$pars[0]."'>37</td>
    <td colspan='".$pars[1]."'>Наличие зеркал заднего вида в соответствии с требованиями</td>
    <td colspan='".$pars[0]."'>".par_out(37)."</td>
    <td colspan='".$pars[0]."'>61</td>
    <td colspan='".$pars[1]."'>Соответствие вертикальной статической нагрузки на тяговое устройство автомобиля от сцепной петли одноосного прицепа (прицепа-роспуска) нормам</td>
    <td colspan='".$pars[0]."'>".par_out(61)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>18</td>
    <td colspan='".$pars[1]."'>Соответствие устройств освещения и световой сигнализации установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(18)."</td>
    <td colspan='".$pars[0]."'>38</td>
    <td colspan='".$pars[1]."'>Отсутствие дополнительных предметов или покрытий, ограничивающих обзорность с места водителя. Соответствие полосы пленки в верхней части ветрового стекла установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(38)."</td>
    <td colspan='".$pars[0]."'>62</td>
    <td colspan='".$pars[1]."'>Работоспособность держателя запасного колеса, лебедки и механизма подъема-опускания запасного колеса</td>
    <td colspan='".$pars[0]."'>".par_out(62)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>19</td>
    <td colspan='".$pars[1]."'>Отсутствие разрушений рассеивателей световых приборов</td>
    <td colspan='".$pars[0]."'>".par_out(19)."</td>
    <td colspan='".$pars[0]."'>39</td>
    <td colspan='".$pars[1]."'>Соответствие норме светопропускания ветрового стекла, передних боковых стекол и стекол передних дверей</td>
    <td colspan='".$pars[0]."'>".par_out(39)."</td>
    <td colspan='".$pars[0]."'>63</td>
    <td colspan='".$pars[1]."'>Работоспособность механизмов подъема и опускания опор и фиксаторов транспортного положения опор</td>
    <td colspan='".$pars[0]."'>".par_out(63)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>20</td>
    <td colspan='".$pars[1]."'>Работоспособность и режим работы сигналов торможения</td>
    <td colspan='".$pars[0]."'>".par_out(30)."</td>
    <td colspan='".$pars[0]."'>40</td>
    <td colspan='".$pars[1]."'>Отсутствие трещин на ветровом стекле в зоне очистки водительского стеклоочистителя</td>
    <td colspan='".$pars[0]."'>".par_out(40)."</td>
    <td colspan='".$pars[0]."'>64</td>
    <td colspan='".$pars[1]."'>Соответствие каплепадения масел и рабочих жидкостей нормам</td>
    <td colspan='".$pars[0]."'>".par_out(64)."</td>
</tr>
<tr>
    <td colspan='".$pars[0]."'>21</td>
    <td colspan='".$pars[1]."'>Соответствие углов регулировки и силы света фар установленным требованиям</td>
    <td colspan='".$pars[0]."'>".par_out(21)."</td>
    <td colspan='".$pars[0]."'>41</td>
    <td colspan='".$pars[1]."'>Работоспособность замков дверей кузова, кабины, механизмов регулировки и фиксирующих устройств сидений, устройства обогрева и обдува ветрового стекла, противоугонного устройства</td>
    <td colspan='".$pars[0]."'>".par_out(41)."</td>
    <td colspan='".$pars[0]."'>65</td>
    <td colspan='".$pars[1]."'>Установка государственных регистрационных знаков в соответствии с требованиями</td>
    <td colspan='".$pars[0]."'>".par_out(65)."</td>
</tr>
</tbody>
</table>

<table border='1' style='border: 0; border-spacing: 0px;font-size: 12px;width: 100%; padding-top:50px;'>
    <tbody>
    <tr><td colspan='730' align='right' style='border: 0;'></td></tr>
   <tr><td  colspan='730'  align='right' style='border: 0; text-align: right'>Обратная сторона</td></tr>

    <tr>
        <td colspan='730'  align='center' style='border: 0; text-align: center; width: 100%; font-size: 14px;'>
            <strong>Результаты диагностирования</strong></td>
    </tr>
    <tr>
        <td colspan='580' align='center' class='td-top'><strong>Параметры, по которым установлено несоответствие</strong></td>
        <td colspan='150' rowspan='2' align='center' class='td-top'><strong>Пункт диагностической карты</strong></td>
    </tr>
    <tr>
        <td colspan='60' align='center' style='padding-top: 2px; padding-bottom: 2px;'><strong>Нижняя граница</strong></td>
        <td colspan='180' align='center' style='padding-top: 2px; padding-bottom: 2px;'><strong>Результат проверки</strong></td>
        <td colspan='60' align='center' style='padding-top: 2px; padding-bottom: 2px;'><strong>Верхняя граница</strong></td>
        <td colspan='280' align='center'><strong>Наименование параметра</strong></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center' style='padding-top: 2px;'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='180' height='$hhh' align='center'></td>
        <td colspan='60' height='$hhh' align='center'></td>
        <td colspan='280' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>



    <tr>
        <td colspan='580' align='center' style='border-left: none;'>
            <strong>Невыполненные требования</strong></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' align='center'><strong>Предмет проверки (узел, деталь, агрегат)</strong></td>
        <td colspan='340' align='center'><strong>Содержание невыполненного требования (с указанием нормативного источника)</strong></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='240' height='$hhh' align='center'></td>
        <td colspan='340' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center' style='border-top:0;'></td>
    </tr>

    <tr>
        <td colspan='730' style='
    border: 0;
'><strong>Примечания</strong></td>
    </tr>
    <tr>
        <td colspan='730' style='
    height: 60px;
' class='td-top'></td>
    </tr>
    <tr>
        <td colspan='730' style='border: none;'></td>
    </tr>
    </tbody></table>

<table border='1' style='border: 0; border-spacing: 0px;font-size: 12px;width: 100%;'>
    <tbody>
    <tr>
        <td colspan='730' align='center' style='font-size: 14px; margin-bottom: none !important;' class='td-top'> <strong>Данные транспортного средства</strong></td>
    </tr>
    <tr>
        <td colspan='230' style='border-right: none;'><strong>Масса без нагрузки:</strong></td>
        <td colspan='135' style='border-left: none;'> $mbn</td>
        <td colspan='290' style='border-right: none;'><strong>Разрешенная максимальная масса:</strong></td>
        <td colspan='75' style='border-left: none;'> $rmm</td>
    </tr>
    <tr>
        <td colspan='230' style='border-right: none;'><strong>Тип топлива:</strong></td>
        <td colspan='135' style='border-left: none;'> $oil</td>
        <td colspan='290' style='border-right: none;'><strong>Пробег ТС:</strong></td>
        <td colspan='75' style='border-left: none;'> $run</td>
    </tr>
    <tr>
        <td colspan='230' style='border-right: none;'><strong>Тип тормозной системы:</strong></td>
        <td colspan='135' style='border-left: none;'> $breaks</td>
        <td colspan='365' rowspan='2'></td>
    </tr>
    <tr>
        <td colspan='230' style='border-right: none;'><strong>Марка шин:</strong></td>
        <td colspan='135' style='border-left: none;'> $tures</td>
    </tr>


    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr>
        <td colspan='300' align='center' style='border-bottom: none;' class='td-top'>
            <div><strong>Заключение о возможности/невозможности эксплуатации транспортного средства</strong></div>
        </td>
        <td colspan='150' style='border: 0;' class='td-top'></td>
        <td colspan='280' border='0' align='right' class='td-top' style='border-right: 1px solid black !important; border-bottom: none !important;'>
            <img src='$cross_img' alt='' style='width: 300px; height: 35px; padding: 0 !important; margin: 0 !important' />
        </td>
        <!--<td colspan='65' align='center' style='border-left: 1px solid black !important;' class='td-top'>
            <div>Возможно</div><div><em>Passed</em></div>
        </td>
        <td colspan='65' align='center' border='0'  class='td-top' style='padding: 0 !important; margin: 0 !important;'>
            <div style='padding: 0 !important; margin: 0 !important'>
                <div style='/*position: relative; z-index: 3;*/'>Невозможно</div><div><em>Failed</em></div>
            </div>
        </td>-->
    </tr>
        <tr>
        <td colspan='300' align='center'  style='border-top: none;'>
            <div><em>Results of the roadworthiness inspection</em></div>
        </td>
        <td colspan='430' style='border: 0; border-right: 1px solid black; border-bottom: 1px solid black;'></td>
    </tr>

    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr>
        <td colspan='530' height='75' align='center' style='vertical-align:top; text-align: center; padding-right: 50px; padding-left: 50px;' class='td-top'><strong>Пункты диагностической карты, требующие повторной проверки:</strong></td>
        <td colspan='300' height='75' class='td-top'></td>
    </tr>
    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr><td colspan='730' height='0' style='border-bottom: none; padding: 0;' class='td-top'></td></tr>
    <tr>
        <td colspan='40' align='center' style='border: 0; border-left: 1px solid black !important; padding-bottom: 5px; padding-left: 10px;'><strong>Дата: </strong></td>

        <td colspan='25' align='center' style='border-left: 1px solid black !important;'  class='td-top td-date'>$ddata_char[0]</td>
        <td colspan='25' align='center' class='td-top td-date'>$ddata_char[1]</td>
        <td colspan='25' align='center' class='td-top td-date'>$ddata_char[2]</td>
        <td colspan='25' align='center' class='td-top td-date'>$ddata_char[3]</td>
        <td colspan='25' align='center' class='td-top td-date'>$ddata_char[4]</td>
        <td colspan='25' align='center' class='td-top td-date'>$ddata_char[5]</td>
        <td colspan='25' align='center' class='td-top td-date'>$ddata_char[6]</td>
        <td colspan='25' align='center' class='td-top td-date'>$ddata_char[7]</td>
        <td colspan='490' style='border: 0; border-right: 1px solid black !important;'></td>
    </tr>
    <tr>
        <td colspan='200' style='border: 0;  border-left: 1px solid black !important;  padding-bottom: 10px; padding-left: 10px;'><strong>Ф.И.О. технического эксперта</strong></td>
        <td colspan='100' style='border: 0;  padding-bottom: 10px;'>Абутова  В.Б.</td>
        <td colspan='430' style='border: 0; border-right: 1px solid black !important;   padding-bottom: 10px;'></td>
    </tr>
    <tr>
        <td colspan='350' style='border: 0; border-left: 1px solid black !important; '><strong>Подпись</strong></td>
        <td colspan='380' style='border: 0;  border-right: 1px solid black !important;  '><strong>Печать</strong></td>
    </tr>
    <tr>
        <td colspan='350' style='border: 0;  border-left: 1px solid black !important; padding-left: 10px;'><em>Signature</em></td>
        <td colspan='380' style='border: 0;  border-right: 1px solid black !important; padding-left: 10px;'><em>Stamp</em></td>
    </tr>
    <tr><td colspan='730' style='border-top: none; padding-bottom: 5px;'></td></tr>

    </tbody></table>
</body></html>

";

//echo $html;

//$mpdf = new mPDF('utf-8', 'A4', '8', '', 5, 5, 5, 5, 5, 5); /*задаем формат, отступы и.т.д.*/
//$mpdf->charset_in = 'utf-8'; /*не забываем про русский*/
//$stylesheet = file_get_contents($ROOT.'/print/index.css'); /*подключаем css*/
//$mpdf->WriteHTML($stylesheet, 1);
//$mpdf->list_indent_first_level = 0;
//$mpdf->WriteHTML($html, 2); /*формируем pdf*/
//$mpdf->Output('mpdf.pdf', 'I');

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('bto_to.pdf'); // Выводим результат (скачивание)
$output = $dompdf->output();
?>