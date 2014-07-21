$(document).ready(function () {
    jQuery('ul.sf-menu').superfish();

    mw = $('.main').width();
    slmargin = 0.0;
    slwidth = 1-slmargin;

    /*Aside Slider*/
    aw = $('.main .content-wrapper aside').width();
    aslmargin = 0.05;
    aslwidth = 1-aslmargin;

    // This function runs before the slide transition starts
     var switchIndicator = function ($c, $n, currIndex, nextIndex) {

        $('.time-indicator').stop().css('width', 0);  // kills the timeline by setting it's width to zero
     };

     // This function runs after the slide transition finishes
     var startTimeIndicator = function () {

         $('.time-indicator').animate({width: '100%'}, 10000);          // start the timeline animation
     };

    setting = {
        /****************
         * General
         ****************/
        //mode: 'horizontal', /**/
        //speed: 500, /**/
        slideMargin: slmargin,
        //startSlide: 0, /**/
        /*slideSelector*/
        //infiniteLoop: true, /**/
        //responsive: true, /**/
        //useCSS: true, /**/
        preloadImages: 'visible', /**/
        //touchEnabled: true, /**/
        //swipeThreshold: 50, /**/
        //oneToOneTouch: true, /**/
        //preventDefaultSwipeX: true, /****/
        /********************
         * Pager
         ********************/
        pager: false,
        /*******************
         * Controls
         *******************/
        //controls: true, /**/
        nextText: 'Для бизнеса',
         prevText: 'Для дома',
        nextSelector: '.sl-1 .s-right',
         prevSelector: '.sl-1 .s-left',

        /******************
         * Auto
         ******************/
        auto: true,
        pause: 5000,
        //autoStart: true, /**/
        /*autoDirection: 'next'*/
        autoHover: true,
        /**********************
         * Carousel
         **********************/
        minSlides: 2,
        maxSlides: 2,
        moveSlides: 2,
        slideWidth: slwidth * mw / 2.0,
        /**********************
         * Callbacks
         ******************/
        onSliderLoad: function (curIndex) {
            $('.sl-1 .bx-controls-direction').toggleClass('invisible');
            $('.sl-1 .slider-viewport')
                .mouseenter(function () {
                    $('.sl-1 .bx-controls-direction').toggleClass('invisible');
                })
                .mouseleave(function () {
                    $('.sl-1 .bx-controls-direction').toggleClass('invisible');
                });
        },
         onSlideBefore: switchIndicator,
         onSlideAfter: startTimeIndicator

    };
    aset = {
        slideMargin: aslmargin,
        preloadImages: 'visible', /**/
        pager: false,
        nextText: ' ',
        prevText: ' ',
        nextSelector: '.sl-2 .s-right',
        prevSelector: '.sl-2 .s-left',
        auto: true,
        pause: 5000,
        autoHover: true,
        minSlides: 1,
        maxSlides: 1,
        moveSlides: 1,
        slideWidth: aslwidth * aw / 2,
        /**********************
         * Callbacks
         ******************/
        onSliderLoad: function (curIndex) {
            $('.sl-2 .bx-controls-direction').toggleClass('invisible');
            $('.sl-2 .slider-viewport')
                .mouseenter(function () {
                    $('.sl-2 .bx-controls-direction').toggleClass('invisible');
                })
                .mouseleave(function () {
                    $('.sl-2 .bx-controls-direction').toggleClass('invisible');
                });
        }

    };
    if ($('.bxslider').length) {
        var slider = $('.bxslider.sl-1').bxSlider(setting);
        var aslider = $('.bxslider.sl-2').bxSlider(aset);

        $('.sl-1 .arrows .s-left').not('a').click(function(e){
            slider.goToPrevSlide();
        });
        $('.sl-1 .arrows .s-right').not('a').click(function(e){
            slider.goToNextSlide();
        });

        $('.sl-2 .arrows .s-left').not('a').click(function(e){
            aslider.goToPrevSlide();
        });
        $('.sl-2 .arrows .s-right').not('a').click(function(e){
            aslider.goToNextSlide();
        });

        //startTimeIndicator(); // start the time line for the first slide

        $(window).resize(function () {
            mw = $('.slider').width();
            tmp= $('body').width();

            /*Aside Slider*/
            aw = $('.main .content-wrapper aside').width();

            //if (tmp >= mediawidthmin && tmp < mediawidthmax) {
            setting.slideMargin = slmargin;
            setting.slideWidth = slwidth * mw / 2.0;
            slider.reloadSlider(setting);

            aset.slideMargin = slmargin;
            aset.slideWidth = aslwidth * aw / 2.0;
            aslider.reloadSlider(aset);
            //}
        });

        if($('.hoverBox').length){
            //prettyPhoto
            $('a[rel^=\'prettyOverlay\'],a[rel^=\'prettyPhoto466\']').prettyPhoto({
                animation_speed: 'fast',
                show_title: false,
                opacity: 0.6,
                allowresize: true,
                counter_separator_label: '/',
                overlay_gallery: 1,
                theme: 'dark_rounded'
            });
        }
    }

});
