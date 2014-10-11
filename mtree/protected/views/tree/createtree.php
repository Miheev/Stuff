<?php
/* @var $this TreeController */
/* @var $model Tree */

$this->breadcrumbs = array(
    'Trees' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Tree', 'url' => array('index')),
    array('label' => 'Manage Tree', 'url' => array('admin')),
);

Yii::app()->clientScript->registerScript("quest",
    'window.tree =' . '""' . ';' . "\n\r" .
    'window.treeid =' . '""' . ';' . "\n\r"
);

?>

    <h1>Create Tree</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>


<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <script>window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    <link rel="stylesheet"
          href="<?php echo Yii::app()->request->baseUrl; ?>/assets/jstree/dist/themes/default/style.min.css" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/jstree/dist/jstree.min.js"></script>
    <div class="tree-container">
        <div class="tree-out" style="float: left; width: 50%;">
            <div id="jstree_out"></div>
        </div>
        <div class="aq-content" style="float: left; width: 50%;">

            <div class="tree-build">
                <h2>Questions Selects</h2>

                <div class="q-create">
                    <?php $this->renderPartial('_form_tdata', array('qc_model' => $qc_model)); ?>
                </div>

                <?php
                Yii::app()->clientScript->registerScript("quest",
                    'window.quest =' . CJSON::encode($quest) . ';' . "\n\r".
                    'window.aurl ="' . $this->createUrl('/tree/createtree') . '";' . "\n\r"
                );
                ?>

                <div class="lists">
                    <div class="base-list" data-parent="0" style="border: 1px solid grey;">
                        <div class="questions">
                                <?php
                                $opt = TreeData::getQOptions($quest);
                                echo CHtml::dropDownList('questions', $opt[1], $opt/*, array('empty' => '(Select a question)')*/);
                                ?>
                        </div>
                    </div>
                </div>
                <div class="tree-buttons" style="margin: 20px; padding: 20px; background: green;">
                    <button class="btn tree-btn-add" style="font-size: 1.5em">+</button>
                    <button id="qappend" class="btn tree-btn-edit ajax-btn" style="font-size: 1.5em">+/-</button>
                    <button class=" btn tree-btn-del" style="font-size: 1.5em">--</button>
                </div>
                <script>
                    //Dialog Functions
                    subtree_del = {
                        status:  undefined,
                        accept:  function () {
                            subtree_del.status = true;
                            $("#subtree_del").dialog("close");
                        },
                        discard: function () {
                            subtree_del.status = false;
                            $("#subtree_del").dialog("close");
                        }
                    }
                </script>
            </div>

        </div>
        <div style="clear: both;"></div>
    </div>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/createJT.js"></script>


<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'subtree_del',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Подтверждение операции',
        'autoOpen' => false,
        'resizable' => false,
        'height' => 200,
        'modal' => true,
        'buttons' => array(
            'Удалить' => 'js:subtree_del.accept',
            'Закрыть' => 'js:subtree_del.discard')
    ),
));
?>
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы действительно хотите удалить вопрос и его ветку?</p>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>