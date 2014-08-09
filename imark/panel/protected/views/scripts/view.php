<?php
/* @var $this ScriptsController */
/* @var $model Scripts */

$this->breadcrumbs=array(
	'Scripts'=>array('index'),
	$model->code,
);

$this->menu=array(
	array('label'=>'List Scripts', 'url'=>array('index')),
	array('label'=>'Create Scripts', 'url'=>array('create')),
	array('label'=>'Update Scripts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Scripts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Scripts', 'url'=>array('admin'), 'visible'=>(Yii::app()->user->name == Yii::app()->params['admin_name'])),
);
?>

<h1>View Scripts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
//		'script',
		'code',
        'domain',
        'params',
//        'user_id',
	),
)); ?>

<h2>Код для вставки</h2>
<?php echo CHtml::textArea('script_insert',$model->ScriptBase() ,array('rows'=>10, 'style'=>'width:100%;')); ?>