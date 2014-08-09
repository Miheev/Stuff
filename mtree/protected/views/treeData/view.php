<?php
/* @var $this TreeDataController */
/* @var $model TreeData */

$this->breadcrumbs=array(
	'Tree Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TreeData', 'url'=>array('index')),
	array('label'=>'Create TreeData', 'url'=>array('create')),
	array('label'=>'Update TreeData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TreeData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TreeData', 'url'=>array('admin')),
);
?>

<h1>View TreeData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'answers',
		'creator_id',
	),
)); ?>
