<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Profiles', 'url'=>array('index')),
	array('label'=>'Manage Profiles', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Create Profiles</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>