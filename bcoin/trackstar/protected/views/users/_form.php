<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_login'); ?>
		<?php echo $form->textField($model,'user_login',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'user_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_pass'); ?>
		<?php echo $form->textField($model,'user_pass',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_pass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_phone'); ?>
		<?php echo $form->textField($model,'user_phone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'user_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_company'); ?>
		<?php echo $form->textField($model,'user_company',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_company'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->