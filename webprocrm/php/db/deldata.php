<?php
require_once(ABSPATH.'php/conf.php');
require_once(ABSPATH.'php/std.php');

//if (isset($_GET['ajax']) && $_GET['ajax'] == 'del') {
    $ptype= intval($_POST['ptype']);
    $id= intval($_POST['id']);
    //DELETE FROM `brokdata`.`br_homeinfo` WHERE `br_homeinfo`.`id` = 138

    $table= 'br_homeinfo';
    if (intval($ptype) == 4) $table= 'br_acreinfo';
    else if (intval($ptype) == 3) $table= 'br_cominfo';

    $query="DELETE FROM $table WHERE id = $id";

    $link->query($query);
//}
?>