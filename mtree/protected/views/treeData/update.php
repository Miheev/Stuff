<?php
/* @var $this TreeDataController */
/* @var $model TreeData */

$this->breadcrumbs=array(
	'Tree Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TreeData', 'url'=>array('index')),
	array('label'=>'Create TreeData', 'url'=>array('create')),
	array('label'=>'View TreeData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TreeData', 'url'=>array('admin')),
);
?>

<h1>Update TreeData <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>