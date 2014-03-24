<?php

/**
 * Filter based on regular expression.
 */
class views_handler_filter_regex extends views_handler_filter {
  var $always_multiple = TRUE;

  function operator_options() {
    return array(
      'match' => t('Matches regex'),
      'nomatch' => t('Does not match regex'),
    );
  }

  function admin_summary() {
    if (!empty($this->options['exposed'])) {
      return t('exposed');
    }
    return parent::admin_summary();
  }

  function value_form(&$form, &$form_state) {
    $form['value'] = array(
      '#type' => 'textfield',
      '#title' => t('Value'),
      '#size' => 30,
      '#default_value' => $this->value,
    );
  }

  function query() {
    $db_type = Database::getConnection()->databaseType();
    switch ($db_type) {
      case 'mysql':
        $match = 'REGEXP';
        $nomatch = 'NOT REGEXP';
        break;
      case 'pgsql':
        $match = '*~'; // case insensitive match
        $nomatch = '!*~'; 
        break;
      default:
        $operators =& drupal_static(__METHOD__);
        if (empty($operators)) {
          $operators = module_invoke_all('views_regex_operators', $db_type);
        }
        if (empty($operators)) {
          watchdog('views_regex', 'No regex operators found for database type %type.', array('%type' => $db_type));
          return array();
        }
        $match = $operators['match'];
        $nomatch = $operators['not match'];
    }
    $this->operator = $this->operator === 'match' ? $match : $nomatch;
    parent::query();
  }
}

