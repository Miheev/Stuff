<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 6/13/14
 * Time: 3:28 PM
 */

$res= $link->query("select * from orders as o where o.order_id = ". $_GET['oid'] ." group by o.order_id");
$res2= $link->query("select * from docs d join order_doc od on od.doc_id = d.doc_id join orders o on o.order_id = od.order_id where o.order_id = ". $_GET['oid']);
//                    group by o.order_time desc
?>

<div class="sys-msg">
</div>
<button type="button" class="btn btn-default">Перейти к чату</button>
<table>
    <thead><tr><td><h2><?php echo $res[0]['order_name']; ?></h2></td></tr></thead>
    <tbody>
    <tr><td>Услуга</td><td><?php echo $order_service[ intval($res[0]['order_service']) ]; ?></td></tr>
    <tr><td>Тип</td><td><?php echo $order_time[ intval($res[0]['order_time']) ]; ?></td></tr>
    <tr><td>Дата начала</td><td><?php echo $res[0]['order_start']; ?></td></tr>
    <tr><td>Дата завершения</td><td><?php echo $res[0]['order_end']; ?></td></tr>
    <tr><td>Статус</td><td><?php echo $res[0]['order_status']; ?></td></tr>

    <tr><td><h3>Файлы проекта</h3></td></tr>
    <tr><td><strong>Название</strong></td><td><strong>Дата</strong></td></tr>
    <?php
    if ($res2 != false)
        foreach ($res2 as $item) : ?>
            <tr>
                <td><a href="<?php echo $item['doc_path']; ?>"><?php echo $item['doc_name']; ?></a></td>
                <td><a href="<?php echo $item['doc_path']; ?>"><?php echo $item['doc_date']; ?></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>