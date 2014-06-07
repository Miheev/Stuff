<?php

function front_end_slider($images, $paramssld, $slider)
{

 ob_start();
	$sliderID=$slider[0]->id;
	$slidertitle=$slider[0]->name;
	$sliderheight=$slider[0]->sl_height;
	$sliderwidth=$slider[0]->sl_width;
	$slidereffect=$slider[0]->slider_list_effects_s;
	$slidepausetime=($slider[0]->description+$slider[0]->param);
	$sliderpauseonhover=$slider[0]->pause_on_hover;
	$slidechangespeed=$slider[0]->param;

?>

	<!--Huge IT SLIDER START-->
	<script>
	var data_<?php echo $sliderID; ?> = [];      
	var event_stack_<?php echo $sliderID; ?> = [];
	<?php
		$images=array_reverse($images);
		for($i=0;$i<count($images);$i++){
			echo 'data_'.$sliderID.'["'.$i.'"]=[];';
			
			echo 'data_'.$sliderID.'["'.$i.'"]["id"]="'.$i.'";';
			echo 'data_'.$sliderID.'["'.$i.'"]["image_url"]="'.$images[$i]->image_url.'";';
			
			
			$strdesription=str_replace('"',"'",$images[$i]->description);
			$strdesription=preg_replace( "/\r|\n/", " ", $strdesription );
			echo 'data_'.$sliderID.'["'.$i.'"]["description"]="'.$strdesription.'";';
			$current_image_description = $textarea_array[$i];
			
			$stralt=str_replace('"',"'",$images[$i]->name);
			$stralt=preg_replace( "/\r|\n/", " ", $stralt );
			echo 'data_'.$sliderID.'["'.$i.'"]["alt"]="'.$stralt.'";';
			$current_image_alt=$title_array[$i];
		}
	?>
	
	

      var huge_it_trans_in_progress_<?php echo $sliderID; ?> = false;
      var huge_it_transition_duration_<?php echo $sliderID; ?> = <?php echo $slidechangespeed;?>;
      var huge_it_playInterval_<?php echo $sliderID; ?>;
      // Stop autoplay.
      clearInterval(huge_it_playInterval_<?php echo $sliderID; ?>);
      // Set watermark container size.
      /*function huge_it_change_watermark_container_<?php echo $sliderID; ?>() {
        // setTimeout(function () {
          if (jQuery(".huge_it_slideshow_image_span_<?php echo $sliderID; ?>").css('zIndex') == 2) {
            width = jQuery("#huge_it_slideshow_image_<?php echo $sliderID; ?>").width();
            height = jQuery("#huge_it_slideshow_image_<?php echo $sliderID; ?>").height();
          }
          else {
            width = jQuery("#huge_it_slideshow_image_second_<?php echo $sliderID; ?>").width();
            height = jQuery("#huge_it_slideshow_image_second_<?php echo $sliderID; ?>").height();
          }
          jQuery(".huge_it_slideshow_watermark_span_<?php echo $sliderID; ?>").width(width);
          jQuery(".huge_it_slideshow_watermark_span_<?php echo $sliderID; ?>").height(height);
          jQuery(".huge_it_slideshow_title_span_<?php echo $sliderID; ?>").width(width);
          jQuery(".huge_it_slideshow_title_span_<?php echo $sliderID; ?>").height(height);
          jQuery(".huge_it_slideshow_description_span_<?php echo $sliderID; ?>").width(width);
          jQuery(".huge_it_slideshow_description_span_<?php echo $sliderID; ?>").height(height);
          
          jQuery(".huge_it_slideshow_watermark_<?php echo $sliderID; ?>").css({display: ''});
          jQuery(".huge_it_slideshow_title_text_<?php echo $sliderID; ?>").css({display: ''});
          jQuery(".huge_it_slideshow_description_text_<?php echo $sliderID; ?>").css({display: ''});
        // }, 500);
      }*/

      var huge_it_current_key_<?php echo $sliderID; ?> = '<?php echo (isset($current_key) ? $current_key : ''); ?>';
      var huge_it_current_filmstrip_pos_<?php echo $sliderID; ?> = 0;
      // Set filmstrip initial position.
      function huge_it_set_filmstrip_pos_<?php echo $sliderID; ?>(filmStripWidth) {
        var selectedImagePos = -huge_it_current_filmstrip_pos_<?php echo $sliderID; ?> - (jQuery(".huge_it_slideshow_filmstrip_thumbnail_<?php echo $sliderID; ?>").width() + 2) / 2;
        var imagesContainerLeft = Math.min(0, Math.max(filmStripWidth - jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").width(), selectedImagePos + filmStripWidth / 2));
        jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").animate({
            left: imagesContainerLeft
          }, {
            duration: 500,
            complete: function () { huge_it_filmstrip_arrows_<?php echo $sliderID; ?>(); }
          });
      }
      function huge_it_move_dots_<?php echo $sliderID; ?>() {
        var image_left = jQuery(".huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").position().left;
        var image_right = jQuery(".huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").position().left + jQuery(".huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").outerWidth(true);
        var huge_it_dots_width = jQuery(".huge_it_slideshow_dots_container_<?php echo $sliderID; ?>").outerWidth(true);
        var huge_it_dots_thumbnails_width = jQuery(".huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?>").outerWidth(true);
        var long_filmstrip_cont_left = jQuery(".huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?>").position().left;
        var long_filmstrip_cont_right = Math.abs(jQuery(".huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?>").position().left) + huge_it_dots_width;
        if (huge_it_dots_width > huge_it_dots_thumbnails_width) {
          return;
        }
        if (image_left < Math.abs(long_filmstrip_cont_left)) {
          jQuery(".huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?>").animate({
            left: -image_left
          }, {
            duration: 500,
            complete: function () {  }
          });
        }
        else if (image_right > long_filmstrip_cont_right) {
          jQuery(".huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?>").animate({
            left: -(image_right - huge_it_dots_width)
          }, {
            duration: 500,
            complete: function () {  }
          });
        }
      }
      // Show/hide filmstrip arrows.
      function huge_it_filmstrip_arrows_<?php echo $sliderID; ?>() {
        if (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").width() < jQuery(".huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>").width()) {
          jQuery(".huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?>").hide();
          jQuery(".huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?>").hide();
        }
        else {
          jQuery(".huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?>").show();
          jQuery(".huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?>").show();
        }
      }

      function huge_it_testBrowser_cssTransitions_<?php echo $sliderID; ?>() {
        return huge_it_testDom_<?php echo $sliderID; ?>('Transition');
      }
      function huge_it_testBrowser_cssTransforms3d_<?php echo $sliderID; ?>() {
        return huge_it_testDom_<?php echo $sliderID; ?>('Perspective');
      }
      function huge_it_testDom_<?php echo $sliderID; ?>(prop) {
        // Browser vendor CSS prefixes.
        var browserVendors = ['', '-webkit-', '-moz-', '-ms-', '-o-', '-khtml-'];
        // Browser vendor DOM prefixes.
        var domPrefixes = ['', 'Webkit', 'Moz', 'ms', 'O', 'Khtml'];
        var i = domPrefixes.length;
        while (i--) {
          if (typeof document.body.style[domPrefixes[i] + prop] !== 'undefined') {
            return true;
          }
        }
        return false;
      }
     function huge_it_cube_<?php echo $sliderID; ?>(tz, ntx, nty, nrx, nry, wrx, wry, current_image_class, next_image_class, direction) {
        /* If browser does not support 3d transforms/CSS transitions.*/
        if (!huge_it_testBrowser_cssTransitions_<?php echo $sliderID; ?>()) {
			jQuery(".huge_it_slideshow_dots_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>");
        jQuery("#huge_it_dots_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>");
          return huge_it_fallback_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction);
        }
        if (!huge_it_testBrowser_cssTransforms3d_<?php echo $sliderID; ?>()) {
          return huge_it_fallback3d_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction);
        }
        huge_it_trans_in_progress_<?php echo $sliderID; ?> = true;
        /* Set active thumbnail.*/
        jQuery(".huge_it_slideshow_filmstrip_thumbnail_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_thumb_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_thumb_deactive_<?php echo $sliderID; ?>");
        jQuery("#huge_it_filmstrip_thumbnail_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_thumb_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_thumb_active_<?php echo $sliderID; ?>");
        jQuery(".huge_it_slideshow_dots_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>");  
		jQuery("#huge_it_dots_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>");
        jQuery(".huge_it_slide_bg_<?php echo $sliderID; ?>").css('perspective', 1000);
        jQuery(current_image_class).css({
          transform : 'translateZ(' + tz + 'px)',
          backfaceVisibility : 'hidden'
        });
		
		 jQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>,.huge_it_slide_bg_<?php echo $sliderID; ?>,.huge_it_slideshow_image_span_<?php echo $sliderID; ?>,.huge_it_slideshow_image_second_span_<?php echo $sliderID; ?> ").css('overflow', 'visible');
		
        jQuery(next_image_class).css({
          opacity : 1,
          filter: 'Alpha(opacity=100)',
          backfaceVisibility : 'hidden',
          transform : 'translateY(' + nty + 'px) translateX(' + ntx + 'px) rotateY('+ nry +'deg) rotateX('+ nrx +'deg)'
        });
        jQuery(".huge_it_slider_<?php echo $sliderID; ?>").css({
          transform: 'translateZ(-' + tz + 'px)',
          transformStyle: 'preserve-3d'
        });
        /* Execution steps.*/
        setTimeout(function () {
          jQuery(".huge_it_slider_<?php echo $sliderID; ?>").css({
            transition: 'all ' + huge_it_transition_duration_<?php echo $sliderID; ?> + 'ms ease-in-out',
            transform: 'translateZ(-' + tz + 'px) rotateX('+ wrx +'deg) rotateY('+ wry +'deg)'
          });
        }, 20);
        /* After transition.*/
        jQuery(".huge_it_slider_<?php echo $sliderID; ?>").one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(huge_it_after_trans));
        function huge_it_after_trans() {
          /*if (huge_it_from_focus_<?php echo $sliderID; ?>) {
            huge_it_from_focus_<?php echo $sliderID; ?> = false;
            return;
          }*/
		  jQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>,.huge_it_slide_bg_<?php echo $sliderID; ?>,.huge_it_slideshow_image_span_<?php echo $sliderID; ?>,.huge_it_slideshow_image_second_span_<?php echo $sliderID; ?> ").css('overflow', 'hidden');
		  jQuery(".huge_it_slide_bg_<?php echo $sliderID; ?>").removeAttr('style');
          jQuery(current_image_class).removeAttr('style');
          jQuery(next_image_class).removeAttr('style');
          jQuery(".huge_it_slider_<?php echo $sliderID; ?>").removeAttr('style');
          jQuery(current_image_class).css({'opacity' : 0, filter: 'Alpha(opacity=0)', 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, filter: 'Alpha(opacity=100)', 'z-index' : 2});
         // huge_it_change_watermark_container_<?php echo $sliderID; ?>();
          huge_it_trans_in_progress_<?php echo $sliderID; ?> = false;
          if (typeof event_stack_<?php echo $sliderID; ?> !== 'undefined' && event_stack_<?php echo $sliderID; ?>.length > 0) {
            key = event_stack_<?php echo $sliderID; ?>[0].split("-");
            event_stack_<?php echo $sliderID; ?>.shift();
            huge_it_change_image_<?php echo $sliderID; ?>(key[0], key[1], data_<?php echo $sliderID; ?>, true);
          }
        }
      }
      function huge_it_cubeH_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        /* Set to half of image width.*/
        var dimension = jQuery(current_image_class).width() / 2;
        if (direction == 'right') {
          huge_it_cube_<?php echo $sliderID; ?>(dimension, dimension, 0, 0, 90, 0, -90, current_image_class, next_image_class, direction);
        }
        else if (direction == 'left') {
          huge_it_cube_<?php echo $sliderID; ?>(dimension, -dimension, 0, 0, -90, 0, 90, current_image_class, next_image_class, direction);
        }
      }
      function huge_it_cubeV_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        /* Set to half of image height.*/
        var dimension = jQuery(current_image_class).height() / 2;
        /* If next slide.*/
        if (direction == 'right') {
          huge_it_cube_<?php echo $sliderID; ?>(dimension, 0, -dimension, 90, 0, -90, 0, current_image_class, next_image_class, direction);
        }
        else if (direction == 'left') {
          huge_it_cube_<?php echo $sliderID; ?>(dimension, 0, dimension, -90, 0, 90, 0, current_image_class, next_image_class, direction);
        }
      }
      /* For browsers that does not support transitions.*/
      function huge_it_fallback_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_fade_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction);
      }
      /* For browsers that support transitions, but not 3d transforms (only used if primary transition makes use of 3d-transforms).*/
      function huge_it_fallback3d_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_sliceV_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction);
      }
      function huge_it_none_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
        jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
       // huge_it_change_watermark_container_<?php echo $sliderID; ?>();
        /* Set active thumbnail.*/
        jQuery(".huge_it_slideshow_filmstrip_thumbnail_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_thumb_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_thumb_deactive_<?php echo $sliderID; ?>");
        jQuery("#huge_it_filmstrip_thumbnail_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_thumb_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_thumb_active_<?php echo $sliderID; ?>");
        jQuery(".huge_it_slideshow_dots_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>");
        jQuery("#huge_it_dots_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>");
      }
      function huge_it_fade_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        if (huge_it_testBrowser_cssTransitions_<?php echo $sliderID; ?>()) {
          jQuery(next_image_class).css('transition', 'opacity ' + huge_it_transition_duration_<?php echo $sliderID; ?> + 'ms linear');
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
         // huge_it_change_watermark_container_<?php echo $sliderID; ?>();
        }
        else {
          jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, huge_it_transition_duration_<?php echo $sliderID; ?>);
          jQuery(next_image_class).animate({
              'opacity' : 1,
              'z-index': 2
            }, {
              duration: huge_it_transition_duration_<?php echo $sliderID; ?>,
              complete: function () {/* huge_it_change_watermark_container_<?php echo $sliderID; ?>(); */}
            });
          // For IE.
          jQuery(current_image_class).fadeTo(huge_it_transition_duration_<?php echo $sliderID; ?>, 0);
          jQuery(next_image_class).fadeTo(huge_it_transition_duration_<?php echo $sliderID; ?>, 1);
        }
      }
      function huge_it_grid_<?php echo $sliderID; ?>(cols, rows, ro, tx, ty, sc, op, current_image_class, next_image_class, direction) {
        /* If browser does not support CSS transitions.*/
        if (!huge_it_testBrowser_cssTransitions_<?php echo $sliderID; ?>()) {
			jQuery(".huge_it_slideshow_dots_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>");
        jQuery("#huge_it_dots_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>");
          return huge_it_fallback_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction);
		  
        }
        huge_it_trans_in_progress_<?php echo $sliderID; ?> = true;
        /* Set active thumbnail.*/
        jQuery(".huge_it_slideshow_filmstrip_thumbnail_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_thumb_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_thumb_deactive_<?php echo $sliderID; ?>");
        jQuery("#huge_it_filmstrip_thumbnail_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_thumb_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_thumb_active_<?php echo $sliderID; ?>");
        jQuery(".huge_it_slideshow_dots_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>");
        jQuery("#huge_it_dots_" + huge_it_current_key_<?php echo $sliderID; ?> + "_<?php echo $sliderID; ?>").removeClass("huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?>").addClass("huge_it_slideshow_dots_active_<?php echo $sliderID; ?>");
        /* The time (in ms) added to/subtracted from the delay total for each new gridlet.*/
        var count = (huge_it_transition_duration_<?php echo $sliderID; ?>) / (cols + rows);
        /* Gridlet creator (divisions of the image grid, positioned with background-images to replicate the look of an entire slide image when assembled)*/
        function huge_it_gridlet(width, height, top, img_top, left, img_left, src, imgWidth, imgHeight, c, r) {
          var delay = (c + r) * count;
          /* Return a gridlet elem with styles for specific transition.*/
          return jQuery('<div class="huge_it_gridlet_<?php echo $sliderID; ?>" />').css({
            width : width,
            height : height,
            top : top,
            left : left,
            backgroundImage : 'url("' + src + '")',
            backgroundColor: jQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").css("background-color"),
            /*backgroundColor: rgba(0, 0, 0, 0),*/
            backgroundRepeat: 'no-repeat',
            backgroundPosition : img_left + 'px ' + img_top + 'px',
            backgroundSize : imgWidth + 'px ' + imgHeight + 'px',
            transition : 'all ' + huge_it_transition_duration_<?php echo $sliderID; ?> + 'ms ease-in-out ' + delay + 'ms',
            transform : 'none'
          });
        }
        /* Get the current slide's image.*/
        var cur_img = jQuery(current_image_class).find('img');
        /* Create a grid to hold the gridlets.*/
        var grid = jQuery('<div />').addClass('huge_it_grid_<?php echo $sliderID; ?>');
        /* Prepend the grid to the next slide (i.e. so it's above the slide image).*/
        jQuery(current_image_class).prepend(grid);
        /* vars to calculate positioning/size of gridlets*/
        var cont = jQuery(".huge_it_slide_bg_<?php echo $sliderID; ?>");
        var imgWidth = cur_img.width();
        var imgHeight = cur_img.height();
        var contWidth = cont.width(),
            contHeight = cont.height(),
            imgSrc = cur_img.attr('src'),/*.replace('/thumb', ''),*/
            colWidth = Math.floor(contWidth / cols),
            rowHeight = Math.floor(contHeight / rows),
            colRemainder = contWidth - (cols * colWidth),
            colAdd = Math.ceil(colRemainder / cols),
            rowRemainder = contHeight - (rows * rowHeight),
            rowAdd = Math.ceil(rowRemainder / rows),
            leftDist = 0,
            img_leftDist = (jQuery(".huge_it_slide_bg_<?php echo $sliderID; ?>").width() - cur_img.width()) / 2;
        /* tx/ty args can be passed as 'auto'/'min-auto' (meaning use slide width/height or negative slide width/height).*/
        tx = tx === 'auto' ? contWidth : tx;
        tx = tx === 'min-auto' ? - contWidth : tx;
        ty = ty === 'auto' ? contHeight : ty;
        ty = ty === 'min-auto' ? - contHeight : ty;
        /* Loop through cols*/
        for (var i = 0; i < cols; i++) {
          var topDist = 0,
              img_topDst = (jQuery(".huge_it_slide_bg_<?php echo $sliderID; ?>").height() - cur_img.height()) / 2,
              newColWidth = colWidth;
          /* If imgWidth (px) does not divide cleanly into the specified number of cols, adjust individual col widths to create correct total.*/
          if (colRemainder > 0) {
            var add = colRemainder >= colAdd ? colAdd : colRemainder;
            newColWidth += add;
            colRemainder -= add;
          }
          /* Nested loop to create row gridlets for each col.*/
          for (var j = 0; j < rows; j++)  {
            var newRowHeight = rowHeight,
                newRowRemainder = rowRemainder;
            /* If contHeight (px) does not divide cleanly into the specified number of rows, adjust individual row heights to create correct total.*/
            if (newRowRemainder > 0) {
              add = newRowRemainder >= rowAdd ? rowAdd : rowRemainder;
              newRowHeight += add;
              newRowRemainder -= add;
            }
            /* Create & append gridlet to grid.*/
            grid.append(huge_it_gridlet(newColWidth, newRowHeight, topDist, img_topDst, leftDist, img_leftDist, imgSrc, imgWidth, imgHeight, i, j));
            topDist += newRowHeight;
            img_topDst -= newRowHeight;
          }
          img_leftDist -= newColWidth;
          leftDist += newColWidth;
        }
        /* Set event listener on last gridlet to finish transitioning.*/
        var last_gridlet = grid.children().last();
        /* Show grid & hide the image it replaces.*/
        grid.show();
        cur_img.css('opacity', 0);
        /* Add identifying classes to corner gridlets (useful if applying border radius).*/
        grid.children().first().addClass('rs-top-left');
        grid.children().last().addClass('rs-bottom-right');
        grid.children().eq(rows - 1).addClass('rs-bottom-left');
        grid.children().eq(- rows).addClass('rs-top-right');
        /* Execution steps.*/
        setTimeout(function () {
          grid.children().css({
            opacity: op,
            transform: 'rotate('+ ro +'deg) translateX('+ tx +'px) translateY('+ ty +'px) scale('+ sc +')'
          });
        }, 1);
        jQuery(next_image_class).css('opacity', 1);
        /* After transition.*/
        jQuery(last_gridlet).one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(huge_it_after_trans));
        function huge_it_after_trans() {
          /*if (huge_it_from_focus_<?php echo $sliderID; ?>) {
            huge_it_from_focus_<?php echo $sliderID; ?> = false;
            return;
          }*/
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          cur_img.css('opacity', 1);
         // huge_it_change_watermark_container_<?php echo $sliderID; ?>();
          grid.remove();
          huge_it_trans_in_progress_<?php echo $sliderID; ?> = false;
          if (typeof event_stack_<?php echo $sliderID; ?> !== 'undefined' && event_stack_<?php echo $sliderID; ?>.length > 0) {
            key = event_stack_<?php echo $sliderID; ?>[0].split("-");
            event_stack_<?php echo $sliderID; ?>.shift();
            huge_it_change_image_<?php echo $sliderID; ?>(key[0], key[1], data_<?php echo $sliderID; ?>, true);
          }
        }
      }
      function huge_it_sliceH_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateX = 'min-auto';
        }
        else if (direction == 'left') {
          var translateX = 'auto';
        }
        huge_it_grid_<?php echo $sliderID; ?>(1, 8, 0, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_sliceV_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateY = 'min-auto';
        }
        else if (direction == 'left') {
          var translateY = 'auto';
        }
        huge_it_grid_<?php echo $sliderID; ?>(10, 1, 0, 0, translateY, 1, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_slideV_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateY = 'auto';
        }
        else if (direction == 'left') {
          var translateY = 'min-auto';
        }
        huge_it_grid_<?php echo $sliderID; ?>(1, 1, 0, 0, translateY, 1, 1, current_image_class, next_image_class, direction);
      }
      function huge_it_slideH_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateX = 'min-auto';
        }
        else if (direction == 'left') {
          var translateX = 'auto';
        }
        huge_it_grid_<?php echo $sliderID; ?>(1, 1, 0, translateX, 0, 1, 1, current_image_class, next_image_class, direction);
      }
      function huge_it_scaleOut_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_grid_<?php echo $sliderID; ?>(1, 1, 0, 0, 0, 1.5, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_scaleIn_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_grid_<?php echo $sliderID; ?>(1, 1, 0, 0, 0, 0.5, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_blockScale_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_grid_<?php echo $sliderID; ?>(8, 6, 0, 0, 0, .6, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_kaleidoscope_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_grid_<?php echo $sliderID; ?>(10, 8, 0, 0, 0, 1, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_fan_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var rotate = 45;
          var translateX = 100;
        }
        else if (direction == 'left') {
          var rotate = -45;
          var translateX = -100;
        }
        huge_it_grid_<?php echo $sliderID; ?>(1, 10, rotate, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_blindV_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_grid_<?php echo $sliderID; ?>(1, 8, 0, 0, 0, .7, 0, current_image_class, next_image_class);
      }
      function huge_it_blindH_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        huge_it_grid_<?php echo $sliderID; ?>(10, 1, 0, 0, 0, .7, 0, current_image_class, next_image_class);
      }
      function huge_it_random_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction) {
        var anims = ['sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV'];
        /* Pick a random transition from the anims array.*/
        this["huge_it_" + anims[Math.floor(Math.random() * anims.length)] + "_<?php echo $sliderID; ?>"](current_image_class, next_image_class, direction);
      }
      
      function iterator_<?php echo $sliderID; ?>() {
        var iterator = 1;
        /*if (<?php echo $enable_slideshow_shuffle; ?>) {
          iterator = Math.floor((data_<?php echo $sliderID; ?>.length - 1) * Math.random() + 1);
        }*/
        return iterator;
      }
	  
     function huge_it_change_image_<?php echo $sliderID; ?>(current_key, key, data_<?php echo $sliderID; ?>, from_effect) {
        if (data_<?php echo $sliderID; ?>[key]) {
           /* clearInterval(huge_it_playInterval_<?php echo $sliderID; ?>);
           play_<?php echo $sliderID; ?>();*/

          if (!from_effect) {
            // Change image key.
            jQuery("#huge_it_current_image_key_<?php echo $sliderID; ?>").val(key);
            if (current_key == '-1') { // Filmstrip
              current_key = jQuery(".huge_it_slideshow_thumb_active_<?php echo $sliderID; ?>").children("img").attr("image_key");
            }
            else if (current_key == '-2') { // Dots
              current_key = jQuery(".huge_it_slideshow_dots_active_<?php echo $sliderID; ?>").attr("image_key");
            }
          }

          if (huge_it_trans_in_progress_<?php echo $sliderID; ?>) {
			//brrjQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").after(" --IN TRANSACTION-- <br />");
            event_stack_<?php echo $sliderID; ?>.push(current_key + '-' + key);
            return;
          }
		  
          var direction = 'right';
          if (huge_it_current_key_<?php echo $sliderID; ?> > key) {
            var direction = 'left';
          }
          else if (huge_it_current_key_<?php echo $sliderID; ?> == key) {
            return;
          }

         
          // Set active thumbnail position.
         // huge_it_current_filmstrip_pos_<?php echo $sliderID; ?> = key * (jQuery(".huge_it_slideshow_filmstrip_thumbnail_<?php echo $sliderID; ?>").width() + 2 + 2 * <?php echo $theme_row->lightbox_filmstrip_thumb_border_width; ?>);
          huge_it_current_key_<?php echo $sliderID; ?> = key;
          //Change image id, title, description.
          jQuery("#huge_it_slideshow_image_<?php echo $sliderID; ?>").attr('image_id', data_<?php echo $sliderID; ?>[key]["id"]);
		  
          jQuery(".huge_it_slideshow_title_text_<?php echo $sliderID; ?>").html(data_<?php echo $sliderID; ?>[key]["alt"]);
          jQuery(".huge_it_slideshow_description_text_<?php echo $sliderID; ?>").html(data_<?php echo $sliderID; ?>[key]["description"]);
        
		  var current_image_class = "#image_id_<?php echo $sliderID; ?>_" + data_<?php echo $sliderID; ?>[current_key]["id"];
          var next_image_class = "#image_id_<?php echo $sliderID; ?>_" + data_<?php echo $sliderID; ?>[key]["id"];
          
		  huge_it_<?php echo $slidereffect; ?>_<?php echo $sliderID; ?>(current_image_class, next_image_class, direction);
		  
		  
		jQuery('.huge_it_slideshow_title_text_<?php echo $sliderID; ?>').removeClass('none');
		if(jQuery('.huge_it_slideshow_title_text_<?php echo $sliderID; ?>').html()==""){jQuery('.huge_it_slideshow_title_text_<?php echo $sliderID; ?>').addClass('none');}

		jQuery('.huge_it_slideshow_description_text_<?php echo $sliderID; ?>').removeClass('none');
		if(jQuery('.huge_it_slideshow_description_text_<?php echo $sliderID; ?>').html()==""){jQuery('.huge_it_slideshow_description_text_<?php echo $sliderID; ?>').addClass('none');}
		  
		  
		  //brrjQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").after("--cur-key="+current_key+" --cur-img-class="+current_image_class+" nxt-img-class="+next_image_class+"--");
          <?php
          if ($enable_slideshow_filmstrip!="") {
            ?>
            huge_it_move_filmstrip_<?php echo $sliderID; ?>();
            <?php
          }
          else {            
            ?>
            huge_it_move_dots_<?php echo $sliderID; ?>();
            <?php
          }
          ?>
        }
      }
	  
      function huge_it_popup_resize_<?php echo $sliderID; ?>() {

		<?php

			//$thumbnail_width= "150"; 
			//$thumbnail_height= "150";
			//$slideshow_filmstrip_height="0";/*/Thumbs height
		?>
		var staticsliderwidth=<?php echo $sliderwidth;?>;
		var sliderwidth=<?php echo $sliderwidth;?>;
		
		var bodyWidth=jQuery(window).width();
        var parentWidth = jQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").parent().width();
		//tryuk vor hankarc responsive.js @  ushana body i chap@ verci vochte verevi div i 
		if(sliderwidth>parentWidth){sliderwidth=parentWidth;}
		if(sliderwidth>bodyWidth){sliderwidth=bodyWidth;}
		
		var str=(<?php echo $sliderheight;?>/staticsliderwidth);
		
		jQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").css({width: (sliderwidth)});
		jQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").css({height: ((sliderwidth) * str)});
		jQuery(".huge_it_slideshow_image_container_<?php echo $sliderID; ?>").css({width: (sliderwidth)});
		jQuery(".huge_it_slideshow_image_container_<?php echo $sliderID; ?>").css({height: ((sliderwidth) * str /*- <?php echo $slideshow_filmstrip_height; ?>*/)});

		 		 
		jQuery(".huge_it_slideshow_image_<?php echo $sliderID; ?>, .huge_it_slideshow_image_span1_<?php echo $sliderID; ?> img, .huge_it_slideshow_image_container_<?php echo $sliderID; ?> img").css({
			width:sliderwidth,
			height:((sliderwidth) * str)			
		});
					  
         // jQuery(".huge_it_slideshow_filmstrip_container_<?php echo $sliderID; ?>").css({width: (sliderwidth)});
         // jQuery(".huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>").css({width: (sliderwidth - 40)});
         // jQuery(".huge_it_slideshow_dots_container_<?php echo $sliderID; ?>").css({width: (sliderwidth)});a
      }
      
      jQuery(window).load(function () {
		jQuery(window).resize(function() {
			huge_it_popup_resize_<?php echo $sliderID; ?>();
		});
		
		huge_it_popup_resize_<?php echo $sliderID; ?>();
        /* Disable right click.*/
        jQuery('div[id^="huge_it_container"]').bind("contextmenu", function () {
          return false;
        });
        /*if (typeof jQuery().swiperight !== 'undefined' && jQuery.isFunction(jQuery().swiperight)) {
          jQuery('#huge_it_container1_<?php echo $sliderID; ?>').swiperight(function () {
            huge_it_change_image_<?php echo $sliderID; ?>(parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()) - iterator_<?php echo $sliderID; ?>()) >= 0 ? (parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()) - iterator_<?php echo $sliderID; ?>()) % data_<?php echo $sliderID; ?>.length : data_<?php echo $sliderID; ?>.length - 1, data_<?php echo $sliderID; ?>);
            return false;
          });
        }
        if (typeof jQuery().swipeleft !== 'undefined' && jQuery.isFunction(jQuery().swipeleft)) {
          jQuery('#huge_it_container1_<?php echo $sliderID; ?>').swipeleft(function () {
            huge_it_change_image_<?php echo $sliderID; ?>(parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()) + iterator_<?php echo $sliderID; ?>()) % data_<?php echo $sliderID; ?>.length, data_<?php echo $sliderID; ?>);
            return false;
          });
        }*/

      /*  var isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
        var huge_it_click = isMobile ? 'touchend' : 'click';
        huge_it_popup_resize_<?php echo $sliderID; ?>();
        jQuery("#huge_it_container1_<?php echo $sliderID; ?>").css({visibility: 'visible'});
        jQuery(".huge_it_slideshow_watermark_<?php echo $sliderID; ?>").css({display: 'none'});
        jQuery(".huge_it_slideshow_title_text_<?php echo $sliderID; ?>").css({display: 'none'});
        jQuery(".huge_it_slideshow_description_text_<?php echo $sliderID; ?>").css({display: 'none'});
        setTimeout(function () {
         // huge_it_change_watermark_container_<?php echo $sliderID; ?>();
        }, 500);
        // Set image container height.
        jQuery(".huge_it_slideshow_image_container_<?php echo $sliderID; ?>").height(jQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").height() - <?php echo $slideshow_filmstrip_height; ?>);
        
        var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel"; // FF doesn't recognize mousewheel as of FF3.x
        jQuery('.huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>').bind(mousewheelevt, function(e) {
          var evt = window.event || e;  Equalize event object.
          evt = evt.originalEvent ? evt.originalEvent : evt;  Convert to originalEvent if possible.
          var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta;  Check for detail first, because it is used by Opera and FF.
          if (delta > 0) {
            // Scroll up.
            jQuery(".huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?>").trigger("click");
          }
          else {
            // Scroll down.
            jQuery(".huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?>").trigger("click");
          }
          return false;
        });
		jQuery(".huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?>").on(huge_it_click, function () {
          jQuery( ".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>" ).stop(true, false);
          if (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left >= -(jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").width() - jQuery(".huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>").width())) {
            jQuery(".huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?>").css({opacity: 1, filter: "Alpha(opacity=100)"});
            if (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left < -(jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").width() - jQuery(".huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>").width() - 2 - <?php echo $slideshow_filmstrip_width; ?>)) {
              jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").animate({left: -(jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").width() - jQuery(".huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>").width())}, 500, 'linear');
            }
            else {
              jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").animate({left: (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left - 2 - <?php echo $slideshow_filmstrip_width; ?>)}, 500, 'linear');
            }
          }
          // Disable right arrow.
          window.setTimeout(function(){
            if (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left == -(jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").width() - jQuery(".huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>").width())) {
              jQuery(".huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?>").css({opacity: 0.3, filter: "Alpha(opacity=30)"});
            }
          }, 500);
        });
        jQuery(".huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?>").on(huge_it_click, function () {
          jQuery( ".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>" ).stop(true, false);
          if (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left < 0) {
            jQuery(".huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?>").css({opacity: 1, filter: "Alpha(opacity=100)"});
            if (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left > -(2 + <?php echo $slideshow_filmstrip_width; ?>)) {
              jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").animate({left: 0}, 500, 'linear');
            }
            else {
              jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").animate({left: (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left + 2 + <?php echo $slideshow_filmstrip_width; ?>)}, 500, 'linear');
            }
          }
          //Disable left arrow.
          window.setTimeout(function(){
            if (jQuery(".huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>").position().left == 0) {
              jQuery(".huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?>").css({opacity: 0.3, filter: "Alpha(opacity=30)"});
            }
          }, 500);
        });*/
        /* Set filmstrip initial position.*/
        huge_it_set_filmstrip_pos_<?php echo $sliderID; ?>(jQuery(".huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>").width());
			
		jQuery("#huge_it_slideshow_image_container_<?php echo $sliderID; ?>, .huge_it_slideshow_image_container_<?php echo $sliderID; ?>, .huge_it_slideshow_dots_container_<?php echo $sliderID; ?>,#huge_it_slideshow_right_<?php echo $sliderID; ?>,#huge_it_slideshow_left_<?php echo $sliderID; ?>").hover(function(){
			//brrjQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").after(" -- hover -- <br /> ");
			jQuery("#huge_it_slideshow_right_<?php echo $sliderID; ?>").css({'display':'inline'});
			jQuery("#huge_it_slideshow_left_<?php echo $sliderID; ?>").css({'display':'inline'});
		},function(){
			jQuery("#huge_it_slideshow_right_<?php echo $sliderID; ?>").css({'display':'none'});
			jQuery("#huge_it_slideshow_left_<?php echo $sliderID; ?>").css({'display':'none'});
		});
		
		var pausehover="<?php echo $sliderpauseonhover;?>";
		if(pausehover=="on"){
			jQuery("#huge_it_slideshow_image_container_<?php echo $sliderID; ?>, .huge_it_slideshow_image_container_<?php echo $sliderID; ?>, .huge_it_slideshow_dots_container_<?php echo $sliderID; ?>,#huge_it_slideshow_right_<?php echo $sliderID; ?>,#huge_it_slideshow_left_<?php echo $sliderID; ?>").hover(function(){
				clearInterval(huge_it_playInterval_<?php echo $sliderID; ?>);
			},function(){
				clearInterval(huge_it_playInterval_<?php echo $sliderID; ?>);
				play_<?php echo $sliderID; ?>();
			});		
		}
          play_<?php echo $sliderID; ?>();        
      });

       function play_<?php echo $sliderID; ?>() {
	   
        /* Play.*/
		//brrjQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").after(" -- paly  ---- ");
        huge_it_playInterval_<?php echo $sliderID; ?> = setInterval(function () {
			//brrjQuery(".huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>").after(" -- jamanak@ ancav ---- ");
          var iterator = 1;
          huge_it_change_image_<?php echo $sliderID; ?>(parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()) + iterator) % data_<?php echo $sliderID; ?>.length, data_<?php echo $sliderID; ?>)
        }, '<?php echo $slidepausetime; ?>');
      }
	  
      jQuery(window).focus(function() {
       /*event_stack_<?php echo $sliderID; ?> = [];*/
        if (!jQuery(".huge_it_ctrl_btn_<?php echo $sliderID; ?>").hasClass("fa-play")) {
          clearInterval(huge_it_playInterval_<?php echo $sliderID; ?>);
          play_<?php echo $sliderID; ?>();
        }
        var i_<?php echo $sliderID; ?> = 0;
        jQuery(".huge_it_slider_<?php echo $sliderID; ?>").children("span").each(function () {
          if (jQuery(this).css('opacity') == 1) {
            jQuery("#huge_it_current_image_key_<?php echo $sliderID; ?>").val(i_<?php echo $sliderID; ?>);
          }
          i_<?php echo $sliderID; ?>++;
        });
      });
      jQuery(window).blur(function() {
        event_stack_<?php echo $sliderID; ?> = [];
        clearInterval(huge_it_playInterval_<?php echo $sliderID; ?>);
      });      
    </script>
	<style>
	
				
		 .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> {
			height:<?php echo $sliderheight; ?>px;
			width:<?php  echo $sliderwidth; ?>px;
			position:relative;
			display: block;
			margin:0px auto;
			text-align: center;
			/*HEIGHT FROM HEADER.PHP*/
			clear:both;
			
			overflow:hidden;
			border-style:solid;
			border-left:0px !important;
			border-right:0px !important;
		}


		.huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> * {

			box-sizing: border-box;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
		}
		  
	  .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_container_<?php echo $sliderID; ?> {
        display: table;
        height: <?php echo $slideshow_filmstrip_height; ?>px;
        position: absolute;
        width: <?php echo $image_width; ?>px;
        /*z-index: 10105;*/
        <?php echo $theme_row->slideshow_filmstrip_pos; ?>: 0;
      }
	  
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_<?php echo $sliderID; ?> {
        left: 20px;
        overflow: hidden;
        position: absolute;
        width: <?php echo $image_width - 40; ?>px;
        /*z-index: 10106;*/
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?> {
        height: <?php echo $slideshow_filmstrip_height; ?>px;
        left: 0px;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
        width: <?php echo ($slideshow_filmstrip_width + 2) * count($image_rows); ?>px;
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_thumbnail_<?php echo $sliderID; ?> {
        position: relative;
        background: none;
        border: <?php echo $theme_row->slideshow_filmstrip_thumb_border_width; ?>px <?php echo $theme_row->slideshow_filmstrip_thumb_border_style; ?> #<?php echo $theme_row->slideshow_filmstrip_thumb_border_color; ?>;
        border-radius: <?php echo $theme_row->slideshow_filmstrip_thumb_border_radius; ?>;
        cursor: pointer;
        float: left;
        height: <?php echo $slideshow_filmstrip_height; ?>px;
        margin: <?php echo $theme_row->slideshow_filmstrip_thumb_margin; ?>;
        width: <?php echo $slideshow_filmstrip_width; ?>px;
        overflow: hidden;
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_thumb_active_<?php echo $sliderID; ?> {
        opacity: 1;
        filter: Alpha(opacity=100);
        border: <?php echo $theme_row->slideshow_filmstrip_thumb_active_border_width; ?>px solid #<?php echo $theme_row->slideshow_filmstrip_thumb_active_border_color; ?>;
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_thumb_deactive_<?php echo $sliderID; ?> {
        opacity: <?php echo $theme_row->slideshow_filmstrip_thumb_deactive_transparent / 100; ?>;
        filter: Alpha(opacity=<?php echo $theme_row->slideshow_filmstrip_thumb_deactive_transparent; ?>);
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_thumbnail_img_<?php echo $sliderID; ?> {
        display: block;
        opacity: 1;
        filter: Alpha(opacity=100);
        padding: 0 !important;
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?> {
        background-color: #<?php echo $theme_row->slideshow_filmstrip_rl_bg_color; ?>;
        cursor: pointer;
        display: table-cell;
        vertical-align: middle;
        width: 20px;
        /*z-index: 10106;*/
        left: 0;
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?> {
        background-color: #<?php echo $theme_row->slideshow_filmstrip_rl_bg_color; ?>;
        cursor: pointer;
        right: 0;
        width: 20px;
        display: table-cell;
        vertical-align: middle;
        /*z-index: 10106;*/
      }
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?> i,
     .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> .huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?> i {
        color: #<?php echo $theme_row->slideshow_filmstrip_rl_btn_color; ?>;
        font-size: <?php echo $theme_row->slideshow_filmstrip_rl_btn_size; ?>px;
      }

	  .huge_it_slideshow_image_<?php echo $sliderID; ?> {
			width:100%;
	  }

	  #huge_it_slideshow_left_<?php echo $sliderID; ?>,
	  #huge_it_slideshow_right_<?php echo $sliderID; ?> {
		bottom: 0;
		cursor: pointer;
		display:none;
		display: block;
		
		height: 100%;
		outline: medium none;
		position: absolute;

		/*z-index: 10130;*/
		z-index: 13;
		bottom:25px;
		top:50%;		
	  }
	 
	  
	  #huge_it_slideshow_left_<?php echo $sliderID; ?>:hover span {
		left: 20px;
	  }

	  #huge_it_slideshow_right_<?php echo $sliderID; ?>:hover span {
		left: auto;
		right: 20px;
	  }
	  #huge_it_slideshow_left-ico_<?php echo $sliderID; ?> span,
	  #huge_it_slideshow_right-ico_<?php echo $sliderID; ?> span {
		display: table-cell;
		text-align: center;
		vertical-align: middle;
		z-index: 13;
	  }
	  #huge_it_slideshow_left-ico_<?php echo $sliderID; ?>,
	  #huge_it_slideshow_right-ico_<?php echo $sliderID; ?> {
		z-index: 13;
		-moz-box-sizing: content-box;
		box-sizing: content-box;
		cursor: pointer;
		display: table;
		left: -9999px;
		line-height: 0;
		margin-top: -15px;
		position: absolute;
		top: 50%;
		/*z-index: 10135;*/
	  }
	  #huge_it_slideshow_left-ico_<?php echo $sliderID; ?>:hover,
	  #huge_it_slideshow_right-ico_<?php echo $sliderID; ?>:hover {
		cursor: pointer;
	  }
	  
	  .huge_it_slideshow_image_container_<?php echo $sliderID; ?> {
		display: table;
		position: relative;
		top:0px;
		left:0px;
		text-align: center;
		vertical-align: middle;
		width:100%;
	  }
	  
	  .huge_it_none_selectable_<?php echo $sliderID; ?> {
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	  }
	  
	  .huge_it_slideshow_title_container_<?php echo $sliderID; ?>,.huge_it_slideshow_description_container_<?php echo $sliderID; ?> {
		display: table-cell;
		margin: 0 auto;
		position: relative;
	  }
	  
	   .huge_it_slideshow_title_container_<?php echo $sliderID; ?> > div, .huge_it_slideshow_description_container_<?php echo $sliderID; ?> > div {
			display:block;
			width:100%;
	   }
	   
	  .huge_it_slideshow_title_span_<?php echo $sliderID; ?> {
		display: table-cell;
		overflow: hidden;
		position: relative;
		/*text-align FROM HEADER.PHP*/
		/*vertical-align FROM HEADER.PHP*/
	  }
	  .huge_it_slideshow_description_span_<?php echo $sliderID; ?> {
		
		display: table-cell !important;
		

		overflow: hidden;
		position: relative;
		/*text-align FROM HEADER.PHP*/
		/*vertical-align FROM HEADER.PHP*/
	  }
  
	  .huge_it_slideshow_title_text_<?php echo $sliderID; ?> {
		text-decoration: none;
		position: relative;
		z-index: 11;
		display: inline-block;
		max-width: 33%;
		text-align:justify;  
		padding:10px;
		border-style:solid;
		margin:10px;
		font-weight:bold;
	  }
	  
	  .huge_it_slideshow_description_text_<?php echo $sliderID; ?> {
		text-decoration: none;
		position: relative;
		z-index: 11;
		margin: 5px;
		border-style:solid;
		padding:10px;
		display: inline-block;
		max-width: 33%;
		text-align:justify;  
		margin:10px;
	  }
	  
	   .huge_it_slideshow_title_text_<?php echo $sliderID; ?>.none, .huge_it_slideshow_description_text_<?php echo $sliderID; ?>.none {display:none;}

	  .huge_it_slide_container_<?php echo $sliderID; ?> {
		display: table-cell;
		margin: 0 auto;
		position: relative;
		vertical-align: middle;
		width:100%;
		height:100%;
		_width: inherit;
		_height: inherit;
	  }
	  .huge_it_slide_bg_<?php echo $sliderID; ?> {
		margin: 0 auto;
		width:100%;
		height:100%;
		_width: inherit;
		_height: inherit;
	  }
	  .huge_it_slider_<?php echo $sliderID; ?> {
		height: inherit;
		width: inherit;
	  }
	  .huge_it_slideshow_image_span_<?php echo $sliderID; ?> {
		width: inherit;
		height: inherit;
		display: table-cell;
		filter: Alpha(opacity=100);
		opacity: 1;
		position: absolute;
		vertical-align: middle;
		z-index: 2;
		overflow:hidden;
	  }
	  .huge_it_slideshow_image_second_span_<?php echo $sliderID; ?> {
		width: inherit;
		height: inherit;
		display: table-cell;
		filter: Alpha(opacity=0);
		opacity: 0;
		position: absolute;
		vertical-align: middle;
		z-index: 1;
		overflow:hidden;
	  }
	  .huge_it_grid_<?php echo $sliderID; ?> {
		display: none;
		height: 100%;
		overflow: hidden;
		position: absolute;
		width: 100%;
	  }
	  .huge_it_gridlet_<?php echo $sliderID; ?> {
		opacity: 1;
		filter: Alpha(opacity=100);
		position: absolute;
	  }
	  
					
	  .huge_it_slideshow_dots_container_<?php echo $sliderID; ?> {
		display: table;
		position: absolute;
		width:100% !important;
		height:100% !important;
		/*width FROM HEADER.PHP*/
	  }
	  .huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?> {
		margin: 0 auto;
		overflow: hidden;
		position: absolute;
		width:100%;
		height:30px;
	  }
	  
	  .huge_it_slideshow_dots_<?php echo $sliderID; ?> {
		display: inline-block;
		position: relative;
		cursor: pointer;
		box-shadow: 1px 1px 1px rgba(0,0,0,0.1) inset, 1px 1px 1px rgba(255,255,255,0.1);
		width:10px;
		height: 10px;
		border-radius: 10px;
		background: #00f;
		margin: 10px;
		overflow: hidden;
		z-index: 17;
	  }
	  
	  .huge_it_slideshow_dots_active_<?php echo $sliderID; ?> {
		opacity: 1;
		background:#0f0;
		filter: Alpha(opacity=100);
	  }
	  .huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?> {
	  
	  }
	  
	  .huge_it_slideshow_image_span1_<?php echo $sliderID; ?> {
		 display: table; 
		 width: inherit; 
		 height: inherit;
	  }
	  .huge_it_slideshow_image_span2_<?php echo $sliderID; ?> {
		 display: table-cell; 
		 vertical-align: middle; 
		 text-align: center;
	  }
	  
	  .huge_it_slideshow_image_span2_<?php echo $sliderID; ?> a {
		display:block;
		width:100%;
		height:100%;
	  }
		
		<?php		
			$slideshow_title_position = explode('-', trim($paramssld['slider_title_position']));
			$slideshow_description_position = explode('-', trim($paramssld['slider_description_position']));
		 ?>

		.huge_it_slideshow_title_container_<?php echo $sliderID; ?> {
			text-align: <?php echo $slideshow_title_position[0]; ?>;
			vertical-align: <?php echo $slideshow_title_position[1]; ?>;
		}
		
		.huge_it_slideshow_description_container_<?php echo $sliderID; ?> {
			text-align: <?php echo $slideshow_description_position[0]; ?>;
			vertical-align: <?php echo $slideshow_description_position[1]; ?>;
		}

		.huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> {
			background:#<?php echo $paramssld['slider_slider_background_color']; ?>;
			border-width:<?php echo $paramssld['slider_slideshow_border_size']; ?>px;
			border-color:#<?php echo $paramssld['slider_slideshow_border_color']; ?>;
			border-radius:<?php echo $paramssld['slider_slideshow_border_radius']; ?>px;
		}
		
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> {
			color:#<?php echo $paramssld['slider_title_color']; ?>;
			
			background:<?php 
				if(isset($paramssld['slider_title_transparent']) and $paramssld['slider_title_transparent']=="checked"){
					
					list($r,$g,$b) = array_map('hexdec',str_split($paramssld['slider_title_background_color'],2));	
					echo 'rgba('.$r.','.$g.','.$b.',0.5)'; 
					
				}else{
					echo "none";
				}?>;
				
			font-size:<?php echo $paramssld['slider_title_font_size']; ?>px;
			border-width:<?php echo $paramssld['slider_title_border_size']; ?>px;
			border-color:#<?php echo $paramssld['slider_title_border_color']; ?>;
			border-radius:<?php echo $paramssld['slider_title_border_radius']; ?>px;
		}
		
		.huge_it_slideshow_description_text_<?php echo $sliderID; ?> {
			color:#<?php echo $paramssld['slider_description_color']; ?>;
			background:<?php 
				if(isset($paramssld['slider_description_transparent']) and $paramssld['slider_description_transparent']=="checked"){
					list($r,$g,$b) = array_map('hexdec',str_split($paramssld['slider_description_background_color'],2));	
					echo 'rgba('.$r.','.$g.','.$b.',0.5)';
					
				}else{
					echo "none";
				}?>;
			font-size:<?php echo $paramssld['slider_description_font_size']; ?>px;
			border-width:<?php echo $paramssld['slider_description_border_size']; ?>px;
			border-color:#<?php echo $paramssld['slider_description_border_color']; ?>;
			border-radius:<?php echo $paramssld['slider_description_border_radius']; ?>px;
		}
		.huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?> {
			<?php if($paramssld['slider_dots_position']=="bottom"){?>
			bottom:0px;
			<?php }else if($paramssld['slider_dots_position']=="none"){?>
			display:none;
			<?
			}else{ ?>
			top:0px; <?php } ?>
		}
		
		.huge_it_slideshow_dots_<?php echo $sliderID; ?> {
			background:#<?php echo $paramssld['slider_dots_color']; ?>;
		}
		
		.huge_it_slideshow_dots_active_<?php echo $sliderID; ?> {
			background:#<?php echo $paramssld['slider_active_dot_color']; ?>;
		}
		
		<?php
		
		$arrowfolder=plugins_url('slider-image/Front_images/arrows', _FILE_);
		switch ($paramssld['slider_navigation_type']) {
			case 1:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-21px;
						height:43px;
						width:29px;
						background:url(<?php echo $arrowfolder;?>/arrows.simple.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-21px;
						height:43px;
						width:29px;
						background:url(<?php echo $arrowfolder;?>/arrows.simple.png) right top no-repeat; 
					}
				<?php
				break;
			case 2:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-25px;
						height:50px;
						width:50px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.shadow.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-25px;
						height:50px;
						width:50px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.shadow.png) right top no-repeat; 
					}

					#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
						background-position:left -50px;
					}

					#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
						background-position:right -50px;
					}
				<?php
				break;
			case 3:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-22px;
						height:44px;
						width:44px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.simple.dark.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-22px;
						height:44px;
						width:44px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.simple.dark.png) right top no-repeat; 
					}

					#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
						background-position:left -44px;
					}

					#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
						background-position:right -44px;
					}
				<?php
				break;
			case 4:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-33px;
						height:66px;
						width:59px;
						background:url(<?php echo $arrowfolder;?>/arrows.cube.dark.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-33px;
						height:66px;
						width:59px;
						background:url(<?php echo $arrowfolder;?>/arrows.cube.dark.png) right top no-repeat; 
					}

					#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
						background-position:left -66px;
					}

					#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
						background-position:right -66px;
					}
				<?php
				break;
			case 5:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-18px;
						height:37px;
						width:40px;
						background:url(<?php echo $arrowfolder;?>/arrows.light.blue.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-18px;
						height:37px;
						width:40px;
						background:url(<?php echo $arrowfolder;?>/arrows.light.blue.png) right top no-repeat; 
					}

				<?php
				break;
			case 6:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-25px;
						height:50px;
						width:50px;
						background:url(<?php echo $arrowfolder;?>/arrows.light.cube.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-25px;
						height:50px;
						width:50px;
						background:url(<?php echo $arrowfolder;?>/arrows.light.cube.png) right top no-repeat; 
					}

					#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
						background-position:left -50px;
					}

					#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
						background-position:right -50px;
					}
				<?php
				break;
			case 7:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						right:0px;
						margin-top:-19px;
						height:38px;
						width:38px;
						background:url(<?php echo $arrowfolder;?>/arrows.light.transparent.circle.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-19px;
						height:38px;
						width:38px;
						background:url(<?php echo $arrowfolder;?>/arrows.light.transparent.circle.png) right top no-repeat; 
					}
				<?php
				break;
			case 8:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-22px;
						height:45px;
						width:45px;
						background:url(<?php echo $arrowfolder;?>/arrows.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-22px;
						height:45px;
						width:45px;
						background:url(<?php echo $arrowfolder;?>/arrows.png) right top no-repeat; 
					}
				<?php
				break;
			case 9:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-22px;
						height:45px;
						width:45px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.blue.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-22px;
						height:45px;
						width:45px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.blue.png) right top no-repeat; 
					}
				<?php
				break;
			case 10:
				?>
					#huge_it_slideshow_left_<?php echo $sliderID; ?> {	
						left:0px;
						margin-top:-24px;
						height:48px;
						width:48px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.green.png) left  top no-repeat; 
					}
					
					#huge_it_slideshow_right_<?php echo $sliderID; ?> {
						right:0px;
						margin-top:-24px;
						height:48px;
						width:48px;
						background:url(<?php echo $arrowfolder;?>/arrows.circle.green.png) right top no-repeat; 
					}

					#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
						background-position:left -48px;
					}

					#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
						background-position:right -48px;
					}
				<?php
				break;
		}
