<?php
/* @var $this RegStateController */
/* @var $model RegState */

$this->breadcrumbs=array(
	'Reg States'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RegState', 'url'=>array('index')),
	array('label'=>'Create RegState', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reg-state-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Reg States</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reg-state-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'admin',
		'accountant',
		'in_store',
		'supplier',
		'financier',
		/*
		'sign_fin',
		'signer',
		'sign_exec',
		'sign_general',
		'register_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
