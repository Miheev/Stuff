<?php
require_once 'config.php';

/**
 * Login/User Check
 */
    session_start();

if (isset($_GET['user_logout'])) {
try{
    session_destroy();
}
catch (Exception $e) {
    foreach ($_SESSION as $item)
        unset($item);
}
    header("Location: /");
}

if (isset($_SESSION['user']) && empty($_SESSION['user'])) {

    $login= $_POST['login'];
    $pass= hash('sha256', $_POST['pass'] . AUTH_KEY);

    $res = $link->query("SELECT * FROM users WHERE user_login = '$login'");
    $u= $res[0];
    if ($u['user_id'] == 0) {
        die ('Wrong user data');
    }
    $u_pass= hash('sha256', $u['user_pass'] . AUTH_KEY);
    if ($pass == $u_pass) {
        $_SESSION['uid']=$u['user_id'];
        $_SESSION['user']=$u['user_name'];
        $_SESSION['login']=$u['user_login'];
        $_SESSION['email']=$u['user_email'];

        echo 'Access Granted';
    }
} else {
    header("Location: /");
}

?>