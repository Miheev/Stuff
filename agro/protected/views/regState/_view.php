<?php
/* @var $this RegStateController */
/* @var $data RegState */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin')); ?>:</b>
	<?php echo CHtml::encode($data->admin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accountant')); ?>:</b>
	<?php echo CHtml::encode($data->accountant); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('in_store')); ?>:</b>
	<?php echo CHtml::encode($data->in_store); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplier')); ?>:</b>
	<?php echo CHtml::encode($data->supplier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financier')); ?>:</b>
	<?php echo CHtml::encode($data->financier); ?>
	<br />

<!--	<b>--><?php //echo CHtml::encode($data->getAttributeLabel('sign_fin')); ?><!--:</b>-->
<!--	--><?php //echo CHtml::encode($data->sign_fin); ?>
<!--	<br />-->

	<?php /*

    <b><?php echo CHtml::encode($data->getAttributeLabel('signer')); ?>:</b>
	<?php echo CHtml::encode($data->signer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sign_exec')); ?>:</b>
	<?php echo CHtml::encode($data->sign_exec); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sign_general')); ?>:</b>
	<?php echo CHtml::encode($data->sign_general); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('register_id')); ?>:</b>
	<?php echo CHtml::encode($data->register_id); ?>
	<br />

	*/ ?>

</div>