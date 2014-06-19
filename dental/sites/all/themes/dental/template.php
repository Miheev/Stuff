<?php
// $Id: template.php,v 1.16.2.3 2010/05/11 09:41:22 goba Exp $

/**
 * Sets the body-tag class attribute.
 *
 * Adds 'sidebar-left', 'sidebar-right' or 'sidebars' classes as needed.
 */
function phptemplate_body_class($left, $right) {
  if ($left != '' && $right != '') {
    $class = 'sidebars';
  }
  else {
    if ($left != '') {
      $class = 'sidebar-left';
    }
    if ($right != '') {
      $class = 'sidebar-right';
    }
  }

  if (isset($class)) {
    print ' class="'. $class .'"';
  }
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb) ? count($breadcrumb) > 1 : false) {
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .'</div>';
  }
}

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function phptemplate_preprocess_page(&$vars) {//var_dump($_GET);
  $vars['tabs2'] = menu_secondary_local_tasks();

  // Hook into color.module
  if (module_exists('color')) {
    _color_page_alter($vars);
  }

    //Main Page Text Cut && Slider
    if (arg(0) == 'node' && arg(1) == '48') {
        drupal_add_js(path_to_theme().'/text_cut.js');

        drupal_add_css('sites/all/libraries/bxslider/jquery.bxslider.css');
        drupal_add_js('sites/all/libraries/bxslider/jquery.bxslider.min.js');

        drupal_add_js(path_to_theme().'/slcool.js');
        $vars['scripts'] = drupal_get_js();
        $vars['styles'] = drupal_get_css();
    }

    //Contacts map injection
    if (arg(0) == 'node' && arg(1) == '118') {
        drupal_add_js('/api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript', 'external');
        drupal_add_js(path_to_theme().'/map.js');
        $vars['scripts'] = drupal_get_js();
    }

    drupal_add_css('sites/all/libraries/bootstrap/css/bootstrap.nocf.css');
    $vars['styles'] = drupal_get_css();

    //PopUp
    if ($_GET['q'] != 'node/122') {
        drupal_add_js('sites/all/libraries/bootstrap/js/bootstrap.min.js');
        drupal_add_js('sites/all/libraries/formatter/jquery.formatter.min.js');
        drupal_add_js(path_to_theme().'/call/init.js');
        $vars['scripts'] = drupal_get_js();
    }

    //Alias specific for node
    //$n_alias= drupal_lookup_path('alias', $_GET['q']);
    //Share Sets
//    if ( preg_match('/^discount/', $n_alias) || arg(0) == 'news') {
//        $head=<<<EOT
////<![CDATA[
//  (function() {
//    var shr = document.createElement('script');
//    shr.setAttribute('data-cfasync', 'false');
//    shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
//    shr.type = 'text/javascript'; shr.async = 'true';
//    shr.onload = shr.onreadystatechange = function() {
//      var rs = this.readyState;
//      if (rs && rs != 'complete' && rs != 'loaded') return;
//      var site_id = 'fe007500add95f8abd364da19102869d';
//      try { Shareaholic.init(site_id); } catch (e) {}
//    };
//    var s = document.getElementsByTagName('script')[0];
//    s.parentNode.insertBefore(shr, s);
//  })();
////]]>
//EOT;
//        drupal_add_js($head, 'inline');
//        $vars['scripts'] = drupal_get_js();
//    }
    $tt=0;
}

/**
 * Add a "Comments" heading above comments except on forum pages.
 */
function garland_preprocess_comment_wrapper(&$vars) {
  if ($vars['content'] && $vars['node']->type != 'forum') {
    $vars['content'] = '<h2 class="comments">'. t('Comments') .'</h2>'.  $vars['content'];
  }
}

/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  return menu_primary_local_tasks();
}

/**
 * Returns the themed submitted-by string for the comment.
 */
function phptemplate_comment_submitted($comment) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}

/**
 * Returns the themed submitted-by string for the node.
 */
function phptemplate_node_submitted($node) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}

/**
 * Generates IE CSS links for LTR and RTL languages.
 */
function phptemplate_get_ie_styles() {
  global $language;

  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="'. base_path() . path_to_theme() .'/fix-ie.css" />';
  if ($language->direction == LANGUAGE_RTL) {
    $iecss .= '<style type="text/css" media="all">@import "'. base_path() . path_to_theme() .'/fix-ie-rtl.css";</style>';
  }

  return $iecss;
}

