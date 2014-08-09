<?php
/* @var $this TreeDataController */
/* @var $model TreeData */

$this->breadcrumbs=array(
	'Tree Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TreeData', 'url'=>array('index')),
	array('label'=>'Manage TreeData', 'url'=>array('admin')),
);
?>

<h1>Create TreeData</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>