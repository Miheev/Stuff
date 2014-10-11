<?php
/* @var $this UserurlController */
/* @var $model Userurl */

$this->breadcrumbs=array(
	'Userurls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Userurl', 'url'=>array('index')),
	array('label'=>'Create Userurl', 'url'=>array('create')),
	array('label'=>'Update Userurl', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Userurl', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userurl', 'url'=>array('admin')),
);
?>

<h1>View Userurl #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'user_id',
	),
)); ?>
