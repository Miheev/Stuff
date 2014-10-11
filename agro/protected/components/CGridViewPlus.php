<?php

Yii::import('zii.widgets.grid.CGridView');

class CGridViewPlus extends CGridView {

    public $addingHeaders = array();

    public function renderTableHeader() {
        if (!empty($this->addingHeaders))
            $this->multiRowHeader();

        parent::renderTableHeader();
    }

    protected function multiRowHeader() {
        echo CHtml::openTag('thead') . "\n";
        foreach ($this->addingHeaders as $row) {
            $this->addHeaderRow($row);
        }
        echo CHtml::closeTag('thead') . "\n";
    }

    // each cell value expects array(array($text,$colspan,$options), array(...))
    protected function addHeaderRow($row) {
        // add a single header row
        echo CHtml::openTag('tr') . "\n";
        // inherits header options from first column
        $options = $this->columns[0]->headerHtmlOptions;
        foreach ($row as $header) {
            $options['colspan'] = $header['colspan'];
            $cellOptions=($header['options'] + $options);
            echo CHtml::openTag('th', $cellOptions);
            echo $header['text'];
            echo CHtml::closeTag('th');
        }
        echo CHtml::closeTag('tr') . "\n";
    }

}
?>