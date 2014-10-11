<?php
/* @var $this RegStateController */
/* @var $model RegState */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reg-state-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'admin'); ?>
		<?php echo $form->textField($model,'admin',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'admin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accountant'); ?>
		<?php echo $form->textField($model,'accountant',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'accountant'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'in_store'); ?>
		<?php echo $form->textField($model,'in_store'); ?>
		<?php echo $form->error($model,'in_store'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'supplier'); ?>
		<?php echo $form->textField($model,'supplier',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'financier'); ?>
		<?php echo $form->textField($model,'financier',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'financier'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'sign_fin'); ?>
<!--		--><?php //echo $form->textField($model,'sign_fin',array('size'=>10,'maxlength'=>10)); ?>
<!--		--><?php //echo $form->error($model,'sign_fin'); ?>
<!--	</div>-->

    <div class="row">
        <?php echo $form->labelEx($model,'signer'); ?>
        <?php echo $form->textField($model,'signer',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'signer'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'sign_exec'); ?>
		<?php echo $form->textField($model,'sign_exec',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'sign_exec'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sign_general'); ?>
		<?php echo $form->textField($model,'sign_general',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'sign_general'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'register_id'); ?>
		<?php echo $form->textField($model,'register_id',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'register_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->