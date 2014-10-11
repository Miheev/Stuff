<?php
/* @var $this SparesController */
/* @var $data Spares */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('mark')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::encode($data->mark); ?>
<!--	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('count')); ?>:</b>
	<?php echo CHtml::encode($data->count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cat_id')); ?>:</b>
	<?php echo CHtml::encode($data->cat_id); ?>
	<br />

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('cat_date')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::encode($data->cat_date); ?>
<!--	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('register_id')); ?>:</b>
	<?php echo CHtml::encode($data->register_id); ?>
	<br />


</div>