function phptemplate_get_menus() {
    $items = menu_tree_all_data('primary-links');
    $items_secondary = menu_tree_all_data('secondary-links');
    $items2 = Array();
    $items2_secondary = Array();
    $return = Array(
        'top' => '',
        'bottom' => '',
        'sub' => '',
        'sub2' => '',
        'has_active' => false,
    );

    $has_active = false;
    $active_highlight_style = '';

    $keys = array_keys($items);
    for ($i=0; isset($items[$keys[$i]]); $i++) {
        $item = $items[$keys[$i]];

        if (!$item['link']['hidden']) {
            if (empty($return['sub'])) {
                $below = phptemplate_get_submenu($item['below']);
                if ($below['has_active_item']) {
                    $return['sub'] = $below['html'];
                    $active = true;
                    $has_active = true;
                } else {
                    $active = false;
                    if (phptemplate_path_is_active($item['link']['link_path'])) {
                        $return['sub'] = $below['html'];
                        $active = true;
                        $has_active = true;
                    }
                }
            } else {
                $active = false;
            }

            $items2[] = Array(
            'id' => $item['link']['mlid'],
            'title' => $item['link']['title'],
            'link' => url($item['link']['link_path']),
            'active' => $active,
            );
        }
    }

    $keys = array_keys($items_secondary);
    for ($i=0; isset($items_secondary[$keys[$i]]); $i++) {
        $item = $items_secondary[$keys[$i]];

        if (!$item['link']['hidden']) {
	        $below = phptemplate_get_submenu($item['below']);
	        if ($below['has_active_item']) {
	            if (empty($return['sub'])) {
	                $return['sub'] = $below['html'];
	            }
	            $active = true;
	            $has_active = true;
	        } else {
	            $active = false;
	            if (phptemplate_path_is_active($item['link']['link_path'])) {
	                if (empty($return['sub'])) {
	                    $return['sub'] = $below['html'];
	                }
	                $active = true;
	                $has_active = true;
	            }
	        }

            $items2_secondary[] = Array(
            'id' => $item['link']['mlid'],
            'title' => $item['link']['title'],
            'link' => url($item['link']['link_path']),
            'icon_src' => !empty($item['link']['options']['menu_icon']['path']) ? url($item['link']['options']['menu_icon']['path']) : null,
            'active' => $active,
            );
        }
    }

    $return['top'] = '<table border="0" cellsapcing="0" celpadding="0" width="100%" class="dental-top-menu" style="width: 100%"><tr>';
    for ($i=0; isset($items2[$i]); $i++) {
        $item2 = $items2[$i];
        // Ссылки
        $return['top'] .= "\n";
        $return['top'] .= '<td align="center" valign="center" nowrap="nowrap" class="dental-top-menu-item">'."\n";
        $return['top'] .= '<div class="dental-top-menu-item'.($item2['active'] ? ' dental-top-menu-item-active' : '').'">'."\n";
        $return['top'] .= '<a href="'.htmlspecialchars($item2['link']).'">'.htmlspecialchars($item2['title']).'</a>'."\n";
        $return['top'] .= '</div>'."\n";
        $return['top'] .= '</td>'."\n";
    }
    $return['top'] .= '</tr></table>';

    $return['bottom'] = '<table border="0" cellsapcing="0" celpadding="0" align="center" class="dental-bottom-menu" width="100%" style="width: 100%"><tr>';
    for ($i=0; isset($items2_secondary[$i]); $i++) {
        $item2 = $items2_secondary[$i];
        // Ссылки
        $return['bottom'] .= "\n";
        $return['bottom'] .= '<td align="center" valign="top" nowrap="nowrap" class="dental-bottom-menu-item">'."\n";
        $return['bottom'] .= '<div class="dental-bottom-menu-item" '.($item2['active'] ? 'id="dental-bottom-menu-item-active"' : '').'>'."\n";
        $return['bottom'] .= '<a href="'.htmlspecialchars($item2['link']).'" title="'.htmlspecialchars($item2['title']).'">';
        $return['bottom'] .= '<img src="'.$item2['icon_src'].'" border="0" alt="'.htmlspecialchars($item2['title']).'" />';
        $return['bottom'] .= '</a>'."\n";
        $return['bottom'] .= '</div>'."\n";
        $return['bottom'] .= '</td>'."\n";
    }
    $return['bottom'] .= '</tr></table>';

    if (empty($return['sub2'])) {
	    $return['sub2'] = phptemplate_get_sub2menu($items);
    }
    if (empty($return['sub2'])) {
	    $return['sub2'] = phptemplate_get_sub2menu($items_secondary);
    }

    $return['has_active'] = $has_active;

    return $return;
}

/**
 * Строит меню второго уровня
 */
