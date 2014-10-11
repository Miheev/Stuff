<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        'Проекты'=>array('index'),
        $model->name.': Скрипты'=>array('view','id'=>$model->id),
        $model->name.': Управление',
    ),
    'homeLink'=>false // add this line
));

$this->menu=array(
	array('label'=>'Список проектов', 'url'=>array('index'), 'visible'=>Users::isAdmin()),
	array('label'=>'Создать проект', 'url'=>array('create'), 'visible'=>Users::isAdmin()),
	array('label'=>'Редактировать проект', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить проект', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить этот элемент?')),
	array('label'=>'Manage Profiles', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

    <h2><a href="<?php echo $this->createUrl('view', array('id'=>$model->id)); ?>">В менеджер скриптов</a></h2>
    <br/>
    <br/>

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

    <h2>Код для вставки</h2>
<p style="background: #e1e1e1;">Вставьте код ниже на сайте проекта после библиотеки jQuery<br/>
    Если Вы не знаете установлена она или нет, просто вставьте код перед закрывающим тегом &lt;/head&gt;</p>
<?php echo CHtml::textArea('script_insert',$model->ScriptBase() ,array('rows'=>10, 'style'=>'width:100%;')); ?>