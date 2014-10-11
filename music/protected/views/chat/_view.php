<?php
/* @var $this ChatController */
/* @var $data Chat */
?>

<div class="view chat-item">

	<b><?php echo CHtml::encode($data->getAttributeLabel('song')); ?>:</b>
	<?php echo CHtml::encode($data->song); ?>
	<br />

    <div class="clearfix">
        <div class="left">
            <b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
            <?php echo CHtml::encode($data->user->name); ?>
        </div>
        <div class="right">
            <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
            <?php echo CHtml::encode($data->date); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<p><?php echo CHtml::encode($data->text); ?></p>


</div>