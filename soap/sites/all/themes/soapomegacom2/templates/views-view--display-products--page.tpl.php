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
<?php print render($title_suffix); ?>
<?php if ($header): ?>
    <div class="view-header">
        <?php print $header; ?>
    </div>
<?php endif; ?>

<?php if ($exposed): ?>
    <div class="view-filters">
        <?php print $exposed; ?>
    </div>
<?php endif; ?>

<?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
    </div>
<?php endif; ?>

<?php if ($rows): ?>
    <div class="view-content">
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

<?php
    switch ($view->current_display): ?>
<?php
    case 'page':
    case 'page_1':
    case 'page_2': ?>
    <script>
        do_code= function(){
            td_count= ( jQuery('body').hasClass('page-search') ) ? 5 : 4;
            jQuery('.view-display-products>.view-content table tr').each(function(){
                td= jQuery(this).find('td');
                    if (td.length < td_count)
                        for (i=0; i < td_count-td.length; i++) {
                            jQuery(this).append('<td><span style="color: transparent;">00</span></td>');
                        }
            });

            jQuery('.view-display-products>.view-content table tr').each(function(){
                var len=0;
                jQuery(this).find('td article > div.content').each(function(){
                    if ( jQuery(this).height() > len) {len= jQuery(this).height(); console.log(len);}
                });
                jQuery(this).find('td article > div.content').height(len+'px');
            });
            //mg= (175 - 20 - jQuery('.view-display-products>.view-content .commerce-product-field-commerce-price').width() - jQuery('.view-display-products>.view-content .field-name-field-product').width()) / 2;
            //jQuery('.view-display-products>.view-content .field-name-field-product').css('margin-left', mg);
        }

        jQuery(document).ready(function(){
            setTimeout(function tmr(){
                if (jQuery('tr.row-last td.col-last').length) {
                    setTimeout(do_code, 10);
                } else
                    setTimeout(tmr, 1000);
            }, 10);
        });
    </script>
<?php break;?>
<?php endswitch;?>

</div><?php /* class view */ ?>