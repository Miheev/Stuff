<?php
/* @var $this ProfilesController */
/* @var $data Profiles */
?>

<a href="<?php echo $this->createUrl('view', array('id'=>$data->id)); ?>">
    <div class="view">

        <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
        <?php echo CHtml::encode($data->name); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('domain')); ?>:</b>
        <?php echo CHtml::encode($data->domain); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::encode('LC-'.$data->id); ?>
        <br />

        <?php if (Users::isAdmin()) : ?>
            <!--        <b>--><?php //echo CHtml::encode($data->getAttributeLabel('user_id')); ?><!--:</b>-->
            <!--        --><?php //echo CHtml::encode($data->user_id); ?>
            <!--        <br />-->
            <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
            <?php echo CHtml::encode($data->user->login); ?>
            <br />
        <?php endif; ?>

        <!--    <b>--><?php
                      //        echo CHtml::link('Delete', '#', array('submit'=>array('delete','id'=>$data->id),'confirm'=>'Вы действительно хотите удалить этот элемент?'))
                      //        ?><!--</b>-->
        <!--    <br />-->
        <!--    <b>--><?php //echo CHtml::link('Update', array('update', 'id'=>$data->id)) ?><!--</b>-->
        <!--    <br />-->

    </div>
</a>
<b><?php echo CHtml::link('Администрирование', array('padmin', 'id'=>$data->id)); ?></b>
<b style="margin-left:10px;"><?php echo CHtml::link('Настройки', array('view', 'id'=>$data->id)); ?></b>
<br/>
<br/>