<?php
// $Id: page.tpl.php,v 1.18.2.1 2009/04/30 00:13:31 goba Exp $
?>

<?php include 'header.tpl.php' ?>
<?php
$predefined_pages = Array(
    'faq' => Array(
        'design_left' => 'questions',
        'design_bottom' => 'pearl',
    ),
    'nash-collectiv' => Array(
        'design_bottom' => 'pearl',
    ),
);
$design_left = Array(
    'thumbs_up' => Array(
        'img_src' => '/'.$directory.'/images/left/1.jpg',
        'img_width' => 262,
        'img_height' => 641,
    ),
    'questions' => Array(
        'img_src' => '/'.$directory.'/images/left/2.jpg',
        'img_width' => 367,
        'img_height' => 603,
    ),
    'papers' => Array(
        'img_src' => '/'.$directory.'/images/left/5.jpg',
        'img_width' => 313,
        'img_height' => 707,
    ),
    'seat' => Array(
        'img_src' => '/'.$directory.'/images/left/6.jpg',
        'img_width' => 327,
        'img_height' => 384,
    ),
    'tooth_brush' => Array(
        'img_src' => '/'.$directory.'/images/left/7.jpg',
        'img_width' => 359,
        'img_height' => 381,
    ),
    'tooth' => Array(
        'img_src' => '/'.$directory.'/images/left/8.jpg',
        'img_width' => 335,
        'img_height' => 385,
    ),
    'automat' => Array(
        'img_src' => '/'.$directory.'/images/left/9.jpg',
        'img_width' => 334,
        'img_height' => 379,
    ),
);
$design_bottom = Array(
    'pearl' => Array(
        'img_src' => '/'.$directory.'/images/right_bottom/1.jpg',
        'img_width' => 218,
        'img_height' => 83,
    ),
    'jewels' => Array(
        'img_src' => '/'.$directory.'/images/right_bottom/2.jpg',
        'img_width' => 163,
        'img_height' => 63,
    ),
    'cherry' => Array(
        'img_src' => '/'.$directory.'/images/right_bottom/3.jpg',
        'img_width' => 159,
        'img_height' => 94,
    ),
    'apples' => Array(
        'img_src' => '/'.$directory.'/images/right_bottom/4.jpg',
        'img_width' => 201,
        'img_height' => 89,
    ),
    'ice' => Array(
        'img_src' => '/'.$directory.'/images/right_bottom/5.jpg',
        'img_width' => 218,
        'img_height' => 95,
    ),
    'leafs' => Array(
        'img_src' => '/'.$directory.'/images/right_bottom/6.jpg',
        'img_width' => 212,
        'img_height' => 87,
    ),
);

if (isset($predefined_pages[$_GET['q']])) {
    $design_left_info = $design_left[$predefined_pages[$_GET['q']]['design_left']];
    $design_bottom_info = $design_bottom[$predefined_pages[$_GET['q']]['design_bottom']];
} else {

	if (!empty($node->field_design_left[0]['value']) ? isset($design_left[$node->field_design_left[0]['value']]) : false) {
	    $design_left_info = $design_left[$node->field_design_left[0]['value']];
	} else {
	    $design_left_info = Array();
	}
	if (!empty($node->field_design_bottom[0]['value']) ? isset($design_bottom[$node->field_design_bottom[0]['value']]) : false) {
	    $design_bottom_info = $design_bottom[$node->field_design_bottom[0]['value']];
	} else {
	    $design_bottom_info = Array();
	}

}

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#important_inner').hide();

//        $('#important').hover(
//            function () {
//                $('#important_inner').show('slow');
//            },
//            function () {
//                $('#important_inner').hide();
//            }
//        );
    });
</script>
<div id="important">
    <?php print '<a href="/news"><img src="/sites/all/themes/dental/images/important.png" alt="Внимание акция. Стоматология Хабаровска"/></a>'; ?>
    <div id="important_inner">
        <?php echo $important ?>
    </div>
</div>

  <div id="dental-container">

    <div id="dental-top">
    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100%">
      <tr>
        <td align="left" valign="top" width="50%" id="dental-top-left">
          <?php echo $header ?>
        </td>
        <td align="center" valign="top" width="0%" id="dental-logo">
          <a href="/" title="Дентал-стиль"><img alt="Дентал-стиль - стоматология в Хабаровске" src="/<?php echo $directory ?>/images/logo.jpg" width="256" height="149" border="0" /></a>
        </td>
        <td align="left" valign="top" width="50%" id="dental-top-right">
          <?php echo $right ?>
        </td>
      </tr>
    </table>
    </div>

    <div id="dental-menu-top">
      <?php echo $menu['top'] ?>
    </div>

      <div id="special_block" class="simple cf">
          <?php echo $special ?>
      </div>

    <div id="dental-content">
      <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width: 100%">
        <tr>
          <?php if (!empty($design_left_info)): ?>
          <td align="left" valign="top" width="0%" id="dental-content-left">
          <?php
          $src = $design_left_info['img_src'];
          $width = $design_left_info['img_width'];
          $height = $design_left_info['img_height'];
          echo '<div style="width: '.$width.'px; height: '.$height.'px; background: url(\''.$src.'\') no-repeat left top;">';
          echo '&nbsp;</div>';
          ?>
          <?php
          echo $menu['sub'];
          ?>
          </td>
          <td align="left" valign="top" width="100%" id="dental-content-body">
          <?php else: ?>
          <td align="left" valign="top" width="100%" id="dental-content-body">
          <?php endif; ?>
          <?php print $breadcrumb; ?>
          <?php if ($mission): print '<div id="mission">'. $mission .'</div>'; endif; ?>
          <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block">'; endif; ?>
          <?php if ($title && (!isset($node->type) || $node->type != 'our_team')): print '<h2'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h2>'; endif; ?>
          <?php if ($tabs): print '<ul class="tabs primary">'. $tabs .'</ul></div>'; endif; ?>
          <?php if ($tabs2): print '<ul class="tabs secondary">'. $tabs2 .'</ul>'; endif; ?>
          <?php if ($show_messages && $messages): print $messages; endif; ?>
          <?php print $help; ?>
          <div class="clear-block">
            <?php print $content ?>
              <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='6624340'>
                  <?php
                  $n_alias= drupal_lookup_path('alias', $_GET['q']);
                  //Share Sets
                      if ( preg_match('/^discount/', $n_alias) || preg_match('/^news/', $n_alias)) {
                          echo '<h4>Понравилось? Расскажите друзьям</h4>';
                          echo '<script src="http://odnaknopka.ru/ok3.js" type="text/javascript"></script>';
                          //<script src="< echo base_path().path_to_theme().'/ok3.js' " type="text/javascript"></script>
                      }
                  ?>
              </div>
          </div>
          <?php if (!empty($menu['sub2'])): ?>
          <div id="dental-menu-sub2">
          <?php echo $menu['sub2'] ?>
          </div>
          <?php endif; ?>
          <?php if (!empty($design_bottom_info)): ?>
          <div id="dental-content-bottom" style="height: <?php echo $design_bottom_info['img_height']; ?>px; background: url('<?php echo $design_bottom_info['img_src']; ?>') top right no-repeat;">
          &nbsp;
          </div>
          <?php endif; ?>
            <div id="warning">
                ПО ПОВОДУ ВОЗМОЖНЫХ ПРОТИВОПОКАЗАНИЙ ПРОКОНСУЛЬТИРУЙТЕСЬ У СПЕЦИАЛИСТА !
            </div>
          </td>
        </tr>
      </table>
    </div>

  </div>

<?php include 'footer.tpl.php' ?>
