<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'request-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для ввода.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'image'); ?>
    <?php
    $form->widget('CMultiFileUpload', array(
//        'model'=>$model,
//        'attribute'=>'image',
        'name' => 'images',
        'accept'=>'jpg|jpeg|gif|png',
        'options'=>array(
            // 'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
            // 'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
            // 'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
            // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
            // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
            // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
        ),
//        'htmlOptions'=>array('multiple'=>'multiple'),
        'duplicate' => 'Duplicate file!', // useful, i think
        'denied' => 'Invalid file type', // useful, i think
        'max'=>10, // max 10 files


    ));
    ?>
    <?php echo $form->error($model,'image'); ?>
</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'request'); ?>
<!--		--><?php //echo $form->textField($model,'request',array('size'=>60,'maxlength'=>255)); ?>
<!--		--><?php //echo $form->error($model,'request'); ?>
<!--	</div>-->

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'image'); ?>
<!--		--><?php //echo $form->fileField($model,'image'); ?>
<!--		--><?php //echo $form->error($model,'image'); ?>
<!--	</div>-->

<!--    <div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'user_id'); ?>
<!--		--><?php //echo $form->textField($model,'user_id',array('size'=>4,'maxlength'=>4)); ?>
<!--		--><?php //echo $form->error($model,'user_id'); ?>
<!--	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->