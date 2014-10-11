<?php
/* @var $this SparesController */
/* @var $model Spares */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'spares-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для ввода.</p>

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'mark'); ?>
<!--		--><?php //echo $form->textField($model,'mark',array('size'=>60,'maxlength'=>100)); ?>
<!--		--><?php //echo $form->error($model,'mark'); ?>
<!--	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'model'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'count'); ?>
		<?php echo $form->textField($model,'count',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cat_id'); ?>
		<?php echo $form->textField($model,'cat_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cat_id'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'cat_date'); ?>
<!--		--><?php //echo $form->textField($model,'cat_date'); ?>
<!--		--><?php //echo $form->error($model,'cat_date'); ?>
<!--	</div>-->

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'register_id'); ?>
<!--		--><?php //echo $form->textField($model,'register_id',array('size'=>4,'maxlength'=>4)); ?>
<!--		--><?php //echo $form->error($model,'register_id'); ?>
<!--	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->