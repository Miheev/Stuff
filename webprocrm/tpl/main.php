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

        <link rel="stylesheet" href="add/bootstrap/css/bootstrap.nocf.css">
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
		<header>
                <div class="header1 ">
					<div class="width-list">
						<div class="logo"><a href="http://webpro.su/" id="logo"></a></div>
						<div class="back-to"><a href="http://webpro.su/">Вернуться на основной сайт</a></div>
					</div>
                </div>
				<?php if ($ses) : ?>
				<div class="header2">
					<div class="width-list">
						<div class="user-name">
								<div><p>Вы зашли как <a href="/personal"><?php echo $_SESSION['user']; ?></a></p></div>
						</div>
						<div class="exit">
							<p><a href="/login.php?user_logout">Выход »</a></p>
						</div>
					</div>
                </div>
				<?php endif; ?>
              
        </header>
		<?php if ($ses) : ?>
		<div class="nav-menu width-list">
				
                    <?php if ($curuser->hasPerm('edit') === false) { ?>
                            <div class="contol">
							<a href="/personal"><button type="button" class="btn btn-success rool-user">Ваш профиль</button></a>
                            <a href="/orders"><button type="button" class="btn btn-success rool-order">Заказы</button></a>
							</div>
                        <?php } else { ?>
							<div class="contol">
								<a href="/admin-users"><button type="button" class="btn btn-success rool-user">Управление пользователями</button></a>
								<a href="/orders"><button type="button" class="btn btn-success rool-order">Управление заказами</button></a>
							</div>
							<div class="add-node">
								<a href="/admin-add-user"><button type="button" class="btn btn-default add-user">+ Пользователя</button></a>
								<a href="/admin-add-order"><button type="button" class="btn btn-primary add-order">+ Заказ</button></a>
							</div>
                        <?php } ?>
                
		</div>
		<?php endif; ?>
        <div class="wrapper"> 
      <!-- Example row of columns -->
            <div class="main width-list">
                <!--Main Content-->
                <?php include $main_block; ?>
            </div>
      </div>

      <div id="footer">
		<div class="width-list">
			<div class="copyright">
				<a href="/content/politika-konfi" target="_blank"> Политика конфиденциальности</a><br>
			2013-2014 © webpro.su Все права защищены
			</div>
			<div class="contact">
				<div class="phone">+7 (4212)944-320</div>
				<div class="email">info@webpro.su</div>
			</div>
		</div>
	</div>


        <!--Additional JS Libs-->
        <?php echo $script_lib; ?>

        <!--Additional Script-->
        <script>
            <?php include $script_block; ?>
        </script>
    </body>
</html>
