<?php
/* @var $this UserurlController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Userurls',
);

$this->menu=array(
	array('label'=>'Create Userurl', 'url'=>array('create')),
	array('label'=>'Manage Userurl', 'url'=>array('admin')),
);
?>

<h1>Userurls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
