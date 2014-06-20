<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 6/13/14
 * Time: 3:28 PM
 */

$res= $link->query("select * from orders as o
                    join order_doc as od on o.order_id = od.order_id
                    join docs as d on d.doc_id = od.doc_id
                    where o.user_id = $curuser->id
                    order by o.order_time desc");
//                    group by o.order_time desc
?>
        <table>
            <thead>
            <tr><th>Название</th><th>Оказываемые услуги</th><th>Тип</th><th>Дата начало</th><th>Дата завершения</th><th>Статус</th></tr>
            </thead>
            <tbody>
<?php foreach ($res as $item) :?>
            <tr>
                <td><?php echo $item['order_name']; ?></td>
                <td><?php
                    if (isset($item['order_service']) && !empty($item['order_service'])){
                        $i= array_search($item['order_service'], $order_service);
                        echo $order_service[$i];
                    }
                    ?></td>
                <td><?php
                    if (isset($item['order_time']) && !empty($item['order_time'])){
                        $i= array_search($item['order_time'], $order_time);
                        echo $order_time[$i];
                    }
                    ?></td>
                <td><?php echo $item['order_start']; ?></td>
                <td><?php echo $item['order_end']; ?></td>
                <td><?php echo $item['order_status']; ?></td>
            </tr>
<?php    endforeach; ?>
            </tbody>
        </table>