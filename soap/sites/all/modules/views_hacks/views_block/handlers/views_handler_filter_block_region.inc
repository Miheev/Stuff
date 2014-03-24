<?php

/**
 * Filter based on block region.
 */
class views_handler_filter_block_region extends views_handler_filter_in_operator {
  function get_value_options() {
    foreach (list_themes() as $key => $theme) {
      if ($theme->status) {
        foreach (system_region_list($key) as $name => $description) {
          $this->value_options[$name] = $name . ' (' . $theme->info['name'] . ')';
        }
      }
    }
    $this->value_options['-1'] = t('- None -');
    ksort($this->value_options);
  }
}

