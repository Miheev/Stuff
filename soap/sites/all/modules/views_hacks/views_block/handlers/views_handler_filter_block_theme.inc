<?php

/**
 * Filter based on block theme.
 */
class views_handler_filter_block_theme extends views_handler_filter_in_operator {
  function get_value_options() {
    foreach (list_themes() as $key => $theme) {
      if ($theme->status) {
        $this->value_options[$key] = $theme->info['name'];
      }
    }
    ksort($this->value_options);
    $this->value_options = array('***CURRENT_THEME***' => t('Current theme'), '***DEFAULT_THEME***' => t('Default theme')) + $this->value_options;
  }
}

