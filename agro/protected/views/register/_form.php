<?php
/* @var $this RegisterController */
/* @var $model Register */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'register-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
//    'enableClientValidation'=>true,
    )); ?>

    <p class="note">Поля с <span class="required">*</span> обязательны для ввода.</p>

    <?php echo $form->errorSummary(array($model, $state)); ?>

    <?php if (Yii::app()->user->checkAccess('admin')) : ?>
        <!--    <div class="row">-->
        <!--        --><?php //echo $form->labelEx($model,'request_id'); ?>
        <!--        --><?php //echo $form->textField($model,'request_id',array('size'=>4,'maxlength'=>4)); ?>
        <!--        --><?php //echo $form->error($model,'request_id'); ?>
        <!--    </div>-->
        <?php $ff= 0; ?>
        <div class="row request_id">
            <?php
                 if (empty($_GET['rid'])) {
                     $req_id= $model->request_id;
                     $req=array($model->request_id => $model->request->getImg());
                 } else {
                     $req_id= $_GET['rid'];
                     $req=array($_GET['rid'] => Request::getReqImg($_GET['rid']));
                 }
            ?>
            <?php echo $form->labelEx($model, 'request_id', array('label'=>$model->getCutName('request_id'))); ?>
            <?php echo $form->RadioButtonList($model, 'request_id', $req, array('uncheckValue'=>$req_id)); ?>
            <?php echo $form->error($model, 'request_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'sp'); ?>
            <?php echo $form->textField($model, 'sp', array('size' => 10, 'maxlength' => 10)); ?>
            <?php echo $form->error($model, 'sp'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'fio_req'); ?>
            <?php echo $form->textField($model, 'fio_req', array('size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'fio_req'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'reg_id'); ?>
<!--            --><?php //echo $form->textField($model, 'reg_id', array('size' => 6, 'maxlength' => 6)); ?>
<!--            --><?php //echo $form->error($model, 'reg_id'); ?>
<!--        </div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'reg_date'); ?>
<!--            --><?php //echo $form->textField($model, 'reg_date'); ?>
            <?php
            $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'reg_date',
                'language'=>'ru',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                    'changeMonth' => 'true',
                    'changeYear'=>'true',
                    'showButtonPanel' => 'true',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'reg_date'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'mark'); ?>
<!--            --><?php //echo $form->textField($model, 'mark', array('size' => 60, 'maxlength' => 100)); ?>
<!--            --><?php //echo $form->error($model, 'mark'); ?>
<!--        </div>-->

        <fieldset>
            <legend><?php echo $model->getCutHead('object'); ?></legend>
        <div class="row">
            <?php echo $form->labelEx($model, 'model'); ?>
            <?php echo $form->textField($model, 'model', array('size' => 60, 'maxlength' => 100)); ?>
            <?php echo $form->error($model, 'model'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'inv_id'); ?>
            <?php echo $form->textField($model, 'inv_id', array('size' => 6, 'maxlength' => 6)); ?>
            <?php echo $form->error($model, 'inv_id'); ?>
        </div>
        </fieldset>
        <div class="row">
            <?php echo $form->labelEx($model, 'comment'); ?>
            <?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model, 'comment'); ?>
        </div>
    <?php endif; ?>

        <?php if (Yii::app()->user->checkAccess('accountant')) : ?>
            <div class="row">
            <?php if (is_null($state->in_store)) : ?>
                <h4 class="important">Для заполнения других полей необходимо указать наличие товара на складе</h4>
            <?php endif; ?>
                <?php echo $form->labelEx($state, 'in_store'); ?>
<!--                --><?php //echo $form->radioButtonList($state, 'in_store', array(0=>'Нет', 1=>'Да')); ?>
                <?php echo $form->textField($state,'in_store'); ?>
                <?php echo $form->error($state, 'in_store'); ?>
            </div>
        <?php endif; ?>

    <?php if (!is_null($state->in_store)) : ?>

        <?php if (Yii::app()->user->checkAccess('signer')) : //techdir ?>
            <div class="row">
                <?php echo $form->labelEx($state, 'sign_exec'); ?>
                <?php echo $form->checkBox($state, 'sign_exec', array('value'=>1)); ?>
                <?php echo $form->error($state, 'sign_exec'); ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->checkAccess('signer')) : //gendir ?>
            <div class="row">
                <?php echo $form->labelEx($state, 'sign_general'); ?>
                <?php echo $form->checkBox($state, 'sign_general', array('value'=>1)); ?>
                <?php echo $form->error($state, 'sign_general'); ?>
            </div>
        <?php endif; ?>



        <?php if (Yii::app()->user->checkAccess('supplier')) : ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'fio_exec'); ?>
                <?php echo $form->textField($model, 'fio_exec', array('size' => 60, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'fio_exec'); ?>
            </div>

            <fieldset>
                <legend><?php echo $model->getCutHead('pact'); ?></legend>

            <div class="row">
                <?php echo $form->labelEx($model, $model->getCutName('pact_id')); ?>
                <?php echo $form->textField($model, 'pact_id', array('size' => 50, 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'pact_id'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, $model->getCutName('pact_date')); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'pact_date',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'pact_date'); ?>
            </div>
            </fieldset>

            <div class="row">
                <?php echo $form->labelEx($model, 'city'); ?>
                <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'city'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'agent_name'); ?>
                <?php echo $form->textField($model, 'agent_name', array('size' => 60, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'agent_name'); ?>
            </div>

            <fieldset>
                <legend><?php echo $model->getCutHead('account'); ?></legend>
            <div class="row">
                <?php echo $form->labelEx($model, $model->getCutName('account_id')); ?>
                <?php echo $form->textField($model, 'account_id', array('size' => 50, 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'account_id'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, $model->getCutName('account_date')); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'account_date',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'account_date'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, $model->getCutName('account_sum')); ?>
                <?php echo $form->textField($model, 'account_sum', array('size' => 10, 'maxlength' => 10)); ?>
                <?php echo $form->error($model, 'account_sum'); ?>
            </div>
            </fieldset>

            <fieldset>
                <legend><?php echo $model->getCutHead('date_out'); ?></legend>
            <div class="row">
                <?php echo $form->labelEx($model, $model->getCutName('date_out_real')); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_out_real',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'date_out_real'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, $model->getCutName('date_out_plan')); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_out_plan',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'date_out_plan'); ?>
            </div>
            </fieldset>

            <div class="row">
                <?php echo $form->labelEx($model, 'date_in_plan'); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_in_plan',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'date_in_plan'); ?>
            </div>
        <?php endif;
        if (Yii::app()->user->checkAccess('accountant')) : ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'date_in_real'); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_in_real',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'date_in_real'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'date_in_real_sp'); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'date_in_real_sp',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'date_in_real_sp'); ?>
            </div>

<!--            <div class="row">-->
<!--                --><?php //echo $form->labelEx($state, 'sign_fin'); ?>
<!--                --><?php //echo $form->checkBox($state, 'sign_fin', array('value'=>1)); ?>
<!--                --><?php //echo $form->error($state, 'sign_fin'); ?>
<!--            </div>-->
        <?php endif;
        if (Yii::app()->user->checkAccess('financier')) : ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'pay_date'); ?>
                <?php
                $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'pay_date',
                    'language'=>'ru',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'showButtonPanel' => 'true',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'pay_date'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'trust_id'); ?>
                <?php echo $form->textField($model, 'trust_id', array('size' => 50, 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'trust_id'); ?>
            </div>
        <?php endif; ?>


    <?php endif; ?>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->