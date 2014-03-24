<?php

/**
 * Filter based on block module.
 */
class views_handler_filter_block_module extends views_handler_filter_in_operator {
  function get_value_options() {
    $modules = db_query("SELECT DISTINCT module FROM {block}");
    foreach ($modules as $module) {
      $this->value_options[$module->module] = $module->module;
    }
    ksort($this->value_options);
  }
}
