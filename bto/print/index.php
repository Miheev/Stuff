<?
session_start(); //Kasahara Yuri feat Tarantula  //Abingdon Boys School
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

$hhh= 10;

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

    </style>
</head>

<body>

<table border='1' style='border: 0; border-spacing: 0px;width: 100%;font-size: 11px;'>
    <tbody><tr>
        <td colspan='9' align='center' style='border: 0;'><strong>Диагностическая карта</strong></td>
    </tr>
    <tr>
        <td colspan='9' align='center' style='border: 0;'><strong>Certificate of periodic technical inspection</strong></td>
    </tr>
    <tr>
        <td colspan='5' style='    border: 0;'><strong>Регистрационный номер</strong></td>
        <td colspan='4' style='    border: 0;'><strong>Срок действия до</strong></td>
    </tr>
    <tr>
        <td colspan='5'>  $eaisto </td>
        <td colspan='4' >   $unt </td>
    </tr>
    <tr>
        <td colspan='9' style=' border: 0; '></td>
    </tr>
    <tr>
        <td colspan='4'> <strong>Оператор технического осмотра/пункт технического осмотра: </strong></td>
        <td colspan='5'> <strong>ООО Диагностика сервис №01174, Санкт-Петербург, Приморское шоссе, д. 262</strong></td>
    </tr>
    <tr>
        <td colspan='2'><strong> Первичная проверка</strong></td>
        <td width='73'>X</td>
        <td colspan='3'></td>
        <td colspan='2'><strong>Повторная проверка</strong></td>
        <td width='7' style='
    width: 30px;
'></td>
    </tr>
    <tr>
        <td colspan='2'><strong>Регистрационный знак ТС:</strong></td>
        <td colspan='2'>$gnum</td>
        <td colspan='2'><strong>Марка, модель ТС:</strong></td>
        <td colspan='3'>$mark,$model</td>
    </tr>
    <tr>
        <td colspan='2'><strong>VIN:</strong></td>
        <td colspan='2'>$vin</td>
        <td colspan='2'><strong>Категория ТС:</strong></td>
        <td colspan='3'>$cat</td>
    </tr>
    <tr>
        <td colspan='2'><strong>Номер рамы:</strong></td>
        <td colspan='2'>$rama</td>
        <td colspan='2' rowspan='2'><strong>Год выпуска ТС:</strong></td>
        <td colspan='3' rowspan='2'>$year</td>
    </tr>
    <tr>
        <td colspan='2'><strong>Номер кузова:</strong></td>
        <td colspan='2'>$kuz</td>
    </tr>
    <tr>
        <td colspan='3'><strong>СРТС или ПТС (серия, номер, выдан кем, когда):</strong></td>
        <td colspan='6'>$doc   Серия: $ser  Номер: $num Выдан: $data_buy_who</td>
    </tr>
    <tr>
        <td colspan='9' style='
    border: 0;
'></td>
    </tr>
    </tbody>
</table>

<table border='1' style='border: 0; border-spacing: 0px;font-size: 8px;line-height: 7px; width: 745px !important'>

<tbody>
<tr>
    <td colspan='10'  ><strong>№</strong></td>
    <td colspan='240' ><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
    <td colspan='10'  ><strong>№</strong></td>
    <td colspan='240' ><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
    <td colspan='10'  ><strong>№</strong></td>
    <td colspan='240' ><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
</tr>
<tr>
    <td colspan='250'><strong>I.Тормозные системы</strong></td>
    <td colspan='10'>22</td>
    <td colspan='230'>Наличие и расположение фар и сигнальных фонарей в местах, предусмотренных конструкцией</td>
    <td colspan='10'>".par_out(22)."</td>
    <td colspan='10'>42</td>
    <td colspan='230'>Работоспособность запоров бортов грузовой платформы и запоров горловин цистерн</td>
    <td colspan='10'>".par_out(42)."</td>
