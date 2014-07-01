<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 6/25/14
 * Time: 2:55 AM
 */
/**
 * @file
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
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php switch($view->current_display):
    case 'block_forum': ?>
        <div>
            <div class="left">
            <?php print $fields['picture']->wrapper_prefix; ?>
            <?php print $fields['picture']->content; ?>
            <?php print $fields['picture']->wrapper_suffix; ?>
            </div>
            <div class="right">
                <?php print $fields['name']->wrapper_prefix; ?>
                <?php print $fields['name']->content; ?>
                <?php print $fields['name']->wrapper_suffix; ?>
                <div class="icons">
                    <?php print $fields['mail']->wrapper_prefix; ?>
                    <?php print $fields['mail']->content; ?>
                    <?php print $fields['mail']->wrapper_suffix; ?>
                    <?php print $fields['nothing_1']->wrapper_prefix; ?>
                    <?php print $fields['nothing_1']->content; ?>
                    <?php print $fields['nothing_1']->wrapper_suffix; ?>
                    <?php print $fields['nothing']->wrapper_prefix; ?>
                    <?php print $fields['nothing']->content; ?>
                    <?php print $fields['nothing']->wrapper_suffix; ?>

                </div>
            </div>
        </div>

<?php   break;
    case 'block_user': ?>
            <div class="left">
                <?php print $fields['picture']->wrapper_prefix; ?>
                <?php print $fields['picture']->content; ?>
                <?php print $fields['picture']->wrapper_suffix; ?>
            </div>
            <div class="right">
                <?php print $fields['name']->wrapper_prefix; ?>
                <?php print $fields['name']->content; ?>
                <?php print $fields['name']->wrapper_suffix; ?>
                <?php print $fields['nothing_3']->wrapper_prefix; ?>
                <?php print $fields['nothing_3']->label_html; ?>
                <?php print $fields['nothing_3']->content; ?>
                <?php print $fields['nothing_3']->wrapper_suffix; ?>
            </div>
            <div class="other">
                <?php print $fields['nothing_2']->wrapper_prefix; ?>
                <?php print $fields['nothing_2']->content; ?>
                <?php print $fields['nothing_2']->wrapper_suffix; ?>
                <?php print $fields['nothing_1']->wrapper_prefix; ?>
                <?php print $fields['nothing_1']->content; ?>
                <?php print $fields['nothing_1']->wrapper_suffix; ?>
                <?php print $fields['nothing']->wrapper_prefix; ?>
                <?php print $fields['nothing']->content; ?>
                <?php print $fields['nothing']->wrapper_suffix; ?>

            </div>

        <?php   break;
        default:
?>
<?php foreach ($fields as $id => $field): ?>
    <?php if (!empty($field->separator)): ?>
        <?php print $field->separator; ?>
    <?php endif; ?>

    <?php print $field->wrapper_prefix; ?>
    <?php print $field->label_html; ?>
    <?php print $field->content; ?>
    <?php print $field->wrapper_suffix; ?>
    <?php endforeach; ?>
<?php endswitch; ?>