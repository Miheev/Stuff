<?php

class views_handler_field_block_theme extends views_handler_field {
  function render($values) {
    $themes = list_themes();
    if (isset($themes[$values->{$this->field_alias}])) {
      return $themes[$values->{$this->field_alias}]->info['name'];
    }
    return t('- None -');
  }
}

