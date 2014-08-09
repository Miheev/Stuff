<?php
/* @var $this TariffInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tariff Infos',
);

$this->menu=array(
	array('label'=>'Create TariffInfo', 'url'=>array('create')),
	array('label'=>'Manage TariffInfo', 'url'=>array('admin')),
);
?>

<h1>Tariff Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
