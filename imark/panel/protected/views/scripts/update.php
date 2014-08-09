<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<?php
/* @var $this ScriptsController */
/* @var $model Scripts */

$this->breadcrumbs=array(
	'Scripts'=>array('index'),
	$model->code=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Scripts', 'url'=>array('index')),
	array('label'=>'Create Scripts', 'url'=>array('create')),
	array('label'=>'View Scripts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Scripts', 'url'=>array('admin'), 'visible'=>(Yii::app()->user->name == Yii::app()->params['admin_name'])),
);
?>

<h1>Update Scripts <?php echo $model->code; ?></h1>

<?php
if (isset($admin_script))
    $this->renderPartial('_form', array('model'=>$model, 'admin_script'=>$admin_script));
else
    $this->renderPartial('_form', array('model'=>$model));
?>

<script>
    var params= {
        service: [],
        id: '',
        host: '',
        jquery: false
    }
    var putparams= function() {
        $('#Scripts_params').val(JSON.stringify(params));
    }
    jQuery(function ($) {
        $(document).ready(function () {
            params= JSON.parse($('#Scripts_params').val());
            $('#service_id').val(params.id);
            $('#jq_include').prop('checked', params.jquery);
            $('#Scripts_domain').val(params.host);
            for (i=0; i<params.service.length; i++) {
                if (params.service[i] && params.service[i].length) {
                    $('input[name="service[]"]').eq(i).prop('checked', true);
                    $('input[name="service_text[]"]').eq(i).val(params.service[i]);
                }
            }

            $('input[name="service[]"]').change(function(){
                $('input[name="service[]"]').each(function(itid){
                    if ($(this).prop('checked')) {
                        //itid= $('input[name="service[]"]').index($(this));
                        txtval= $('input[name="service_text[]"]').eq(itid).val();
                        params.service[itid]= txtval;
                    }
                });
                putparams();
            });
            $('input[name="service_text[]"]').change(function(){
                itid= $('input[name="service_text[]"]').index($(this));
                params.service[itid]= $(this).val();
                $('input[name="service[]"]').eq(itid).prop('checked', true);
                putparams();
            });

            $('#service_id').change(function(){
                params.id= $(this).val();
                putparams();
            });
            $('#jq_include').change(function(){
                params.jquery= $(this).prop('checked');
                putparams();
            });

        });
    });
</script>