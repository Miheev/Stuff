var slider= undefined;
var sets= undefined;

var aff_id= -1;
var itemhh_fix= 0;
var dry= [];
var slck= [];
var maxscroll= 0;

var aTop= 0;
var aLeft= 0;

function getHeight() {
    myHeight = 0;
    if( typeof( window.innerWidth ) == 'number' ) {
        //Non-IE
        myHeight = window.innerHeight;
    } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
        //IE 6+ in 'standards compliant mode'
        myHeight = document.documentElement.clientHeight;
    } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
        //IE 4 compatible
        myHeight = document.body.clientHeight;
    }
    return myHeight;
}

function gallery_node() {
    if ($('.gallery-node').length) {
        $('.gallery-node .img-tumb .sl-item span').click(function(){
            it= $(this);
            $('.gallery-node .img-full img').fadeOut('slow', function(){
                $('.gallery-node .img-full img').attr('src', it.prev().attr('src'));
                $('.gallery-node .img-full img').fadeIn('slow');

                id= $('.gallery-node .img-tumb .sl-item span').index(it);
                $('.gallery-node .img-full').attr('data-imgid', id);
            });
        });
        $('.gallery-node .img-full img').click(function(){
            max= $('.gallery-node .img-tumb .sl-item img').length;
            it= parseInt($('.gallery-node .img-full').attr('data-imgid'));
            console.log(max);
            console.log(it);
            if (it == max-1)
                it=0;
            else
                it++;
            console.log(it);
            $('.gallery-node .img-tumb .sl-item span').eq(it).trigger('click');
        });
    }
}

$(document).ready(function(){
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

        setTimeout(function(){
            aTop = $('#fixblock').offset().top;
            aLeft = $('#fixblock').offset().left;
        },300);
        $(window).scroll(function(){
//            var aTop = $('header.header').height() + $('.menu-container').height();
            var afooter = aTop + $('.main-container').height()-600;//*0.72;

            if ($(this).scrollTop()>=aTop){
                ww= $('#fixblock').css('width');
                $('#fixblock').addClass('sticky')
                    .css('width', ww);

                leftfix= $(window).scrollLeft();
                if (leftfix > aLeft)
                    $('#fixblock').css('left', -leftfix);
                else
                    $('#fixblock').css('left', aLeft);
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
    else if ($('body.realization').length) {
        $("input[name='dream']").kalypto();
        $("input[name='filter_actions[]']").kalypto();
//        setTimeout(function tmr_chk(){
//            if (!$("input[name='filter_actions[]']").length)
//                setTimeout(tmr_chk, 300);
//            else
//                $("input[name='filter_actions[]']").kalypto();
//        }, 300);
    } else if ($('body.index').length) {

        setTimeout(function(){
            if ($('.bxslider').length) {
                mw = $('bxslider').width();
                slmargin = 0.00;
                slwidth = 1-slmargin;


                sets = {
                    slideMargin: slmargin * mw,
                    pager: false,
                    auto: true,
                    pause: 5000,
                    autoHover: true,
                    minSlides: 1,
                    maxSlides: 1,
                    moveSlides: 1,
                    slideWidth: slwidth * mw,
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

                slider = $('.bxslider').bxSlider(sets);

                //startTimeIndicator(); // start the time line for the first slide

                $(window).resize(function () {
                    mw = $('.bxslider').width();
                    tmp= $('.bxslider').width();
                    //if (tmp >= mediawidthmin && tmp < mediawidthmax) {
                    sets.slideMargin = slmargin * mw;
                    sets.slideWidth = slwidth * mw;
                    slider.reloadSlider(sets);
                    //}
                });
            }
        }, 100);
    } else if ($('body.registration').length) {
        $("input[type='checkbox']").kalypto();
    } else if ($('body.user_sets').length) {
        $('.currency .radio .abutton').click(function(){

            id= $('.currency .radio .abutton').index($(this));
            prev= $('.currency .radio .abutton').index($('.currency .radio .abutton.select'));

            if (prev == id) return;

            $('.currency .radio .abutton.select').removeClass('select');
            $(this).addClass('select');
            $('input[name="currency"]').val(id);
        });
    }


    gallery_node();

//    if (navigator.appName == "Netscape" && (typeof chrome != 'undefined'))
//        if (navigator.userAgent.split('Chrome')[1].split(' ')[0].substr(1) < "36.0.1985.143")
//            itemhh_fix= 162;

    radial_effect= function(obj) {
//        $('.radial-progress').eq(0).attr('data-to', $('.radial-progress').eq(0).find('.percentage span').text());
        $(obj).each(function(){
            elto= $(this).find('.percentage span').text().trim();
            console.log(elto);
            $(this).attr('data-to', elto);
        });

        aff_id++;
    };
    radial_scroll= function(){
        console.log($(window).scrollTop());
        maxscroll= $(document).height()-getHeight() - 10;

        for (i=1; i<=dry.length; i++) {
            if ($(window).scrollTop()>=dry[i-1] && $(window).scrollTop()<dry[i] && slck[i-1].topdown){
                radial_effect($('.true-dreams > .dreams').eq(i-1).find('.radial-progress'));
                slck[i-1].topdown = false;
                slck[i-1].downtop = true;
            } else if ($(window).scrollTop() >= maxscroll && dry[i-1] >= maxscroll && slck[i-1].topdown) {
                radial_effect($('.true-dreams > .dreams').eq(i-1).find('.radial-progress'));
                slck[i-1].topdown = false;
                slck[i-1].downtop = true;
            }
        }
    };
    radial_init= function() {
        aff_id= -1;
        dry= [];
        slck= [];

        if (!$('.true-dreams > .dreams').length) return;
        for(ind=0, hh=0, mm=0; ind<=$('.true-dreams > .dreams').length; ind++){
            tmp= $('.true-dreams > .dreams').eq(0).offset().top;
//            console.log(tmp);
            dry.push(tmp + hh + mm - 100); // - отступ для видимости эффекта при прокрутки снизу
            hh+= $('.true-dreams > .dreams').eq(ind).height()+itemhh_fix; // + разница с определением высоты
            mm+= parseInt($('.true-dreams > .dreams').eq(ind).css('margin-bottom'));
            slck.push({topdown: true, downtop: false});
        }
        //dry.push($('.footer-container').offset().top);
//    $('.true-dreams > .dreams').hover(function(){
//        curdry = $('.true-dreams > .dreams').index($(this));
//        //console.log(curdry);
//    });

//        console.log(dry);
//        console.log(slck);

        radial_scroll();

        $(window).scroll(radial_scroll);
    };

    setTimeout(radial_init, 300);
});