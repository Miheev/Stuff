<?php

if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die('Access Denied');
    }
if (!function_exists('current_user_can')) {
    die('Access Denied');
}





function showStyles($op_type = "0")
{
    global $wpdb;
    $query = "SELECT *  from " . $wpdb->prefix . "huge_itslider_params ";

    $rows = $wpdb->get_results($query);

    $param_values = array();
    foreach ($rows as $row) {
        $key = $row->name;
        $value = $row->value;
        $param_values[$key] = $value;
    }
    html_showStyles($param_values, $op_type);
}


function save_styles_options()
{

    global $wpdb;
    if (isset($_POST['params'])) {
      $params = $_POST['params'];
      foreach ($params as $key => $value) {
          $wpdb->update($wpdb->prefix . 'huge_itslider_params',
              array('value' => $value),
              array('name' => $key),
              array('%s')
          );
      }
      ?>
      <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
      <?php
    }
}

function save_global_options()
{

    global $wpdb;
    if (isset($_POST['params']))
        $params = $_POST['params'];
    foreach ($params as $key => $value) {

	echo $_POST['params'];
        $wpdb->update($wpdb->prefix . 'huge_itslider_params',
            array('value' => $value),
            array('name' => $key),
            array('%s')
        );
		
    }
	
    ?>
    <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
<?php

}


?>
  