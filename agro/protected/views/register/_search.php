<?php
/* @var $this RegisterController */
/* @var $model Register */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sp'); ?>
		<?php echo $form->textField($model,'sp',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fio_req'); ?>
		<?php echo $form->textField($model,'fio_req',array('size'=>60,'maxlength'=>100)); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->label($model,'reg_id'); ?>
<!--		--><?php //echo $form->textField($model,'reg_id',array('size'=>6,'maxlength'=>6)); ?>
<!--	</div>-->

	<div class="row">
		<?php echo $form->label($model,'reg_date'); ?>
		<?php echo $form->textField($model,'reg_date'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'comment'); ?>
        <?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
    </div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->label($model,'mark'); ?>
<!--		--><?php //echo $form->textField($model,'mark',array('size'=>60,'maxlength'=>100)); ?>
<!--	</div>-->

	<div class="row">
		<?php echo $form->label($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inv_id'); ?>
		<?php echo $form->textField($model,'inv_id',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fio_exec'); ?>
		<?php echo $form->textField($model,'fio_exec',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pact_id'); ?>
		<?php echo $form->textField($model,'pact_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pact_date'); ?>
		<?php echo $form->textField($model,'pact_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_name'); ?>
		<?php echo $form->textField($model,'agent_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_id'); ?>
		<?php echo $form->textField($model,'account_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_date'); ?>
		<?php echo $form->textField($model,'account_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_sum'); ?>
		<?php echo $form->textField($model,'account_sum',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_out_real'); ?>
		<?php echo $form->textField($model,'date_out_real'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_out_plan'); ?>
		<?php echo $form->textField($model,'date_out_plan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_in_plan'); ?>
		<?php echo $form->textField($model,'date_in_plan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_in_real'); ?>
		<?php echo $form->textField($model,'date_in_real'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_in_real_sp'); ?>
		<?php echo $form->textField($model,'date_in_real_sp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_date'); ?>
		<?php echo $form->textField($model,'pay_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trust_id'); ?>
		<?php echo $form->textField($model,'trust_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_id'); ?>
		<?php echo $form->textField($model,'request_id',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->