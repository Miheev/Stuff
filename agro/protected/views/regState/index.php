<?php
/* @var $this RegStateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reg States',
);

$this->menu=array(
	array('label'=>'Create RegState', 'url'=>array('create')),
	array('label'=>'Manage RegState', 'url'=>array('admin')),
);
?>

<h1>Reg States</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
