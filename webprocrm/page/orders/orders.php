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
                <th>Оказываемые услуги</th><th>Тип</th><th>Дата начало</th><th>Дата завершения</th><th>Статус</th><th>Документы</th><th>Операции</th></tr>
            </thead>
            <tbody>
<?php foreach ($res as $item) :?>
            <tr data-time="<?php echo $item['order_service']; ?>"  data-itemid="<?php echo $item['order_id']; ?>">
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
                <?php if ($curuser->hasPerm('edit') !== false) { ?>
                <td><button type="button" class="btn btn-danger delete">Удалить</button></td>
                <?php } ?>
            </tr>
<?php    endforeach; ?>
            </tbody>
        </table>
<script src="/js/admin-menu.js"></script>
<script>
$(document).ready(function(){
    //Id item to beeing deleted;
    CRM.delid= 0;
    $('table tbody tr').click(function(){
        id= parseInt($(this).data('itemid'));

        location.assign('/order-more?oid='+id);
    });

    $('button.delete').click(function(e){
        e.stopPropagation();

        $('#del-alert').modal();
        CRM.delid= parseInt($(this).parents('tr').data('itemid'));
    });
    $('button.delete-true').click(function(){
        $('#del-alert').modal('hide');
        $('button.delete').css('display', 'none');
        console.log(CRM.delid);
        $.post(CRM.getdata+'?delete=orders&&id='+CRM.delid, function(data, status){
            console.log(status);
            if (status= 'success') {
                console.log(data);
                location.reload();
            }
        });
    });
});
</script>

<?php if ($curuser->hasPerm('edit') !== false) { ?>
<div id="del-alert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="del-alert-title" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="del-alert-title">Вы уверены, что хотите продолжить?</h3>
            </div>
            <div class="modal-body">
                <div class="dlg-msg"></div>
                <div class="edit-dlg">
                    <p>Если вы продолжите, этот заказ и все его документы будут безвозвратно удалены!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete-true">Удалить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php } ?>