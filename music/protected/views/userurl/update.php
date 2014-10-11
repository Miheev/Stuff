<?php
/* @var $this UserurlController */
/* @var $model Userurl */

$this->breadcrumbs=array(
	'Userurls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userurl', 'url'=>array('index')),
	array('label'=>'Create Userurl', 'url'=>array('create')),
	array('label'=>'View Userurl', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Userurl', 'url'=>array('admin')),
);
?>

<h1>Update Userurl <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>