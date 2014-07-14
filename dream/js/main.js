var slider= undefined;
var sets= undefined;

$(document).ready(function(){
    $('footer .right .right select').chosen({disable_search_threshold: 10, width: '140px'});
    $('header.header .user .personal select').chosen({disable_search_threshold: 10, width: '100px'});

    if ($('body.dreams').length) {
        $("div.range-1").noUiSlider({
            start: [0, 100],
            step: 5,
            margin: 20,
            connect: true,
            behaviour: 'tap-drag',
            range: {
                'min': 0,
                'max': 100
            },
            serialization: {
                lower: [
                    $.Link({
                        target: $(".range-in")
                    })
                ],
                upper: [
                    $.Link({
                        target: $(".range-out")
                    })
                ],
                format: {
                    mark: '%',
                    decimals: 0
                }
            }
        });

        $("input[name='dream']").kalypto();


//            var offset = $("#fixblock").offset(); // запоминаем первоначальные отсупы
//            $(window).scroll(function() { // во время скроллинга
//                if ($(window).scrollTop() > offset.top) { // Если скроллинг больше первоначальной позиции
//                    $("#fixblock").stop().animate({marginTop: $(window).scrollTop() - offset.top}); // увиличиваем отступ сверху
//                }else{
//                    $("#fixblock").stop().animate({marginTop: 0}); // Иначе отступ нулевой
//                }
//            });

        $(window).scroll(function(){
            var aTop = $('header.header').height() + $('.menu-container').height();
            var afooter = aTop + $('.main-container').height()*0.72;

            if ($(this).scrollTop()>=aTop){
                $('#fixblock').addClass('sticky');
            } else
                $('#fixblock').removeClass('sticky');

            delta= $(this).scrollTop() - afooter;
            delta= (delta < 0)? delta: -delta;
            if ($(this).scrollTop()>=afooter){
                $('#fixblock').css('top', delta);
            } else
                $('#fixblock').css('top', 0);
        });
    }

    /**
     * Created by storm on 4/13/14. Riverside / Sound Couture /One Ok Rock / Foreground Eclipse / Flaming June -- Muteki no Soldier / coldrain // Aikawa Nanase / Kokia / Afilia Saga / Calafina / Lost Fairy / Man with a mission / Kasahara Yori, Tarantula / Disarmonia Mundi feat Hallelujah Yoko
     */
    mw = $('body').width();
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
            tmp= $('body').width();
            //if (tmp >= mediawidthmin && tmp < mediawidthmax) {
            sets.slideMargin = slmargin * mw;
            sets.slideWidth = slwidth * mw;
            slider.reloadSlider(sets);
            //}
        });
    }


    var ppp = Math.floor(Math.random() * 100);
    $(window).scroll(function(){
        var aTop = $('header.header').height() + $('.slider').height() + $('.true-dreams').height() / 10;

        slck= {topdown: true, downtop: false};
        if ($(this).scrollTop()>=aTop && slck.topdown){
                $('.radial-progress').attr('data-progress', 67);
                slck.topdown = false;
                slck.downtop = true;
        }
    });

});
