	var huge_it_transition_duration = <?php echo $_GET["speed"];?>;
	// For browsers that does not support transitions.
	function huge_it_fallback(current_image_class, next_image_class, direction) {
		huge_it_<?php echo $_GET["effect"];?>(current_image_class, next_image_class, direction);
		
	}
	
	function huge_it_<?php echo $_GET["effect"];?>(current_image_class, next_image_class, direction) {
	
		if (huge_it_testBrowser_cssTransitions()) {
		  jQuery(next_image_class).css('transition', 'opacity ' + huge_it_transition_duration + 'ms linear');
		  jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
		  jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
		}
		else {
		  jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, huge_it_transition_duration);
		  jQuery(next_image_class).animate({
			  'opacity' : 1,
			  'z-index': 2
			});
		  // For IE.
		  jQuery(current_image_class).fadeTo(huge_it_transition_duration, 0);
		  jQuery(next_image_class).fadeTo(huge_it_transition_duration, 1);
		}
	}
	

  var huge_it_trans_in_progress = false;
     
      var huge_it_playInterval;
      // Stop autoplay.
      clearInterval(huge_it_playInterval);

     

      var huge_it_current_key = 0;
      var huge_it_current_filmstrip_pos = 0;
      // Set filmstrip initial position.
      function huge_it_set_filmstrip_pos(filmStripWidth) {
        var selectedImagePos = -huge_it_current_filmstrip_pos - (jQuery(".huge_it_slideshow_filmstrip_thumbnail").width() + 2) / 2;
        var imagesContainerLeft = Math.min(0, Math.max(filmStripWidth - jQuery(".huge_it_slideshow_filmstrip_thumbnails").width(), selectedImagePos + filmStripWidth / 2));
        jQuery(".huge_it_slideshow_filmstrip_thumbnails").animate({
            left: imagesContainerLeft
          }, {
            duration: 500,
            complete: function () { huge_it_filmstrip_arrows(); }
          });
      }
      function huge_it_move_filmstrip() {
        var image_left = jQuery(".huge_it_slideshow_thumb_active").position().left;
        var image_right = jQuery(".huge_it_slideshow_thumb_active").position().left + jQuery(".huge_it_slideshow_thumb_active").outerWidth(true);
        var huge_it_filmstrip_width = jQuery(".huge_it_slideshow_filmstrip").outerWidth(true);
        var long_filmstrip_cont_left = jQuery(".huge_it_slideshow_filmstrip_thumbnails").position().left;
        var long_filmstrip_cont_right = Math.abs(jQuery(".huge_it_slideshow_filmstrip_thumbnails").position().left) + huge_it_filmstrip_width;
        if (image_left < Math.abs(long_filmstrip_cont_left)) {
          jQuery(".huge_it_slideshow_filmstrip_thumbnails").animate({
            left: -image_left
          }, {
            duration: 500,
            complete: function () { huge_it_filmstrip_arrows(); }
          });
        }
        else if (image_right > long_filmstrip_cont_right) {
          jQuery(".huge_it_slideshow_filmstrip_thumbnails").animate({
            left: -(image_right - huge_it_filmstrip_width)
          }, {
            duration: 500,
            complete: function () { huge_it_filmstrip_arrows(); }
          });
        }
      }
      // Show/hide filmstrip arrows.
      function huge_it_filmstrip_arrows() {
        if (jQuery(".huge_it_slideshow_filmstrip_thumbnails").width() < jQuery(".huge_it_slideshow_filmstrip").width()) {
          jQuery(".huge_it_slideshow_filmstrip_left").hide();
          jQuery(".huge_it_slideshow_filmstrip_right").hide();
        }
        else {
          jQuery(".huge_it_slideshow_filmstrip_left").show();
          jQuery(".huge_it_slideshow_filmstrip_right").show();
        }
      }

      function huge_it_testBrowser_cssTransitions() {
        return huge_it_testDom('Transition');
      }
      function huge_it_testBrowser_cssTransforms3d() {
        return huge_it_testDom('Perspective');
      }
      function huge_it_testDom(prop) {
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
	  
	  
	  
	  
	  
      function huge_it_cube(tz, ntx, nty, nrx, nry, wrx, wry, current_image_class, next_image_class, direction) {
		// If browser does not support 3d transforms/CSS transitions.
        if (!huge_it_testBrowser_cssTransitions()) {
          return huge_it_fallback(current_image_class, next_image_class, direction);
        }
        if (!huge_it_testBrowser_cssTransforms3d()) {
          return huge_it_fallback3d(current_image_class, next_image_class, direction);
        }
        huge_it_trans_in_progress = true;
        jQuery(".huge_it_slide_bg").css('perspective', 1000);

        jQuery(current_image_class).css({
          transform : 'translateZ(' + tz + 'px)',
          backfaceVisibility : 'hidden'
        });
        jQuery(next_image_class).css({
          opacity : 1,
          backfaceVisibility : 'hidden',
          transform : 'translateY(' + nty + 'px) translateX(' + ntx + 'px) rotateY('+ nry +'deg) rotateX('+ nrx +'deg)'
        });
        jQuery(".huge_it_slider").css({
          transform: 'translateZ(-' + tz + 'px)',
          transformStyle: 'preserve-3d'
        });
        // Execution steps.
        setTimeout(function () {
          jQuery(".huge_it_slider").css({
            transition: 'all ' + huge_it_transition_duration + 'ms ease-in-out',
            transform: 'translateZ(-' + tz + 'px) rotateX('+ wrx +'deg) rotateY('+ wry +'deg)'
          });
        }, 20);
        // After transition.

			jQuery(".huge_it_slider").one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(huge_it_after_trans));
			function huge_it_after_trans() {
			   jQuery(".huge_it_slide_bg").removeAttr('style');
			  jQuery(current_image_class).removeAttr('style');
			  jQuery(next_image_class).removeAttr('style');
			  
			  jQuery(".huge_it_slider").removeAttr('style');
			  jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
			  jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
			 
			  huge_it_trans_in_progress = false;		 
			}

	  }
	  
	  
	  
	  
	  
      function huge_it_cubeH(current_image_class, next_image_class, direction) {
        // Set to half of image width.
        var dimension = jQuery(current_image_class).width() / 2;
        if (direction == 'right') {
          huge_it_cube(dimension, dimension, 0, 0, 90, 0, -90, current_image_class, next_image_class, direction);
        }
        else if (direction == 'left') {
          huge_it_cube(dimension, -dimension, 0, 0, -90, 0, 90, current_image_class, next_image_class, direction);
        }
      }
      function huge_it_cubeV(current_image_class, next_image_class, direction) {
        // Set to half of image height.
        var dimension = jQuery(current_image_class).height() / 2;
        // If next slide.
        if (direction == 'right') {
          huge_it_cube(dimension, 0, -dimension, 90, 0, -90, 0, current_image_class, next_image_class, direction);
        }
        else if (direction == 'left') {
          huge_it_cube(dimension, 0, dimension, -90, 0, 90, 0, current_image_class, next_image_class, direction);
        }
      }
      // For browsers that does not support transitions.
      function huge_it_fallback(current_image_class, next_image_class, direction) {
	  
        huge_it_(current_image_class, next_image_class, direction);
      }
      // For browsers that support transitions, but not 3d transforms (only used if primary transition makes use of 3d-transforms).
      function huge_it_fallback3d(current_image_class, next_image_class, direction) {
        huge_it_sliceV(current_image_class, next_image_class, direction);
      }
      function huge_it_none(current_image_class, next_image_class, direction) {
        jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
        jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
      }
      function huge_it_(current_image_class, next_image_class, direction) {
		
        if (huge_it_testBrowser_cssTransitions()) {
          jQuery(next_image_class).css('transition', 'opacity ' + huge_it_transition_duration + 'ms linear');
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
        }
        else {
          jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, huge_it_transition_duration);
          jQuery(next_image_class).animate({
              'opacity' : 1,
              'z-index': 2
            });
          // For IE.
          jQuery(current_image_class).fadeTo(huge_it_transition_duration, 0);
          jQuery(next_image_class).fadeTo(huge_it_transition_duration, 1);
        }
      }
      function huge_it_grid(cols, rows, ro, tx, ty, sc, op, current_image_class, next_image_class, direction) {
        // If browser does not support CSS transitions.
        if (!huge_it_testBrowser_cssTransitions()) {
          return huge_it_fallback(current_image_class, next_image_class, direction);
        }
        huge_it_trans_in_progress = true;
        // The time (in ms) added to/subtracted from the delay total for each new gridlet.
        var count = (huge_it_transition_duration) / (cols + rows);
        // Gridlet creator (divisions of the image grid, positioned with background-images to replicate the look of an entire slide image when assembled)
        function huge_it_gridlet(width, height, top, img_top, left, img_left, src, imgWidth, imgHeight, c, r) {
          var delay = (c + r) * count;
          // Return a gridlet elem with styles for specific transition.
          return jQuery('<div class="huge_it_gridlet" />').css({
            width : width,
            height : height,
            top : top,
            left : left,
            backgroundImage : 'url("' + src + '")',
            backgroundColor: jQuery(".huge_it_slideshow_image_wrap").css("background-color"),
            /*backgroundColor: rgba(0, 0, 0, 0),*/
            backgroundRepeat: 'no-repeat',
            backgroundPosition : img_left + 'px ' + img_top + 'px',
            backgroundSize : imgWidth + 'px ' + imgHeight + 'px',
            transition : 'all ' + huge_it_transition_duration + 'ms ease-in-out ' + delay + 'ms',
            transform : 'none'
          });
        }
        // Get the current slide's image.
        var cur_img = jQuery(current_image_class).find('img');
        // Create a grid to hold the gridlets.
        var grid = jQuery('<div />').addClass('huge_it_grid');
        // Prepend the grid to the next slide (i.e. so it's above the slide image).
        jQuery(current_image_class).prepend(grid);
        // vars to calculate positioning/size of gridlets
        var cont = jQuery(".huge_it_slide_bg");
        var imgWidth = cur_img.width();
        var imgHeight = cur_img.height();
        var contWidth = cont.width(),
            contHeight = cont.height(),
            imgSrc = cur_img.attr('src'),//.replace('/thumb', ''),
            colWidth = Math.floor(contWidth / cols),
            rowHeight = Math.floor(contHeight / rows),
            colRemainder = contWidth - (cols * colWidth),
            colAdd = Math.ceil(colRemainder / cols),
            rowRemainder = contHeight - (rows * rowHeight),
            rowAdd = Math.ceil(rowRemainder / rows),
            leftDist = 0,
            img_leftDist = (jQuery(".huge_it_slide_bg").width() - cur_img.width()) / 2;
        // tx/ty args can be passed as 'auto'/'min-auto' (meaning use slide width/height or negative slide width/height).
        tx = tx === 'auto' ? contWidth : tx;
        tx = tx === 'min-auto' ? - contWidth : tx;
        ty = ty === 'auto' ? contHeight : ty;
        ty = ty === 'min-auto' ? - contHeight : ty;
        // Loop through cols
        for (var i = 0; i < cols; i++) {
          var topDist = 0,
              img_topDst = (jQuery(".huge_it_slide_bg").height() - cur_img.height()) / 2,
              newColWidth = colWidth;
          // If imgWidth (px) does not divide cleanly into the specified number of cols, adjust individual col widths to create correct total.
          if (colRemainder > 0) {
            var add = colRemainder >= colAdd ? colAdd : colRemainder;
            newColWidth += add;
            colRemainder -= add;
          }
          // Nested loop to create row gridlets for each col.
          for (var j = 0; j < rows; j++)  {
            var newRowHeight = rowHeight,
                newRowRemainder = rowRemainder;
            // If contHeight (px) does not divide cleanly into the specified number of rows, adjust individual row heights to create correct total.
            if (newRowRemainder > 0) {
              add = newRowRemainder >= rowAdd ? rowAdd : rowRemainder;
              newRowHeight += add;
              newRowRemainder -= add;
            }
            // Create & append gridlet to grid.
            grid.append(huge_it_gridlet(newColWidth, newRowHeight, topDist, img_topDst, leftDist, img_leftDist, imgSrc, imgWidth, imgHeight, i, j));
            topDist += newRowHeight;
            img_topDst -= newRowHeight;
          }
          img_leftDist -= newColWidth;
          leftDist += newColWidth;
        }
        // Set event listener on last gridlet to finish transitioning.
        var last_gridlet = grid.children().last();
        // Show grid & hide the image it replaces.
        grid.show();
        cur_img.css('opacity', 0);
        // Add identifying classes to corner gridlets (useful if applying border radius).
        grid.children().first().addClass('rs-top-left');
        grid.children().last().addClass('rs-bottom-right');
        grid.children().eq(rows - 1).addClass('rs-bottom-left');
        grid.children().eq(- rows).addClass('rs-top-right');
        // Execution steps.
        setTimeout(function () {
          grid.children().css({
            opacity: op,
            transform: 'rotate('+ ro +'deg) translateX('+ tx +'px) translateY('+ ty +'px) scale('+ sc +')'
          });
        }, 1);
        jQuery(next_image_class).css('opacity', 1);
        // After transition.
        jQuery(last_gridlet).one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(huge_it_after_trans));
        function huge_it_after_trans() {
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          cur_img.css('opacity', 1);

          grid.remove();
          huge_it_trans_in_progress = false;
        }
      }
      function huge_it_sliceH(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateX = 'min-auto';
        }
        else if (direction == 'left') {
          var translateX = 'auto';
        }
        huge_it_grid(1, 8, 0, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
      }
      function huge_it_sliceV(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateY = 'min-auto';
        }
        else if (direction == 'left') {
          var translateY = 'auto';
        }
        huge_it_grid(10, 1, 0, 0, translateY, 1, 0, current_image_class, next_image_class, direction);
      }

      function huge_it_slideV(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateY = 'auto';
        }
        else if (direction == 'left') {
          var translateY = 'min-auto';
        }
        huge_it_grid(1, 1, 0, 0, translateY, 1, 1, current_image_class, next_image_class, direction);
      }

      function huge_it_slideH(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateX = 'min-auto';
        }
        else if (direction == 'left') {
          var translateX = 'auto';
        }
        huge_it_grid(1, 1, 0, translateX, 0, 1, 1, current_image_class, next_image_class, direction);
      }

      function huge_it_scaleOut(current_image_class, next_image_class, direction) {
        huge_it_grid(1, 1, 0, 0, 0, 1.5, 0, current_image_class, next_image_class, direction);
      }
      
      function huge_it_scaleIn(current_image_class, next_image_class, direction) {
        huge_it_grid(1, 1, 0, 0, 0, 0.5, 0, current_image_class, next_image_class, direction);
      }

      function huge_it_blockScale(current_image_class, next_image_class, direction) {
        huge_it_grid(8, 6, 0, 0, 0, .6, 0, current_image_class, next_image_class, direction);
      }

      function huge_it_kaleidoscope(current_image_class, next_image_class, direction) {
        huge_it_grid(10, 8, 0, 0, 0, 1, 0, current_image_class, next_image_class, direction);
      }

      function huge_it_fan(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var rotate = 45;
          var translateX = 100;
        }
        else if (direction == 'left') {
          var rotate = -45;
          var translateX = -100;
        }
        huge_it_grid(1, 10, rotate, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
      }

      function huge_it_blindV(current_image_class, next_image_class, direction) {
        huge_it_grid(1, 8, 0, 0, 0, .7, 0, current_image_class, next_image_class);
      }

      function huge_it_blindH(current_image_class, next_image_class, direction) {
        huge_it_grid(10, 1, 0, 0, 0, .7, 0, current_image_class, next_image_class);
      }
	  
      function huge_it_random(current_image_class, next_image_class, direction) {
        var anims = ['sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV'];
        // Pick a random transition from the anims array.
		
        this["huge_it_" + anims[Math.floor(Math.random() * anims.length)] + ""](current_image_class, next_image_class, direction);
      }
      
	  function iterator() {
        var iterator = 1;

        return iterator;
      }

	function huge_it_change_image(current_key, key, sliderdata) {
			
		if (huge_it_trans_in_progress) {
		  return;
		}
		var direction = 'right';
		if (huge_it_current_key > key) {
		  var direction = 'left';
		}
		else if (huge_it_current_key == key) {
		  return;
		}
		
		// Hide previous/next buttons on first/last images.
		if (sliderdata[key]) {
		  if (current_key == '-1') { // Filmstrip.
			current_key = jQuery(".huge_it_slideshow_thumb_active").children("img").attr("image_key");
		  }
		  else if (current_key == '-2') { // Dots.
			current_key = jQuery(".huge_it_slideshow_dots_active").attr("image_key");
		  }

		 // jQuery(".huge_it_slideshow_title_text").css({display: 'none'});
		//  jQuery(".huge_it_slideshow_description_text").css({display: 'none'});
		  // Set active thumbnail.
		  jQuery(".huge_it_slideshow_filmstrip_thumbnail").removeClass("huge_it_slideshow_thumb_active").addClass("huge_it_slideshow_thumb_deactive");
		  jQuery("#huge_it_filmstrip_thumbnail_" + key + "").removeClass("huge_it_slideshow_thumb_deactive").addClass("huge_it_slideshow_thumb_active");
		  jQuery(".huge_it_slideshow_dots").removeClass("huge_it_slideshow_dots_active").addClass("huge_it_slideshow_dots_deactive");
		  jQuery("#huge_it_dots_" + key + "").removeClass("huge_it_slideshow_dots_deactive").addClass("huge_it_slideshow_dots_active");          

		 
		  huge_it_current_key = key;
		  

		  // Change image id, key, title, description.
		  jQuery("#huge_it_current_image_key").val(key);
		  jQuery("#huge_it_slideshow_image").attr('image_id', sliderdata[key]["id"]);
		  
		  
		  jQuery(".huge_it_slideshow_title_text").html(sliderdata[key]["alt"]);
		  jQuery(".huge_it_slideshow_description_text").html(sliderdata[key]["description"]);
			
			
		  var current_image_class = "#image_id_" + sliderdata[current_key]["id"];
		
		  var next_image_class = "#image_id_" + sliderdata[key]["id"];
		 // alert(current_image_class+","+next_image_class+","+direction);
		  huge_it_<?php echo $_GET["effect"];?>(current_image_class, next_image_class, direction);
		}
	
		
		//prpr
		jQuery('.huge_it_slideshow_title_text').removeClass('none');
		if(jQuery('.huge_it_slideshow_title_text').html()==""){jQuery('.huge_it_slideshow_title_text').addClass('none');}
		
		jQuery('.huge_it_slideshow_description_text').removeClass('none');
		if(jQuery('.huge_it_slideshow_description_text').html()==""){jQuery('.huge_it_slideshow_description_text').addClass('none');}
	}
	
	
	
		
     function huge_it_popup_resize() {
		
      
	   //standart chap vor@ voroshvac chi bnav template um
	   
		var staticsliderwidth=<?php echo $_GET["width"];?>;
		var sliderwidth=<?php echo $_GET["width"];?>;
		
		var bodyWidth=jQuery(window).width();
		var	parentWidth=jQuery(".huge_it_slideshow_image_wrap").parent().width();
		
		//tryuk vor hankarc responsive.js @  ushana body i chap@ verci vochte verevi div i 
		if(sliderwidth>parentWidth){sliderwidth=parentWidth;}
		if(sliderwidth>bodyWidth){sliderwidth=bodyWidth;}
		
		var str=(<?php echo $_GET["height"];?>/staticsliderwidth  );
		//alert(parentWidth+' '+bodyWidth+' '+firstsize);
	
	
			jQuery(".huge_it_slideshow_image_wrap").css({width:sliderwidth});
           jQuery(".huge_it_slideshow_image_wrap").css({height: ((sliderwidth) * str)});
		
		 
		   jQuery(".huge_it_slideshow_image_wrap > div").css({height: ((sliderwidth) * str)});
		   jQuery(".huge_it_slideshow_title_container > div").css({height: ((sliderwidth) * str)});
			
				
		  jQuery(".huge_it_slideshow_image_container").css({width: (sliderwidth)});
		  jQuery(".huge_it_slideshow_image_container").css({height: ((sliderwidth) * str)});
		  
		  
  
		 if("<?php echo $_GET["cropresize"];?>"=="resize"){ 	
			jQuery(".huge_it_slideshow_image").css({
				maxWidth: sliderwidth,
				minHeight:((sliderwidth) * str)
			});
			
			jQuery(".huge_it_slideshow_image").css({
				maxHeight: ((sliderwidth) * str),
				height: ((sliderwidth) * str)
			});
		  }
       

          jQuery(".huge_it_slideshow_filmstrip_container").css({width: (sliderwidth)});
          jQuery(".huge_it_slideshow_filmstrip").css({width: (sliderwidth - 40)});
          jQuery(".huge_it_slideshow_dots_container").css({width: (sliderwidth)});   
      }
	  
      
	  
      jQuery(document).ready(function () {
		huge_it_popup_resize();
		jQuery(window).resize(function() {
			huge_it_popup_resize();
		});
		
		
        var huge_it_click = jQuery.browser.mobile ? 'touchend' : 'click';
       // huge_it_popup_resize();
       
       // jQuery(".huge_it_slideshow_title_text").css({display: 'none'});
      //  jQuery(".huge_it_slideshow_description_text").css({display: 'none'});

        // Set image container height.
        jQuery(".huge_it_slideshow_image_container").height(jQuery(".huge_it_slideshow_image_wrap").height() - 0);
        
        /*var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
        jQuery('.huge_it_slideshow_filmstrip').bind(mousewheelevt, function(e) {
          var evt = window.event || e //equalize event object     
          evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
          var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF
          if (delta > 0) {
            // Scroll up.
            jQuery(".huge_it_slideshow_filmstrip_left").trigger("click");
          }
          else {
            // Scroll down.
            jQuery(".huge_it_slideshow_filmstrip_right").trigger("click");
          }
        });*/


        // Set filmstrip initial position.
        huge_it_set_filmstrip_pos(jQuery(".huge_it_slideshow_filmstrip").width());

        // Play/pause.

        
        function play() {
          // PLay.            
          huge_it_playInterval = setInterval(function () {
            var iterator = 1;
            if (0) {
              iterator = Math.floor((sliderdata.length - 1) * Math.random() + 1);
            }
            /*if (!sliderdata[parseInt(jQuery('#huge_it_current_image_key').val()) + iterator]) {
              // Wrap around.
              jQuery('#huge_it_current_image_key').val((parseInt(jQuery('#huge_it_current_image_key').val()) + iterator) % sliderdata.length - 1);
            }*/
            huge_it_change_image(parseInt(jQuery('#huge_it_current_image_key').val()), (parseInt(jQuery('#huge_it_current_image_key').val()) + 1) % sliderdata.length, sliderdata)
          }, '<?php echo $_GET["pausetime"];?>');
		 
        }
		

			jQuery("#huge_it_slideshow_image_container, .huge_it_slideshow_image_container, .huge_it_slideshow_dots_container,#huge_it_slideshow_right,#huge_it_slideshow_left").hover(function(){
				jQuery("#huge_it_slideshow_right").css({'display':'inline'});
				jQuery("#huge_it_slideshow_left").css({'display':'inline'});
			},function(){
				jQuery("#huge_it_slideshow_right").css({'display':'none'});
				jQuery("#huge_it_slideshow_left").css({'display':'none'});
			});
			
			var pausehover="<?php echo $_GET["pausehover"];?>";
			if(pausehover=="on"){
				jQuery("#huge_it_slideshow_image_container, .huge_it_slideshow_image_container, .huge_it_slideshow_dots_container,#huge_it_slideshow_right,#huge_it_slideshow_left").hover(function(){clearInterval(huge_it_playInterval);},function(){play();});
				
			
			}

		
		
        if (1) {
          play();
          jQuery(".huge_it_slideshow_play_pause").attr("title", "Pause");
          jQuery(".huge_it_slideshow_play_pause").attr("class", "huge_it_ctrl_btn huge_it_slideshow_play_pause fa fa-pause");
        }
		


      });
