<?php
/* @var $this RegStateController */
/* @var $model RegState */

$this->breadcrumbs=array(
	'Reg States'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RegState', 'url'=>array('index')),
	array('label'=>'Create RegState', 'url'=>array('create')),
	array('label'=>'Update RegState', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RegState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Подтверждение удаления элемента. Продолжить?')),
	array('label'=>'Manage RegState', 'url'=>array('admin')),
);
?>

<h1>View RegState #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'admin',
		'accountant',
		'in_store',
		'supplier',
		'financier',
//		'sign_fin',
        'signer',
		'sign_exec',
		'sign_general',
		'register_id',
	),
)); ?>
