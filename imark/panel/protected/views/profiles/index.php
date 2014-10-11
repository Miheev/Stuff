<?php
/* @var $this ProfilesController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        'Проекты',
    ),
    'homeLink'=>false // add this line
));

$this->menu=array(
    array('label'=>'Создать проект', 'url'=>array('create')),
    array('label'=>'Manage Profiles', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Ваши проекты</h1>
<?php
//if (!Users::isAdmin())
//    $this->widget('zii.widgets.CMenu', array(
//        'items'=>array(
//            array('label'=>'Новый проект', 'url'=>array('/profiles/create')),
//        ),
//    ));

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
