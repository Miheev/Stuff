<?php
/* @var $this TreeBookmarkController */
/* @var $model TreeBookmark */

$this->breadcrumbs=array(
	'Tree Bookmarks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TreeBookmark', 'url'=>array('index')),
	array('label'=>'Manage TreeBookmark', 'url'=>array('admin')),
);
?>

<h1>Create TreeBookmark</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>