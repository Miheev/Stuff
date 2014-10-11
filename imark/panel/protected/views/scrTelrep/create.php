<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-1.8.1.min.js"><\/script>')</script>

<?php
/* @var $this ScrTelrepController */
/* @var $model ScrTelrep */

$this->breadcrumbs=array(
    'Проекты'=>array('profiles/index'),
    $_GET['name']=> array('/profiles/view', 'id'=>$_GET['id']),
	'Статический calltracking (подмена номеров)',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        'Главная'=>Yii::app()->getBaseUrl(true),
        'Проекты'=>array('profiles/index'),
        $_GET['name']=> array('/profiles/view', 'id'=>$_GET['id']),
        'Статический calltracking (подмена номеров)',
    ),
    'homeLink'=>false // add this line
));

if (Users::isAdmin())
    $this->menu=array(
        array('label'=>'List ScrTelrep', 'url'=>array('index')),
        array('label'=>'Manage ScrTelrep', 'url'=>array('admin'), 'visible'=>Users::isAdmin()),
    );
?>

<h1>Статический calltracking(подмена номеров)</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<script>
    var params= {
        service: [],
        //script: '',
        id: ''
        //jquery: false
    }
    var putparams= function() {
        $('#ScrTelrep_params').val(JSON.stringify(params));
//        console.log(params.service);
    }
    jQuery(function ($) {
        $(document).ready(function () {
            $('input[name="service[]"]').change(function(){
                id= $('input[name="service[]"]').index($(this));
                $('input[name="service[]"]').each(function(itid){
                    if ($(this).prop('checked')) {
                        //itid= $('input[name="service[]"]').index($(this));
                        txtval= $('input[name="service_text[]"]').eq(itid).val();
                        if (txtval.length)
                            params.service[itid]= txtval;
                        else
                            params.service[itid]= null;
                    } else {
                        params.service[itid]= null;
                        $('input[name="service_text[]"]').eq(itid).val('');
                    }
                });
                putparams();
            });
            $('input[name="service_text[]"]').change(function(){
                id= $('input[name="service_text[]"]').index($(this));
                $('input[name="service[]"]').eq(id).prop('checked', true);
                $('input[name="service[]"]').each(function(itid){
                    if ($(this).prop('checked') || itid == id) {
                        txtval= $('input[name="service_text[]"]').eq(itid).val();
                        if (txtval.length)
                            params.service[itid]= txtval;
                        else {
                            params.service[itid]= null;
                            $('input[name="service[]"]').eq(itid).prop('checked', false);
                        }
                    } else {
                        params.service[itid]= null;
                        $('input[name="service_text[]"]').eq(itid).val('');
                    }
                });
                putparams();
            });

//            $('#ext_script').change(function(){
//                params.script= $(this).val();
//                putparams();
//            });
            $('#service_id').change(function(){
                params.id= $(this).val();
                putparams();
            });
//            $('#jq_include').change(function(){
//                params.jquery= $(this).prop('checked');
//                putparams();
//            });
        });
    });
</script>