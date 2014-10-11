<?php
/* @var $this SparesController */
/* @var $model Spares */

$this->breadcrumbs=array(
	'Spares'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Spares', 'url'=>array('index')),
	array('label'=>'Manage Spares', 'url'=>array('admin')),
);
?>

<h1>Create Spares</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>