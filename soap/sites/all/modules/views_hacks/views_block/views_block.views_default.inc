<?php

/**
 * Implementation of hook_views_default_views().
 */
function views_block_views_default_views() {
  $view = new view();
  $view->name = 'block';
  $view->description = 'Manage blocks.';
  $view->tag = 'admin';
  $view->base_table = 'block';
  $view->human_name = 'Administration: Blocks';
  $view->core = 0;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Defaults */
  $handler = $view->new_display('default', 'Defaults', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'none';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'draggableviews' => 'draggableviews',
    'views_bulk_operations' => 'views_bulk_operations',
    'info' => 'info',
    'edit_block' => 'edit_block',
    'status' => 'status',
    'title' => 'title',
    'body' => 'body',
    'format' => 'format',
    'module' => 'module',
    'delta' => 'delta',
    'custom' => 'custom',
    'visibility' => 'visibility',
    'pages' => 'pages',
    'theme' => 'theme',
    'region' => 'region',
    'weight' => 'weight',
    'cache' => 'cache',
  );
  $handler->display->display_options['style_options']['default'] = 'weight';
  $handler->display->display_options['style_options']['info'] = array(
    'draggableviews' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'views_bulk_operations' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'info' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'edit_block' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'status' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'title' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'body' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'format' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'module' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'delta' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'custom' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'visibility' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'pages' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'theme' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'region' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'weight' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'cache' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* Field: Bulk operations: Block */
  $handler->display->display_options['fields']['views_bulk_operations']['id'] = 'views_bulk_operations';
  $handler->display->display_options['fields']['views_bulk_operations']['table'] = 'block';
  $handler->display->display_options['fields']['views_bulk_operations']['field'] = 'views_bulk_operations';
  $handler->display->display_options['fields']['views_bulk_operations']['label'] = 'Select';
  $handler->display->display_options['fields']['views_bulk_operations']['vbo_settings']['display_type'] = '0';
  $handler->display->display_options['fields']['views_bulk_operations']['vbo_settings']['enable_select_all_pages'] = 1;
  $handler->display->display_options['fields']['views_bulk_operations']['vbo_settings']['force_single'] = 0;
  $handler->display->display_options['fields']['views_bulk_operations']['vbo_settings']['entity_load_capacity'] = '10';
  $handler->display->display_options['fields']['views_bulk_operations']['vbo_operations'] = array(
    'action::views_bulk_operations_delete_item' => array(
      'selected' => 0,
      'postpone_processing' => 0,
      'skip_confirmation' => 0,
      'override_label' => 0,
      'label' => '',
    ),
    'action::views_bulk_operations_script_action' => array(
      'selected' => 1,
      'postpone_processing' => 0,
      'skip_confirmation' => 0,
      'override_label' => 0,
      'label' => '',
    ),
    'action::views_bulk_operations_modify_action' => array(
      'selected' => 0,
      'postpone_processing' => 0,
      'skip_confirmation' => 0,
      'override_label' => 0,
      'label' => '',
      'settings' => array(
        'show_all_tokens' => 1,
        'display_values' => array(
          '_all_' => '_all_',
        ),
      ),
    ),
    'action::views_bulk_operations_argument_selector_action' => array(
      'selected' => 0,
      'skip_confirmation' => 0,
      'override_label' => 0,
      'label' => '',
      'settings' => array(
        'url' => '',
      ),
    ),
    'action::system_send_email_action' => array(
      'selected' => 0,
      'postpone_processing' => 0,
      'skip_confirmation' => 0,
      'override_label' => 0,
      'label' => '',
    ),
  );
  /* Field: Block: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'block';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  /* Field: Block: Description */
  $handler->display->display_options['fields']['info']['id'] = 'info';
  $handler->display->display_options['fields']['info']['table'] = 'block_custom';
  $handler->display->display_options['fields']['info']['field'] = 'info';
  /* Field: Block: Module */
  $handler->display->display_options['fields']['module']['id'] = 'module';
  $handler->display->display_options['fields']['module']['table'] = 'block';
  $handler->display->display_options['fields']['module']['field'] = 'module';
  /* Field: Block: Delta */
  $handler->display->display_options['fields']['delta']['id'] = 'delta';
  $handler->display->display_options['fields']['delta']['table'] = 'block';
  $handler->display->display_options['fields']['delta']['field'] = 'delta';
  /* Field: Block: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'block_custom';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  /* Field: Block: Body format */
  $handler->display->display_options['fields']['format']['id'] = 'format';
  $handler->display->display_options['fields']['format']['table'] = 'block_custom';
  $handler->display->display_options['fields']['format']['field'] = 'format';
  $handler->display->display_options['fields']['format']['label'] = 'Format';
  /* Field: Block: Active */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'block';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  /* Field: Block: Custom visibility */
  $handler->display->display_options['fields']['custom']['id'] = 'custom';
  $handler->display->display_options['fields']['custom']['table'] = 'block';
  $handler->display->display_options['fields']['custom']['field'] = 'custom';
  /* Field: Block: Page visibility */
  $handler->display->display_options['fields']['visibility']['id'] = 'visibility';
  $handler->display->display_options['fields']['visibility']['table'] = 'block';
  $handler->display->display_options['fields']['visibility']['field'] = 'visibility';
  /* Field: Block: Pages */
  $handler->display->display_options['fields']['pages']['id'] = 'pages';
  $handler->display->display_options['fields']['pages']['table'] = 'block';
  $handler->display->display_options['fields']['pages']['field'] = 'pages';
  /* Field: Block: Theme */
  $handler->display->display_options['fields']['theme']['id'] = 'theme';
  $handler->display->display_options['fields']['theme']['table'] = 'block';
  $handler->display->display_options['fields']['theme']['field'] = 'theme';
  /* Field: Block: Region */
  $handler->display->display_options['fields']['region']['id'] = 'region';
  $handler->display->display_options['fields']['region']['table'] = 'block';
  $handler->display->display_options['fields']['region']['field'] = 'region';
  /* Field: Block: Cache */
  $handler->display->display_options['fields']['cache']['id'] = 'cache';
  $handler->display->display_options['fields']['cache']['table'] = 'block';
  $handler->display->display_options['fields']['cache']['field'] = 'cache';
  /* Field: Block: Weight */
  $handler->display->display_options['fields']['weight']['id'] = 'weight';
  $handler->display->display_options['fields']['weight']['table'] = 'block';
  $handler->display->display_options['fields']['weight']['field'] = 'weight';
  /* Field: Block: Edit link */
  $handler->display->display_options['fields']['edit_block']['id'] = 'edit_block';
  $handler->display->display_options['fields']['edit_block']['table'] = 'block';
  $handler->display->display_options['fields']['edit_block']['field'] = 'edit_block';
  /* Filter criterion: Block: Title */
  $handler->display->display_options['filters']['title']['id'] = 'title';
  $handler->display->display_options['filters']['title']['table'] = 'block';
  $handler->display->display_options['filters']['title']['field'] = 'title';
  $handler->display->display_options['filters']['title']['operator'] = 'contains';
  $handler->display->display_options['filters']['title']['group'] = 1;
  $handler->display->display_options['filters']['title']['exposed'] = TRUE;
  $handler->display->display_options['filters']['title']['expose']['operator_id'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['label'] = 'Title';
  $handler->display->display_options['filters']['title']['expose']['operator'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['identifier'] = 'title';
  /* Filter criterion: Block: Description */
  $handler->display->display_options['filters']['info']['id'] = 'info';
  $handler->display->display_options['filters']['info']['table'] = 'block_custom';
  $handler->display->display_options['filters']['info']['field'] = 'info';
  $handler->display->display_options['filters']['info']['group'] = 1;
  $handler->display->display_options['filters']['info']['exposed'] = TRUE;
  $handler->display->display_options['filters']['info']['expose']['operator_id'] = 'info_op';
  $handler->display->display_options['filters']['info']['expose']['label'] = 'Description';
  $handler->display->display_options['filters']['info']['expose']['operator'] = 'info_op';
  $handler->display->display_options['filters']['info']['expose']['identifier'] = 'info';
  /* Filter criterion: Block: Module */
  $handler->display->display_options['filters']['module']['id'] = 'module';
  $handler->display->display_options['filters']['module']['table'] = 'block';
  $handler->display->display_options['filters']['module']['field'] = 'module';
  $handler->display->display_options['filters']['module']['group'] = 1;
  $handler->display->display_options['filters']['module']['exposed'] = TRUE;
  $handler->display->display_options['filters']['module']['expose']['operator_id'] = 'module_op';
  $handler->display->display_options['filters']['module']['expose']['label'] = 'Module';
  $handler->display->display_options['filters']['module']['expose']['operator'] = 'module_op';
  $handler->display->display_options['filters']['module']['expose']['identifier'] = 'module';
  /* Filter criterion: Block: Delta */
  $handler->display->display_options['filters']['delta']['id'] = 'delta';
  $handler->display->display_options['filters']['delta']['table'] = 'block';
  $handler->display->display_options['filters']['delta']['field'] = 'delta';
  $handler->display->display_options['filters']['delta']['operator'] = 'contains';
  $handler->display->display_options['filters']['delta']['group'] = 1;
  $handler->display->display_options['filters']['delta']['exposed'] = TRUE;
  $handler->display->display_options['filters']['delta']['expose']['operator_id'] = 'delta_op';
  $handler->display->display_options['filters']['delta']['expose']['label'] = 'Delta';
  $handler->display->display_options['filters']['delta']['expose']['operator'] = 'delta_op';
  $handler->display->display_options['filters']['delta']['expose']['identifier'] = 'delta';
  /* Filter criterion: Block: Body */
  $handler->display->display_options['filters']['body']['id'] = 'body';
  $handler->display->display_options['filters']['body']['table'] = 'block_custom';
  $handler->display->display_options['filters']['body']['field'] = 'body';
  $handler->display->display_options['filters']['body']['operator'] = 'match';
  $handler->display->display_options['filters']['body']['group'] = 1;
  $handler->display->display_options['filters']['body']['exposed'] = TRUE;
  $handler->display->display_options['filters']['body']['expose']['operator_id'] = 'body_op';
  $handler->display->display_options['filters']['body']['expose']['label'] = 'Body';
  $handler->display->display_options['filters']['body']['expose']['description'] = 'Enter a regular expression.';
  $handler->display->display_options['filters']['body']['expose']['operator'] = 'body_op';
  $handler->display->display_options['filters']['body']['expose']['identifier'] = 'body';
  $handler->display->display_options['filters']['body']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
  );
  /* Filter criterion: Block: Body format */
  $handler->display->display_options['filters']['format']['id'] = 'format';
  $handler->display->display_options['filters']['format']['table'] = 'block_custom';
  $handler->display->display_options['filters']['format']['field'] = 'format';
  $handler->display->display_options['filters']['format']['group'] = 1;
  $handler->display->display_options['filters']['format']['exposed'] = TRUE;
  $handler->display->display_options['filters']['format']['expose']['operator_id'] = 'format_op';
  $handler->display->display_options['filters']['format']['expose']['label'] = 'Body format';
  $handler->display->display_options['filters']['format']['expose']['operator'] = 'format_op';
  $handler->display->display_options['filters']['format']['expose']['identifier'] = 'format';
  /* Filter criterion: Block: Active */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'block';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 'All';
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['exposed'] = TRUE;
  $handler->display->display_options['filters']['status']['expose']['label'] = 'Active';
  $handler->display->display_options['filters']['status']['expose']['identifier'] = 'status';
  /* Filter criterion: Block: Custom visibility */
  $handler->display->display_options['filters']['custom']['id'] = 'custom';
  $handler->display->display_options['filters']['custom']['table'] = 'block';
  $handler->display->display_options['filters']['custom']['field'] = 'custom';
  $handler->display->display_options['filters']['custom']['group'] = 1;
  $handler->display->display_options['filters']['custom']['exposed'] = TRUE;
  $handler->display->display_options['filters']['custom']['expose']['operator_id'] = 'custom_op';
  $handler->display->display_options['filters']['custom']['expose']['label'] = 'Custom visibility';
  $handler->display->display_options['filters']['custom']['expose']['operator'] = 'custom_op';
  $handler->display->display_options['filters']['custom']['expose']['identifier'] = 'custom';
  /* Filter criterion: Block: Page visibility */
  $handler->display->display_options['filters']['visibility']['id'] = 'visibility';
  $handler->display->display_options['filters']['visibility']['table'] = 'block';
  $handler->display->display_options['filters']['visibility']['field'] = 'visibility';
  $handler->display->display_options['filters']['visibility']['group'] = 1;
  $handler->display->display_options['filters']['visibility']['exposed'] = TRUE;
  $handler->display->display_options['filters']['visibility']['expose']['operator_id'] = 'visibility_op';
  $handler->display->display_options['filters']['visibility']['expose']['label'] = 'Page visibility';
  $handler->display->display_options['filters']['visibility']['expose']['operator'] = 'visibility_op';
  $handler->display->display_options['filters']['visibility']['expose']['identifier'] = 'visibility';
  /* Filter criterion: Block: Pages */
  $handler->display->display_options['filters']['pages']['id'] = 'pages';
  $handler->display->display_options['filters']['pages']['table'] = 'block';
  $handler->display->display_options['filters']['pages']['field'] = 'pages';
  $handler->display->display_options['filters']['pages']['operator'] = 'match';
  $handler->display->display_options['filters']['pages']['group'] = 1;
  $handler->display->display_options['filters']['pages']['exposed'] = TRUE;
  $handler->display->display_options['filters']['pages']['expose']['operator_id'] = 'pages_op';
  $handler->display->display_options['filters']['pages']['expose']['label'] = 'Pages';
  $handler->display->display_options['filters']['pages']['expose']['description'] = 'Enter a regular expression.';
  $handler->display->display_options['filters']['pages']['expose']['operator'] = 'pages_op';
  $handler->display->display_options['filters']['pages']['expose']['identifier'] = 'pages';
  $handler->display->display_options['filters']['pages']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
  );
  /* Filter criterion: Block: Theme */
  $handler->display->display_options['filters']['theme']['id'] = 'theme';
  $handler->display->display_options['filters']['theme']['table'] = 'block';
  $handler->display->display_options['filters']['theme']['field'] = 'theme';
  $handler->display->display_options['filters']['theme']['value'] = array(
    '***CURRENT_THEME***' => '***CURRENT_THEME***',
  );
  $handler->display->display_options['filters']['theme']['group'] = 1;
  $handler->display->display_options['filters']['theme']['exposed'] = TRUE;
  $handler->display->display_options['filters']['theme']['expose']['operator_id'] = 'theme_op';
  $handler->display->display_options['filters']['theme']['expose']['label'] = 'Theme';
  $handler->display->display_options['filters']['theme']['expose']['operator'] = 'theme_op';
  $handler->display->display_options['filters']['theme']['expose']['identifier'] = 'theme';
  /* Filter criterion: Block: Region */
  $handler->display->display_options['filters']['region']['id'] = 'region';
  $handler->display->display_options['filters']['region']['table'] = 'block';
  $handler->display->display_options['filters']['region']['field'] = 'region';
  $handler->display->display_options['filters']['region']['group'] = 1;
  $handler->display->display_options['filters']['region']['exposed'] = TRUE;
  $handler->display->display_options['filters']['region']['expose']['operator_id'] = 'region_op';
  $handler->display->display_options['filters']['region']['expose']['label'] = 'Region';
  $handler->display->display_options['filters']['region']['expose']['operator'] = 'region_op';
  $handler->display->display_options['filters']['region']['expose']['identifier'] = 'region';
  /* Filter criterion: Block: Cache */
  $handler->display->display_options['filters']['cache']['id'] = 'cache';
  $handler->display->display_options['filters']['cache']['table'] = 'block';
  $handler->display->display_options['filters']['cache']['field'] = 'cache';
  $handler->display->display_options['filters']['cache']['value'] = array(
    -1 => 0,
    1 => 0,
    2 => 0,
    4 => 0,
    8 => 0,
  );
  $handler->display->display_options['filters']['cache']['group'] = 1;
  $handler->display->display_options['filters']['cache']['exposed'] = TRUE;
  $handler->display->display_options['filters']['cache']['expose']['label'] = 'Cache';
  $handler->display->display_options['filters']['cache']['expose']['identifier'] = 'cache';

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page_1');
  $handler->display->display_options['path'] = 'admin/structure/block2';
  $translatables['block'] = array(
    t('Defaults'),
    t('more'),
    t('Apply'),
    t('Reset'),
    t('Sort by'),
    t('Asc'),
    t('Desc'),
    t('Select'),
    t('- Choose an operation -'),
    t('Title'),
    t('Description'),
    t('Module'),
    t('Delta'),
    t('Body'),
    t('Format'),
    t('Active'),
    t('Custom visibility'),
    t('Page visibility'),
    t('Pages'),
    t('Theme'),
    t('Region'),
    t('Cache'),
    t('Weight'),
    t('Edit link'),
    t('Enter a regular expression.'),
    t('Body format'),
    t('Page'),
  );
  $views[$view->name] = $view;
  return $views;
}

