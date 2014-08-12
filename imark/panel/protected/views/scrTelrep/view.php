<?php
/* @var $this ScrTelrepController */
/* @var $model ScrTelrep */

$this->breadcrumbs=array(
	'Scr Telreps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ScrTelrep', 'url'=>array('index')),
	//array('label'=>'Create ScrTelrep', 'url'=>array('create')),
	array('label'=>'Update ScrTelrep', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ScrTelrep', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ScrTelrep', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>View ScrTelrep #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'params',
		'profile_id',
	),
)); ?>
