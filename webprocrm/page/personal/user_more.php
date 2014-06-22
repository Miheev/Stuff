<?php
/**
 * Created by PhpStorm.
 * User: storm              /Kon Katsumi
 * Date: 6/13/14
 * Time: 3:28 PM
 */

if ($_SESSION['u']->hasPerm('edit')!== false) :

$res= $link->query("select * from users u left join users_company c on u.user_company = c.company_id where u.user_id = " . $_GET['uid']);
    $res2= $link->query('select o.order_name, o.order_status, o.order_id from orders o join users u on u.user_id = o.user_id where u.user_id = ' . $_GET['uid']);
?>
<table>
    <thead><tr><td><h2><?php echo $res[0]['user_name']; ?></h2></td></tr></thead>
    <tbody>
    <tr><td>Логин</td><td><?php echo $res[0]['user_login']; ?></td></tr>
    <tr><td>Контактный e-mail</td><td><?php echo $res[0]['user_email']; ?></td></tr>
    <tr><td>контактный телефон</td><td><?php echo $res[0]['user_phone']; ?></td></tr>

    <?php if ($res[0]['company_name'] != false) : ?>
    <tr><td><h3>Сведения о компании</h3></td></tr>
    <tr><td>Название организации</td><td><?php echo $res[0]['company_name']; ?></td></tr>
    <tr><td>Юридический адрес</td><td><?php echo $res[0]['company_address']; ?></td></tr>
    <?php endif; ?>

    <tr><td><h3>Заказы пользователя</h3></td></tr>
    <tr><td><strong>Название</strong></td><td><strong>Статус</strong></td></tr>
    <?php
        foreach ($res2 as $item) : ?>
            <tr>
                <td><a href="/order-more?oid=<?php echo $item['order_id']; ?>"><?php echo $item['order_name']; ?></a></td>
                <td><a href="/order-more?oid=<?php echo $item['order_id']; ?>"><?php echo $item['order_status']; ?></a></td>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<div class="sys-msg">
    <p></p>
</div>

<?php endif; ?>