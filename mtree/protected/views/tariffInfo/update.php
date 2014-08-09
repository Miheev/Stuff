<?php
/* @var $this TariffInfoController */
/* @var $model TariffInfo */

$this->breadcrumbs=array(
	'Tariff Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TariffInfo', 'url'=>array('index')),
	array('label'=>'Create TariffInfo', 'url'=>array('create')),
	array('label'=>'View TariffInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TariffInfo', 'url'=>array('admin')),
);
?>

<h1>Update TariffInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>