<?php
/* @var $this RegisterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Записи реестра',
);

$this->menu=array(
	array('label'=>'Создать запись', 'url'=>array('/request/index')),
	array('label'=>'Управлять записями', 'url'=>array('admin')),
);
?>

<h1>Последние заявки</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<script>
    $(document).ready(function(){
        $('.view').click(function(){
            location.assign($(this).data('link'));
        });
    });
</script>