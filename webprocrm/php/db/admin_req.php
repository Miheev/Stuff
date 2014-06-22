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

if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['u']->hasPerm('edit')!== false) {
    if (isset($_GET['rool_user'])) {
        $res= $link->query('select *, u.user_id from users u
                            left join users_company c on u.user_id = c.user_id');
        $res= json_encode($res);
        echo $res;
        return;
    }
    if (isset($_GET['rool_order'])) {
        //        left join order_doc od on o.order_id = od.order_id
        //left join docs d on d.doc_id = od.doc_id
        // group by o.order_id
        $res= $link->query("select *, o.order_id from orders o
        join users u on o.user_id = u.user_id");
        foreach( $res as $id => $item ) {
            $res[$id]['list_time']= $order_time[intval($item['order_time'])];
            $res[$id]['list_service']= $order_service[intval($item['order_service'])];
        }
        $res= json_encode($res);
        echo $res;
        return;
    }
    if (isset($_GET['add_user'])) {
        $cols= $_POST['data'];
        $res= $link->query("insert into users values ('', '$cols[0]', '$cols[1]', '$cols[2]', '$cols[3]', '$cols[4]', '')");
        echo $res;
        return;
    }
    if (isset($_GET['add_order'])) {
        $cols= $_POST['data'];
        $ds= new DateTime($cols[4]);
        $de= new DateTime($cols[5]);
        $res= $link->query("insert into orders values ('', '$cols[0]', '$cols[1]', '$cols[2]', '$cols[3]', '".$ds->format('Y-m-d')."', '".$de->format('Y-m-d')."', '$cols[6]')");
        echo $res;
        return;
    }
} else die ('У вас нет прав для доступа к этой странице');