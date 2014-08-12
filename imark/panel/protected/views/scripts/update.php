<?php
/* @var $this ScriptsController */
/* @var $model Scripts */

$this->breadcrumbs=array(
	'Scripts'=>array('index'),
	$model->code=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Scripts', 'url'=>array('index')),
	array('label'=>'Create Scripts', 'url'=>array('create')),
	array('label'=>'View Scripts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Scripts', 'url'=>array('admin'), 'visible'=>(Yii::app()->user->name == Yii::app()->params['admin_name'])),
);
?>

<h1>Update Scripts <?php echo $model->code; ?></h1>



