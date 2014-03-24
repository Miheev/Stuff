<?php

class views_handler_field_block_cache extends views_handler_field {
  function render($values) {
    $cache = $values->{$this->field_alias};
    if ($cache == DRUPAL_NO_CACHE) {
      return 'DRUPAL_NO_CACHE';
    }
    $caches = array(
      DRUPAL_CACHE_PER_ROLE => 'DRUPAL_CACHE_PER_ROLE',
      DRUPAL_CACHE_PER_USER => 'DRUPAL_CACHE_PER_USER',
      DRUPAL_CACHE_PER_PAGE => 'DRUPAL_CACHE_PER_PAGE',
      DRUPAL_CACHE_GLOBAL => 'DRUPAL_CACHE_GLOBAL',
    );
    $result = array();
    foreach ($caches as $bit => $string) {
      if (($cache & $bit) > 0) {
        $result[] = $string;
      }
    }
    return implode("\n", $result);
  }
}

