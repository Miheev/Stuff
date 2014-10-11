<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Заявки', 'url'=>array('index')),
	array('label'=>'Создать заявку', 'url'=>array('create')),
	array('label'=>'Заявка: Подробно', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление заявками', 'url'=>array('admin')),
);
?>

<h1>Редактировать заявку <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php //$this->renderPartial('_form_spares', $spares); ?>