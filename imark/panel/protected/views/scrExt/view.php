<?php
/* @var $this ScrExtController */
/* @var $model ScrExt */

$this->breadcrumbs=array(
	'Scr Exts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ScrExt', 'url'=>array('index')),
//	array('label'=>'Create ScrExt', 'url'=>array('create')),
	array('label'=>'Update ScrExt', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ScrExt', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ScrExt', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>View ScrExt #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'script',
		'profile_id',
	),
)); ?>
