<?php
/* @var $this TreeDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tree Datas',
);

$this->menu=array(
	array('label'=>'Create TreeData', 'url'=>array('create')),
	array('label'=>'Manage TreeData', 'url'=>array('admin')),
);
?>

<h1>Tree Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
