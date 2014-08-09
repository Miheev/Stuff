<?php
/* @var $this TariffInfoController */
/* @var $model TariffInfo */

$this->breadcrumbs=array(
	'Tariff Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TariffInfo', 'url'=>array('index')),
	array('label'=>'Manage TariffInfo', 'url'=>array('admin')),
);
?>

<h1>Create TariffInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>