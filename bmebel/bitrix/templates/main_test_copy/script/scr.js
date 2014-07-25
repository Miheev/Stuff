var scroller=jQuery.browser.webkit ? "body": "html";

/* placeholder */
function placeholder() {
	if(!Modernizr.input.placeholder){
		$('[placeholder]').each(function() {
			$(this).watermark($(this).attr('placeholder'));
		});
	}
}

/* iosSliderInit */
function initIosSlider() {
	sdelay = isNaN(sdelay) ? 5000 : sdelay;

	// slider selectors
	var slidesNum = $('.slide').length;
	if (slidesNum > 1 ) {	
		var i = 0;
		while (i < slidesNum) {
			$('.slideSelectors').append('<div class="item" />');
			i++;
		}
		$('.slideSelectors .item:eq(0)').addClass('selected');
	}	
	
	$('.iosslider').iosSlider({
		snapToChildren: true,
		scrollbar: false,
		scrollbarHide: true,
		desktopClickDrag: true,
		navSlideSelector: $('.slideSelectors .item'),
		navPrevSelector: $('.sliderNav.slide-prev'),
		navNextSelector: $('.sliderNav.slide-next'),
		infiniteSlider:  true,
		responsiveSlideContainer : true,
		responsiveSlides : true,
		onSlideChange: slideChange,
		onSliderLoaded	: setSliderHeight,
		onSliderResize : setSliderHeight,
		autoSlide: true,
		autoSlideTimer: sdelay
	});
	
	// slider Change 
	function slideChange(args) {
		$('.slideSelectors .item').removeClass('selected');
		$('.slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');
	}	
		
	// set slider height
	function setSliderHeight() {
		var w = $('.iosslider').outerWidth();
		var h = parseInt(w/2.3)
		$('.iosslider').css({ height : h });
	}
};

/* fancybox */ 
function initFancybox() {
	$('.fancybox').fancybox({
		padding:0,
		scrolling: 'no',
		fitToView: false,
		autoSize : true,
	});
	
	$('.fancybox-dark').fancybox({
		padding:22,
		scrolling: 'no',
		fitToView: false,
		autoSize : true,
		margin :0,
		type: 'ajax',
		wrapCSS: 'fancybox-dark',
		beforeShow   : function() {
						this.inner.prepend('<div class="fancybox-dark-header"><a href="/"><img src="images/logo-white.png" alt=""/></a></div>' );
						niceImageChange();
						$('.order-popup .popup-form').zNice();
						uModalBlocks();
						placeholder();						
					},			
		afterClose : function() {
						uModalBlocks();
						
					},
		helpers : {
					overlay : {
						locked : false 
					}
		}
	});
	
	$('.fancybox-gal').fancybox({
		padding:[90, 40, 22, 40],
		scrolling: 'no',
		fitToView: false,
		autoSize : true,
		wrapCSS: 'fancybox-dark-gal',
		beforeShow   : function() {
						this.inner.prepend('<div class="fancybox-dark-header"><a href="/"><img src="images/logo-white.png" alt=""/></a></div>' );
					}
	});
}

/* footer height = footerplaceholder height fix */
function footerHeight() {
	$('.footer').addClass('active');
	$('.footer_placeholder').height($('.footer').outerHeight());
}

/* catalog ajax loader */
function catalog(){
	$('.ajax-preloader').addClass('active');
	$.ajax({
		url : 'ajax/catalog-item-ajax.php',
		success : function(response){
			var ajax_return = response;
			setTimeout(function(){
				$('.catalog-content').append(ajax_return);
				$('.catalog-item').fadeIn();
				$('.ajax-preloader').removeClass('active')
			}, 1000)
		}
	});
}
	
/* catlaog scroll position */
function scrollPosition(){
	var offsetTopBlock = $('.catalog').offset().top;
	var heightBlock = $('.catalog').height();
	var scrollChange = offsetTopBlock + heightBlock;
	var scrollBottom = $(window).scrollTop() + $(window).height()-$('.footer').height();
	if(scrollBottom>=scrollChange){
		catalog();
	}
};

/* radiolabel */
function radiolabel(){
	$('.radiolabel').click(function(){
		var parent = $(this).closest($('.radio-item'));
		$('.radiobutton .zNice-radio', parent).click();
	})
}

