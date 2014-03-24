<?php ;
/**
 * Created by JetBrains PhpStorm.
 * User: leve_000
 * Date: 05.12.13
 * Time: 20:50
 * To change this template use File | Settings | File Templates.
 */

/**
 * @file
 * Default simple view template to display a rows in a grid.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 *
 * @ingroup views_templates
 */
function number() {
    $num= array('', '_1', '_2', '_3');
    static $pos= 0;
    return $num[$pos++];
}
?>

<?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>
<table class="<?php print $class; ?>"<?php print $attributes; ?>>
    <?php if (!empty($caption)) : ?>
        <caption><?php print $caption; ?></caption>
    <?php endif; ?>

    <tbody>
    <?php foreach ($rows as $row_number => $columns): ?>
        <tr <?php if ($row_classes[$row_number]) { print 'class="' . $row_classes[$row_number] .'"';  } ?>>
            <?php foreach ($columns as $column_number => $item): ?>
                <td <?php if ($column_classes[$row_number][$column_number]) { print 'class="' . $column_classes[$row_number][$column_number] .'"';  } ?>>
                    <div>
                        <?php print $item; ?>
                        <?php
                        //$block = module_invoke('views', 'block_view', 'View: WhereBuy Slider: Слайдер для Филиала 1');
                        //print views_embed_view('WhereBuy Slider', $display_id = 'default');
                        //$block = module_invoke('views','block_view','_1-block');
                        //print render($block);
                        if (strlen($item)) {
                            $block = block_load('views','_1-block'.number());
                            $tmp = _block_get_renderable_array(_block_render_blocks(array($block)));
                            print drupal_render($tmp);
                            print '<div class="hr-line"></div>';
                        }
                        //$view = views_get_view('WhereBuy Slider');
                        //print $view->preview('_1-block');
                        ?>
                    </div>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>