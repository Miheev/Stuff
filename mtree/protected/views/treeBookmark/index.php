<?php
/* @var $this TreeBookmarkController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tree Bookmarks',
);

$this->menu=array(
	array('label'=>'Create TreeBookmark', 'url'=>array('create')),
	array('label'=>'Manage TreeBookmark', 'url'=>array('admin')),
);
?>

<h1>Tree Bookmarks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
