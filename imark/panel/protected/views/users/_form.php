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

    <p class="note">Поля с <span class="required">*</span> обязательны для ввода.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'pass'); ?>
	</div>
    <div class="row">
        <?php echo $form->label($model,'pass_repeat'); ?>
        <?php echo $form->passwordField($model,'pass_repeat',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'pass_repeat'); ?>
    </div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'name'); ?>
<!--		--><?php //echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
<!--		--><?php //echo $form->error($model,'name'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'phone'); ?>
<!--		--><?php //echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>100)); ?>
<!--		--><?php //echo $form->error($model,'phone'); ?>
<!--	</div>-->
<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'company'); ?>
<!--		--><?php //echo $form->textField($model,'company',array('size'=>60,'maxlength'=>100)); ?>
<!--		--><?php //echo $form->error($model,'company'); ?>
<!--	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Обновить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->