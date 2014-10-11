<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Заявки', 'url'=>array('index')),
	array('label'=>'Создать заявку', 'url'=>array('create')),
	array('label'=>'Обновить заявку', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить заявку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Подтверждение удаления элемента. Продолжить?')),
	array('label'=>'Управлять заявкамиt', 'url'=>array('admin')),
);
?>
<?php if (isset($_GET['msg'])) : ?>
    <h3 style="background: yellowgreen; padding: 10px;"><?php echo $_GET['msg']; ?></h3>
<? endif; ?>

<h1>Просмотреть заявку #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
        'user.name',
        array(
            'label'=>$model->getAttributeLabel('assign'),
            'value'=>$model->getAssignText()
        ),
        array(
            'label'=>$model->getAttributeLabel('request'),
            'type'=>'html',
            'value'=>$model->getImg()
        ),
	),
)); ?>
