<?php
/**
 * @file
 * Provide views data and handlers for blocks.
 */

/**
 * Implementation of hook_views_data()
 */
function views_block_views_data() {
  // Basic table information.
  $data['block']['table']['group']  = t('Block');

  // Advertise this table as a possible base table
  $data['block']['table']['base'] = array(
    'field' => 'bid',
    'title' => t('Block'),
    'help' => t('Blocks are the boxes visible in the sidebar(s) of your Drupal website.'),
  );
  
  // Module
  $data['block']['module'] = array(
    'title' => t('Module'),
    'help' => t('The module that exposes the block.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_block_module',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  // Block id
  $data['block']['bid'] = array(
    'title' => t('Block ID'),
    'help' => t('The ID of the block.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
      'allow empty' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument',
    ),
  );

  // Delta
  $data['block']['delta'] = array(
    'title' => t('Delta'),
    'help' => t('The block index within its parent module.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  // Theme
  $data['block']['theme'] = array(
    'title' => t('Theme'),
    'help' => t('The theme where the block appears.'),
    'field' => array(
      'handler' => 'views_handler_field_block_theme',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_block_theme',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  // Status
  $data['block']['status'] = array(
    'title' => t('Active'),
    'help' => t('Whether or not the block is active.'),
    'field' => array(
      'handler' => 'views_handler_field_boolean',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_boolean_operator',
      'label' => t('Active'),
      'type' => 'yes-no',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );

  // Weight
  $data['block']['weight'] = array(
    'title' => t('Weight'),
    'help' => t('The weight of the block.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_numeric',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument',
    ),
  );

  // Region
  $data['block']['region'] = array(
    'title' => t('Region'),
    'help' => t('The region where the block appears.'),
    'field' => array(
      'handler' => 'views_handler_field_block_region',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_block_region',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  // Custom
  $data['block']['custom'] = array(
    'title' => t('Custom visibility'),
    'help' => t('The custom visibility setting of the block.'),
    'field' => array(
      'handler' => 'views_handler_field_block_custom',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_block_custom',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument',
    ),
  );

  // Visibility
  $data['block']['visibility'] = array(
    'title' => t('Page visibility'),
    'help' => t('The page-specific visibility setting of the block.'),
    'field' => array(
      'handler' => 'views_handler_field_block_visibility',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_block_visibility',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument',
    ),
  );

  // Pages
  $data['block']['pages'] = array(
    'title' => t('Pages'),
    'help' => t('The pages where the block appears.'),
    'field' => array(
      'handler' => 'views_handler_field',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_regex',
    ),
  );

  // Title
  $data['block']['title'] = array(
    'title' => t('Title'),
    'help' => t('The block title.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  // Cache
  $data['block']['cache'] = array(
    'title' => t('Cache'),
    'help' => t('The caching settings of the block.'),
    'field' => array(
      'handler' => 'views_handler_field_block_cache',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_block_cache',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );

  // Link to edit block
  $data['block']['edit_block'] = array(
    'field' => array(
      'title' => t('Edit link'),
      'help' => t('Provide a simple link to edit the block.'),
      'handler' => 'views_handler_field_block_link_edit',
    ),
  );

  // Boxes table
  $data['block_custom']['table']['group']  = t('Block');
  $data['block_custom']['table']['join'] = array(
    'block' => array(
      'left_field' => 'delta',
      'field' => 'bid',
      'extra' => array(
        array('table' => 'block', 'field' => 'module', 'value' => 'block'),
      ),
    ),
  );

  // Info
  $data['block_custom']['info'] = array(
    'title' => t('Description'),
    'help' => t('The block description.'),
    'field' => array(
      'handler' => 'views_handler_field_block_info',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );

  // Body
  $data['block_custom']['body'] = array(
    'title' => t('Body'),
    'help' => t('The block body.'),
    'field' => array(
      'handler' => 'views_handler_field',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_regex',
    ),
  );

  // Format
  $data['block_custom']['format'] = array(
    'title' => t('Body format'),
    'help' => t('The format of the block body.'),
    'field' => array(
      'handler' => 'views_handler_field_block_format',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_block_format',
    ),
  );

  return $data;
}

/**
 * Implementation of hook_views_query_substitutions().
 */
function views_block_views_query_substitutions() {
  global $theme_key;
  return array(
    '***CURRENT_THEME***' => $theme_key,
  );
}

