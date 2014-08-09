<?php
/* @var $this ScriptsController */
/* @var $data Scripts */
?>

<div class="view">

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('id')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
<!--	<br />-->

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('script')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::encode($data->script); ?>
<!--	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('domain')); ?>:</b>
    <?php echo CHtml::encode($data->domain); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('params')); ?>:</b>
    <?php echo CHtml::encode($data->params); ?>
    <br />

<!--    <b>--><?php //echo CHtml::encode($data->getAttributeLabel('user_id')); ?><!--:</b>-->
<!--    --><?php //echo CHtml::encode($data->user_id); ?>
<!--    <br />-->

    <b><?php
        echo CHtml::link('Delete Scripts', '#', array('submit'=>array('delete','id'=>$data->id),'confirm'=>'Are you sure you want to delete this item?'))
//        echo CHtml::ajaxLink(
//            'Удалить',
//            CController::createUrl('/scripts/delete'),
//            array(
//                'type' => 'GET',// method
//                'id' => $data->id,
//            ));
        ?></b>
    <br />
    <b><?php echo CHtml::link('Update Scripts', array('update', 'id'=>$data->id)) ?></b>
    <br />

</div>