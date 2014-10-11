<?php
/* @var $this RegStateController */
/* @var $model RegState */
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

	<div class="row">
		<?php echo $form->label($model,'admin'); ?>
		<?php echo $form->textField($model,'admin',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'accountant'); ?>
		<?php echo $form->textField($model,'accountant',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'in_store'); ?>
		<?php echo $form->textField($model,'in_store'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'supplier'); ?>
		<?php echo $form->textField($model,'supplier',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'financier'); ?>
		<?php echo $form->textField($model,'financier',array('size'=>10,'maxlength'=>10)); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->label($model,'sign_fin'); ?>
<!--		--><?php //echo $form->textField($model,'sign_fin',array('size'=>10,'maxlength'=>10)); ?>
<!--	</div>-->

    <div class="row">
        <?php echo $form->label($model,'signer'); ?>
        <?php echo $form->textField($model,'signer',array('size'=>10,'maxlength'=>10)); ?>
    </div>

    <div class="row">
		<?php echo $form->label($model,'sign_exec'); ?>
		<?php echo $form->textField($model,'sign_exec',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sign_general'); ?>
		<?php echo $form->textField($model,'sign_general',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'register_id'); ?>
		<?php echo $form->textField($model,'register_id',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->