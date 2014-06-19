<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <?php print $head ?>
    <title><?php print $head_title ?></title>
    <?php print $styles ?>
    <?php print $scripts ?>
    <?php if ($user->uid == 0): ?>
<!--    <script type="text/javascript" src="/--><?php //echo $directory ?><!--/jquery-1.7.1.min.js"></script>-->
    <?php endif; ?>
  </head>
  <?php $node = phptemplate_get_current_node(); ?>
  <body class="<?php print arg(0); if (arg(0) == 'node') {print '-'.arg(1); print ' node-type-'.$node->type;} ?>">
  <?php $menu = phptemplate_get_menus(); ?>