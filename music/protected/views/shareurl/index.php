<?php
/* @var $this ShareurlController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Shareurls',
);

$this->menu=array(
	array('label'=>'Create Shareurl', 'url'=>array('create')),
	array('label'=>'Manage Shareurl', 'url'=>array('admin')),
);
?>

<h1>Shareurls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
