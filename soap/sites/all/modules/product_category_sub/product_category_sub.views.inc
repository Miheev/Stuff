<?php
/**
 * Implements of hook_views_pre_render(&$view).
 */
/*function product_category_sub_views_data_alter(&$data) {
    static $io= 10;
        dfb($io++, 'io');
        dfb($data, 'io-data');
        dvr($io++, 'io');
    var_dump($data);
}*/
//function product_category_sub_views_pre_build(&$view) {
    //if ($view->name == "product_category_sub" && $view->current_display == 'entity_view_2') {
    /*if ($view->name == "product_category_sub" && $view->current_display == 'entity_view_2') {
        if (!isset($view->description) || empty($view->description)) $view->description= '000';
        else  $view->description= 'pass9';
    }*/
        //if (isset($_GET['page'])) unset($_GET['page']);
        //if (!isset($_GET['xwr'])) $_GET['xwr']= '3333';
        //else $_GET['xwr']= '4444';
        //dfb($view->get_current_page(), 'build');
        //dfb($_GET, 'build_$_GET');
    /*}
}*/

/*function product_category_sub_views_view(&$vars) {
    $view = $vars['view'];
    // Make sure it's the correct view
    if ($view->name == "product_category_sub") {
        // add needed javascript

        // add needed stylesheet
        //drupal_add_css(drupal_get_path('theme', 'your-theme') .'/your-css.css');
    }
}*/

function product_category_sub_views_query_alter(&$view) {
    if ($view->name == "product_category_sub" && $view->current_display == 'entity_view_2' && !isset($_GET['wtf'])) {
        //Use it if product deleted without taxonomy term refference was unassigned.
        //dpm($view, 'view');
        $tmp= &$view->query->where[0]['conditions'][0]['value'];
        if (is_array($tmp[':node_nid'])) {
            $res= array_search($view->args[0], $tmp[':node_nid']);
            if ($res) {
                //dfb($res, 'res');
                $view->set_current_page($res);
                //$_GET['page']= $res;
                //dfb($_GET, 'q_$_GET');
                //$view->query->pager->update_page_info();
            }
        }
        $_GET['wtf']= 2;
    }
}

function product_category_sub_views_pre_render(&$view) {
    if ($view->name == "product_category_sub" && $view->current_display == 'entity_view_2') {
        $_GET['cur_tid']= $view->result[0]->taxonomy_term_data_node_name;
        //dpm($view, 'ppr');
        //dfb($view, 'pr');
    }
}
//function product_category_sub_views_ajax_data_alter(&$commands, $view) {
    // Replace Views' method for scrolling to the top of the element with your
    // custom scrolling method.
    //dpm($commands, 'ajax-com');
    //dpm($view, 'ajax-view');
    //if (isset($_GET['page'])) unset($_GET['page']);
    //dfb($view->get_current_page(), 'a_alter');
    //dfb($_GET, 'a_$_GET');
    /*foreach ($commands as &$command) {
        if ($command['method'] == 'viewsScrollTop') {
            $command['method'] .= 'myScrollTop';
        }


    $n_id = intval(arg(1));
$nnm = db_query("select t.nid from {taxonomy_index} t join {node} n on n.nid = t.nid where t.tid = (select t2.tid from {taxonomy_index} t2 join {taxonomy_term_data} d on t2.tid=d.tid where t2.nid = :tid and d.vid=:vid) order by n.title", array(':tid' => $n_id, ":vid"=>5));
$res= array();
if ($nnm->rowCount()) {
    foreach ($nnm as $row) $res[]= $row->nid;
//$_GET= array ('q' => 'node/'.implode('+', $res));
    $handler->argument= implode('+', $res);
//dfb($res);
    return true;
} else {
    return false;
}



    }*/
//}
