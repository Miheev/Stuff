<?
session_start(); //Kasahara Yuri feat Tarantula
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
$num=$eaid['num'];
$data= $eaid['data'];
$buywho= $eaid['bywho'];
$data_buy_who= $data.'  '.$buywho;
$mbn= $eaid['mbn'];
$rmm= $eaid['rmm'];
$run= $eaid['run'];
$tures= $eaid['turns'];
$ddata= $eaid['ddata'];

$html=<<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Документ без названия</title>
    <style type="text/css">
	    table {width: 750px !important; vertical-align: top !important;}
	    tr {width: 100% !important;}
	    /*td {width: auto !important;}*/
	    td {height: auto !important;}
</style>
</head>

<body>

<table border="1" style="border: 0; border-spacing: 0px;width: 100%;font-size: 11px;">
  <tbody><tr>
    <td colspan="9" align="center" style="border: 0;"><strong>Диагностическая карта</strong></td>
  </tr>
  <tr>
    <td colspan="9" align="center" style="border: 0;"><strong>Certificate of periodic technical inspection</strong></td>
  </tr>
  <tr>
    <td colspan="5" style="    border: 0;"><strong>Регистрационный номер</strong></td>
    <td colspan="4" style="    border: 0;"><strong>Срок действия до</strong></td>
  </tr>
  <tr>
    <td colspan="5">  $eaisto </td>
    <td colspan="4" >   $unt </td>
  </tr>
  <tr>
    <td colspan="9" style=" border: 0; "></td>
  </tr>
  <tr>
    <td colspan="4"> <strong>Оператор технического осмотра/пункт технического осмотра: </strong></td>
    <td colspan="5"> <strong>ООО Диагностика сервис №01174, Санкт-Петербург, Приморское шоссе, д. 262</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong> Первичная проверка</strong></td>
    <td width="73">X</td>
    <td colspan="3"></td>
    <td colspan="2"><strong>Повторная проверка</strong></td>
    <td width="7" style="
    width: 30px;
"></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Регистрационный знак ТС:</strong></td>
    <td colspan="2">$gnum</td>
    <td colspan="2"><strong>Марка, модель ТС:</strong></td>
    <td colspan="3">$mark,$model</td>
  </tr>
  <tr>
    <td colspan="2"><strong>VIN:</strong></td>
    <td colspan="2">$vin</td>
    <td colspan="2"><strong>Категория ТС:</strong></td>
    <td colspan="3">$cat</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Номер рамы:</strong></td>
    <td colspan="2">$rama</td>
    <td colspan="2" rowspan="2"><strong>Год выпуска ТС:</strong></td>
    <td colspan="3" rowspan="2">$year</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Номер кузова:</strong></td>
    <td colspan="2">$kuz</td>
  </tr>
  <tr>
    <td colspan="3"><strong>СРТС или ПТС (серия, номер, выдан кем, когда):</strong></td>
      <td colspan="6">$doc   Серия: $ser  Номер: $num Выдан: $data_buy_who</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"></td>
  </tr>
  </tbody>
  </table>
  <table border="1" style="border: 0; border-spacing: 0px;font-size: 8px;line-height: 7px;">

  <tbody><tr>
    <td width="10"><strong>№</strong></td>
    <td colspan="2"><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
    <td width="10"><strong>№</strong></td>
    <td colspan="2"><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
    <td width="10"><strong>№</strong></td>
    <td colspan="2"><strong>Параметры и требования, предъявляемые ктранспортным средствам при проведении технического осмотра</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>I.Тормозные системы</strong></td>
    <td width="10">22</td>
    <td width="150">Наличие и расположение фар и сигнальных фонарей в местах, предусмотренных конструкцией</td>
    <td width="1"></td>
    <td width="10">42</td>
    <td width="310">Работоспособность запоров бортов грузовой платформы и запоров горловин цистерн</td>
    <td style="
    width: 60px;
"></td>
  </tr>
  <tr>
    <td width="10" style="
    width: 60px !important;