</tr>
<tr>
    <td colspan='10'>1</td>
    <td colspan='230'>Соответствие показателей эффективности торможения и устойчивости торможения</td>
    <td colspan='10'>".par_out(1)."</td>
    <td colspan='250'><strong>IV. Стеклоочистители и стеклоомыватели</strong></td>
    <td colspan='10'>43</td>
    <td colspan='230'>Работоспособность аварийного выключателя дверей и сигнала требования остановки</td>
    <td colspan='10'>".par_out(43)."</td>
</tr>
<tr>
    <td colspan='10'>2</td>
    <td colspan='230'>Соответствие разности тормозных сил установленным требованиям </td>
    <td colspan='10'>".par_out(2)."</td>
    <td colspan='10'>23</td>
    <td colspan='230'>Наличие стеклоочистителя и форсунки стеклоомывателя ветрового стекла</td>
    <td colspan='10'>".par_out(23)."</td>
    <td colspan='10'>44</td>
    <td colspan='230'>Работоспособность аварийных выходов, приборов внутреннего освещения салона, привода управления дверями и сигнализации их работы</td>
    <td colspan='10'>".par_out(44)."</td>
</tr>
<tr>
    <td colspan='10'>3</td>
    <td colspan='230'>Работоспособность рабочей тормозной системы автопоездов с пневматическим тормозным приводом в режиме аварийного (автоматического) торможения </td>
    <td colspan='10'>".par_out(3)."</td>
    <td colspan='10'>24</td>
    <td colspan='230'>Обеспечение стеклоомывателем подачи жидкости в зоны очистки стекла</td>
    <td colspan='10'>".par_out(24)."</td>
    <td colspan='10'>45</td>
    <td colspan='230'>Наличие работоспособного звукового сигнального прибора</td>
    <td colspan='10'>".par_out(45)."</td>
</tr>
<tr>
    <td colspan='10'>4</td>
    <td colspan='230'>Отсутствие утечек сжатого воздуха из колесных тормозных камер</td>
    <td colspan='10'>".par_out(4)."</td>
    <td colspan='10'>25</td>
    <td colspan='230'>Работоспособность стеклоочистителей и стеклоомывателей</td>
    <td colspan='10'>".par_out(25)."</td>
    <td colspan='10'>46</td>
    <td colspan='230'>Наличие обозначений аварийных выходов и табличек по правилам их использования. Обеспечение свободного доступа к аварийным выходам</td>
    <td colspan='10'>".par_out(46)."</td>
</tr>
<tr>
    <td colspan='10'>5</td>
    <td colspan='230'>Отсутствие подтеканий тормозной жидкости, нарушения герметичности трубопроводов или соединений в гидравлическом тормозном приводе</td>
    <td colspan='10'>".par_out(5)."</td>
    <td colspan='250'><strong>V. Шины и колеса</strong></td>
    <td colspan='10'>47</td>
    <td colspan='230'>Наличие задних и боковых защитных устройств, соответствие их нормам</td>
    <td colspan='10'>".par_out(47)."</td>
</tr>
<tr>
    <td colspan='10'>6</td>
    <td colspan='230'>Отсутствие коррозии, грозящей потерей герметичности или разрушением</td>
    <td colspan='10'>".par_out(6)."</td>
    <td colspan='10'>26</td>
    <td colspan='230'>Соответствие высоты рисунка протектора шин установленным требованиям</td>
    <td colspan='10'>".par_out(26)."</td>
    <td colspan='10'>48</td>
    <td colspan='230'>Работоспособность автоматического замка, ручной и автоматической блокировки седельно-сцепного устройства. Отсутствие видимых повреждений сцепных устройств</td>
    <td colspan='10'>".par_out(48)."</td>
