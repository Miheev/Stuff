<?php
/* @var $this TreeDataController */
/* @var $qc_model TreeData */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tree-data-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
    'action'=>$this->createUrl('/tree/createtree'),
    'enableClientValidation'=>true,
)); ?>
    <div class="errorMessage" id="formResult"></div>
    <div id="AjaxLoader" style="display: none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/spinner.gif"></img></div>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($qc_model); ?>

	<div class="row">
		<?php echo $form->labelEx($qc_model,'question'); ?>
		<?php echo $form->textArea($qc_model,'question',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($qc_model,'question'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($qc_model,'answers'); ?>
		<?php echo $form->textArea($qc_model,'answers',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($qc_model,'answers'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($qc_model,'creator_id'); ?>
<!--		--><?php //echo $form->textField($qc_model,'creator_id',array('size'=>4,'maxlength'=>4)); ?>
<!--		--><?php //echo $form->error($qc_model,'creator_id'); ?>
<!--	</div>-->

	<div class="row buttons">
<!--		--><?php //echo CHtml::submitButton($qc_model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::ajaxSubmitButton('Save',CHtml::normalizeUrl(array('tree/createtree','render'=>true)),
            array(
                'dataType'=>'json',
                'type'=>'post',
                'success'=>'function(data) {
                         $("#AjaxLoader").hide();
                        if(data.status=="success"){
                         $("#formResult").html("form submitted successfully.");
                         addtolist(data.qid);
                         $("#tree-data-form")[0].reset();
                        }
                         else{
                        $.each(data, function(key, val) {
                        $("#tree-data-form #"+key+"_em_").text(val);
                        $("#tree-data-form #"+key+"_em_").show();
                        });
                        }
                    }',
                'beforeSend'=>'function(){
                           $("#AjaxLoader").show();
                           $("#formResult").html("");
                      }'
            ),array('id'=>'qsubmit','class'=>'ajax-btn')); ?>
        <?php echo CHtml::ajaxSubmitButton('Edit',CHtml::normalizeUrl(array('tree/createtree','render'=>true)),
            array(
                'dataType'=>'json',
                'type'=>'post',
                'success'=>'function(data) {
                         $("#AjaxLoader").hide();
                        if(data.status=="success"){
                         $("#formResult").html("form submitted successfully.");
                         updatelist(data.qid);
                         $("#tree-data-form")[0].reset();
                         $("#tree-data-form .buttons").prev().remove();
                        }
                         else{
                        $.each(data, function(key, val) {
                        $("#tree-data-form #"+key+"_em_").text(val);
                        $("#tree-data-form #"+key+"_em_").show();
                        });
                        }
                    }',
                'beforeSend'=>'function(){
                           $("#AjaxLoader").show();
                           $("#formResult").html("");
                      }'
            ),array('id'=>'qeditsubmit','class'=>'ajax-btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->