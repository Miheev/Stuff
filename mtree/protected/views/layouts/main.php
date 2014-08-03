<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html class="no-js" xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

    <!--[if lt IE 9]>
    <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
    <![endif]-->

<!--    --><?php //Yii::app()->clientScript->registerCoreScript('jquery');
//    I would recommend that you copy the file
//framework/web/js/source/jui/js/jquery-ui-i18n.min.js
//to the "javascript/jui" directory under your document root -
///yourapplication/www/javascript/jui/jquery-ui-i18n.min.js
//
//Then edit your controller, adding:
//
//
//$baseUrl = Yii::app()->request->baseUrl;
//$clientScriptUrl = "{$baseUrl}/javascript/jui/jquery-ui-i18n.min.js";
//$clientScript = Yii::app()->clientScript;
//$clientScript->registerScriptFile($clientScriptUrl, CClientScript::POS_HEAD);

    ?>
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<!--    <script>window.jQuery || document.write('<script src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/vendor/jquery-1.11.0.min.js"><\/script>')</script>-->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php
//var_dump(Yii::app()->user->id);
//if(Yii::app()->user->isGuest) var_dump(23232323);
?>
<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Tariffinfo', 'url'=>array('/tariffInfo/index')),
                array('label'=>'Users', 'url'=>array('/users/index')),
                array('label'=>'Tree', 'url'=>array('/tree/index')),
                array('label'=>'Treedata', 'url'=>array('/treeData/index')),
                array('label'=>'Treebookmark', 'url'=>array('/treeBookmark/index'))
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
