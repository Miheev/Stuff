<?php
/**
 * Created by PhpStorm. //Inner Universe Icon feat R.Cenna //visual work station
 * User: storm
 * Date: 6/20/14
 * Time: 4:41 PM
 */

require_once '../../config.php';
require_once '../std.php';

session_start();

if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['u']->hasPerm('view')!== false) {
    if (isset($_GET['order_sort'])) {
        if ($_GET['order_sort'] == 'active') {
            $res= $link->query('select *, u.user_id from users u left join users_company c on u.user_id = c.user_id');
            $res= json_encode($res);
            echo $res;
            return;
        }
        if ($_GET['order_sort'] == 'archive') {
            $res= $link->query('select *, u.user_id from users u left join users_company c on u.user_id = c.user_id');
            $res= json_encode($res);
            echo $res;
            return;
        }
        if ($_GET['order_sort'] == 'finished') {
            $res= $link->query('select *, u.user_id from users u left join users_company c on u.user_id = c.user_id');
            $res= json_encode($res);
            echo $res;
            return;
        }
    }
} else die ('У вас нет прав для доступа к этой странице');