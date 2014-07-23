/**
 * Created by storm on 7/23/14.
 */

var slider= undefined;
var sets= undefined;

$(document).ready(function(){
    mw = $('#slider').width();
    slmargin = 0.00;
    slwidth = 1-slmargin;

    sets = {
        /****************
         * General
         ****************/
        //mode: 'horizontal', /**/
        //speed: 500, /**/
        slideMargin: slmargin * mw,
        //startSlide: 0, /**/
        /*slideSelector*/
        //infiniteLoop: true, /**/
        //responsive: true, /**/
        //useCSS: true, /**/
        //preloadImages: 'visible', /**/
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
        /*nextText: 'Next',
         prevText: 'Prev'*/
        /*nextSelector:
         prevSelector:
         */
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
        minSlides: 1,
        maxSlides: 1,
        moveSlides: 1,
        slideWidth: slwidth * mw,
        /**********************
         * Callbacks
         ******************/
        onSliderLoad: function (curIndex) {
            if (!$('.bx-controls-direction').hasClass('invisible'))
                $('.bx-controls-direction').toggleClass('invisible');
            $('.slider-viewport')
                .mouseenter(function (e) {
                    e.preventDefault();
                    if ($('.bx-controls-direction').hasClass('invisible'))
                        $('.bx-controls-direction').toggleClass('invisible');
                })
                .mouseleave(function (e) {
                    e.preventDefault();
                    if (!$('.bx-controls-direction').hasClass('invisible'))
                        $('.bx-controls-direction').toggleClass('invisible');
                });
        }/*,
         onSlideBefore: switchIndicator,
         onSlideAfter: startTimeIndicator*/

    };
    if ($('.bxslider').length) {
        slider = $('.bxslider').bxSlider(sets);

        //startTimeIndicator(); // start the time line for the first slide

        $(window).resize(function () {
            mw = $('body').width();
            tmp= $('#slider').width();
            //if (tmp >= mediawidthmin && tmp < mediawidthmax) {
            sets.slideMargin = slmargin * mw;
            sets.slideWidth = slwidth * mw;
            slider.reloadSlider(sets);
            //}
        });
    }
});
