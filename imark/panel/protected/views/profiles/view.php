<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
    $model->code,
);

$this->menu=array(
	array('label'=>'List Profiles', 'url'=>array('index')),
	array('label'=>'Create Profiles', 'url'=>array('create')),
	array('label'=>'Update Profiles', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Profiles', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profiles', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>View Profiles #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'domain',
		'code',
//		'user_id',
	),
)); ?>

    <h2>Код для вставки</h2>
<?php echo CHtml::textArea('script_insert',$model->ScriptBase() ,array('rows'=>10, 'style'=>'width:100%;')); ?>

<h2>Менеджер Скриптов</h2>
<?php $this->widget('zii.widgets.CMenu',array(
    'items'=>array(
        array('label'=>'Подмена номеров', 'url'=>array('/scrTelrep/append', 'id'=>$model->id)),
        array('label'=>'Произвольный скрипт', 'url'=>array('/scrExt/append', 'id'=>$model->id)),
    ),
)); ?>