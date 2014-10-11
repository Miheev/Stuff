<?php
/* @var $this SharelistController */
/* @var $model Sharelist */

$this->breadcrumbs=array(
	'Sharelists'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sharelist', 'url'=>array('index')),
	array('label'=>'Create Sharelist', 'url'=>array('create')),
	array('label'=>'View Sharelist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sharelist', 'url'=>array('admin')),
);
?>

<h1>Update Sharelist <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>