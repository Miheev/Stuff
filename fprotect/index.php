<?php ///Blood Stain Child ##melodic metal!!!
require_once 'config.php';

/**
 * Login/User Check
 */
//if(isset($_REQUEST[session_name()]))
session_start();

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {

    if (isset($_SESSION['timeout'])) {
        # Check Session Time for expiry
        #
        # Time is in seconds. 10 * 60 = 600s = 10 minutes
        if ($_SESSION['timeout'] + 30 * 60 < time()) {
            session_destroy();
            header("Location: /");
        }
    }

        if (isset($_GET['q'])) {
            $page_class = 'page-docs-page';
            $main_block .= $_GET['q'];
        } else {
        //Default Page

        $page_class = 'page-docs';
        $main_block .= 'page/docs/index.html';
        }

} else {
    # Check for session timeout, else initiliaze time
    # Initialize variables
    $_SESSION['user'] = "";
    $_SESSION['login'] = "";
    $_SESSION['email'] = "";
    $_SESSION['timeout'] = time();

    if (isset($_GET['q'])) {
        header('Location: /');
    } else {
        //include 'login.php';
        $page_class = 'page-login';
        $main_block .= 'page/login/login.php';
    }
}


include 'tpl/main.php';

?>