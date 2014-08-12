<?php
/* @var $this ScrTelrepController */
/* @var $data ScrTelrep */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('params')); ?>:</b>
	<?php echo CHtml::encode($data->params); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile_id')); ?>:</b>
	<?php echo CHtml::encode($data->profile_id); ?>
	<br />

    <b><?php
        echo CHtml::link('Delete', '#', array('submit'=>array('delete','id'=>$data->id),'confirm'=>'Are you sure you want to delete this item?'))
        ?></b>
    <br />
    <b><?php echo CHtml::link('Update', array('update', 'id'=>$data->id)) ?></b>
    <br />


</div>