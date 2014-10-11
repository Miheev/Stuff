<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Запросы', 'url'=>array('index')),
	array('label'=>'Управлять запросами', 'url'=>array('admin')),
);
?>

<h1>Создать заявку</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>