<?php
/* @var $this UserlistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Userlists',
);

$this->menu=array(
	array('label'=>'Create Userlist', 'url'=>array('create')),
	array('label'=>'Manage Userlist', 'url'=>array('admin')),
);
?>

<h1>Userlists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
