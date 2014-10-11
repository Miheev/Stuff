<?php
/* @var $this UserlistController */
/* @var $model Userlist */

$this->breadcrumbs=array(
	'Userlists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userlist', 'url'=>array('index')),
	array('label'=>'Manage Userlist', 'url'=>array('admin')),
);
?>

<h1>Create Userlist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>