</tr>
<tr>
    <td colspan='10'>7</td>
    <td colspan='230'>Отсутствие механических повреждений тормозных трубопроводов</td>
    <td colspan='10'>".par_out(7)."</td>
    <td colspan='10'>27</td>
    <td colspan='230'>Отсутствие признаков непригодности шин к эксплуатации</td>
    <td colspan='10'>".par_out(27)."</td>
    <td colspan='10'>49</td>
    <td colspan='230'>Наличие работоспособных предохранительных приспособлений у одноосных прицепов (за исключением роспусков) и прицепов, не оборудованных рабочей тормозной системой </td>
    <td colspan='10'>".par_out(49)."</td>
</tr>
<tr>
    <td colspan='10'>8</td>
    <td colspan='230'>Отсутствие трещин остаточной деформации деталей тормозного привода</td>
    <td colspan='10'>".par_out(8)."</td>
    <td colspan='10'>28</td>
    <td colspan='230'>Наличие всех болтов или гаек крепления дисков и ободьев колес</td>
    <td colspan='10'>".par_out(28)."</td>
    <td colspan='10'>50</td>
    <td colspan='230'>Оборудование прицепов (за исключением одноосных и роспусков) исправным устройством, поддерживающим сцепную петлю дышла в положении, облегчающем сцепку и расцепку с тяговым автомобилем</td>
    <td colspan='10'>".par_out(50)."</td>
</tr>
<tr>
    <td colspan='10'>9</td>
    <td colspan='230'>Исправность средств сигнализации и контроля тормозных систем</td>
    <td colspan='10'>".par_out(9)."</td>
    <td colspan='10'>29</td>
    <td colspan='230'>Отсутствие трещин на дисках и ободьях колес</td>
    <td colspan='10'>".par_out(29)."</td>
    <td colspan='10'>51</td>
    <td colspan='230'>Отсутствие продольного люфта в беззазорных тягово-сцепных устройствах с тяговой вилкой для сцепленного с прицепом тягача</td>
    <td colspan='10'>".par_out(51)."</td>
</tr>
<tr>
    <td colspan='10'>10</td>
    <td colspan='230'>Отсутствие набухания тормозных шлангов под давлением, трещин и видимых мест перетирания</td>
    <td colspan='10'>".par_out(10)."</td>
    <td colspan='10'>30</td>
    <td colspan='230'>Отсутствие видимых нарушений формы и размеров крепежных отверстий в дисках колес</td>
    <td colspan='10'>".par_out(30)."</td>
    <td colspan='10'>52</td>
    <td colspan='230'>Обеспечение тягово-сцепными устройствами легковых автомобилей беззазорной сцепки сухарей замкового устройства с шаром</td>
    <td colspan='10'>".par_out(52)."</td>
</tr>
<tr>
    <td colspan='10'>11</td>
    <td colspan='230'>Расположение и длина соединительных шлангов пневматического тормозного привода автопоездов</td>
    <td colspan='10'>".par_out(11)."</td>
    <td colspan='10'>31</td>
    <td colspan='230'>Установка шин на транспортное средство в соответствии с требованиями</td>
    <td colspan='10'>".par_out(31)."</td>
    <td colspan='10'>53</td>
    <td colspan='230'>Соответствие размерных характеристик сцепных устройств установленным требованиям</td>
    <td colspan='10'>".par_out(53)."</td>
</tr>
<tr>
    <td colspan='250'><strong>II. Рулевое управление</strong></td>
    <td colspan='250'><strong>VI. Двигатель и его системы</strong></td>
    <td colspan='10'>54</td>
    <td colspan='230'>Оснащение транспортных средств исправными ремнями безопасности</td>
    <td colspan='10'>".par_out(54)."</td>
