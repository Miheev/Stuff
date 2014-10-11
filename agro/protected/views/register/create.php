<?php
/* @var $this RegisterController */
/* @var $model Register */

$this->breadcrumbs=array(
	'Записи реестра'=>array('trace'),
	'Создать новую',
);

$this->menu=array(
	array('label'=>'Cписок записей реестра', 'url'=>array('trace')),
);
?>

<h1>Добавить запись в реестр</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'state'=>$state)); ?>