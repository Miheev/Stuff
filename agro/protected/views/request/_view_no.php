<?php
/* @var $this RequestController */
/* @var $data Request */
?>

<?php if ($data->assign) : ?>
    <?php $this->renderPartial('_view', array('data'=>$data)); ?>
<? endif; ?>