</tr>
<tr>
    <td colspan='10'>12</td>
    <td colspan='230'>Работоспособность усилителя рулевого управления. Плавность изменения усилия при повороте рулевого колеса</td>
    <td colspan='10'>".par_out(12)."</td>
    <td colspan='10'><p>32</p></td>
    <td colspan='230'>Соответствие содержания загрязняющих веществ в отработавших газах транспортных средств установленным требованиям</td>
    <td colspan='10'>".par_out(32)."</td>
    <td colspan='10'>55</td>
    <td colspan='230'>Наличие знака аварийной остановки</td>
    <td colspan='10'>".par_out(55)."</td>
</tr>
<tr>
    <td colspan='10'>13</td>
    <td colspan='230'>Отсутствие самопроизвольного поворота рулевого колеса с усилителем рулевого управления от нейтрального положения при работающем двигателе</td>
    <td colspan='10'>".par_out(13)."</td>
    <td colspan='10'>33</td>
    <td colspan='230'>Отсутствие подтекания и каплепадения топлива в системе питания</td>
    <td colspan='10'>".par_out(33)."</td>
    <td colspan='10'>56</td>
    <td colspan='230'>Наличие не менее двух противооткатных упоров</td>
    <td colspan='10'>".par_out(56)."</td>
</tr>
<tr>
    <td colspan='10'>14</td>
    <td colspan='230'>Отсутствие превышения предельных значений суммарного люфта в рулевом управлении</td>
    <td colspan='10'>".par_out(14)."</td>
    <td colspan='10'>34</td>
    <td colspan='230'>Работоспособность запорных устройств и устройств перекрытия топлива</td>
    <td colspan='10'>".par_out(34)."</td>
    <td colspan='10'>57</td>
    <td colspan='230'>Наличие огнетушителей, соответствующих установленным требованиям</td>
    <td colspan='10'>".par_out(57)."</td>
</tr>
<tr>
    <td colspan='10'>15</td>
    <td colspan='230'>Отсутствие повреждения и полная комплектность деталей крепления рулевой колонки и картера рулевого механизма</td>
    <td colspan='10'>".par_out(15)."</td>
    <td colspan='10'>35</td>
    <td colspan='230'>Герметичность системы питания транспортных средств, работающих на газе. Соответствие газовых баллонов установленным требованиям</td>
    <td colspan='10'>".par_out(35)."</td>
    <td colspan='10'>58</td>
    <td colspan='230'>Надежное крепление поручней в автобусах, запасного колеса, аккумуляторной батареи, сидений, огнетушителей и медицинской аптечки</td>
    <td colspan='10'>".par_out(58)."</td>
</tr>
<tr>
    <td colspan='10'>16</td>
    <td colspan='230'>Отсутствие следов остаточной деформации, трещин и других дефектов в рулевом механизме и рулевом приводе </td>
    <td colspan='10'>".par_out(16)."</td>
    <td colspan='10'>36</td>
    <td colspan='230'>Соответствие нормам уровня шума выпускной системы</td>
    <td colspan='10'>".par_out(36)."</td>
    <td colspan='10'>59</td>
    <td colspan='230'>Работоспособность механизмов регулировки сидений</td>
    <td colspan='10'>".par_out(59)."</td>
</tr>
<tr>
    <td colspan='10'>17</td>
    <td colspan='230'>Отсутствие устройств, ограничивающих поворот рулевого колеса, не предусмотренных конструкцией</td>
    <td colspan='10'>".par_out(17)."</td>
    <td colspan='250'><strong>VII. Прочие элементы конструкции</strong></td>
    <td colspan='10'>60</td>
    <td colspan='230'>Наличие надколесных грязезащитных устройств, отвечающих установленным требованиям</td>
    <td colspan='10'>".par_out(60)."</td>
</tr>
<tr>
    <td colspan='250'><strong>III. Внешние световые приборы</strong></td>
    <td colspan='10'>37</td>
    <td colspan='230'>Наличие зеркал заднего вида в соответствии с требованиями</td>
    <td colspan='10'>".par_out(37)."</td>
    <td colspan='10'>61</td>
    <td colspan='230'>Соответствие вертикальной статической нагрузки на тяговое устройство автомобиля от сцепной петли одноосного прицепа (прицепа-роспуска) нормам</td>
    <td colspan='10'>".par_out(61)."</td>
