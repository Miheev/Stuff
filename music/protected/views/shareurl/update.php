<?php
/* @var $this ShareurlController */
/* @var $model Shareurl */

$this->breadcrumbs=array(
	'Shareurls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Shareurl', 'url'=>array('index')),
	array('label'=>'Create Shareurl', 'url'=>array('create')),
	array('label'=>'View Shareurl', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Shareurl', 'url'=>array('admin')),
);
?>

<h1>Update Shareurl <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>