<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 5/13/14
 * Time: 11:51 PM
 */

// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div class="row">
<?php if (!empty($title)): ?>
    <div class="row-head simple cf">
        <div class="hleft"><h3><?php print $title; ?></h3></div>
        <div class="hright"><hr/></div>
    </div>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
    <div class="<?php print $classes[$id]; ?>">
        <?php print $row; ?>
    </div>
    <hr>
<?php endforeach; ?>
</div>