<?php
/* @var $this UserurlController */
/* @var $model Userurl */

$this->breadcrumbs=array(
	'Userurls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userurl', 'url'=>array('index')),
	array('label'=>'Manage Userurl', 'url'=>array('admin')),
);
?>

<h1>Create Userurl</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>