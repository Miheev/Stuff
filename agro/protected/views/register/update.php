<?php
/* @var $this RegisterController */
/* @var $model Register */

$this->breadcrumbs=array(
	'Записи реестра'=>array('trace'),
	$model->id=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Записи реестра', 'url'=>array('trace')),
	array('label'=>'Созлать запись', 'url'=>array('/request/index')),
	array('label'=>'Смотреть запись', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управлять реестром', 'url'=>array('admin')),
);
?>

<h1>Редактировать запись <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'state'=>$state)); ?>

    <h2>Прикрепленные запчасти</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$sparesData,
    'columns'=>array(
//        'mark',
        'model',  // disp
        'count',   // dis
        'cat_id',   // di
//        'cat_date',   //
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
            'deleteConfirmation'=>"Подтверждение удаления элемента. Продолжить?",
            'deleteButtonUrl'=>'Yii::app()->createUrl("spares/delete", array("id"=>$data->id))',
            'updateButtonUrl'=>'Yii::app()->createUrl("spares/update", array("id"=>$data->id, "back"=>$data->register_id))'
        ),
    ),
));

//var_dump(Yii::app()->createUrl('/spares/delete', array('id'=>$data->id)));
?>
<?php if (Yii::app()->user->checkAccess('admin')) : ?>
    <h2>Добавить запчасть</h2>
    <?php $this->renderPartial('_form_spares', array('model'=>$spares)); ?>
<? endif; ?>