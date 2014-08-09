<?php
$script= $model->serviceScript();
if ($_SERVER['HTTP_ACCEPT'] == '*/*') {
    print($script);
    print(";".$model->script);
    print(";".$model->adminScript());
} else
    $this->redirect(array('scriptcode'));
?>