">1</td>
    <td width="276">Соответствие показателей эффективности торможения и устойчивости торможения</td>
    <td width="10"></td>
    <td colspan="3"><strong>IV. Стеклоочистители и стеклоомыватели</strong></td>
    <td width="10">43</td>
    <td>Работоспособность аварийного выключателя дверей и сигнала требования остановки</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">2</td>
    <td>Соответствие разности тормозных сил установленным требованиям </td>
    <td width="10"></td>
    <td width="10" style="
    width: 60px;
">23</td>
    <td>Наличие стеклоочистителя и форсунки стеклоомывателя ветрового стекла</td>
    <td style="
    width: 60px;
"></td>
    <td width="10" style="
    width: 60px;
">44</td>
    <td>Работоспособность аварийных выходов, приборов внутреннего освещения салона, привода управления дверями и сигнализации их работы</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">3</td>
    <td>Работоспособность рабочей тормозной системы автопоездов с пневматическим тормозным приводом в режиме аварийного (автоматического) торможения </td>
    <td width="10"></td>
    <td width="10">24</td>
    <td>Обеспечение стеклоомывателем подачи жидкости в зоны очистки стекла</td>
    <td></td>
    <td width="10">45</td>
    <td>Наличие работоспособного звукового сигнального прибора</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">4</td>
    <td>Отсутствие утечек сжатого воздуха из колесных тормозных камер</td>
    <td width="10"></td>
    <td width="10">25</td>
    <td>Работоспособность стеклоочистителей и стеклоомывателей</td>
    <td></td>
    <td width="10">46</td>
    <td>Наличие обозначений аварийных выходов и табличек по правилам их использования. Обеспечение свободного доступа к аварийным выходам</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">5</td>
    <td>Отсутствие подтеканий тормозной жидкости, нарушения герметичности трубопроводов или соединений в гидравлическом тормозном приводе</td>
    <td width="10"></td>
    <td colspan="3"><strong>V. Шины и колеса</strong></td>
    <td width="10">47</td>
    <td>Наличие задних и боковых защитных устройств, соответствие их нормам</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">6</td>
    <td>Отсутствие коррозии, грозящей потерей герметичности или разрушением</td>
    <td width="10"></td>
    <td width="10">26</td>
    <td>Соответствие высоты рисунка протектора шин установленным требованиям</td>
    <td></td>
    <td width="10">48</td>
    <td>Работоспособность автоматического замка, ручной и автоматической блокировки седельно-сцепного устройства. Отсутствие видимых повреждений сцепных устройств</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">7</td>
    <td>Отсутствие механических повреждений тормозных трубопроводов</td>
    <td width="10"></td>
    <td width="10">27</td>
    <td>Отсутствие признаков непригодности шин к эксплуатации</td>
    <td></td>
    <td width="10">49</td>
    <td>Наличие работоспособных предохранительных приспособлений у одноосных прицепов (за исключением роспусков) и прицепов, не оборудованных рабочей тормозной системой </td>
    <td></td>
  </tr>
  <tr>
    <td width="10">8</td>
    <td>Отсутствие трещин остаточной деформации деталей тормозного привода</td>
    <td width="10"></td>
    <td width="10">28</td>
    <td>Наличие всех болтов или гаек крепления дисков и ободьев колес</td>
    <td></td>
    <td width="10">50</td>
    <td>Оборудование прицепов (за исключением одноосных и роспусков) исправным устройством, поддерживающим сцепную петлю дышла в положении, облегчающем сцепку и расцепку с тяговым автомобилем</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">9</td>
    <td>Исправность средств сигнализации и контроля тормозных систем</td>
    <td width="10"></td>
    <td width="10">29</td>
    <td>Отсутствие трещин на дисках и ободьях колес</td>
    <td></td>
    <td width="10">51</td>
    <td>Отсутствие продольного люфта в беззазорных тягово-сцепных устройствах с тяговой вилкой для сцепленного с прицепом тягача</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">10</td>
    <td>Отсутствие набухания тормозных шлангов под давлением, трещин и видимых мест перетирания</td>
    <td width="10"></td>
    <td width="10">30</td>
    <td>Отсутствие видимых нарушений формы и размеров крепежных отверстий в дисках колес</td>
    <td></td>
    <td width="10">52</td>
    <td>Обеспечение тягово-сцепными устройствами легковых автомобилей беззазорной сцепки сухарей замкового устройства с шаром</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">11</td>
    <td>Расположение и длина соединительных шлангов пневматического тормозного привода автопоездов</td>
    <td width="10"></td>
    <td width="10">31</td>
    <td>Установка шин на транспортное средство в соответствии с требованиями</td>
    <td></td>
    <td width="10">53</td>
    <td>Соответствие размерных характеристик сцепных устройств установленным требованиям</td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3"><strong>II. Рулевое управление</strong></td>
    <td colspan="3"><strong>VI. Двигатель и его системы</strong></td>
    <td width="10">54</td>
    <td>Оснащение транспортных средств исправными ремнями безопасности</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">12</td>
    <td>Работоспособность усилителя рулевого управления. Плавность изменения усилия при повороте рулевого колеса</td>
    <td width="10"></td>
    <td width="10"><p>32</p></td>
    <td>Соответствие содержания загрязняющих веществ в отработавших газах транспортных средств установленным требованиям</td>
    <td></td>
    <td width="10">55</td>
    <td>Наличие знака аварийной остановки</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">13</td>
    <td>Отсутствие самопроизвольного поворота рулевого колеса с усилителем рулевого управления от нейтрального положения при работающем двигателе</td>
    <td width="10"></td>
    <td width="10">33</td>
    <td>Отсутствие подтекания и каплепадения топлива в системе питания</td>
    <td></td>
    <td width="10">56</td>
    <td>Наличие не менее двух противооткатных упоров</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">14</td>
    <td>Отсутствие превышения предельных значений суммарного люфта в рулевом управлении</td>
    <td width="10"></td>
    <td width="10">34</td>
    <td>Работоспособность запорных устройств и устройств перекрытия топлива</td>
    <td></td>
    <td width="10">57</td>
    <td>Наличие огнетушителей, соответствующих установленным требованиям</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">15</td>
    <td>Отсутствие повреждения и полная комплектность деталей крепления рулевой колонки и картера рулевого механизма</td>
    <td width="10"></td>
    <td width="10">35</td>
    <td>Герметичность системы питания транспортных средств, работающих на газе. Соответствие газовых баллонов установленным требованиям</td>
    <td></td>
    <td width="10">58</td>
    <td>Надежное крепление поручней в автобусах, запасного колеса, аккумуляторной батареи, сидений, огнетушителей и медицинской аптечки</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">16</td>
    <td>Отсутствие следов остаточной деформации, трещин и других дефектов в рулевом механизме и рулевом приводе </td>
    <td width="10"></td>
    <td width="10">36</td>
    <td>Соответствие нормам уровня шума выпускной системы</td>
    <td></td>
    <td width="10">59</td>
    <td>Работоспособность механизмов регулировки сидений</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">17</td>
    <td>Отсутствие устройств, ограничивающих поворот рулевого колеса, не предусмотренных конструкцией</td>
    <td width="10"></td>
    <td colspan="3"><strong>VII. Прочие элементы конструкции</strong></td>
    <td width="10">60</td>
    <td>Наличие надколесных грязезащитных устройств, отвечающих установленным требованиям</td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3"><strong>III. Внешние световые приборы</strong></td>
    <td width="10">37</td>
    <td>Наличие зеркал заднего вида в соответствии с требованиями</td>
    <td></td>
    <td width="10">61</td>
    <td>Соответствие вертикальной статической нагрузки на тяговое устройство автомобиля от сцепной петли одноосного прицепа (прицепа-роспуска) нормам</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">18</td>
    <td>Соответствие устройств освещения и световой сигнализации установленным требованиям</td>
    <td width="10"></td>
    <td width="10">38</td>
    <td>Отсутствие дополнительных предметов или покрытий, ограничивающих обзорность с места водителя. Соответствие полосы пленки в верхней части ветрового стекла установленным требованиям</td>
    <td></td>
    <td width="10">62</td>
    <td>Работоспособность держателя запасного колеса, лебедки и механизма подъема-опускания запасного колеса</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">19</td>
    <td>Отсутствие разрушений рассеивателей световых приборов</td>
    <td width="10"></td>
    <td width="10">39</td>
    <td>Соответствие норме светопропускания ветрового стекла, передних боковых стекол и стекол передних дверей</td>
    <td></td>
    <td width="10">63</td>
    <td>Работоспособность механизмов подъема и опускания опор и фиксаторов транспортного положения опор</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">20</td>
    <td>Работоспособность и режим работы сигналов торможения</td>
    <td width="10"></td>
    <td width="10">40</td>
    <td>Отсутствие трещин на ветровом стекле в зоне очистки водительского стеклоочистителя</td>
    <td></td>
    <td width="10">64</td>
    <td>Соответствие каплепадения масел и рабочих жидкостей нормам</td>
    <td></td>
  </tr>
  <tr>
    <td width="10">21</td>
    <td>Соответствие углов регулировки и силы света фар установленным требованиям</td>
    <td width="10"></td>
    <td width="10">41</td>
    <td>Работоспособность замков дверей кузова, кабины, механизмов регулировки и фиксирующих устройств сидений, устройства обогрева и обдува ветрового стекла, противоугонного устройства</td>
    <td></td>
    <td width="10">65</td>
    <td>Установка государственных регистрационных знаков в соответствии с требованиями</td>
    <td></td>
  </tr>
  </tbody>
  </table>
  <table border="1" style="border: 0; border-spacing: 0px;font-size: 11px;width: 100%;">
  <tbody>
  <tr>
    <td colspan="9" align="right" style="
    border: 0;
