<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('root')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Подтверждение удаления элемента. Продолжить?'), 'visible'=>Yii::app()->user->checkAccess('root')),
	array('label'=>'Manage Users', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('root')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		'pass',
		'name',
		'phone',
		'role',
		'available',
	),
)); ?>
