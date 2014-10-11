<?php
/* @var $this RegisterController */
/* @var $data Register */
?>

<div class="view" data-link="<?php echo $this->createUrl('view', array('id' => $data->id)); ?>">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sp')); ?>:</b>
	<?php echo CHtml::encode($data->sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fio_req')); ?>:</b>
	<?php echo CHtml::encode($data->fio_req); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_id')); ?>:</b>
	<?php echo CHtml::encode($data->request_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_date')); ?>:</b>
	<?php echo CHtml::encode($data->reg_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inv_id')); ?>:</b>
	<?php echo CHtml::encode($data->inv_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fio_exec')); ?>:</b>
	<?php echo CHtml::encode($data->fio_exec); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pact_id')); ?>:</b>
	<?php echo CHtml::encode($data->pact_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pact_date')); ?>:</b>
	<?php echo CHtml::encode($data->pact_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_name')); ?>:</b>
	<?php echo CHtml::encode($data->agent_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_date')); ?>:</b>
	<?php echo CHtml::encode($data->account_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_sum')); ?>:</b>
	<?php echo CHtml::encode($data->account_sum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out_real')); ?>:</b>
	<?php echo CHtml::encode($data->date_out_real); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out_plan')); ?>:</b>
	<?php echo CHtml::encode($data->date_out_plan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in_plan')); ?>:</b>
	<?php echo CHtml::encode($data->date_in_plan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in_real')); ?>:</b>
	<?php echo CHtml::encode($data->date_in_real); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in_real_sp')); ?>:</b>
	<?php echo CHtml::encode($data->date_in_real_sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_date')); ?>:</b>
	<?php echo CHtml::encode($data->pay_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trust_id')); ?>:</b>
	<?php echo CHtml::encode($data->trust_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request_id')); ?>:</b>
	<?php echo CHtml::encode($data->request_id); ?>
	<br />

	*/ ?>

</div>