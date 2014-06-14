<?php
require_once 'config.php';
require_once 'php/std.php';

$page_path= trim($_SERVER["REQUEST_URI"], '/\\ ');
if (isset($page_path) && !empty($page_path)){

    switch ($page_path) {
        case 'personal':
            $page_title= 'Личный кабинет';
            $page_class= 'page-main';
            $main_block .= 'page/personal/personal.php';
            $script_block .= '';
            $css_lib = <<<EOT
EOT;
            $script_lib = <<<EOT
EOT;
            break;
        case 'docs':
            $page_title= 'Документы';
            $page_class= 'page-main';
            $main_block .= 'page/docs/docs.php';
            $script_block .= '';
            $css_lib = <<<EOT
EOT;
            $script_lib = <<<EOT
EOT;
            break;
        case 'projects':
            $page_title= 'Ваш профиль';
            $page_class= 'page-main';
            $main_block .= 'page/personal/personal.php';
            $script_block .= '';
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

include 'tpl/main.php';

?>