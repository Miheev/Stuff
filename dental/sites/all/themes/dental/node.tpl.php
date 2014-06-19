<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>
<?php if ($node->nid == '48')
    $block = (object) module_invoke('views', 'block', 'view', 'slider_main-block_1');
    $block->module = 'views';
    $block->delta = 'slider_main-block_1';
print theme('block', $block);
;?>
<div id="node-<?php print $node->nid; ?>" class="node<?php print ' cnode-type-'.$node->type; if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

  <div class="content clear-block">
    <?php print $content ?>
  </div>

</div>
