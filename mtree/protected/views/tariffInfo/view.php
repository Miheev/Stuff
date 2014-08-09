<?php
/* @var $this TariffInfoController */
/* @var $model TariffInfo */

$this->breadcrumbs=array(
	'Tariff Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TariffInfo', 'url'=>array('index')),
	array('label'=>'Create TariffInfo', 'url'=>array('create')),
	array('label'=>'Update TariffInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TariffInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TariffInfo', 'url'=>array('admin')),
);
?>

<h1>View TariffInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>
