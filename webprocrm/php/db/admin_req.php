<?php
/**
 * Created by PhpStorm. //Inner Universe Icon feat R.Cenna //visual work station //Iin feat Maria from Carnidelia
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
                            left join users_company c on u.user_company = c.company_id');
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
        $cols= &$_POST['data'];
        if ($cols[5] == "1") {
            $res1= $link->query("insert into users_company values ('', '$cols[6]', '$cols[7]')");
            $last_id= $link->insert_id();
        } else {
            $res1= 'not performed';
            $last_id= '';
        }
        $res2= $link->query("insert into users values ('', '$cols[0]', '$cols[1]', '$cols[2]', '$cols[3]', '$cols[4]', '$last_id')");
        $tmp= array($res1, $res2);
        $tmp= json_encode($tmp);
        echo $tmp;
        return;
    }
    if (isset($_GET['add_order'])) {
        $cols= $_POST['data'];
        $ds= new DateTime($cols[4]);
        $de= new DateTime($cols[5]);
        $res= $link->query("insert into orders values ('', '$cols[0]', '$cols[1]', '$cols[2]', '$cols[3]', '".$ds->format('Y-m-d')."', '".$de->format('Y-m-d')."', '$cols[6]')");

        $order_id= $link->insert_id();
        $docs_id= $link->query('SELECT MAX( doc_id ) as id FROM docs');
        $docs_id= $docs_id[0]['id'] + 1;
        $docs_id_end= $docs_id;

        $cols2 = array_slice($cols, 7);
        if (count($cols2) > 1) {
            $sql= "";
            for ($i=0; $i<count($cols2); $i+=2) {
              $tmp= "('', ";
                if (isset($cols2[$i+1]) && !empty($cols2[$i+1]))
                  $tmp.= "'".$cols2[$i]."', ";
                else
                  continue;

              $dd= new DateTime();
              $tmp.= "'".$dd->format('Y-m-d')."', ";

              if (isset($cols2[$i]) && !empty($cols2[$i]))
                $tmp.= "'".$cols2[$i]."')";
              else
                $tmp.= "'Без имени')";

              $sql.= $tmp.", ";
                $docs_id_end++;
            }
            if (!empty($sql)) {
                $sql= "insert into docs values ".trim($sql, ' ,');
                $res2= $link->query($sql);
                if ($res2) {
                    $sql= "insert into order_doc values ";
                    for ($i=$docs_id; $i<=$docs_id_end; $i++) {
                        $sql.= "( ".$order_id.", ".$i." ), ";
                    }
                    $sql= trim($sql, ' ,');
                    $res3= $link->query($sql);
                }
            }
        }

        $tmp= array($res, $res2, $res3);
        $tmp= json_encode($tmp);
        echo $tmp;
        return;
    }

    /**
     * Delete Requests
     */
    if (isset($_GET['delete']) && !empty($_GET['delete']) &&
        isset($_GET['id']) && !empty($_GET['id'])) {

        if ($_GET['delete'] == 'orders') {
            $res= $link->query('DELETE FROM orders where order_id = '.$_GET['id']);
            $res2= $link->query('DELETE FROM order_doc where order_id = '.$_GET['id']);
            $tmp= array($res, $res2);
            $tmp= json_encode($tmp);
            echo $tmp;
            return;
        }
        if ($_GET['delete'] == 'users') {
            $res= $link->query('DELETE FROM users_company where company_id = ( select user_company from users where user_id = '.$_GET['id'].')');
            $res2= $link->query('DELETE FROM users where user_id = '.$_GET['id']);
            $tmp= array($res, $res2);
            $tmp= json_encode($tmp);
            echo $tmp;
            return;
        }
    }

    /**
     * Select Requests
     */
    if (isset($_GET['select']) && !empty($_GET['select'])) {
        $res= $link->gettbl($_GET['select']);
        $res= json_encode($res);
        echo $res;
        return;
    }
} else die ('У вас нет прав для доступа к этой странице');