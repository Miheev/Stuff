<?php
/* @var $this RegisterController */
/* @var $model Register */

$this->breadcrumbs=array(
	'Записи реестра'=>array('trace'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Записи реестра', 'url'=>array('trace')),
	array('label'=>'Создать запись', 'url'=>array('/request/index')),
	array('label'=>'Редактировать запись', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить запись', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Подтверждение удаления элемента. Продолжить?')),
	array('label'=>'Управлять записями', 'url'=>array('admin')),
);
?>
<?php if (isset($_GET['msg'])) : ?>
    <h3 style="background: yellowgreen; padding: 10px;"><?php echo $_GET['msg']; ?></h3>
<? endif; ?>

<h1>Просмотреть запись #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sp',
		'fio_req',
//		'request_id',
		'reg_date',
//		'mark',
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

//        array('name'=>'spares.model', 'value'=>$model->spares[0]->model),
//        array('name'=>'spares.mark', 'value'=>$model->spares[0]->mark),
//        array('name'=>'spares.count', 'value'=>$model->spares[0]->count),
//        array('name'=>'spares.cat_id', 'value'=>$model->spares[0]->cat_id),
//        array('name'=>'spares.cat_date', 'value'=>$model->spares[0]->cat_date),

        array('name'=>'regStates.in_store', 'value'=>$model->storeOut($model->regStates[0]->in_store)),
//        array('name'=>'regStates.sign_fin', 'value'=>$model->boolOut($model->regStates[0]->sign_fin)),
        array('name'=>'regStates.sign_exec', 'value'=>$model->boolOut($model->regStates[0]->sign_exec)),
        array('name'=>'regStates.sign_general', 'value'=>$model->boolOut($model->regStates[0]->sign_general)),

        'comment',
//		'request_id',
	),
)); ?>
