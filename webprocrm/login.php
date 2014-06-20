<?php
require_once 'config.php';
require_once 'php/std.php';

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

    $u = new crmUser($login);
    if ($u->id == 0) {
        die ('Wrong user data');
    }
    if ($pass == $u->getPass()) {
        $_SESSION['user']=$u->name;
        $_SESSION['login']=$u->login;
        $_SESSION['email']=$u->email;
        $_SESSION['u']= &$u;

        echo 'Access Granted';
    }

} else {
    header("Location: /");
}

?>