<?php
/* @var $this SparesController */
/* @var $model Spares */

//$this->breadcrumbs=array(
//	'Spares'=>array('index'),
//	$model->id=>array('view','id'=>$model->id),
//	'Update',
//);
//
//$this->menu=array(
//	array('label'=>'List Spares', 'url'=>array('index')),
//	array('label'=>'Create Spares', 'url'=>array('create')),
//	array('label'=>'View Spares', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Spares', 'url'=>array('admin')),
//);
?>

<h1>Редактировать запчасть <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>