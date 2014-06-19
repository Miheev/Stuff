<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 5/13/14
 * Time: 11:55 PM
 */
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<div class="left">
    <div class="<?php print $fields['field_foto_fid']->class; ?>">
        <div class="content">
            <?php print $fields['field_foto_fid']->content; ?>
        </div>
    </div>
</div>
<div class="right">
    <h3 class="head">
        <?php $tmp= explode(' ', trim($fields['title_1']->content), 2); ?>
        <span><?php print $tmp[0]; ?></span>
        <span><?php print $tmp[1]; ?></span>
    </h3>
    <div class="<?php print $fields['field_tshort_value']->class; ?>">
        <?php print $fields['field_tshort_value']->content; ?>
    </div>
    <?php
        if ($fields['field_work_value']->raw == '1 ')
            print '<div class="'.$fields['title']->class.'"><hr>'. $fields['title']->content .'</div>';
    ?>
</div>