">обратная сторона</td>
  </tr>
  <tr>
    <td colspan="9" align="center" style="
    border: 0; padding-top: 150px;
">
<strong>Результаты диагностирования</strong></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>Параметры, по которым установлено несоответствие</strong></td>
    <td colspan="3" rowspan="2" align="center"><strong>Пункт диагностической карты</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>Нижняя граница</strong></td>
    <td align="center"><strong>Результат проверки</strong></td>
    <td align="center"><strong>Верхняя граница</strong></td>
    <td colspan="3" align="center"><strong>Наименование параметра</strong></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
   <tr>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="6" align="center" style="
    border: 0;
"><strong>Невыполненные требования</strong></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>Предмет проверки (узел, деталь, агрегат)</strong></td>
    <td colspan="4" align="center"><strong>Содержание невыполненного требования (с указанием нормативного источника)</strong></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td colspan="4"></td>
    <td colspan="3" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"><strong>Примечания</strong></td>
  </tr>
  <tr>
    <td colspan="9" style="
    height: 40px;
"></td>
  </tr>


  <tr style="
">
    <td colspan="9" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="9" align="center"> <strong>Данные транспортного средства</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Масса без нагрузки:</strong></td>
    <td colspan="2">$mbn</td>
    <td colspan="2"><strong>Разрешенная максимальная масса:</strong></td>
    <td colspan="3">$rmm</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Тип топлива:</strong></td>
    <td colspan="2">$oil</td>
    <td colspan="2"><strong>Пробег ТС:</strong></td>
    <td colspan="3">$run</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Тип тормозной системы:</strong></td>
    <td colspan="2">$breaks</td>
    <td colspan="5" rowspan="2"></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Марка шин:</strong></td>
    <td colspan="2">$tures</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Заключение о возможности/невозможности эксплуатации транспортного средства</strong></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td>Возможно</td>
    <td colspan="2">Невозможно</td>
  </tr>
  <tr>
    <td colspan="2">Results of the roadworthiness inspection</td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td> Passed</td>
    <td colspan="2">Failed</td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>Пункты диагностической карты, требующие повторной проверки:</strong></td>
    <td colspan="3"></td>
  </tr>
  <tr style="
    height: 40px;
">
    <td colspan="6"></td>

    <td colspan="3"></td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Дата: </strong></td>
    <td colspan="4">$ddata</td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Ф.И.О. технического эксперта</strong></td>
    <td colspan="4">Абутова  В.Б.</td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="9" style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Подпись</strong></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td colspan="3"><strong>Печать</strong></td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
  </tr>
  <tr>
    <td colspan="2">Signature</td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
    <td colspan="3">Stamp</td>
    <td style="
    border: 0;
"></td>
    <td style="
    border: 0;
"></td>
  </tr>
<tr><td style="color:transparent; height:1000px;">..</td></tr>
</tbody></table>


</body></html>
EOT;

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