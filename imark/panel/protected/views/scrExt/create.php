<?php
/* @var $this ScrExtController */
/* @var $model ScrExt */

$this->breadcrumbs=array(
	'Scr Exts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ScrExt', 'url'=>array('index')),
	array('label'=>'Manage ScrExt', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
);
?>

<h1>Create ScrExt</h1>

<?php
if (isset($admin_script))
    $this->renderPartial('_form', array('model'=>$model, 'admin_script'=>$admin_script));
else
    $this->renderPartial('_form', array('model'=>$model));
?>