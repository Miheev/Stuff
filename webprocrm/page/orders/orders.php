<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 6/13/14
 * Time: 3:28 PM
 */

if ($curuser->hasPerm('edit') !== false) {
$res= $link->query("select *, o.order_id, o.order_service from orders as o
                    left join order_doc as od on o.order_id = od.order_id
                    left join docs as d on d.doc_id = od.doc_id
                    join users as u on u.user_id = o.user_id
                    group by o.order_id desc
                    order by o.order_time desc");
} else {
    $res= $link->query("select *, o.order_id from orders as o
                    left join order_doc as od on o.order_id = od.order_id
                    left join docs as d on d.doc_id = od.doc_id
                    where o.user_id = $curuser->id
                    group by o.order_id desc
                    order by o.order_time desc");
}
?>
<div class="order-filter">
    <button type="button" class="btn btn-default">Активные</button>
    <button type="button" class="btn btn-default">Выполненные</button>
    <button type="button" class="btn btn-default">Архивные</button>
    <script>
        $(document).ready(function(){
            $('.order-filter button').click(function(){
                id= $('.order-filter button').index($(this));
                $('table tbody tr').each(function(){
                    if ( parseInt($(this).data('time')) == id)
                        $(this).css('display', 'table-row');
                    else
                        $(this).css('display', 'none');
                });
            });
        });
    </script>
</div>
        <table>
            <thead>
            <tr><th>Название</th>
                <?php
                if ($curuser->hasPerm('edit') !== false) : ?>
                <th>Клиент</th>
                <?php endif;?>
                <th>Оказываемые услуги</th><th>Тип</th><th>Дата начало</th><th>Дата завершения</th><th>Статус</th><th>Документы</th></tr>
            </thead>
            <tbody>
<?php foreach ($res as $item) :?>
            <tr data-time="<?php echo $item['order_service']; ?>">
                <td><a href="/order-more?oid=<?php echo $item['order_id']; ?>"><?php echo $item['order_name']; ?></a></td>
                <?php
                if ($curuser->hasPerm('edit') !== false) : ?>
                    <td><a href="/user-more?uid=<?php echo $item['user_id']; ?>"><?php echo $item['user_name']; ?></a></td>
                <?php endif;?>
                <td><?php
                    if (isset($item['order_service']) && !empty($item['order_service'])){
                        $i= $order_service[intval($item['order_service'])];
                        echo $i;
                    }
                    ?></td>
                <td><?php
                    if (isset($item['order_time']) && !empty($item['order_time'])){
                        $i= $order_time[intval($item['order_time'])];
                        echo $i;
                    }
                    ?></td>
                <td><?php echo $item['order_start']; ?></td>
                <td><?php echo $item['order_end']; ?></td>
                <td><?php echo $item['order_status']; ?></td>
                <td><?php if (isset($item['doc_id'])) echo 'В наличии'; ?></td>
            </tr>
<?php    endforeach; ?>
            </tbody>
        </table>

<script>
    $('table tbody tr').click(function(){
        id= $('.edit-content table tbody tr').index($(this));

        location.assign('/order-more?oid='+CRM.data[id]['order_id']);
    });
</script>