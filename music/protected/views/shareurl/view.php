<?php
/* @var $this ShareurlController */
/* @var $model Shareurl */

$this->breadcrumbs=array(
	'Shareurls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Shareurl', 'url'=>array('index')),
	array('label'=>'Create Shareurl', 'url'=>array('create')),
	array('label'=>'Update Shareurl', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Shareurl', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Shareurl', 'url'=>array('admin')),
);
?>

<h1>View Shareurl #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'user_id',
	),
)); ?>
