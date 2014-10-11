<?php
/* @var $this SharelistController */
/* @var $data Sharelist */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('singer')); ?>:</b>
	<?php echo CHtml::encode($data->singer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('song')); ?>:</b>
	<?php echo CHtml::encode($data->song); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('genre')); ?>:</b>
	<?php echo CHtml::encode($data->genre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />


</div>