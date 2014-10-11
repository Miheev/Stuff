<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        'Проекты'=>array('index'),
        'Создать',
    ),
    'homeLink'=>false // add this line
));

$this->menu=array(
	array('label'=>'Список проектов', 'url'=>array('index')),
	array('label'=>'Manage Profiles', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Создать проект</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>