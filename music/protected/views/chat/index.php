<?php //Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php
/* @var $this ChatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Chats',
);

$this->menu=array(
	array('label'=>'Create Chat', 'url'=>array('create')),
	array('label'=>'Manage Chat', 'url'=>array('admin')),
);
?>

<h1>Chats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<?php if ($to_bottom) : ?>
<script>
    $(document).ready(function(){
        $('body').animate({scrollTop: $('#chat-form').position().top},1000);
//        $(window).scrollTop($('#chat-form').offset().top);
    });
</script>
<?php endif; ?>