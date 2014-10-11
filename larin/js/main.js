var slider= undefined;
var sets= undefined;

var bslider= undefined;
var bsets= undefined;

$(document).ready(function(){

    id= -1;
    shown= false;
    left= -1.5;
    margin= 10;
    $('.menu-in nav li').mouseenter(function(){
        pid= $('.menu-in nav li').index($(this));
        if (pid == id && shown)
            return;
        id=pid;
        count= $('.menu-in .item').length - 1;
        $('.menu-in .item').stop(true, true);
        $('.menu-in .item').slideUp();

        if (id == count)
            $('.menu-in .item').eq(id).css('left', (left+(id-1)*(100/3 - 2*margin/3 + margin))+'%');
        else
            $('.menu-in .item').eq(id).css('left', (left+id*(100/3 - 2*margin/3 + margin))+'%');

        $('.menu-in .item').eq(id).slideDown(400, function(){
            shown= true;
            $(this).delay(5000).slideUp(400, function(){
                shown= false;
            });
        });
    });
    $('.menu-in .item').mouseleave(function(){
        $(this).stop(true, true);
        $(this).delay(500).slideUp(400, function(){
            shown= false;
        });
    });
    $('.menu-in .item').mouseenter(function(){
        $(this).stop(true, true);
    });

    if ($('body.index').length) {

        setTimeout(function(){
            if ($('.bxslider').length) {
                mw = $('.flip-block .bxslider').width();
                slmargin = 0.05;
                slwidth = 1-slmargin;

                bmw = $('.branding .bxslider').width();
                bslmargin = 0.00;
                bslwidth = 1-bslmargin;


                sets = {
                    slideMargin: (slmargin * mw)/2,
                    pager: false,
                    auto: true,
                    pause: 10000,
                    autoHover: true,
                    minSlides: 3,
                    maxSlides: 3,
                    moveSlides: 3,
                    slideWidth: (slwidth * mw)/3,
                    onSliderLoad: function (curIndex) {
                        if (!$('.flip-block .bx-controls-direction').hasClass('invisible'))
                            $('.flip-block .bx-controls-direction').toggleClass('invisible');
                        $('.flip-block .slider-viewport')
                            .mouseenter(function (e) {
                                e.preventDefault();
                                if ($('.flip-block .bx-controls-direction').hasClass('invisible'))
                                    $('.flip-block .bx-controls-direction').toggleClass('invisible');
                            })
                            .mouseleave(function (e) {
                                e.preventDefault();
                                if (!$('.flip-block .bx-controls-direction').hasClass('invisible'))
                                    $('.flip-block .bx-controls-direction').toggleClass('invisible');
                            });
                    }/*,
                     onSlideBefore: switchIndicator,
                     onSlideAfter: startTimeIndicator*/

                };
                bsets = {
                    /****************
                     * General
                     ****************/
                    //mode: 'horizontal', /**/
                    //speed: 500, /**/
                    slideMargin: (bslmargin * bmw),
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
                    slideWidth: (bslwidth * bmw),
                    onSliderLoad: function (curIndex) {
                        if (!$('.branding .bx-controls-direction').hasClass('invisible'))
                            $('.branding .bx-controls-direction').toggleClass('invisible');
                        $('.branding .slider-viewport')
                            .mouseenter(function (e) {
                                e.preventDefault();
                                if ($('.branding .bx-controls-direction').hasClass('invisible'))
                                    $('.branding .bx-controls-direction').toggleClass('invisible');
                            })
                            .mouseleave(function (e) {
                                e.preventDefault();
                                if (!$('.branding .bx-controls-direction').hasClass('invisible'))
                                    $('.branding .bx-controls-direction').toggleClass('invisible');
                            });
                    }/*,
                     onSlideBefore: switchIndicator,
                     onSlideAfter: startTimeIndicator*/

                };

                slider = $('.flip-block .bxslider').bxSlider(sets);
                bslider = $('.branding .bxslider').bxSlider(bsets);

                //startTimeIndicator(); // start the time line for the first slide

                $(window).resize(function () {
                    mw = $('.flip-block .bxslider').width();
                    bmw = $('.branding .bxslider').width();

                    //if (tmp >= mediawidthmin && tmp < mediawidthmax) {
                    sets.slideMargin = (slmargin * mw)/2;
                    sets.slideWidth = (slmargin * mw)/3;
                    bsets.slideMargin = (slmargin * mw);
                    bsets.slideWidth = (slmargin * mw);

                    slider.reloadSlider(sets);
                    bslider.reloadSlider(bsets);
                    //}
                });
            }
        }, 100);
    }

});