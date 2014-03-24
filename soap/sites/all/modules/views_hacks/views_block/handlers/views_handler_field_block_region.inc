<?php

class views_handler_field_block_region extends views_handler_field {
  function render($values) {
    return ($values->{$this->field_alias} == -1) ? t('- None -') : $values->{$this->field_alias};
  }
}

