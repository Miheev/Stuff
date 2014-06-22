<?php
        $ses = false;
    if (isset($_SESSION['user']) && !empty($_SESSION['user']))
        $ses= true;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Добро пожаловать!</title>
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="add/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--Additional CSS Libs-->
        <?php echo $css_lib; ?>

        <style class="before-after">
                /***/
        </style>

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="add/bootstrap/js/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body class="<?php echo $page_class; ?>">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="h-container wrapper">
            <div class="h-wrapper">
      <!-- Example row of columns -->
            <header class="clearfix header" role="banner">
                <div class="clearfix">
                    <div class="logo"><a href="/"><img src="" alt="Logo" title="На главную страницу"></a></div>
                    <div class="content clearfix">
                        <?php if ($ses) : ?>
                            <div><p>Вы зашли как <a href="/personal"><?php echo $_SESSION['user']; ?></a></p><p><a href="/login.php?user_logout">Выход »</a></p></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($ses) : ?>
                    <nav class="clearfix">
                        <?php if ($curuser->hasPerm('edit') === false) { ?>
                            <ul class="sf-menu clearfix">
                                <li class="toplevel"><a href="/personal">Ваш профиль</a></li>
                                <li class="toplevel"><a href="/orders">Заказы</a></li>
                            </ul>
                        <?php } else { ?>
                            <a href="/admin-users"><button type="button" class="btn btn-success rool-user">Управление пользователями</button></a>
                            <a href="/orders"><button type="button" class="btn btn-success rool-order">Управление заказами</button></a>
                            <a href="/admin-add-user"><button type="button" class="btn btn-default add-user">+ Пользователя</button></a>
                            <a href="/admin-add-order"><button type="button" class="btn btn-primary add-order">+ Заказ</button></a>
                        <?php } ?>
                    </nav>
                <?php endif; ?>
            </header>
            <div class="main clearfix">
                <!--Main Content-->
                <?php include $main_block; ?>
            </div>

            <hr>
        </div>
      </div>

      <div class="l-footer wrapper">
          <footer class="clearfix" role="contentinfo">
            <p>&copy; WebPro 2014</p>
          </footer>
      </div>


        <!--Additional JS Libs-->
        <?php echo $script_lib; ?>

        <!--Additional Script-->
        <script>
            <?php include $script_block; ?>
        </script>
    </body>
</html>
