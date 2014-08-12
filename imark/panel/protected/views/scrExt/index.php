<?php
/* @var $this ScrExtController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Scr Exts',
);

$this->menu=array(
//	array('label'=>'Create ScrExt', 'url'=>array('create')),
	array('label'=>'Manage ScrExt', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Scr Exts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