/* filter range */
function filterRange(){
	$( "#slider-range" ).slider({
		range: true,
		min: valmin,
		max: valmax,
		values: [ valmin, valmax ],
		slide: function( event, ui ) {
			$( "#areaFrom" ).val( ui.values[ 0 ] );
			$( "#areaTo" ).val( ui.values[ 1 ] );
		}
	});
	$('#slider-range .ui-slider-handle.ui-state-default.ui-corner-all:eq(0)').append('<span class="rangeBlock-input"><input type="text" name="fromprice" class = "inputrange" value="'+valmin+'" id="areaFrom"/></span>');
	$('#slider-range .ui-slider-handle.ui-state-default.ui-corner-all:eq(1)').append('<span class="rangeBlock-input"><input type="text" name="toprice" class = "inputrange" value="'+valmax+'" id="areaTo"/></span>');
	$('#slider-range').zNice();
	$('.rangeBlock-input').css('display' , 'none');
}

/* domenu */
function domenu(block){
	var mw=0;
	var $link = $(block+'>ul>li>a');
	
	$link.each(function(){
		$(this).css({'padding-left':'0','padding-right':'0'});
		mw+=$(this).innerWidth();
	});
	
	
	ai=$link.length;
	
	
	
	mw=830-mw;

	$link.each(function(){
		cpad=Math.round(mw/ai);
		$(this).css({'padding-left':Math.floor(cpad/2)+'px','padding-right':(Math.floor(cpad/2)+cpad%2)+'px'})
		mw-=cpad;
		ai--;
	});
};

/* modal window link */
function uModalBlocks() {
	// init modalblock 
	$('.u_modal-block').fadeOut(0);

	//  u_modal link
	$('.u_modal-link').click(function(e) {
		e.preventDefault();

		var $lnk = $(this)
		var uID = $lnk.data('umodal');
		
		$('.u_modal-block[data-umodal="'+ uID +'"]').stop().fadeToggle(350, function() {
			$(this).toggleClass('active');
			$('.u_modal-link[data-umodal="'+ uID +'"]').toggleClass('active');
		})
			
	});
		
	// modal block close button  
	$('.u_modal-close').click(function() {
		var uID = $(this).closest('.u_modal-block').data('umodal');
		$('.u_modal-block[data-umodal="'+ uID +'"]').stop().fadeOut(350, function() {
			$(this).removeClass('active');
			$('.u_modal-link[data-umodal="'+ uID +'"]').removeClass('active');
		})
	});	
	
	// close all modal if click not over him 
	$(document).click(function(event) {
		if ($(event.target).closest('.u_modal').length) return;
		
		$('.u_modal-block').fadeOut(350).removeClass('active');
		$('.u_modal-link').removeClass('active');
		event.stopPropagation();
	});
}

/* header phone List  */
function hPhoneList() {
	$('.h-list-item').on('click',function(){
		var $el = $(this);
		if (!$el.hasClass('active')){
			$el.parent().find('.active').removeClass('active');
			$el.addClass('active');
		}
	});
}

/* image nice change */
function niceImageChange() {
	$('.product-image-small').click(function() {
		var niceimgid = $(this).data('niceimgid');			
		$('.product-image-small').removeClass('active');
		$(this).addClass('active');
		
		$('.product-image').stop().animate({'opacity':'0'}, 600);


		$('.product-image[data-niceimgid="'+ niceimgid +'"]').stop().animate({'opacity':'1'},  600, function(){ 
			$('.product-image').removeClass('active');
			$('.product-image[data-niceimgid="'+ niceimgid +'"]').addClass('active');
		});
		
	return false;
	event.preventDefault();			
	});
	
	$('.product-image-small').eq(0).click();
}


/* DOCUMENT READY  ************** */
$(document).ready(function() {	
	placeholder();
	//domenu('.mainmenu');
	initFancybox();
	initIosSlider();
	footerHeight();
	radiolabel();
	filterRange();
	uModalBlocks();
	hPhoneList();
	niceImageChange()
});

/* WINDOW SCROLL  ************** */
$(window).scroll(function() {
	if ($('.catalog').length >0 ) {
		scrollPosition();
	}
});

/* WINDOW LOAD  ************** */
$(window).load(function() {
	domenu('.mainmenu');
});

/* WINDOW RESIZE  ************** */
$(window).resize(function() {
 
});













/* search Enter = submit */ 
function enterSubmit(block) {
	var $block = $(block);
	
	$('input', $block).keyup(function(e){
		if (e.which == 13) {
			$search.find('form').submit();
		}
	})
}






/* input only Number  */
function inputNumber(block) {	
	$('input', block).keypress(function(e) {
		if (e.which >= 47 && e.which <= 57 ){}
		else return false;
	});
	
	$('input', block).keyup(function() {
		$inputNum = $(this);
		if ($inputNum.val == '' || $inputNum.val() == 0) {
			$inputNum.val('1'); 
		}
	});
}	
	
/* nice number 1 000 000*/
function niceNumber(number, type) {
	if (type == 'f') {
		number = parseFloat(number).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
	} else if (type == 'i') {
		number = parseInt(number).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
	} 
	return number;
}






			

