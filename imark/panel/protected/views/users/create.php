<?php
/* @var $this UsersController */
/* @var $model Users */

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        'Регистрация',
    ),
    'homeLink'=>false // add this line
));


if (Users::isAdmin()) {
    $this->menu=array(
        array('label'=>'List Users', 'url'=>array('index')),
        array('label'=>'Manage Users', 'url'=>array('admin')),
    );
}
?>

<h1>Регистрация</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>