?>
	</style>
	
	<div class="huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>">
      <?php
      $current_pos = 0;
	  $enable_slideshow_filmstrip="";
      if ($enable_slideshow_filmstrip!="") {
        ?>
		<!--#################THUMBNAILS###############-->
        <div class="huge_it_slideshow_filmstrip_container_<?php echo $sliderID; ?>">
          <div class="huge_it_slideshow_filmstrip_left_<?php echo $sliderID; ?>"><i class="fa fa-angle-left "></i></div>
          <div class="huge_it_slideshow_filmstrip_<?php echo $sliderID; ?>">
            <div class="huge_it_slideshow_filmstrip_thumbnails_<?php echo $sliderID; ?>">
              <?php
			  $slideshow_filmstrip_width="600";
			  $slideshow_filmstrip_height="150";
			  $image_thumb_height="150";
			  $image_thumb_width="150";
              foreach ($images as $key => $image_row) {
                if ($image_row->id == "0") {
                  $current_pos = $key * ($slideshow_filmstrip_width + 2);
                  $current_key = $key;
                }
                /*list($image_thumb_width, $image_thumb_height) = getimagesize(ABSPATH . $WD_huge_it_UPLOAD_DIR . $image_row->thumb_url);
                $scale = max($slideshow_filmstrip_width / $image_thumb_width, $slideshow_filmstrip_height / $image_thumb_height);
                $image_thumb_width *= $scale;
                $image_thumb_height *= $scale;*/
                $thumb_left = ($slideshow_filmstrip_width - $image_thumb_width) / 2;
                $thumb_top = ($slideshow_filmstrip_height - $image_thumb_height) / 2;
              ?>
              <div id="huge_it_filmstrip_thumbnail_<?php echo $key; ?>_<?php echo $sliderID; ?>" class="huge_it_slideshow_filmstrip_thumbnail_<?php echo $sliderID; ?> <?php echo (($image_row->id == $current_image_id) ? 'huge_it_slideshow_thumb_active_' . $sliderID : 'huge_it_slideshow_thumb_deactive_' . $sliderID); ?>">
                <img style="width:<?php echo $image_thumb_width; ?>px; height:<?php echo $image_thumb_height; ?>px; margin-left: <?php echo $thumb_left; ?>px; margin-top: <?php echo $thumb_top; ?>px;"
                     class="huge_it_slideshow_filmstrip_thumbnail_img_<?php echo $sliderID; ?>"
                     src="<?php echo $image_row->image_url; ?>"
                     onclick="huge_it_change_image_<?php echo $sliderID; ?>('<?php echo $key; ?>', data_<?php echo $sliderID; ?>);return false;"
                     image_id="<?php echo $image_row->id; ?>"
                     image_key="<?php echo $key; ?>" />
              </div>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="huge_it_slideshow_filmstrip_right_<?php echo $sliderID; ?>"><i class="fa fa-angle-right"></i></div>
        </div>
        <?php
      }
      else {
        ?>
		<!-- ##########################DOTS######################### -->
        <div class="huge_it_slideshow_dots_container_<?php echo $sliderID; ?>">
          <div class="huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?>">
            <?php
			$current_image_id=0;
			$current_pos =0;
			$current_key=0;
            foreach ($images as $key => $image_row) {
              if ($image_row->id == $current_image_id) {
                $current_pos = $key * ($slideshow_filmstrip_width + 2);
                $current_key = $key;
              }
            ?>
				<span id="huge_it_dots_<?php echo $key; ?>_<?php echo $sliderID; ?>" class="huge_it_slideshow_dots_<?php echo $sliderID; ?> <?php echo (($key==$current_image_id) ? 'huge_it_slideshow_dots_active_' . $sliderID : 'huge_it_slideshow_dots_deactive_' . $sliderID); ?>" onclick="huge_it_change_image_<?php echo $sliderID; ?>(parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()), '<?php echo $key; ?>', data_<?php echo $sliderID; ?>);return false;" image_id="<?php echo $image_row->id; ?>" image_key="<?php echo $key; ?>"></span>
            <?php
            }
            ?>
          </div>
        </div
		<?php
	  }
		  $enable_slideshow_ctrl="1";
          if ($enable_slideshow_ctrl) {
		?> ?>
	   
        <a id="huge_it_slideshow_left_<?php echo $sliderID; ?>" href="#" onclick="huge_it_change_image_<?php echo $sliderID; ?>(parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()) - iterator_<?php echo $sliderID; ?>()) >= 0 ? (parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()) - iterator_<?php echo $sliderID; ?>()) % data_<?php echo $sliderID; ?>.length : data_<?php echo $sliderID; ?>.length - 1, data_<?php echo $sliderID; ?>);return false;">
			<span id="huge_it_slideshow_left-ico_<?php echo $sliderID; ?>">
			<span><i class="huge_it_slideshow_prev_btn_<?php echo $sliderID; ?> fa <?php echo $theme_row->slideshow_rl_btn_style; ?>-left"></i></span></span>
		</a>
        
		<a id="huge_it_slideshow_right_<?php echo $sliderID; ?>" href="#" onclick="huge_it_change_image_<?php echo $sliderID; ?>(parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()), (parseInt(jQuery('#huge_it_current_image_key_<?php echo $sliderID; ?>').val()) + iterator_<?php echo $sliderID; ?>()) % data_<?php echo $sliderID; ?>.length, data_<?php echo $sliderID; ?>);return false;">
			<span id="huge_it_slideshow_right-ico_<?php echo $sliderID;?> , data_<?php echo $sliderID;?>">
			<span><i class="huge_it_slideshow_next_btn_<?php echo $sliderID; ?> fa <?php echo $theme_row->slideshow_rl_btn_style; ?>-right"></i></span></span>
		</a>
          <?php
          }
      ?>
	  <!-- ##########################IMAGES######################### -->
      <div id="huge_it_slideshow_image_container_<?php echo $sliderID; ?>" class="huge_it_slideshow_image_container_<?php echo $sliderID; ?>">        
        <div class="huge_it_slide_container_<?php echo $sliderID; ?>">
          <div class="huge_it_slide_bg_<?php echo $sliderID; ?>">
            <div class="huge_it_slider_<?php echo $sliderID; ?>">
          <?php
		  $i=0;
		  $domain_name = $_SERVER['SERVER_NAME'];
          foreach ($images as $key => $image_row) {
			$target="";
            if ($i == $current_image_id) {
              $current_key = $key;
              ?>
              <span class="huge_it_slideshow_image_span_<?php echo $sliderID; ?>" id="image_id_<?php echo $sliderID.'_'.$i ?>">
                <span class="huge_it_slideshow_image_span1_<?php echo $sliderID; ?>">
                  <span class="huge_it_slideshow_image_span2_<?php echo $sliderID; ?>">
					<?php if($image_row->sl_url!=""){
						
						if (strpos($image_row->sl_url,$domain_name) === false){
							$target='target="_blank"';
						}
						
						echo '<a href="'.$image_row->sl_url.'" '.$target.' >';} ?>
                    <img id="huge_it_slideshow_image_<?php echo $sliderID; ?>"
                         class="huge_it_slideshow_image_<?php echo $sliderID; ?>"
                         src="<?php echo $image_row->image_url; ?>"
                         image_id="<?php echo $image_row->id; ?>" />
					<?php if($image_row->sl_url!=""){ echo '</a>'; }?>
                  </span>
                </span>
              </span>
             
              <?php
            }else {
			?>
              <span class="huge_it_slideshow_image_second_span_<?php echo $sliderID; ?>" id="image_id_<?php echo $sliderID.'_'.$i ?>">
                <span class="huge_it_slideshow_image_span1_<?php echo $sliderID; ?>">
                  <span class="huge_it_slideshow_image_span2_<?php echo $sliderID; ?>">
					<?php if($image_row->sl_url!=""){ 
						if (strpos($image_row->sl_url,$domain_name) === false){
							$target='target="_blank"';
						}
					echo '<a href="'.$image_row->sl_url.'" '.$target.'>';} ?>
                    <img id="huge_it_slideshow_image_<?php echo $sliderID; ?>"
						 class="huge_it_slideshow_image_<?php echo $sliderID; ?>"
                         src="<?php echo $image_row->image_url; ?>"
                         image_id="<?php echo $image_row->id; ?>" />
					<?php if($image_row->sl_url!=""){ echo '</a>'; }?>
                  </span>
                </span>
              </span>
             
              <?php
			}
			$i++;
          }
          ?>
		   <input type="hidden" id="huge_it_current_image_key_<?php echo $sliderID; ?>" value="0" />
            </div>
          </div>
        </div>
        
      </div>
      <?php

	  if($images[0]->name=='')$titleecho= 'none';
      ?>
	  <!-- ##########################TITLE######################### -->
      <div class="huge_it_slideshow_image_container_<?php echo $sliderID; ?> " style="position: absolute;">
        <div class="huge_it_slideshow_title_container_<?php echo $sliderID; ?>">
          <div style="display:table; margin:0 auto;">
            <span class="huge_it_slideshow_title_span_<?php echo $sliderID; ?>">
              <div class="huge_it_slideshow_title_text_<?php echo $sliderID." ".$titleecho; ?>">
                <?php echo $images[0]->name; ?>
              </div>
            </span>
          </div>
        </div>
      </div>
      <?php 

      if($images[0]->description=='')$titleecho= 'none';
      ?>
	  <!-- ##########################DESCRIPTION######################### -->
      <div class="huge_it_slideshow_image_container_<?php echo $sliderID; ?>" style="position: absolute;">
        <div class="huge_it_slideshow_description_container_<?php echo $sliderID; ?>">
          <div style="display:table; margin:0 auto;">
            <span class="huge_it_slideshow_description_span_<?php echo $sliderID; ?>">
              <div class="huge_it_slideshow_description_text_<?php echo $sliderID." ".$titleecho; ?>">
                <?php echo $images[0]->description; ?>
              </div>
            </span>
          </div>
        </div>
      </div>
  </div>
      <?php   
	return ob_get_clean();
}  
?>

