<?php
/* @var $this SparesController */
/* @var $model Spares */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>4,'maxlength'=>4)); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->label($model,'mark'); ?>
<!--		--><?php //echo $form->textField($model,'mark',array('size'=>60,'maxlength'=>100)); ?>
<!--	</div>-->

	<div class="row">
		<?php echo $form->label($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'count'); ?>
		<?php echo $form->textField($model,'count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cat_id'); ?>
		<?php echo $form->textField($model,'cat_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->label($model,'cat_date'); ?>
<!--		--><?php //echo $form->textField($model,'cat_date'); ?>
<!--	</div>-->

	<div class="row">
		<?php echo $form->label($model,'register_id'); ?>
		<?php echo $form->textField($model,'register_id',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->