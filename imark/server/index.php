<?php
mb_internal_encoding("utf-8");
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Vladivostok');
setlocale(LC_ALL, 'ru_RU');

$page_path = trim($_SERVER["REQUEST_URI"], '/\\ ');
if (isset($page_path) && !empty($page_path)) {
    $pars= explode('-', $page_path);
    if ($pars[0] == 'LC')
        header('Location: http://my.liracloud.com/profiles/scriptout/'.$pars[1]);
//      header('Location: http://mkpanel.su/profiles/scriptout/'.$pars[1]);
}