</tr>
<tr>
    <td colspan='10'>18</td>
    <td colspan='230'>Соответствие устройств освещения и световой сигнализации установленным требованиям</td>
    <td colspan='10'>".par_out(18)."</td>
    <td colspan='10'>38</td>
    <td colspan='230'>Отсутствие дополнительных предметов или покрытий, ограничивающих обзорность с места водителя. Соответствие полосы пленки в верхней части ветрового стекла установленным требованиям</td>
    <td colspan='10'>".par_out(38)."</td>
    <td colspan='10'>62</td>
    <td colspan='230'>Работоспособность держателя запасного колеса, лебедки и механизма подъема-опускания запасного колеса</td>
    <td colspan='10'>".par_out(62)."</td>
</tr>
<tr>
    <td colspan='10'>19</td>
    <td colspan='230'>Отсутствие разрушений рассеивателей световых приборов</td>
    <td colspan='10'>".par_out(19)."</td>
    <td colspan='10'>39</td>
    <td colspan='230'>Соответствие норме светопропускания ветрового стекла, передних боковых стекол и стекол передних дверей</td>
    <td colspan='10'>".par_out(39)."</td>
    <td colspan='10'>63</td>
    <td colspan='230'>Работоспособность механизмов подъема и опускания опор и фиксаторов транспортного положения опор</td>
    <td colspan='10'>".par_out(63)."</td>
</tr>
<tr>
    <td colspan='10'>20</td>
    <td colspan='230'>Работоспособность и режим работы сигналов торможения</td>
    <td colspan='10'>".par_out(30)."</td>
    <td colspan='10'>40</td>
    <td colspan='230'>Отсутствие трещин на ветровом стекле в зоне очистки водительского стеклоочистителя</td>
    <td colspan='10'>".par_out(40)."</td>
    <td colspan='10'>64</td>
    <td colspan='230'>Соответствие каплепадения масел и рабочих жидкостей нормам</td>
    <td colspan='10'>".par_out(64)."</td>
</tr>
<tr>
    <td colspan='10'>21</td>
    <td colspan='230'>Соответствие углов регулировки и силы света фар установленным требованиям</td>
    <td colspan='10'>".par_out(21)."</td>
    <td colspan='10'>41</td>
    <td colspan='230'>Работоспособность замков дверей кузова, кабины, механизмов регулировки и фиксирующих устройств сидений, устройства обогрева и обдува ветрового стекла, противоугонного устройства</td>
    <td colspan='10'>".par_out(41)."</td>
    <td colspan='10'>65</td>
    <td colspan='230'>Установка государственных регистрационных знаков в соответствии с требованиями</td>
    <td colspan='10'>".par_out(65)."</td>
</tr>
</tbody>
</table>

<table border='1' style='border: 0; border-spacing: 0px;font-size: 11px;width: 100%; padding-top:50px;'>
    <tbody>
    <tr>
        <td colspan='9' align='right' style='
    border: 0;
