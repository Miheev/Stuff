<?php
/* @var $this ScrTelrepController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Scr Telreps',
);

$this->menu=array(
	//array('label'=>'Create ScrTelrep', 'url'=>array('create')),
	array('label'=>'Manage ScrTelrep', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Scr Telreps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
