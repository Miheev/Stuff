<?php
/* @var $this RegisterController */
/* @var $model Register */

$this->breadcrumbs=array(
	'Записи реестра'=>array('trace'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('trace')),
	array('label'=>'Создать запись', 'url'=>array('/request/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#register-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление реестром</h1>

<p>
    Вы также можите использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    или <b>=</b>) в начале каждого поискового запроса, чтобы уточнить как будет происходить отбор.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'register-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'sp',
		'fio_req',
		'request_id',
		'reg_date',
		/*
		'mark',
		'model',
		'inv_id',
		'fio_exec',
		'pact_id',
		'pact_date',
		'city',
		'agent_name',
		'account_id',
		'account_date',
		'account_sum',
		'date_out_real',
		'date_out_plan',
		'date_in_plan',
		'date_in_real',
		'date_in_real_sp',
		'pay_date',
		'trust_id',
		'request_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
