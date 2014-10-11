<?php
/* @var $this SharelistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sharelists',
);

$this->menu=array(
	array('label'=>'Create Sharelist', 'url'=>array('create')),
	array('label'=>'Manage Sharelist', 'url'=>array('admin')),
);
?>

<h1>Sharelists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
