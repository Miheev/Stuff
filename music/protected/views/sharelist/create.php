<?php
/* @var $this SharelistController */
/* @var $model Sharelist */

$this->breadcrumbs=array(
	'Sharelists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sharelist', 'url'=>array('index')),
	array('label'=>'Manage Sharelist', 'url'=>array('admin')),
);
?>

<h1>Create Sharelist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>