<?php
/* @var $this RequestController */
/* @var $data Request */
?>
        <div class="view" data-link="<?php echo $this->createUrl('view', array('id' => $data->id)); ?>">
            <b><?php echo CHtml::encode($data->getAttributeLabel('assign')); ?>:</b>
            <strong><?php echo CHtml::encode($data->getAssignText()); ?></strong>
            <br />

            <!--    <b>--><?php //echo CHtml::encode($data->getAttributeLabel('id')); ?><!--:</b>-->
            <!--	--><?php //echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
            <!--	<br />-->

            <b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
            <?php echo CHtml::encode($data->user->name); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('request')); ?>:</b>
            <div class="request-img">
                <?php echo $data->getImg(); ?>
            </div>
            <br />

            <div class="control">
                <?php echo CHtml::link('Посмотреть', array('view', 'id'=>$data->id)); ?>
                <?php echo CHtml::link('Создать запись в реестре', array('/register/create', 'rid'=>$data->id)); ?>
            </div>
        </div>