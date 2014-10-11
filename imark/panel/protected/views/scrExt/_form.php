<?php
/* @var $this ScrExtController */
/* @var $model ScrExt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'scr-ext-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для ввода.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'script'); ?>
		<?php echo $form->textArea($model,'script',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'script'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'profile_id'); ?>
<!--		--><?php //echo $form->textField($model,'profile_id',array('size'=>4,'maxlength'=>4)); ?>
<!--		--><?php //echo $form->error($model,'profile_id'); ?>
<!--	</div>-->

    <?php if(Users::isAdmin()) : ?>
        <div class="row">
            <h2>Скрипт для всех пользователей</h2>
            <?php echo CHtml::textArea('ext_script',$admin_script ,array('rows'=>6, 'cols'=>50)); ?>
        </div>
    <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->