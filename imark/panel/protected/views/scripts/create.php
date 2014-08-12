
<?php
/* @var $this ScriptsController */
/* @var $model Scripts */

$this->breadcrumbs=array(
	'Scripts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Scripts', 'url'=>array('index')),
	array('label'=>'Manage Scripts', 'url'=>array('admin'), 'visible'=>(Yii::app()->user->name == Yii::app()->params['admin_name'])),
);
?>

<h1>Create Scripts</h1>

<?php
if (isset($admin_script))
    $this->renderPartial('_form', array('model'=>$model, 'admin_script'=>$admin_script));
else
    $this->renderPartial('_form', array('model'=>$model));
?>

