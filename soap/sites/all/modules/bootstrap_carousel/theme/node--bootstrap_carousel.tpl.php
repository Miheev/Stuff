<?php

/**
 * @file
 * Template for bootstrap carousel
 */

?>
<div id="carousel-bootstrap" class="carousel slide">
  <?php
    $carousel_items = field_get_items('node', $node, 'field_slides');

    $control_options = field_get_items('node', $node, 'field_control_options');
    $arrow_enabled = FALSE;
    $bullets_enabled = FALSE;

    if (is_array($control_options)) :
      foreach($control_options as $control) :
        switch($control['value']) :
          case '1':
            $arrow_enabled = TRUE;
            break;

          case '2':
            $bullets_enabled = TRUE;
            break;

        endswitch;
      endforeach;
    endif;
  ?>

  <?php if ($bullets_enabled) : ?>
    <?php if (is_array($carousel_items)) : ?>
    <div class="bullets-control">
      <ol class="carousel-indicators">
      <?php foreach ($carousel_items as $id => $carousel_slide) : ?>
        <li data-target="#carousel-bootstrap" data-slide-to="<?php print $id; ?>" class="bullet <?php ($id == '0') ? print 'active' : print ''; ?>"></li>
      <?php endforeach; ?>
      </ol>
    </div>
    <?php endif; ?>
  <?php endif; ?>

  <div class="carousel-inner">
  <?php if (is_array($carousel_items)) : ?>
    <?php foreach ($carousel_items as $id => $carousel_slide) : ?>
      <div class="item<?php ($id == '0') ? print ' active' : print ''; ?>">
        <?php if(!empty($carousel_slide['carousel_image'])) : ?>
          <?php $img_url = file_create_url(file_load($carousel_slide['carousel_image'])->uri); ?>
          <img src="<?php print $img_url ?>" alt="<?php print $carousel_slide['image_alt_text'];?>"/>
        <?php endif; ?>

        <?php if(!empty($carousel_slide['carousel_video'])) : ?>
          <div class="video-wrapper">
            <div class="video-container">
              <div class="ytplayer" id="ytplayer-<?php print $carousel_slide['carousel_video']; ?>" data-videoid="<?php print $carousel_slide['carousel_video']; ?>">
              </div>
            </div>
          </div>
        <?php endif; ?>


        <?php if (strip_tags($carousel_slide['carousel_caption']) != ''): ?>
          <div class="carousel-caption">
            <?php print $carousel_slide['carousel_caption']; ?>
          </div>
        <?php endif; ?>

      </div>

    <?php endforeach; ?>
  <?php endif; ?>
  </div><!-- .carousel-inner -->

  <?php if($arrow_enabled) : ?>
    <!--  next and previous controls here
          href values must reference the id for this carousel -->
    <a class="carousel-control left" href="#carousel-bootstrap" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#carousel-bootstrap" data-slide="next">&rsaquo;</a>
  <?php endif; ?>

</div>
