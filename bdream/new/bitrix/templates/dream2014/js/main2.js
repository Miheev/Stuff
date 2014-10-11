var slider= undefined;
var sets= undefined;

var effint= [];
var aff_id= -1;
var dry= [];
var slck= [];

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
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
    else if ($('body.realization').length) {
        $("input[name='dream']").kalypto();
//        $('.true-dreams').find('.radial-progress').progressCircle({
//            nPercent        : 67,
//            showPercentText : false,
//            circleSize      : 60,
//            thickness       : 5
//        });
    }

    /**
     * Created by storm on 4/13/14. ##metal ##rock Riverside / Sound Couture /One Ok Rock / Foreground Eclipse / Flaming June -- Muteki no Soldier / coldrain // Aikawa Nanase / Kokia / Afilia Saga / Calafina / Lost Fairy / Man with a mission / Kasahara Yori, Tarantula / Disarmonia Mundi feat Hallelujah Yoko
     */

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


//    $('.true-dreams > .dreams').find('.radial-progress').progressCircle({
//        nPercent        : 0,
//        showPercentText : false,
//        circleSize      : 60,
//        thickness       : 5
//    });

    itemhh_fix= 0;
    if (navigator.appName == "Netscape" && (typeof chrome != 'undefined'))
        if (navigator.userAgent.split('Chrome')[1].split(' ')[0].substr(1) < "36.0.1985.143")
            itemhh_fix= 162;
    for(ind=0, hh=0, mm=0; ind<=$('.true-dreams > .dreams').length; ind++){
        dry.push($('.true-dreams > .dreams').eq(0).offset().top + hh + mm - 100); // - отступ для видимости эффекта при прокрутки снизу
        hh+= $('.true-dreams > .dreams').eq(ind).height()+itemhh_fix; // + разница с определением высоты
        mm+= parseInt($('.true-dreams > .dreams').eq(ind).css('margin-bottom'));
        slck.push({topdown: true, downtop: false});
    }
    //dry.push($('.footer-container').offset().top);
//    $('.true-dreams > .dreams').hover(function(){
//        curdry = $('.true-dreams > .dreams').index($(this));
//        //console.log(curdry);
//    });
    //console.log(dry);
//    console.log(slck);

    statusEffect= function(obj, delay, step, rowid) {
        to=0;
        $(obj).each(function(){
            elto= parseInt($(this).data('to'));
            to= (elto > to)? elto : to;
        });

        effint[rowid].se_sets= {
            nPercent        : 0,
            showPercentText : false,
            circleSize      : 60,
            thickness       : 5
        };
        $(obj).progressCircle(effint[rowid].se_sets);
        aff_id++;
        effint[rowid].order= setInterval(
            function(){
                $(obj).each(function(){
                    elto= parseInt($(this).data('to'));
                    if (effint[rowid].j <= elto) {
                        effint[rowid].se_sets.nPercent= effint[rowid].j;
                        $(this).progressCircle(effint[rowid].se_sets);
                    }
//                    else if (effint[rowid].j - elto < step) {
//                        effint[rowid].se_sets.nPercent= elto;
//                        $(this).progressCircle(effint[rowid].se_sets);
//                    }
                });
                //console.log(effint[rowid].j);
                if (effint[rowid].j > to) {
                    $(obj).each(function(){
                        elto= parseInt($(this).data('to'));
                        effint[rowid].se_sets.nPercent= elto;
                        $(this).progressCircle(effint[rowid].se_sets);
                    });
                    clearInterval(effint[rowid].order);
                }
                effint[rowid].j+=step;
            }, delay);

//        for (j=0; j<=to; j+=step) {
//            setTimeout(function(){
//                se_sets.nPercent= j;
//                $(obj).progressCircle(se_sets);
//            }, delay);
//
//        }
    };
    scroll_radial= function(){
        //console.log($(window).scrollTop());
        for (i=1; i<=dry.length; i++) {
            if ($(window).scrollTop()>=dry[i-1] && $(window).scrollTop()<dry[i] && slck[i-1].topdown){
                rowid= 0;
                do {
                    rowid= Math.round((Math.random() * 100));
                } while ( (typeof effint[rowid]) != 'undefined' );
                effint[rowid]= {
                    j: 0
                };
                statusEffect($('.true-dreams > .dreams').eq(i-1).find('.radial-progress'), 30, 5, rowid);
                slck[i-1].topdown = false;
                slck[i-1].downtop = true;
            }
        }
    };

//    setTimeout(function tmr_clear() {
//        for (z=0; z<effint.length; z++) {
//            clearInterval(effint[z]);
//        }
//        setTimeout(tmr_clear, 5000);
//    },5000);

    $(window).scroll(scroll_radial);

//    scroll_radial();
});
