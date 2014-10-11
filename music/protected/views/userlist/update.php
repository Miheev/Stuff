<?php
/* @var $this UserlistController */
/* @var $model Userlist */

$this->breadcrumbs=array(
	'Userlists'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userlist', 'url'=>array('index')),
	array('label'=>'Create Userlist', 'url'=>array('create')),
	array('label'=>'View Userlist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Userlist', 'url'=>array('admin')),
);
?>

<h1>Update Userlist <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>