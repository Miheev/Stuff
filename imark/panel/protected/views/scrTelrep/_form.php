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

    <p class="note">Поля с <span class="required">*</span> обязательны для ввода.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="display: none;">
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
            .row.service input[type="checkbox"] {margin: 7px 0;}
            h3 {margin-top: 30px;}
            .row.service .hint span{color: blue; margin: 0.2em 0 0.5em 0; padding: 1px 0; min-height: 15px; display: block;}
        </style>
        <h3>Настройки подмены</h3>
        <div class="element-id">
            <?php echo CHtml::label('Идентификатор', 'service_id', array('required'=>true)); ?>
            <?php echo CHtml::textField('service_id', '', array('placeholder'=>'#phone', 'required'=>'required', 'style'=>'width: 285px; display: inline; margin-right: 10px;')); ?>
            <div style="display: inline-block; vertical-align: top;">
                <p style="color: blue; margin-bottom: 10px;">#id или .class или другой селектор. Например:</p>
                <p style="color: #073757; font-weight: 700;">#phone<br/>.phone<br/>input[name="phone"]<br/>div.main > .phone-numbers span:first-child</p>
            </div>
            <!--            --><?php //echo CHtml::checkBox('jq_include'); ?>
<!--            --><?php //echo CHtml::label('Включить jQuery?', 'jq_include'); ?>
        </div>
        <h3>Выбирите какие источники отслеживаем, поставив галочку</h3>
        <div class="checkbox" style="display: inline-block; vertical-align: top;">
            <?php
            $servarr= $model->getServices();
            echo CHtml::checkBoxList('service', '', $servarr, array());
            ?>
        </div>
        <div class="input" style="display: inline-block; vertical-align: top;">
            <?php
            for ($i=0; $i<count($servarr); $i++) {
                $htpars= array('placeholder'=>$servarr[$i], 'id'=>'service_text_'.$i);
                if ($i==0) $htpars['required']= 'required';
                echo CHtml::textField('service_text[]', '', $htpars);
            }
            ?>
        </div>
        <div class="hint" style="display: inline-block; vertical-align: top; width: 370px;">
            <span style="visibility: hidden">&nbsp;</span>
            <span style="visibility: hidden">&nbsp;</span>
            <span style="visibility: hidden">&nbsp;</span>
            <span style="visibility: hidden">&nbsp;</span>
            <span style="visibility: hidden">&nbsp;</span>
            <span style="visibility: hidden">&nbsp;</span>
            <span style="visibility: hidden">&nbsp;</span>
            <span>Ссылки рекламных кампаний из Яндекс Директа должны быть размечены UTM метками utm_source=yandex&utm_medium=cpc</span>
        </div>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить'); ?>
	</div>

<?php $this->endWidget(); ?>
    <script>
        jQuery(function ($) {
            $(document).ready(function () {
                $('.checkbox label').eq(0).addClass('required')
                    .append('<span class="required">*<span>');
            });
        });
    </script>
</div><!-- form -->