<?php ///Isida Yoko ##pop
        $ses = false;
    if (isset($_SESSION['user']) && !empty($_SESSION['user']))
        $ses= true;
?>
<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Добро пожаловать!</title>
        <meta name="viewport" content="width=device-width">

        <style class="before-after">
                /***/
        </style>

        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

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
				
		</div>
		<?php endif; ?>
        <div class="wrapper"> 
      <!-- Example row of columns -->
            <div class="main width-list">
                <!--Main Content-->
                <?php include $main_block; ?>
            </div>
      </div>
    </body>
</html>
