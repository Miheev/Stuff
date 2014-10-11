<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<?php
$page_class=trim($_SERVER['REQUEST_URI'], '/');
if (empty($page_class))
    $page_class= 'index';
else {
    $page_class = Transliteration::text($page_class,'-');
    preg_match('/.*(?=\?)/', $page_class, $tmp);
    $page_class = empty($tmp[0]) ? strtolower($page_class) : strtolower($tmp[0]);
    $page_class = str_replace(array("\\", '&', '?', '/'), '-', $page_class);
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="<?php echo $page_class; ?>">
<?php
//$criteria=new CDbCriteria;
//$criteria->alias='u';
//$criteria->join='join request r on u.id=r.user_id';
//$criteria->join.=' join register rg on r.id=rg.request_id';
//$criteria->condition= 'rg.id=:back';
//$criteria->order= 'id desc';
//$criteria->params=array(':back'=>1858);
//$users= Users::model()->findAll($criteria);
//var_dump($users);
//$text = Transliteration::text('лоыловтмлыАБВ');
//$text = strtolower($text);
//var_dump($text);
//$users= Users::model()->findAllByAttributes(array(),'role=:role1 || role=:role2', array(':role1'=>'admin',':role2'=>'root'));
//$criteria=new CDbCriteria();
//$criteria->order='id desc';
//$criteria->limit=10;
//$users= Request::model()->findAll($criteria);
//var_dump($users);
//var_dump(Yii::app()->getBaseUrl(true) . $this->createUrl('/'.'request'.'/view',array('id'=>40)));
//    var_dump(Yii::app()->user->model->phone);
//var_dump(Yii::app()->getBaseUrl(true));
//var_dump(dirname(Yii::app()->BasePath));
//$tmp= date('H-i-s-d-m-Y');
//$ee= 0;
//var_dump(empty($ee));
//var_dump(isset($ee));
//var_dump(count($ee));
//Request::getNew();
?>
<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
//				array('label'=>'Home', 'url'=>array('/site/index')),
//				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
//				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
//				array('label'=>'Регистрация', 'url'=>array('/users/create'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

                array('label'=>'Заявки', 'url'=>array('/request/index')),
//                array('label'=>'Реестр (Последние записи)', 'url'=>array('/register/index')),
                array('label'=>'Реестр', 'url'=>array('/register/trace')),
                array('label'=>'Запчасти', 'url'=>array('/spares/index'), 'visible'=>Yii::app()->user->checkAccess('root')),
                array('label'=>'Статус заявки', 'url'=>array('/regState/index'), 'visible'=>Yii::app()->user->checkAccess('root')),
                array('label'=>'Пользователи', 'url'=>array('/users/index'), 'visible'=>Yii::app()->user->checkAccess('root')),
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
