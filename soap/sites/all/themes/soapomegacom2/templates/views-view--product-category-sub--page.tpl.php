<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<div class="<?php print $classes; ?>">
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
        <?php print $title; ?>
    <?php endif; ?>
<?php
$tax_id = intval(arg(2));
switch ($view->current_display) {
    case 'page':
    $tax = db_select('taxonomy_term_data', 'n')
        ->fields('n', array('name', 'description'))
        ->condition('n.tid',  $tax_id)
        ->condition('n.vid', 5)
        ->execute()
        ->fetchObject();

        //drupal_add_js(drupal_get_path('theme', 'soapomegacom2') . '/js/product_category.js');
        print '<h1 class="title" id="page-title">Каталог</h1>';
    //if (isset($tax->name) && !empty($tax->name)) print '<h1 class="title" id="page-title">'.$tax->name.'</h1>';
        break;
    case 'entity_view_2': break;
    default: break;
}
?>
    <?php print render($title_suffix); ?>
    <?php if ($header): ?>
        <div class="view-header">
            <?php print $header; ?>
        </div>
    <?php endif; ?>

    <div>
        <?php
switch ($view->current_display) {
    case 'page':
        $block = block_load('views','product_category_sub-block_2');
        $tmp = _block_get_renderable_array(_block_render_blocks(array($block)));
        print drupal_render($tmp);
        break;
    /*case 'entity_view_2':
        $block = block_load('views','product_category_sub-block_2');
        $tmp = _block_get_renderable_array(_block_render_blocks(array($block)));
        print drupal_render($tmp);
        break;*/
    default: break;
}
        ?>
    </div>
    <?php if ($exposed): ?>
        <div class="view-filters">
            <?php print $exposed; ?>
        </div>
    <?php endif; ?>

        <?php
        /*$block = block_load('views','product_category_sub-block_1');
        $tmp = _block_get_renderable_array(_block_render_blocks(array($block)));
        print drupal_render($tmp);*/

        /*
         * SELECT description FROM taxonomy_term_data td
WHERE (td.tid > 0 AND td.tid = (SELECT parent FROM taxonomy_term_hierarchy th WHERE th.tid = 60) AND td.vid = 5)
         * */
    switch ($view->current_display) {
        case 'page':
            if (isset($tax->description) && !empty($tax->description)) echo '<div class="tax_description"><p>'.$tax->description.'</p></div>';
            break;
        default : break;
        //else {
            /*$tmp_id= $tax_id;
            while (isset($tax->description) == false || count($tax->description) > 0) {
                /*$tax = db_select('taxonomy_term_hierarchy', 'n')
                    ->fields('n', array('parent'))
                    ->condition('n.tid',  $tax_id)
                    ->execute()
                    ->fetchField();*/
                /*$tax = db_query("SELECT td.description, th.parent
                                  FROM {taxonomy_term_data} td
                                  INNER JOIN {taxonomy_term_hierarchy} th ON td.tid = th.parent
                                  WHERE th.parent > 0 AND th.tid = :tid AND td.vid = :vid",
                                array(':tid' => $tmp_id, ':vid' => 5))->fetchObject();
                if ($tax === false) break;
                $tmp_id = intval($tax->parent);
            }*/
            //var_dump ($tax);
        //}
    }
        ?>

    <?php if ($attachment_before): ?>
        <div class="attachment attachment-before">
            <?php print $attachment_before; ?>
        </div>
    <?php endif; ?>

    <?php if ($rows): ?>
        <div class="view-content data-tid" data-tid="<?php if (isset($tax->name) && !empty($tax->name)) echo $tax->name; ?>">
            <?php print $rows; ?>
        </div>
    <?php elseif ($empty): ?>
        <div class="view-empty">
            <?php print $empty; ?>
        </div>
    <?php endif; ?>

    <?php if ($pager): ?>
        <?php print $pager; ?>
    <?php endif; ?>

    <?php if ($attachment_after): ?>
        <div class="attachment attachment-after">
            <?php print $attachment_after; ?>
        </div>
    <?php endif; ?>

    <?php if ($more): ?>
        <?php print $more; ?>
    <?php endif; ?>

    <?php if ($footer): ?>
        <div class="view-footer">
            <?php print $footer; ?>
        </div>
    <?php endif; ?>

    <?php if ($feed_icon): ?>
        <div class="feed-icon">
            <?php print $feed_icon; ?>
        </div>
    <?php endif; ?>

    <?php if ($view->current_display == 'page'): ?>
    <script>
        do_code= function(){

            jQuery('.view-display-id-block_2 table div').each(function(){
                if (jQuery(this).find('a').text() == jQuery('.data-tid').data('tid'))
                    jQuery(this).addClass('current');
            });

            jQuery('.data-tid table tr').each(function(){
                var len=0;
                jQuery(this).find('td > div').each(function(){
                    if ( jQuery(this).height() > len) len= jQuery(this).height();
                });
                jQuery(this).find('td > div').height(len+'px');
            });
        }

        jQuery(document).ready(function(){
            setTimeout(function tmr(){
                if (jQuery('td.col-last h3').length) {
                    do_code();
                } else
                    setTimeout(tmr, 1000);
            }, 10);
        });
    </script>
<?php endif; ?>

</div><?php /* class view */ ?>