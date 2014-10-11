<?php
/* @var $this UserlistController */
/* @var $model Userlist */

$this->breadcrumbs=array(
	'Userlists'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Userlist', 'url'=>array('index')),
	array('label'=>'Create Userlist', 'url'=>array('create')),
	array('label'=>'Update Userlist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Userlist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userlist', 'url'=>array('admin')),
);
?>

<h1>View Userlist #<?php echo $model->id; ?></h1>

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
