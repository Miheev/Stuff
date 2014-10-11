<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        'Проекты'=>array('index'),
        $model->name=>array('view','id'=>$model->id),
        'Редактировать',
    ),
    'homeLink'=>false // add this line
));

$this->menu=array(
	array('label'=>'Список проектов', 'url'=>array('index')),
	array('label'=>'Скрипты проекта', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Администрирование', 'url'=>array('padmin', 'id'=>$model->id)),
	array('label'=>'Manage Profiles', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Редактировать проект: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>