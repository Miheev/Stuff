<?php
require_once 'config.php';
require_once 'php/std.php';

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
        if ($_SESSION['timeout'] + 30 * 60 < time()){
            session_destroy();
            header("Location: /");
        }
    }

    $curuser= &$_SESSION['u'];
    if ($curuser->hasPerm('view') !== false) {
        $page_path= trim($_SERVER["REQUEST_URI"], '/\\ ');
        if (isset($page_path) && !empty($page_path)){
            switch ($page_path) {
                case 'personal':
                    $page_title= 'Личный кабинет';
                    $page_class= 'page-personal';
                    $main_block .= 'page/personal/personal.php';
                    $script_block .= 'tpl/blank.js';
                    $css_lib = <<<EOT
EOT;
                    $script_lib = <<<EOT
EOT;
                    break;
                case 'docs':
                    $page_title= 'Документы';
                    $page_class= 'page-docs';
                    $main_block .= 'page/docs/docs.php';
                    $script_block .= 'tpl/blank.js';
                    $css_lib = <<<EOT
EOT;
                    $script_lib = <<<EOT
EOT;
                    break;
                case 'projects':
                    $page_title= 'Ваш профиль';
                    $page_class= 'page-main';
                    $main_block .= 'page/personal/personal.php';
                    $script_block .= 'tpl/blank.js';
                    $css_lib = <<<EOT
EOT;
                    $script_lib = <<<EOT
EOT;
                    break;
                case 'chat':
                    header("Location: /portfolio");
                    $header_h1 = '<h1 role="heading">наши работы</h1>';
                    $main_block .= 'content/portfolio/portfolio.html';
                    $more_block .= '';
                    $social_block .= '';
                    $script_block .= 'content/portfolio/code.js';
                    $csslocal = 'portfolio';
                    $css_lib = '<link href="add/amslider/amslider.css" rel="stylesheet">';
                    $script_lib = <<<EOT
            <script src="add/amslider/sliderengine/amazingslider.js"></script>
            <script src="add/amslider/sliderengine/initslider-1.js"></script>
EOT;
                    break;
                //
                default: header("Location: /404.html");
            }
        } else {
            $page_title= 'Главная';
            $page_class= 'page-main';
            $main_block .= 'page/index/index.php';
            $script_block .= '';
            $css_lib = <<<EOT
EOT;
            $script_lib = <<<EOT
EOT;
        }
    } else { ?>
        <div class="sys-msg">
            <p>У вас нет доступа к данному контенту.</p>
        </div>
    <?php }
} else {
    # Check for session timeout, else initiliaze time
        # Initialize variables
        $_SESSION['user']="";
        $_SESSION['login']="";
        $_SESSION['email']="";
        $_SESSION['timeout']=time();

        //include 'login.php';
    $page_title= 'Авторизация';
    $page_class= 'page-login';
    $main_block .= 'page/login/login.php';
    $script_block .= 'tpl/blank.js';
    $css_lib = <<<EOT
EOT;
    $script_lib = <<<EOT
EOT;
}




include 'tpl/main.php';

?>