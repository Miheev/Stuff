<?php
/**
 * Created by PhpStorm.
 * User: storm              /Kon Katsumi
 * Date: 6/13/14
 * Time: 3:28 PM
 */

$res= $link->query("select * from users_company where user_id = '$curuser->id'");

?>
<table>
    <thead><tr><td><h2><?php echo $curuser->name; ?></h2></td></tr></thead>
    <tbody>
    <tr><td>Логин</td><td><?php echo $curuser->login; ?></td></tr>
    <tr><td>Контактный e-mail</td><td><?php echo $curuser->email; ?></td></tr>
    <tr><td>контактный телефон</td><td><?php echo $curuser->phone; ?></td></tr>

    <?php if ($res != false) : ?>
    <tr><td><h3>Сведения о компании</h3></td></tr>
    <tr><td>Название организации</td><td><?php echo $res[0]['company_name']; ?></td></tr>
    <tr><td>Юридический адрес</td><td><?php echo $res[0]['company_address']; ?></td></tr>
    <?php endif; ?>
    </tbody>
</table>


<div class="sys-msg">
    <p></p>
</div>