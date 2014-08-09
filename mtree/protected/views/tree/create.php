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
?>

    <h1>Create Tree</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>

    <div class="tree-build">
    <h2>Questions Selects</h2>

    <div class="lists">
        <div class="base-list" data-parent="0" style="border: 1px solid grey;">
            <div class="questions" style="display: inline-block">
                <div class="item" style="height: 85px; margin-bottom: 10px;">
                    <div class="control">
                        <button class="btn btn-add" style="font-size: 1.5em">+</button>
                        <button class=" btn btn-del" style="font-size: 1.5em">--</button>
                    </div>
                    <?php
                    $opt = TreeData::getQOptions($quest);
                    echo CHtml::dropDownList('questions', $opt[1], $opt, array('empty' => '(Select a question)'));

                    Yii::app()->clientScript->registerScript("quest",
                        'window.quest =' . CJSON::encode($quest) . ';' . "\n\r"
                    );
                    ?>
                </div>
            </div>
            <div class="answers" style="display: inline-block;">
                <div class="item" style="height: 85px; margin-bottom: 10px;">
                    <select name="answers" size="5" data-qid="none"></select>
                </div>
            </div>
            <div class="childs" style="margin-left: 50px;">
                <div class="item" style="background: antiquewhite; margin-bottom: 30px;"></div>
            </div>
        </div>
    </div>
        <script>
            //Dialog Functions
            subtree_del= {
                status: undefined,
                accept: function() {
                    subtree_del.status= true;
                    $("#subtree_del").dialog("close");
                },
                discard: function() {
                    subtree_del.status= false;
                    $("#subtree_del").dialog("close");
                }
            }
        </script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/createTree.js"></script>
    </div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'subtree_del',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Подтверждение операции',
        'autoOpen'=>false,
        'resizable'=> false,
        'height'=>200,
        'modal'=> true,
        'buttons' => array(
            'Удалить'=>'js:subtree_del.accept',
            'Закрыть'=>'js:subtree_del.discard')
    ),
));
?>
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы действительно хотите сменить вопрос и удалить эту ветку?</p>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>