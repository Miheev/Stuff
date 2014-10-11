<?php
/* @var $this ChatController */
/* @var $model Chat */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chat-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>
    <div class="errorMessage" id="formResult"></div>
    <div id="AjaxLoader" style="display: none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/spinner.gif"/></div>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'song'); ?>
		<?php echo $form->textField($model,'song',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'song'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

<!--	<div class="row buttons">-->
<!--		--><?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
<!--	</div>-->
    <?php echo CHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(array('chat/create','render'=>true)),
        array(
            'dataType'=>'json',
            'type'=>'post',
            'success'=>'function(data) {
                         $("#AjaxLoader").hide();
                        if(data.status=="success"){
                         $("#formResult").html("form submitted successfully.");
                         addtolist(data.qid);
                         $("#chat-form")[0].reset();
                        }
                         else{
                        $.each(data, function(key, val) {
                        $("#chat-form #"+key+"_em_").text(val);
                        $("#chat-form #"+key+"_em_").show();
                        });
                        }
                    }',
            'beforeSend'=>'function(){
                           $("#AjaxLoader").show();
                           $("#formResult").html("");
                      }'
        ),array('id'=>'qsubmit','class'=>'ajax-btn')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->