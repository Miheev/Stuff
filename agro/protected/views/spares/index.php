<?php
/* @var $this SparesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Spares',
);

$this->menu=array(
	array('label'=>'Create Spares', 'url'=>array('create')),
	array('label'=>'Manage Spares', 'url'=>array('admin')),
);
?>

<h1>Spares</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
