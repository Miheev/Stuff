bx_setting = {
    /****************
     * General
     ****************/
    //mode: 'horizontal', /**/
    //speed: 500, /**/
    slideMargin: 5,
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
    controls: true, /**/
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
    minSlides: 3,
    maxSlides: 5,
    moveSlides: 3,
    slideWidth: 150,
    /**********************
     * Callbacks
     ******************/
    onSliderLoad: function (curIndex) {
        tmp= jQuery('.bx-controls-direction');
        if (!tmp.hasClass('simple') && !tmp.hasClass('invisible')) {
            tmp.addClass('simple').addClass('invisible')
            jQuery('.slider-viewport')
                .mouseenter(function () {
                    jQuery('.bx-controls-direction').toggleClass('simple').toggleClass('invisible');
                })
                .mouseleave(function () {
                    jQuery('.bx-controls-direction').toggleClass('simple').toggleClass('invisible');
                });
        }
    }/*,
     onSlideBefore: switchIndicator,
     onSlideAfter: startTimeIndicator
        */
};

/*// This function runs before the slide transition starts
 var switchIndicator = function (jQueryc, jQueryn, currIndex, nextIndex) {

 jQuery('.time-indicator').stop().css('width', 0);  // kills the timeline by setting it's width to zero
 };

 // This function runs after the slide transition finishes
 var startTimeIndicator = function () {

 jQuerytimeIndicator.animate({width: '100%'}, 10000);          // start the timeline animation
 };*/

var bx_set= function (ids, sets) {
    if ((typeof ids) == 'undefined') {ids='.bxslider'; /*bx_ctrl_fix=ids;*/}
    if ((typeof sets) == 'undefined') sets= bx_setting;
    mw = jQuery('#zone-content').width();
    slmargin = 0.03;
    slwidth = 1-slmargin;
    img_border=2;

    sets.slideWidth= slwidth * mw / 5.0 - img_border;
    sets.slideMargin= slmargin * mw / 5.0 + img_border;

    if (jQuery(ids).length) {
        var slider = jQuery(ids).bxSlider(sets);

        //startTimeIndicator(); // start the time line for the first slide

        /*jQuery(window).resize(function () {
            mw = jQuery('.slider').width();
            tmp= jQuery('body').width();
            //if (tmp >= mediawidthmin && tmp < mediawidthmax) {
            setting.slideMargin = slmargin * mw / 5.0;
            setting.slideWidth = slwidth * mw / 5.0;
            slider.reloadSlider(setting);
            //}
        });*/
    }
}