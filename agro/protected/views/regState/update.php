<?php
/* @var $this RegStateController */
/* @var $model RegState */

$this->breadcrumbs=array(
	'Reg States'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RegState', 'url'=>array('index')),
	array('label'=>'Create RegState', 'url'=>array('create')),
	array('label'=>'View RegState', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RegState', 'url'=>array('admin')),
);
?>

<h1>Update RegState <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>