<style>
    .del-item {display: inline-block; margin: 10px 5px;}
    .del-item-link {display: inline-block;}
</style>
<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        'Проекты'=>array('index'),
        $model->name.': Скрипты',
    ),
    'homeLink'=>false // add this line
));


$this->menu=array(
    array('label'=>'Администрирование проекта', 'url'=>array('padmin', 'id'=>$model->id)),
);
?>
<?php if (isset($_GET['msg'])) : ?>
    <h3 style="background: yellowgreen; padding: 10px;"><?php echo $_GET['msg']; ?></h3>
<? endif; ?>

<h1>Информация о: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'name',
        'domain',
		array(
            'label'=>'ID',
            'value'=>'LC-'.$model->id
        ),
//		'user_id',
	),
)); ?>
<br />
<h2>Менеджер Скриптов</h2>
<?php $this->widget('zii.widgets.CMenu',array(
    'items'=>array(
        array('label'=>'Статический calltracking (подмена номеров)', 'itemOptions'=>array('class'=>'del-item'), 'url'=>array('/scrTelrep/append', 'id'=>$model->id, 'name'=>$model->name)),
//        array('label'=>'Удалить скрипт', 'url'=>'#', 'itemOptions'=>array('class'=>'del-item-link'),'linkOptions'=>array('submit'=>array('/scrTelrep/delete','pid'=>$model->id),'confirm'=>'Вы действительно хотите удалить этот элемент?')),
        array('label'=>'Произвольный скрипт', 'url'=>array('/scrExt/append', 'id'=>$model->id, 'name'=>$model->name), 'visible'=>Users::isAdmin()),
    ),
)); ?>