<?php
/* @var $this ShareurlController */
/* @var $model Shareurl */

$this->breadcrumbs=array(
	'Shareurls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Shareurl', 'url'=>array('index')),
	array('label'=>'Manage Shareurl', 'url'=>array('admin')),
);
?>

<h1>Create Shareurl</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>