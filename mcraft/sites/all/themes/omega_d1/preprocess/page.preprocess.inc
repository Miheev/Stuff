<?php

/**
 * Implements hook_preprocess_page().
 */
function omega_d1_preprocess_page(&$variables) {
  // You can use preprocess hooks to modify the variables before they are passed
  // to the theme function or template file.

    //var_dump($_GET);
    $thp= drupal_get_path('theme', 'omega_d1');

    drupal_add_js("/".$thp."/js/vendor/jquery.transit.min.js");
    drupal_add_js("/".$thp."/js/omega-d1.behaviors.js");


    //Alias specific for node
    $n_alias= drupal_lookup_path('alias', $_GET['q']);
    if ( preg_match('/^users/', $n_alias) ) {
        global $user;

        if (preg_match('/.*\/(.*)/', $n_alias, $res) !== false)
            if ($res[1] != $user->name) {
                $page_uid = db_query("SELECT uid FROM {users} WHERE name = :name", array(':name' => $res[1]))->fetchField();
                header("Location: /profile-main/$page_uid");
            }
        return;
    }

}

//function omega_d1_preprocess_node(&$vars) {
//    $vars['submitted'] = date("l, M jS, Y", $vars['created']);
//}