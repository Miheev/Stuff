<?php
/* @var $this SparesController */
/* @var $model Spares */

$this->breadcrumbs=array(
	'Spares'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Spares', 'url'=>array('index')),
	array('label'=>'Create Spares', 'url'=>array('create')),
	array('label'=>'Update Spares', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Spares', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Подтверждение удаления элемента. Продолжить?')),
	array('label'=>'Manage Spares', 'url'=>array('admin')),
);
?>

<h1>View Spares #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
//		'mark',
		'model',
		'count',
		'cat_id',
//		'cat_date',
		'register_id',
	),
)); ?>
