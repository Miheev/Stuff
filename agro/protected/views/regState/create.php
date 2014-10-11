<?php
/* @var $this RegStateController */
/* @var $model RegState */

$this->breadcrumbs=array(
	'Reg States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RegState', 'url'=>array('index')),
	array('label'=>'Manage RegState', 'url'=>array('admin')),
);
?>

<h1>Create RegState</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>