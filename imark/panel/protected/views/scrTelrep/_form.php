<?php
/* @var $this ScrTelrepController */
/* @var $model ScrTelrep */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'scr-telrep-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'params'); ?>
		<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'params'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'profile_id'); ?>
<!--		--><?php //echo $form->textField($model,'profile_id',array('size'=>4,'maxlength'=>4)); ?>
<!--		--><?php //echo $form->error($model,'profile_id'); ?>
<!--	</div>-->

    <div class="row service">
        <style>
            .row.service label {display: inline;}
            .row.service input[type="text"] {display: block;}
        </style>
        <div class="element-id">
            <?php echo CHtml::textField('service_id', '', array('placeholder'=>'Идентификатор элемента')); ?>
            <?php echo CHtml::checkBox('jq_include'); ?>
            <?php echo CHtml::label('Включить jQuery?', 'jq_include'); ?>
        </div>
        <div class="checkbox" style="display: inline-block;">
            <?php
            $servarr= $model->getServices();
            echo CHtml::checkBoxList('service', '', $servarr, array());
            ?>
        </div>
        <div class="input" style="display: inline-block;">
            <?php
            for ($i=0; $i<count($servarr); $i++)
                echo CHtml::textField('service_text[]', '', array('placeholder'=>$servarr[$i], 'id'=>'service_text_'.$i));
            ?>
        </div>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->