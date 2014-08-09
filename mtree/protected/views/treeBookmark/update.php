<?php
/* @var $this TreeBookmarkController */
/* @var $model TreeBookmark */

$this->breadcrumbs=array(
	'Tree Bookmarks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TreeBookmark', 'url'=>array('index')),
	array('label'=>'Create TreeBookmark', 'url'=>array('create')),
	array('label'=>'View TreeBookmark', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TreeBookmark', 'url'=>array('admin')),
);
?>

<h1>Update TreeBookmark <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>