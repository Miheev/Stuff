<?php
/* @var $this ScriptsController */
/* @var $model Scripts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'scripts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<!---->
<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'code'); ?>
<!--		--><?php //echo $form->textField($model,'code',array('size'=>60,'maxlength'=>100)); ?>
<!--		--><?php //echo $form->error($model,'code'); ?>
<!--	</div>-->

    <div class="row">
        <?php echo $form->labelEx($model,'params'); ?>
        <?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'params'); ?>
    </div>


<!--    <div class="row">-->
<!--        <h2>Дополнительный скрипт</h2>-->
<!--        --><?php //echo $form->labelEx($model,'script'); ?>
<!--        --><?php //echo $form->textArea($model,'script',array('rows'=>6, 'cols'=>50, 'value'=>'console.log("Hello World!");')); ?>
<!--        --><?php //echo $form->error($model,'script'); ?>
<!--    </div>-->

    <div class="row">
        <h2>Замена телефона</h2>
        <?php echo $form->labelEx($model,'domain'); ?>
        <?php echo $form->textField($model,'domain',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'domain'); ?>
    </div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

