<?php
/* @var $this TreeController */
/* @var $model Tree */

//if (!isset(Yii::app()->session['bread'])) {
    $this->breadcrumbs=array(
        'Trees'=>array('index'),
        $model->name=>array('view', 'id'=>$model->id),
    );
    if (isset($_GET['nodetitle']))
        $this->breadcrumbs[]= $_GET['nodetitle'];
//    Yii::app()->session['bread']= $this->breadcrumbs;
//} else {
//    $this->breadcrumbs= Yii::app()->session['bread'];
//    $this->breadcrumbs[]= array($_GET['nodetitle'] => array('view', 'id'=>$model->id));
//    Yii::app()->session['bread']= $this->breadcrumbs;
//}

//unset(Yii::app()->session['bread']);
//if (!isset(Yii::app()->session['bread'])) {
//    $this->breadcrumbs=array(
//        'homeLink'=>CHtml::link('Catalog','/' ),
//        'homeLink2'=>CHtml::link('Catalog','/' ),
//    );
//    if (isset($_GET['nodetitle']))
//        $this->breadcrumbs['homeLink2'.count($this->breadcrumbs)]= CHtml::link('Catalog','/' );
//    Yii::app()->session['bread']= $this->breadcrumbs;
//} else {
//    $this->breadcrumbs= Yii::app()->session['bread'];
//    $this->breadcrumbs['homeLink2'.count($this->breadcrumbs)]= CHtml::link('Catalog','/' );
//    Yii::app()->session['bread']= $this->breadcrumbs;
//}

$this->menu=array(
	array('label'=>'List Tree', 'url'=>array('index')),
	array('label'=>'Create Tree', 'url'=>array('create')),
	array('label'=>'Update Tree', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tree', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tree', 'url'=>array('admin')),
);
?>

<h1>View Tree #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
//		'tree',
		'creator_id',
		'name',
	),
)); ?>

<?php

Yii::app()->clientScript->registerScript("quest",
    'window.tree =' . $model->tree . ';' . "\n\r".
    'window.treeid =' . $model->id . ';' . "\n\r".
    'window.nodeway =' . ( (isset($_GET['nodeway']))? '"'.$_GET['nodeway'].'"' : '"j1_1"' ) . ';' . "\n\r".
    'window.nodetype =' . ( (isset($_GET['nodetype']))? '"'.$_GET['nodetype'].'"' : '"ans"' ) . ';' . "\n\r".
    'window.pagenode =' . ( (isset($_GET['qid']))? '"'.$_GET['qid'].'"' : '"start"' ) . ';' . "\n\r".
    '//wayobj=nodeway.split("__");' . "\n\r"
);

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-1.11.0.min.js"><\/script>')</script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/jstree/dist/themes/default/style.min.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/jstree/dist/jstree.min.js"></script>
<div class="tree-container">
    <div class="tree-out" style="float: left; width: 50%;">
        <div id="jstree_out"></div>
    </div>
    <div class="aq-content" style="float: left; width: 50%;">
        <?php
            if (isset($quest)) {
                foreach($quest as $item) : ?>
                    <div class="question" data-id="<?php echo $item->id; ?>">
                        <h2><?php echo $item->question; ?></h2>
                        <div class="answers">
                            <?php
                                $tmp= $item->getAnswers();
                                foreach ($tmp as $aid => $ans) {
                                    echo '<p>'. CHtml::link($ans, array('tree/view', 'id'=>$item->id, 'qid'=>'')) .'</p>';
                                }
                                ?>
                        </div>
                    </div>
                <?php endforeach;
            }
        ?>
    </div>
    <div style="clear: both;"></div>
    <script>
        jQuery(function ($) {
            $(document).ready(function () {
                treestr= JSON.stringify(tree);
                treestr= treestr.replace(/"h"/g, '"text"');
                treestr= treestr.replace(/"a"/g, '"children"');

                treestr= treestr.replace(/"lc"/g, '"li_attr"');
                treestr= treestr.replace(/"=\+=/g, '{"data-nodeid":"');
                treestr= treestr.replace(/=-="/g, '"}');

                treestr= treestr.replace(/[]/g, '"#"');
                treestr= treestr.replace(/null/g, '{"text":"Escaped"}');
                treejs= JSON.parse(treestr);

                console.log(treejs);
                treejs.text= "<?php echo $model->name; ?>";
                //treejs.li_attr= {class: 'root9999'};
                $('#jstree_out').jstree({
                    'core': {'data':treejs}
                });
                $('#jstree_out').on('loaded.jstree', function(){
//                    $(this).jstree(true).open_node($('#jstree_out>ul>li').attr('id'));
//                    $(this).jstree(true).select_node($('#jstree_out>ul>li>ul>li').attr('id'));

                        $(this).jstree(true).open_node(nodeway);
                        $(this).jstree(true).select_node(nodeway);

                    /*
                    Load Answers Path
                     */
                    $('.aq-content .answers a').click(function(e){
                        e.preventDefault();

                        node='#'+nodeway;

                        quest= $(this).parents('.question').first();
                        aid= quest.find('.answers a').index($(this));
                        questid= quest.parent().children('.question').index(quest);
                        nodeid= quest.attr('data-id');

                        console.log(node);
                        console.log(aid);
                        console.log(questid);
                        console.log(nodeid);

                        if (nodetype == 'quest') {
                            aobj= $(node+'>ul>li').eq(aid).attr('id');
                            $('#'+aobj+'>a').trigger('click');
//                            $('#jstree_out').jstree(true).open_node(aobj);
//                            $('#jstree_out').jstree(true).select_node(aobj);
                        } else {
                            qobj= $(node+'>ul>li').eq(questid).attr('id');
                            console.log(qobj);
                            $('#jstree_out').jstree(true).open_node(qobj);
                            $('#jstree_out').jstree(true).select_node(qobj);

                            aobj= $('#'+qobj+'>ul>li').eq(aid).attr('id');
                            $('#'+aobj+'>a').trigger('click');
//                            $('#jstree_out').jstree(true).open_node(aobj);
//                            $('#jstree_out').jstree(true).select_node(aobj);
                        }

                    });

                    if (pagenode == 'start') {
                        $('#j1_1>a').trigger('click');
                    }
                });
                $('#jstree_out').on('activate_node.jstree', function(e, node){
                    itid= '#'+node.node.id;
                    nodetitle= node.node.text;
                    //nodeway+= '__#'+itid;

                    nodeid= $(itid).data('nodeid');
                    aq= nodeid.split('-');
                    if (aq[0] == 'question' && aq[1].length) {
                        qid= aq[1];
                        nodetype= 'quest';
                        nodeway= node.node.id;
                    }
                    else if (aq[1].length) {
                        qid= '';
                        $('#jstree_out').jstree(true).open_node(node.node.id);
                        $('#jstree_out').jstree(true).select_node(node.node.id);
                        $(itid+'>ul>li').each(function(){
                            nodeid= $(this).data('nodeid').split('-')[1];
                            console.log(nodeid);
                            if (nodeid.length)
                                qid+= ','+nodeid;
                        });
                        if (qid.length) {
                            qid= qid.substr(1);
                            nodetype= 'ans';
                            nodeway= node.node.id;
                        }
                        else return;
                    }

                    location.assign(location.origin + '?r=tree/view&id='+ treeid +'&qid='+ qid +'&nodeway='+ nodeway +'&nodetype='+ nodetype +'&nodetitle='+nodetitle);
                });

            });
        });
    </script>
</div>