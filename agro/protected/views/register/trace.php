<?php
/* @var $this RegisterController */
/* @var $model Register */

$this->breadcrumbs=array(
	'Новые записи'=>array('index'),
	'Записи реестра',
);

$this->menu=array(
	array('label'=>'Последнии записи', 'url'=>array('index')),
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

<h1>Список записей</h1>

<p>
Вы также можите использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале каждого поискового запроса, чтобы уточнить как будет происходить отбор.
</p>

<?php echo CHtml::link('Подробный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('CGridViewPlus', array(
	'id'=>'register-grid',
	'dataProvider'=>$model->search($_GET['page_count']),
	'filter'=>$model,
//    'pager'=>array(
//        'header'         => '',
//        'firstPageLabel' => '&lt;&lt;',
//        'lastPageLabel'  => '&gt;&gt;',
//    ),
    'pager' => array(
        'class' => 'PagerSA',
//        'cssFile'=>'/themes/version_3/css/widgets/adminPager.css',
        'header'=>'',
    ),
    'pagerCssClass'=>'pagination pagination-centered',
    'template'=>"{summary}<br />{pager}<br />{items}<br />{pager}<br />",
	'columns'=>array(
        array(
            'class'=>'CButtonColumn',
        ),
//		'id',
        array('name'=>'id', 'type'=>'html', 'value'=>'CHtml::link($data->id, array("/request/view", "id"=>$data->request_id))'),
		'sp',
		'fio_req',
//		array('name'=>'request_id', 'type'=>'html', 'value'=>'CHtml::link($data->request_id, array("/request/view", "id"=>$data->request_id))'),
		'reg_date',

//		'mark',
		'model',
		'inv_id',

        'sp_model',
//        'sp_mark',
        'sp_count',
        'cat_id',
//        'cat_date',

		'fio_exec',

		array('name'=>'pact_id', 'header'=>$model->getCutName('pact_id'), 'value'=>'$data->pact_id'),
		array('name'=>'pact_date', 'header'=>$model->getCutName('pact_date'), 'value'=>'$data->pact_date'),

		'city',
		'agent_name',

        array('name'=>'account_id', 'header'=>$model->getCutName('account_id'), 'value'=>'$data->account_id'),
        array('name'=>'account_date', 'header'=>$model->getCutName('account_date'), 'value'=>'$data->account_date'),
        array('name'=>'account_sum', 'header'=>$model->getCutName('account_sum'), 'value'=>'$data->account_sum'),

        'pay_date',
        'trust_id',

        array('name'=>'date_out_real', 'header'=>$model->getCutName('date_out_real'), 'value'=>'$data->date_out_real'),
        array('name'=>'date_out_plan', 'header'=>$model->getCutName('date_out_plan'), 'value'=>'$data->date_out_plan'),
        array('name'=>'date_in_plan', 'header'=>$model->getCutName('date_in_plan'), 'value'=>'$data->date_in_plan'),
        array('name'=>'date_in_real', 'header'=>$model->getCutName('date_in_real'), 'value'=>'$data->date_in_real'),
		'date_in_real_sp',

        array('name'=>'in_store', 'value'=>'Register::storeOut($data->in_store)'),
//        array('name'=>'sign_fin', 'value'=>'Register::boolOut($data->sign_fin)'),
        array('name'=>'sign_exec', 'value'=>'Register::boolOut($data->sign_exec)'),
        array('name'=>'sign_general', 'value'=>'Register::boolOut($data->sign_general)'),

        'comment'

//		'request_id',
	),
    'addingHeaders' => array(
        array(
            array('text'=>'Операции','colspan'=>1,'options'=>array('class'=>'void operation')),
            array('text'=>'','colspan'=>4,'options'=>array('class'=>'void request')),
            array('text'=>'Объект использования','colspan'=>2,'options'=>array('class'=>'car')),
            array('text'=>'Запчасть','colspan'=>3,'options'=>array('class'=>'spares')),
            array('text'=>'','colspan'=>1,'options'=>array('class'=>'void fio-exec')),
            array('text'=>'Договор','colspan'=>2,'options'=>array('class'=>'pact')),
            array('text'=>'','colspan'=>2,'options'=>array('class'=>'void city')),
            array('text'=>'Счёт','colspan'=>3,'options'=>array('class'=>'account')),
            array('text'=>'','colspan'=>2,'options'=>array('class'=>'void city')),
            array('text'=>'Дата отгрузки','colspan'=>2,'options'=>array('class'=>'date-out')),
            array('text'=>'Дата поступления на ЦС','colspan'=>2,'options'=>array('class'=>'date-in')),
            array('text'=>'','colspan'=>1,'options'=>array('class'=>'void')),
            array('text'=>'Переключатели','colspan'=>3,'options'=>array('class'=>'state')),
            array('text'=>'','colspan'=>1,'options'=>array('class'=>'void')),
        ),
    ),
)); ?>

<script>
    curitem= <?php echo empty($_GET['page_count']) ? 0 : $_GET['page_count']; ?> ;
    $(document).ready(function(){
        $('select[name="show_count"]').val(curitem);

        $('select[name="show_count"]').change(function(){
            count=$(this).val();
            console.log(count);
            location.assign(location.pathname+'?page_count='+count);
        });
    });
</script>