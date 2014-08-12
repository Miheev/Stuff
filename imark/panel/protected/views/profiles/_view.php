<?php
/* @var $this ProfilesController */
/* @var $data Profiles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('domain')); ?>:</b>
	<?php echo CHtml::encode($data->domain); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('user_id')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::encode($data->user_id); ?>
<!--	<br />-->

    <b><?php
        echo CHtml::link('Delete', '#', array('submit'=>array('delete','id'=>$data->id),'confirm'=>'Are you sure you want to delete this item?'))
        ?></b>
    <br />
    <b><?php echo CHtml::link('Update', array('update', 'id'=>$data->id)) ?></b>
    <br />


</div>