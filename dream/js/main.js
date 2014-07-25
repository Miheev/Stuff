var slider= undefined;
var sets= undefined;

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
    }
}

$(document).ready(function(){
    //$('footer .right .right select').chosen({disable_search_threshold: 10, width: '140px', disable_search: true});
    $('footer .right .right .select .abbr').click(function(e){
        e.preventDefault();
        e.stopPropagation();

        if ($('footer .right .right .select .list').css('display') == 'none') {
            $('footer .right .right .select .list').css('display', 'block');
            $('footer .right .right .select .pointer').css('background-position', ' -16px 2px');
        } else {
            $('footer .right .right .select .list').css('display', 'none');
            $('footer .right .right .select .pointer').css('background-position', ' 0 2px');
        }
    });
    $('footer .right .right .select .list a').click(function(e){
        e.preventDefault();
        $('footer .right .right .select .label').text($(this).text().trim());
    });

    $('header.header .user .personal .abbr').click(function(e){
        e.preventDefault();
        e.stopPropagation();

        if ($('header.header .user .personal .list').css('display') == 'none') {
            $('header.header .user .personal .list').css('display', 'block');
            $('header.header .user .personal .pointer').css('background-position', ' -16px 2px');
        } else {
            $('header.header .user .personal .list').css('display', 'none');
            $('header.header .user .personal .pointer').css('background-position', ' 0 2px');
        }
    });
    $('body').click(function(){
        $('.select .list').css('display', 'none');
        $('.select .pointer').css('background-position', ' 0 2px');
    });
//    $('header.header .user .personal select').chosen({disable_search_threshold: 10, width: '100px', disable_search: true})
//    $('.head-choosen').on('chosen:ready', function(evt, params) {
//        link_wrap(evt, params);
//    });
//    link_wrap= function(evt, params) { alert();
//        opt= $('header.header .user .personal select').find('a');
//        console.log(opt);
//        clink= $('.personal .chosen-results .active-result');
//        console.log(clink);
//        for (i=0; i<opt.count; i++) {
//            tmp= clink.eq(i).text().trim();
//            clink.eq(i).empty();
//            clink.eq(i).append('<a href="'+opt.attr('href')+'">'+tmp+'</a>');
//        }
//    }

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
                ww= $('#fixblock').css('width');
                $('#fixblock').addClass('sticky')
                    .css('width', ww);
            } else {
                $('#fixblock').removeClass('sticky')
                    .removeAttr('style');
            }

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
    var dry= [];
    var slck= [];
//    var curdry= 0;
    $('.true-dreams > .dreams').each(function(){
        dry.push($(this).offset().top - $(this).height()/3);
        slck.push({topdown: true, downtop: false});
    });
    dry.push($('.footer-container').offset().top);
//    $('.true-dreams > .dreams').hover(function(){
//        curdry = $('.true-dreams > .dreams').index($(this));
//        //console.log(curdry);
//    });
    console.log(dry);
    console.log(slck);

    effint= [];
    aff_id= -1;
    statusEffect= function(obj, to, delay, step) {
        se_sets= {
            nPercent        : 0,
            showPercentText : false,
            circleSize      : 60,
            thickness       : 5
        };
        $(obj).progressCircle(se_sets);
        j=0;
        aff_id++;
        effint.push(
            setInterval(function(){
                se_sets.nPercent= j;
                $(obj).progressCircle(se_sets);
                console.log(j);
                if (j >= to) clearInterval(effint[aff_id]);
                j+=step;
            }, delay)
        );
//        for (j=0; j<=to; j+=step) {
//            setTimeout(function(){
//                se_sets.nPercent= j;
//                $(obj).progressCircle(se_sets);
//            }, delay);
//
//        }
    };
    setTimeout(function tmr_clear() {
        for (z=0; z<effint.length; z++) {
            clearInterval(effint[z]);
        }
        setTimeout(tmr_clear, 5000);
    },5000);


    $(window).scroll(function(){
        for (i=1; i<dry.length; i++) {
            if ($(this).scrollTop()>=dry[i-1] && $(this).scrollTop()<dry[i] && slck[i-1].topdown){
                statusEffect($('.true-dreams > .dreams').eq(i-1).find('.radial-progress'), 67, 30, 5);
                slck[i-1].topdown = false;
                slck[i-1].downtop = true;
            }
        }
    });


});
