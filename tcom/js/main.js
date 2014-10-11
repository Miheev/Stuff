var slider= undefined;
var sets= undefined;
var media_phone_min= 320;
var media_phone= 480;
var media_phone_medium= 560;
var media_phone_big= 768;
var media_table_landscape= 1000;

var col_num_base= 3;


//(function ($) {
media_bx= function() {
    console.log(slmargin);
    console.log(slwidth);

    if ($(window).width() <= media_phone) {
        mw = $('.slider-viewport').width();
        sets.slideMargin = 0;
        sets.slideWidth = mw;
        sets.minSlides = 1;
        sets.maxSlides = 1;
        sets.moveSlides = 1;
    }
    else if ($(window).width() <= media_phone_big) {
        mw = $('.slider-viewport').width();
        sets.slideMargin = slmargin*mw;
        sets.slideWidth = (mw / 2 - (slmargin*mw)/2);
        sets.minSlides = 2;
        sets.maxSlides = 2;
        sets.moveSlides = 2;
    }
    else if ($(window).width() <= media_table_landscape) {
        mw = $('.slider-viewport').width();
        sets.slideMargin = slmargin*mw;
        sets.slideWidth = (mw / 3 - 2*(slmargin*mw)/3);
        sets.minSlides = 3;
        sets.maxSlides = 3;
        sets.moveSlides = 3;
    }
    else if ($(window).width() > media_table_landscape) {
        mw = $('.slider-viewport').width();
        sets.slideMargin = slmargin*mw;
        sets.slideWidth = (mw / 5 - 4*(slmargin*mw)/5);
        sets.minSlides = 5;
        sets.maxSlides = 5;
        sets.moveSlides = 3;
    }
};
media_col_num= function() {
    col_num= col_num_base;

    if ($(window).width() <= media_phone)
        col_num= 1;
    else if ($(window).width() <= media_phone_big)
        col_num= 2;

    return col_num;
};
stuff_item_hfix= function(obj, call) {
    obj_count= $(obj).length;

    $(obj).each(function(rid, rel){
        max=0;
        $(rel).find('.stuff-item .name').each(function(){
            hh= $(this).height();
            max= hh > max ? hh : max;
        });
        $(rel).find('.stuff-item .name').height(max);

        setTimeout(function tmr_img(){
            if ($(rel).find('.stuff-item .img').last().height() < 50)
                setTimeout(tmr_img, 100);
            else {
                $(rel).find('.stuff-item .img').each(function(){
                    hh= $(this).height();
                    max= hh > max ? hh : max;
                });
                $(rel).find('.stuff-item .img').height(max);

                if (rid == obj_count-1 && (typeof call) == 'function')
                    call();
            }
        }, 100);
    });
};
function map_hfix(col_num) {
    max=0;
    ids= [];
    $('.map-table>li').each(function(id){
        if (col_num == 1) {
            $('.map-table>li').css('width', '100%');
            return;
        }

        if (!(id%col_num) && max && ids.length) {
            for (i=0; i<ids.length; i++)
                $('.map-table>li').eq(ids[i]).height(max);

            max= 0;
            ids= [];
        }

        max= max > $(this).height() ? max : $(this).height();
        ids.unshift(id);
    });
};

