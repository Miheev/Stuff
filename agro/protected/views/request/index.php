<?php
/* @var $this RequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Заявки',
);

$this->menu=array(
	array('label'=>'Создать заявку', 'url'=>array('create')),
	array('label'=>'Управлять заявками', 'url'=>array('admin')),
);
?>

<h1>Заявки</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>

<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $('.view').click(function(){-->
<!--            location.assign($(this).data('link'));-->
<!--        });-->
<!--    });-->
<!--</script>-->