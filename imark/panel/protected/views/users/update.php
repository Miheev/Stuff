<?php
/* @var $this UsersController */
/* @var $model Users */

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        $model->name=>array('view','id'=>$model->id),
        'Редактировать',
    ),
    'homeLink'=>false // add this line
));

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index'), 'visible'=>Users::isAdmin()),
	array('label'=>'Новый аккаунт', 'url'=>array('create')),
	array('label'=>'Информация об аккаунте', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Users', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Изменить аккаунт: <?php echo $model->login; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>