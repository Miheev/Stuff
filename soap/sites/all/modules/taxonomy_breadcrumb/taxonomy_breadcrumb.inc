<?php

/**
 * @file
 * helper functions for taxonomy_breadcrumb
 */

/**
 * Returns the lightest term for a given node.
 *
 * @param $nid
 *   A node id.
 *
 * @return
 *   The lightest term id associated with the node.
 */
function _taxonomy_breadcrumb_node_get_lightest_term($nid) {
  // Get the lightest vocabulary id.
  $query = db_select('node', 'n');
  $query->distinct();
  $query->join('taxonomy_index', 'ti', 'n.nid = ti.nid');
  $query->join('taxonomy_term_data', 'ttd', 'ti.tid = ttd.tid');
  $query->join('taxonomy_vocabulary', 'tv', 'ttd.vid = tv.vid');
  $query->fields('tv', array('vid'));
  $query->condition('n.nid', $nid, '=');
  $query->orderBy('tv.weight');
  $query->orderBy('tv.name');
  $query->range(0, 1);
  $vid = $query->execute()->fetchField();

  // If a vocabulary was successfully retrieved.
  if ($vid) {
    // Retrieve the vocabularies terms associated with the node.
    $query = db_select('node', 'n');
    $query->distinct();
    $query->join('taxonomy_index', 'ti', 'n.nid = ti.nid');
    $query->join('taxonomy_term_data', 'ttd', 'ti.tid = ttd.tid');
    $query->join('taxonomy_vocabulary', 'tv', 'ttd.vid = tv.vid');
    $query->fields('ti', array('tid'));
    $query->condition('n.nid', $nid, '=');
    $query->condition('tv.vid', $vid, '=');
    $tids = $query->execute()->fetchCol();

    // If only a single term is associated with this node.
    if (count($tids) == 1) {
      return $tids[0];
    }
    else {
      // Get the vocabulary tree.
      $vtree = taxonomy_get_tree($vid);
      // Return the first associated term found.
      foreach ($vtree as $term) {
        if (in_array($term->tid, $tids)) {
          return $term->tid;
        }
      }
    }
  }
}

/**
 * Return the administrator defined vocabulary path for a given vocabulary
 * ($vid).  If a path doesn't exist, NULL is returned.
 */
function _taxonomy_breadcrumb_get_vocabulary_path($vid) {
  $path = db_query("SELECT path FROM {taxonomy_breadcrumb_vocabulary} WHERE vid = :vid", array(':vid' => $vid))->fetchField();
  return $path;
}

/**
 * Return the administrator defined term path for a given term ($tid).
 * If a path doesn't exist, NULL is returned.
 */
function _taxonomy_breadcrumb_get_term_path($tid) {
  $path = db_query("SELECT path FROM {taxonomy_breadcrumb_term} WHERE tid = :tid", array(':tid' => $tid))->fetchField();
  return $path;
}

/**
 * If the current drupal path (q=) is /node/nid, generate the breadcrumb trail
 * based on nid.
 */
function _taxonomy_breadcrumb_generate_breadcrumb($tid, $is_term_page = FALSE) {
  $term = taxonomy_term_load($tid);

  // Generate the HOME breadcrumb.
  $home_text = variable_get('taxonomy_breadcrumb_home', t('Home'));
  if ($home_text != '') {
    $breadcrumb[] = l($home_text, NULL);
  }
  // Generate the VOCABULARY breadcrumb.
  $vocabulary_path = _taxonomy_breadcrumb_get_vocabulary_path($term->vid);
  if ($vocabulary_path != NULL) {
    $vocabulary = taxonomy_vocabulary_load($term->vid);
    $breadcrumb[] = l(_taxonomy_breadcrumb_tt("taxonomy:vocabulary:$term->tid:name", $vocabulary->name), $vocabulary_path);
  }

  // Generate the TERM breadcrumb.
  $parent_terms = array_reverse(taxonomy_get_parents_all($tid));
  foreach ($parent_terms as $parent_term) {
    $term_path = _taxonomy_breadcrumb_get_term_path($parent_term->tid);
    if ($term_path == NULL) {
      $uri =  taxonomy_term_uri($parent_term);
      $term_path = $uri['path'];
    }
    if ($term_path == '<none>') {
      continue;
    }

    $term_title = $parent_term->name;

    // Use the SYNONYM instead of TERM, if we want to.
    // if (variable_get('taxonomy_breadcrumb_use_synonym', FALSE)) {
    // TODO The taxonomy synonym functionality has been removed.
    // TODO Is there a way to do this?
    //  $synonyms = array() /*taxonomy_get_synonyms($parent_term->tid)*/;
    //  if (!empty($synonyms)) {
    //    $term_title = $synonyms[0];
    //  }
    // }
    // Do not create links to own self if we are on a taxonomy/term page.
    if ($is_term_page && $parent_term->tid == $tid) {
      $breadcrumb[] = check_plain(_taxonomy_breadcrumb_tt("taxonomy:term:$parent_term->tid:name", $term_title));
    }
    else {
      $breadcrumb[] = l(_taxonomy_breadcrumb_tt("taxonomy:term:$parent_term->tid:name", $term_title), $term_path);
    }
  }

  // Remove the breadcrumb for the term currently being viewed.
  if (!is_null($breadcrumb) && $is_term_page) {
    array_pop($breadcrumb);
  }

  return $breadcrumb;
}

/**
 * Helper function for when i18ntaxonomy module is not installed.
 */
function _taxonomy_breadcrumb_tt($string_id, $default, $language = NULL) {
  return function_exists('tt') ? tt($string_id, $default, $language) : $default;
}
