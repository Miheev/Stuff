<?php
if ($_SERVER['HTTP_ACCEPT'] == '*/*') {
    foreach($out_scripts as $val) {
        print(";".$val);
    }
} else
    $this->redirect(array('scriptcode'));
?>