'>обратная сторона</td>
    </tr>
    <tr>
        <td colspan='9' align='center' style='
    border: 0;'>
            <strong>Результаты диагностирования</strong></td>
    </tr>
    <tr>
        <td colspan='500' align='center'><strong>Параметры, по которым установлено несоответствие</strong></td>
        <td colspan='200' rowspan='2' align='center'><strong>Пункт диагностической карты</strong></td>
    </tr>
    <tr>
        <td colspan='50' align='center'><strong>Нижняя граница</strong></td>
        <td colspan='150' align='center'><strong>Результат проверки</strong></td>
        <td colspan='50' align='center'><strong>Верхняя граница</strong></td>
        <td colspan='250' align='center'><strong>Наименование параметра</strong></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='150' height='$hhh' align='center'></td>
        <td colspan='50' height='$hhh' align='center'></td>
        <td colspan='250' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>

    <tr>
        <td colspan='500' align='center' >
            <strong>Невыполненные требования</strong></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' align='center'><strong>Предмет проверки (узел, деталь, агрегат)</strong></td>
        <td colspan='300' align='center'><strong>Содержание невыполненного требования (с указанием нормативного источника)</strong></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;border-bottom:0;'></td>
    </tr>
    <tr>
        <td colspan='200' height='$hhh' align='center'></td>
        <td colspan='300' height='$hhh' align='center'></td>
        <td colspan='200' height='$hhh' align='center' style='border-top:0;'></td>
    </tr>
    <tr>
        <td colspan='700' style='
    border: 0;
'><strong>Примечания</strong></td>
    </tr>
    <tr>
        <td colspan='700' style='
    height: 40px;
'></td>
    </tr>
    </tbody></table>

<table border='1' style='border: 0; border-spacing: 0px;font-size: 11px;width: 100%;'>
    <tbody>
    <tr>
        <td colspan='700' align='center'> <strong>Данные транспортного средства</strong></td>
    </tr>
    <tr>
        <td colspan='200'><strong>Масса без нагрузки:</strong></td>
        <td colspan='150'>$mbn</td>
        <td colspan='200'><strong>Разрешенная максимальная масса:</strong></td>
        <td colspan='150'>$rmm</td>
    </tr>
    <tr>
        <td colspan='200'><strong>Тип топлива:</strong></td>
        <td colspan='150'>$oil</td>
        <td colspan='200'><strong>Пробег ТС:</strong></td>
        <td colspan='150'>$run</td>
    </tr>
    <tr>
        <td colspan='200'><strong>Тип тормозной системы:</strong></td>
        <td colspan='150'>$breaks</td>
        <td colspan='350' rowspan='2'></td>
    </tr>
    <tr>
        <td colspan='200'><strong>Марка шин:</strong></td>
        <td colspan='150'>$tures</td>
    </tr>


    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr>
        <td colspan='300' style='border-bottom: 0'><strong>Заключение о возможности/невозможности эксплуатации транспортного средства</strong></td>
        <td colspan='300' style='border: 0;'></td>
        <td colspan='50' style='border-bottom: 0'>Возможно</td>
        <td colspan='50' style='border-bottom: 0'>Невозможно</td>
    </tr>
    <tr>
        <td colspan='300' style='border-top: 0'>Results of the roadworthiness inspection</td>
        <td colspan='300' style='border: 0;'></td>
        <td colspan='50' style='border-top: 0'> Passed</td>
        <td colspan='50' style='border-top: 0'>Failed</td>
    </tr>

    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr>
        <td colspan='400' height='40' align='center'><strong>Пункты диагностической карты, требующие повторной проверки:</strong></td>
        <td colspan='300' height='40'></td>
    </tr>
    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr>
        <td colspan='50' style='border: 0;'><strong>Дата: </strong></td>
        <td colspan='100' style='border: 0;'>$ddata</td>
        <td colspan='550' style='border: 0;'></td>
    </tr>
    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr>
        <td colspan='50' style='border: 0;'><strong>Ф.И.О. технического эксперта</strong></td>
        <td colspan='100' style='border: 0;'>Абутова  В.Б.</td>
        <td colspan='550' style='border: 0;'></td>
    </tr>
    <tr>
        <td colspan='700' style='
    border: 0;
'></td>
    </tr>
    <tr>
        <td colspan='350' style='border: 0;'><strong>Подпись</strong></td>
        <td colspan='350' style='border: 0;'><strong>Печать</strong></td>
    </tr>
    <tr>
        <td colspan='350' style='border: 0;'>Signature</td>
        <td colspan='350' style='border: 0;'>Stamp</td>
    </tr>

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