<?php $tpath= drupal_get_path('theme', 'omega_d1'); ?>
<div<?php print $attributes; ?>>
<!--    <div class="imgtest"></div>-->
    <div class="img-art">
        <div class="ground-cube-top">
            <div class="bk_top_right"><img src="/<?php echo $tpath; ?>/images/bk_top_right.png" alt="WebPro"></div>
            <div class="bk_top_left"><img src="/<?php echo $tpath; ?>/images/bk_top_left.png" alt="WebPro"></div>
        </div>
        <div class="platform">
            <div class="platform-img">
                <img src="/<?php echo $tpath; ?>/images/bk_platform.png" alt="WebPro">
                <div class="craftman">
                    <img src="/<?php echo $tpath; ?>/images/bk_craftman.png" alt="WebPro">
                </div>
                <div class="tree">
                    <img src="/<?php echo $tpath; ?>/images/bk_tree.png" alt="WebPro">
                </div>
            </div>
            <div class="menu"></div>
        </div>
        <div class="ground-cube-down">
            <div class="bk_left_down"><img src="/<?php echo $tpath; ?>/images/bk_left_down.png" alt="WebPro"></div>
            <div class="bk_right_down"><img src="/<?php echo $tpath; ?>/images/bk_right_down.png" alt="WebPro"></div>
        </div>
    </div>
    <div class="h-container">
        <div class="h-wrapper">
            <header class="l-header" role="banner">
    <div class="l-branding">
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Главная'); ?>" rel="home" class="site-logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <?php if ($site_name): ?>
          <h1 class="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Главная'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <h2 class="site-slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
      <?php endif; ?>
      <?php print render($page['branding']); ?>
    </div>

    <?php print render($page['header']); ?>
    <?php print render($page['navigation']); ?>
  </header>

            <div class="l-main">
    <div class="l-content" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div>

    <?php print render($page['sidebar_first']); ?>
    <?php print render($page['sidebar_second']); ?>
  </div>
        </div>
    </div>
  <footer class="l-footer clearfix" role="contentinfo">
      <?php print render($page['footer']); ?>
      <div class="copyright">
          <span class="mcraft">
              <a href="/content/politika-konfidencialnosti">Политика конфиденциальности</a><span class="s-nowrap">© "minecraft" 2014</span>
          </span>
          <a href="http://www.webpro.su/" class="wbp"><img src="/<?php echo $tpath; ?>/images/wb_logo.png" alt="WebPro"></a>
      </div>
  </footer>
</div>