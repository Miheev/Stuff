<?php

/*if ( !preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"]) ) {
    $enc = 'UTF-8';
    header('Content-type: text/html; charset='.$enc);
    mb_internal_encoding($enc);
} else {
    $enc = 'windows-1251';
    header('Content-type: text/html; charset='.$enc);
    mb_internal_encoding($enc);
}*/
mb_internal_encoding("utf-8");
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'ru_RU');

error_reporting(E_ALL /*& ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED*/);

require_once('bitstamp-php-api/bitstamp.php');
$key= 'lwbDUXg7ab8Z3UQ5T9p7d3GAcXA0Q1Gv';
$secret= 'g7GC5Swu4GwjaZjchwsheQK1KNmPA0hj';
$client_id= '35903';
//$key= 'b2e0qHIWO44x3b7vH0Sywht7lJK3fbCE';
//$secret= 'pASEed8jq0dg5mS4bkJSEklib0BLis6k';
//$client_id= '107082';

$bs = new Bitstamp($key,$secret,$client_id);

$ts= $bs->ticker();
echo '<p> show bid,ask & other price stats</p>';
var_dump($ts); // show bid,ask & other price stats
echo '<br /><br />';

echo '<p>bitcoindepositaddress uncofirmed 1</p>';
$res= $bs->unconfirmedbtc();
var_dump($res); // show bid,ask & other price stats
echo '<br />';

echo '<p>БИТКОЙН АДРЕС ДЛЯ ДЕПОЗИТА 1</p>';
$res= $bs->bitcoindepositaddress();
var_dump($res); // show bid,ask & other price stats
echo '<br />';

echo '<p>bitcoindepositaddress uncofirmed 2</p>';
$res= $bs->unconfirmedbtc();
var_dump($res); // show bid,ask & other price stats
echo '<br />';

echo '<p>БИТКОЙН АДРЕС ДЛЯ ДЕПОЗИТА 2</p>';
$res= $bs->bitcoindepositaddress();
var_dump($res); // show bid,ask & other price stats
echo '<br />';

echo '<p>ripple_withdrawal</p>';
$res= $bs->ripple_withdrawal();
var_dump($res); // show bid,ask & other price stats
echo '<br />';

echo '<p>ripple_address</p>';
$res= $bs->ripple_address();
var_dump($res); // show bid,ask & other price stats
echo '<br />';

echo '<p>ripple_address</p>';
$res= $bs->ripple_address();
var_dump($res); // show bid,ask & other price stats
echo '<br />';