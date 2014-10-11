<?php
/* @var $this SharelistController */
/* @var $model Sharelist */

$this->breadcrumbs=array(
	'Sharelists'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Sharelist', 'url'=>array('index')),
	array('label'=>'Create Sharelist', 'url'=>array('create')),
	array('label'=>'Update Sharelist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sharelist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sharelist', 'url'=>array('admin')),
);
?>

<h1>View Sharelist #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'singer',
		'song',
		'genre',
		'user_id',
	),
)); ?>