$(document).ready(function() {

    /**
     * Header
     * @type {boolean}
     */
    bslock= false;
    $('.basket .basket-open').click(function(){
        if (!bslock) {
            bslock= true;

            if ($(this).hasClass('opened')) {
                $('.basket .content').slideUp('slow', function(){
                    $('.basket .basket-open').removeClass('opened');
                    $('.basket .basket-open').css('transf');
                    bslock= false;
                });
            } else
                $('.basket .content').slideDown('slow', function(){
                    $('.basket .basket-open').addClass('opened');
                    bslock= false;
                });
        }
    });

    authlock= false;
    $('.auth-btn a').click(function(e){
        e.preventDefault();

        id= $('.auth-btn a').index($(this));
        pid= $('.auth .tab-head span').index($('.auth .tab-head span.selected'));

        if (id == pid) return;

        if ($('.auth').css('display') == 'none' && !authlock) {
            authlock= true;

            $('.auth .tabs .item').eq(id).css('display', 'block');
            $('.auth .tab-head span.selected').removeClass('selected');
            $('.auth .tab-head span').eq(id).addClass('selected');

            $('.auth').slideDown('slow',function(){
                authlock= false;
            });
        } else
            $('.auth .tab-head span').eq(id).trigger('click');
    });
    $('.auth .tab-head span').click(function(){
        if (!authlock) {
            authlock= true;

            id= $('.auth .tab-head span').index($(this));
            pid= $('.auth .tab-head span').index($('.auth .tab-head span.selected'));

            if (id == pid) {
                $('.auth .tab-head span.selected').removeClass('selected');
                $('.auth').slideUp('slow',function(){
                    $('.auth .tabs .item').eq(id).css('display', 'none');

                    authlock= false;
                });
            } else {
                $('.auth .tabs .item').eq(pid).fadeOut('slow', function(){
                    $('.auth .tabs .item').eq(id).fadeIn('slow', function(){
                        $('.auth .tab-head span.selected').removeClass('selected');
                        $('.auth .tab-head span').eq(id).addClass('selected');

                        authlock= false;
                    });
                });
            }
        }
    });
    $('.auth .tab-head .close').click(function(){
        $('.auth .tab-head span.selected').trigger('click');
    });

    /**
     * Left Column
     */
    $('ul.sf-menu').superfish();

    /**
     * Main
     * @type {boolean}
     */



    if ($('body.index').length) {


        stuff_item_hfix('.pop-stuff .content');
        $(window).resize(function () {
            stuff_item_hfix('.pop-stuff .content');
        });

        lock= false;
        slcount= $('.slmain .slides img').length;
        slcur=0;
        slint= 0;
        sltime= 10000;
        $('.slmain').height($('.slmain .slides .current').height()+'px');
        slchange= function(pid, id) {
            $('.slmain .slides .current').fadeOut(1000, function(){
                $('.slmain .slides .current').removeClass('current');
            });
            setTimeout(function(){
                $('.slmain .slides img').eq(id).fadeIn(1000, function(){
                    $(this).addClass('current');
                    $('.slmain').height($(this).height()+'px');
                    $('.slmain .control .center .imgref').eq(id).addClass('hover');
                    $('.slmain .control .center .imgref').eq(pid).removeClass('hover');
                    slcur= id;

                    lock= false;
                });
            }, 500);
        };
        autoslide= function(){
            if (!lock) {
                lock= true;
                pid= slcur;
                all= slcount - 1;
                id= pid == all ? 0 : pid+1;
                slchange(pid, id);
            }
        };

        $('.slmain .control .left a').click(function(e){
            e.preventDefault();

            if (!lock) {
                lock= true;
                clearInterval(slint);
                pid= $('.slmain .slides img').index($('.slmain .slides .current'));
                id= pid ? pid-1 : slcount - 1;

                slchange(pid, id);
                slint= setInterval(autoslide,sltime);
            }
        });
        $('.slmain .control .right a').click(function(e){
            e.preventDefault();

            if (!lock) {
                lock= true;
                clearInterval(slint);
                pid= $('.slmain .slides img').index($('.slmain .slides .current'));
                all= slcount - 1;
                id= pid == all ? 0 : pid+1;

                slchange(pid, id);
                slint= setInterval(autoslide,sltime);
            }
        });
        for(i=0; i<slcount; i++) {
            $('.slmain .control .center').append('<a class="imgref" href="#"><span>'+(i+1)+'</span></a>');
        }
        $('.slmain .control .center .imgref').first().addClass('hover');
        setTimeout(function tmr_h(){
            if ($('.slmain .slides img').first().height() < 100 ) setTimeout(tmr_h, 100);
            else {
//                console.log($('.slmain .slides li').first().height());
                $('.slmain').height($('.slmain .slides img').first().height()+'px');
            }
        },100);
        $('.slmain .control .center .imgref').click(function(e){
            e.preventDefault();

            if (!lock) {
                lock= true;
                clearInterval(slint);
                id= $('.slmain .control .center .imgref').index($(this));
                pid= $('.slmain .slides img').index($('.slmain .slides .current'));

                if (id != pid) {
                    slchange(pid, id);
                    slint= setInterval(autoslide,sltime);
                }
            }
        });

        slint= setInterval(autoslide,sltime);

        $(window).resize(function () {
            $('.slmain').height($('.slmain .slides img.current').height()+'px');
        });

    }
    else if ($('body.product').length) {

        stufflock= false;
        $('.stuff-full .tab-head span').click(function(){
            if (!stufflock) {
                stufflock= true;

                id= $('.stuff-full .tab-head span').index($(this));
                pid= $('.stuff-full .tab-head span').index($('.stuff-full .tab-head span.selected'));

                if (id == pid) return;

                $('.stuff-full .tabs .item').eq(pid).fadeOut('slow', function(){
                    $('.stuff-full .tabs .item').eq(id).fadeIn('slow', function(){
                        $('.stuff-full .tab-head span.selected').removeClass('selected');
                        $('.stuff-full .tab-head span').eq(id).addClass('selected');

                        stufflock= false;
                    });
                });
            }
        });

        slmargin = 0.01;
        slwidth = 1-slmargin;
        bxlock= false;
        setTimeout(function(){
            if ($('.bxslider').length) {

                sets = {
                    pager: false,
                    auto: true,
                    pause: 10000,
                    autoHover: true,
                    adaptiveHeight: true,
                    responsive: true
                };

                media_bx();

                slider = $('.bxslider').bxSlider(sets);

                $(window).resize(function () {
                    media_bx();

                    if (!bxlock) {
                        bxlock= true;
                        slider.reloadSlider(sets);
                    } else
                        bxlock= false;
                });
            }
        }, 100);
    }
    else if ($('body.cart').length) {

        slmargin = 0.01;
        slwidth = 1-slmargin;
        bxlock= false;
        setTimeout(function(){
            if ($('.bxslider').length) {

                sets = {
                    pager: false,
                    auto: true,
                    pause: 10000,
                    autoHover: true,
                    adaptiveHeight: true,
                    responsive: true
                };

                media_bx();

                slider = $('.bxslider').bxSlider(sets);

                $(window).resize(function () {
                    media_bx();

                    if (!bxlock) {
                        bxlock= true;
                        slider.reloadSlider(sets);
                    } else
                        bxlock= false;
                });
            }
        }, 100);
    }
    else if ($('body.catalog').length || $('body.page-404-php').length) {
        colnum= media_col_num();
        map_hfix(colnum);

        $(window).resize(function(){
            $('.map-table>li').removeAttr('style');
            colnum= media_col_num();
            map_hfix(colnum);
        });
    }

    if ($('.product-list').length) {
        stuff_item_hfix('.product-list .list-row');
        $(window).resize(function () {
            stuff_item_hfix('.pop-stuff .list-row');
        });
    }

    slmargin = 0.01;
    slwidth = 1-slmargin;
    bxlock= false;
    setTimeout(function(){
        if ($('.bxslider').length) {


            sets = {
                pager: false,
                auto: true,
                pause: 10000,
                autoHover: true,
                adaptiveHeight: true,
                responsive: true
//                     touchEnabled: false,
                /*onSliderLoad: function (curIndex) {
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
                 }*//*,
                 onSlideBefore: switchIndicator,
                 onSlideAfter: startTimeIndicator*/

            };

            media_bx();
            stuff_item_hfix('.slider-viewport');

            if ($('.bxslider>*').length < sets.maxSlides)
                sets.controls= false;
            slider = $('.bxslider').bxSlider(sets);

            //startTimeIndic ator(); // start the time line for the first slide

            $(window).resize(function () {
//                     mw = $('.slider-viewport').width();
//                     sets.slideMargin = slmargin * mw;
//                     sets.slideWidth = slwidth*mw;
                media_bx();
                stuff_item_hfix('.slider-viewport');

                if (slider.getSlideCount() < sets.maxSlides)
                    sets.controls= false;
                else
                    sets.controls= true;

                    slider.reloadSlider(sets);
            });
        }
    }, 100);

}); /* end of as page load scripts */
//})(jQuery);