function phptemplate_get_submenu($items, $depth = 1) {
	global $directory;

    $return = Array(
	    'has_active_item' => false,
	    'html' => '',
    );

    if (empty($items) ? true : !is_array($items)) {
    	return $return;
    }

    $keys = array_keys($items);
    $has_active = false;
    for ($i=0; isset($items[$keys[$i]]); $i++) {
    	$item = $items[$keys[$i]];
    	$depth_next = $depth+1;
        $below = phptemplate_get_submenu($item['below'], $depth_next);
        if ($below['has_active_item']) {
        	$active = true;
        	$return['has_active_item'] = true;
        } else {
        	$active = false;
        	if (phptemplate_path_is_active($item['link']['link_path'])) {
        		$active = true;
        		$return['has_active_item'] = true;
        	}
        }

        $expanded = $item['link']['expanded'];

        $return['html'] .= "\n";

        $pad = 5+($depth-1)*20;
        if ($active) {
        	$has_active = true;
	        $return['html'] .= '<div class="dental-submenu-item dental-submenu-item-active" style="padding-left: '.$pad.'px">'."\n";
	        $return['html'] .= '<a href="'.htmlspecialchars(url($item['link']['link_path'])).'">';
	        $return['html'] .= htmlspecialchars($item['link']['title']);
	        $return['html'] .= '</a>'."\n";
	        $return['html'] .= '</div>'."\n";
        } else {
	        $return['html'] .= '<div class="dental-submenu-item" style="padding-left: '.$pad.'px">'."\n";
	        $return['html'] .= '<a href="'.htmlspecialchars(url($item['link']['link_path'])).'">';
	        $return['html'] .= htmlspecialchars($item['link']['title']);
	        $return['html'] .= '</a>'."\n";
	        $return['html'] .= '</div>'."\n";
        }
        if (!empty($below['html'])) {
        	$return['html'] .= '<div class="dental-submenu-submenu">'."\n";
            $return['html'] .= $below['html']."\n";
            $return['html'] .= '</div>'."\n";
        }
    }

    /*
    if ($has_active && empty($sub2)) {
	    for ($i=0; isset($items[$keys[$i]]); $i++) {
	    	$item = $items[$keys[$i]];
	    	if ($active) {
		        $sub2 .= '<div class="dental-submenu2-item dental-submenu2-item-active">'."\n";
		        $sub2 .= '<a href="'.htmlspecialchars(url($item['link']['link_path'])).'">';
		        $sub2 .= htmlspecialchars($item['link']['title']);
		        $sub2 .= '</a>'."\n";
		        $sub2 .= '</div>'."\n";
	        } else {
		        $sub2 .= '<div class="dental-submenu2-item">'."\n";
		        $sub2 .= '<a href="'.htmlspecialchars(url($item['link']['link_path'])).'">';
		        $sub2 .= htmlspecialchars($item['link']['title']);
		        $sub2 .= '</a>'."\n";
		        $sub2 .= '</div>'."\n";
	        }
	    }
    }
    */

    if ($depth == 1) {
    	$return['html'] = '
    	<div class="dental-submenu">
    	<div class="dental-submenu-lt">
    	<div class="dental-submenu-rt">
    	<div class="dental-submenu-lb">
    	<div class="dental-submenu-rb">
    	<div class="dental-submenu-items">
    	'.$return['html'].'
    	</div>
    	</div></div></div></div>
    	</div>'."\n";
    }

    return $return;
}

/**
 * Строит подразделы активного пункта
 */
function phptemplate_get_sub2menu($items) {
	$html = '';
	$info = phptemplate_get_active_subitems($items);
	$subitems = $info['items'];
	if (!empty($subitems)) {
		$keys = array_keys($subitems);
		$html .= '<ul>';
		for ($i=0; isset($subitems[$keys[$i]]); $i++) {
	    	$item = $subitems[$keys[$i]];
	        //$html .= '<div class="dental-submenu2-item">'."\n";
	        $html .= '<li>';
	        $html .= '<a href="'.htmlspecialchars(url($item['link']['link_path'])).'">';
	        $html .= htmlspecialchars($item['link']['title']);
	        $html .= '</a>'."\n";
	        $html .= '</li>';
	    }
	    $html .= '</ul>';
    }
	return $html;
}

/**
 * Ищет подразделы активного раздела
 */
function phptemplate_get_active_subitems($items) {
	$return = Array();
	$return['has_active_item'] = false;
	$return['items'] = Array();
    $has_active = false;
    if (!empty($items)) {
	    foreach ($items as $item) {
	        $below = phptemplate_get_active_subitems($item['below']);
	        if ($below['has_active_item']) {
	        	$active = true;
	        	$return['has_active_item'] = true;
	        	$return['items'] = $below['items'];
	        } else {
	        	$active = false;
	        	if (phptemplate_path_is_active($item['link']['link_path'])) {
	        		$active = true;
	        		$return['has_active_item'] = true;
	        	}
	        	if ($active) {
	                $return['items'] = $item['below'];
	        	}
	        }
	    }
    }
    return $return;
}

function phptemplate_get_current_node () {
	global $node;
	if (empty($node)) {
        $q = explode('/', $_GET['q']);
        if (isset($q[0], $q[1]) ? $q[0] == 'node' : false) {
            $nid = (int)$q[1];
            $node = node_load($nid);
            return $node;
        }
	} else {
		return $node;
	}
	return null;
}

function phptemplate_path_is_active($path) {
	$current_node = phptemplate_get_current_node();
	$path_parts = explode('/', url($path));
	$path_real_parts = array_slice(explode('/', url($_GET['q'])), 0, count($path_parts));
    if ($path_parts == $path_real_parts) {
    	return true;
    }
    $path_system_parts = explode('/', $path);
    if (count($path_system_parts) >= 3) {
        if ($path_system_parts[0] == 'taxonomy' && $path_system_parts[1] == 'term') {
		    if (!empty($current_node)) {
                foreach ($current_node->taxonomy as $term) {
                	if ($term->tid == $path_system_parts[2]) {
                        return true;
                	}
                }
		    }
        }
    }
    /*
    if (!empty($current_node->type) ? $current_node->type == 'product' : false) {
        if ($path == 'catalog') {
        	return true;
        }
    }
    */
	return false;
}
