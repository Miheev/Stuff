<?php
/* @var $this TreeBookmarkController */
/* @var $model TreeBookmark */

$this->breadcrumbs=array(
	'Tree Bookmarks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TreeBookmark', 'url'=>array('index')),
	array('label'=>'Create TreeBookmark', 'url'=>array('create')),
	array('label'=>'Update TreeBookmark', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TreeBookmark', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TreeBookmark', 'url'=>array('admin')),
);
?>

<h1>View TreeBookmark #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tree_id',
		'user_id',
		'question_id',
	),
)); ?>
