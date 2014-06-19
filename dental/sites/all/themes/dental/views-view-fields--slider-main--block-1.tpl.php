<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 5/13/14
 * Time: 9:10 AM
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

<?php
    if (isset($fields['field_sl_image_fid'])) {
        print $fields['field_sl_image_fid']->content;
    } else if (isset($fields['field_video_value'])) :
         preg_match('/v=(.*)/', $fields['field_video_value']->content, $tmp);
         $video_id= $tmp[1];
        ?>
        <a href="<?php print base_path() . $fields['field_link_value']->content; ?>">
            <iframe src="//www.youtube.com/embed/<?php print $video_id ?>" frameborder="0" width="600" height="400" allowfullscreen="allowfullscreen"></iframe>
        </a>
    <?php endif;
?>