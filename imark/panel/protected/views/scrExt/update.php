<?php
/* @var $this ScrExtController */
/* @var $model ScrExt */

$this->breadcrumbs=array(
	'Scr Exts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ScrExt', 'url'=>array('index')),
//	array('label'=>'Create ScrExt', 'url'=>array('create')),
	array('label'=>'View ScrExt', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ScrExt', 'url'=>array('admin'), 'visible'=>USERS::isAdmin()),
);
?>

<h1>Update ScrExt <?php echo $model->id; ?></h1>

<?php
if (isset($admin_script))
    $this->renderPartial('_form', array('model'=>$model, 'admin_script'=>$admin_script));
else
    $this->renderPartial('_form', array('model'=>$model));
?>