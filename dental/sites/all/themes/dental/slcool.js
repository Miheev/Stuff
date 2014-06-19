/**
 * Created by storm on 4/13/14. Riverside / Sound Couture /One Ok Rock / Foreground Eclipse / Flaming June -- Muteki no Soldier / coldrain // Aikawa Nanase / Kokia / Afilia Saga / Calafina / Lost Fairy / Man with a mission / Kasahara Yori, Tarantula / Disarmonia Mundi feat Hallelujah Yoko
 */
var slider= undefined;
var sets= undefined;

(function ($) {
$(document).ready(function(){

    $('#block-views-slider_main-block_1 ul').addClass('bxslider')
        .parent().addClass('slider-viewport')
        .parent().parent().addClass('slider')
        .after('<div class="time-indicator"></div>');

    mw = $('.slider').width();
    slmargin = 0.0;
    slwidth = 1-slmargin;

    /**
     *
     * This function runs before the slide transition starts
     var switchIndicator = function ($c, $n, currIndex, nextIndex) {

$('.time-indicator').stop().css('width', 0);  // kills the timeline by setting it's width to zero
};

     This function runs after the slide transition finishes
     var startTimeIndicator = function () {

$timeIndicator.animate({width: '100%'}, 10000);          // start the timeline animation
};
     * @param $c
     * @param $n
     * @param currIndex
     * @param nextIndex
     */

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
            mw = $('.slider').width();
            tmp= $('body').width();
            //if (tmp >= mediawidthmin && tmp < mediawidthmax) {
            sets.slideMargin = slmargin * mw;
            sets.slideWidth = slwidth * mw;
            slider.reloadSlider(sets);
            //}
        });

        //Share Buttons
        $.fn.sharepage = function (s_sets) {

            var setdomain = function(){
                tmp=location.href+'/';
                tmp=tmp.substr(tmp.indexOf('://')+3);
                tmp=tmp.substr(0,tmp.indexOf('/'));
                return tmp;
            }

            var domain= setdomain();
            var loc= false;
            // set a reference to our slider element
            var el = this;

            var url= function(system) {
                title=encodeURIComponent(s_sets.title);
                urlout=encodeURIComponent(s_sets.url);
                switch (system) {
                    case 1: return 'http://vkontakte.ru/share.php?url='+urlout;
                    case 2: return 'http://www.facebook.com/sharer.php?u='+urlout;
                    case 3: return 'http://twitter.com/share?text='+title+'&url='+urlout;
                    case 4: return 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='+urlout;
                    case 5: return 'http://connect.mail.ru/share?share_url='+urlout;
                    case 6: return 'http://www.livejournal.com/update.bml?event='+urlout+'&subject='+title;
                    case 7: return 'http://memori.ru/link/?sm=1&u_data[url]='+urlout+'&u_data[name]='+title;
                    case 8: return 'http://bobrdobr.ru/addext.html?url='+urlout+'&title='+title;
                    case 9: return 'http://www.google.com/bookmarks/mark?op=add&bkmk='+urlout+'&title='+title;
                    case 10: return 'http://zakladki.yandex.ru/newlink.xml?url='+urlout+'&name='+title;
                    case 11: return 'http://surfingbird.ru/share?url='+urlout;
                    case 12: return 'http://text20.ru/add/?title=' + title + '&source='+urlout+'&text='+title;
                }
            }
            var redirect= function() {
                if (loc) location.href= loc;
                loc=false;
            }
            go= function(i) {
                loc= url(i);
            }
            var init=function() {
                var titles=new Array('&#1042; &#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1077;','Facebook','Twitter','&#1054;&#1076;&#1085;&#1086;&#1082;&#1083;&#1072;&#1089;&#1089;&#1085;&#1080;&#1082;&#1080;','&#1052;&#1086;&#1081; &#1052;&#1080;&#1088;','LiveJournal','Memori','&#1041;&#1086;&#1073;&#1088;&#1044;&#1086;&#1073;&#1088;','&#1047;&#1072;&#1082;&#1083;&#1072;&#1076;&#1082;&#1080; Google','&#1071;&#1085;&#1076;&#1077;&#1082;&#1089;.&#1047;&#1072;&#1082;&#1083;&#1072;&#1076;&#1082;&#1080;','Surfingbird','&#1058;&#1077;&#1082;&#1089;&#1090; 2.0');
                var html='';
                html+='<a href="http://odnaknopka.ru/"><img src="http://odnaknopka.ru/images/blank.gif" width="16" height="16" alt=" #" title="&#1054;&#1076;&#1085;&#1072;&#1050;&#1085;&#1086;&#1087;&#1082;&#1072;" style="border:0;padding:0;margin:0 4px 0 0;background:url(http://odnaknopka.ru/images/panel.png) no-repeat -270px -192px"/></a>';
                for (i=0;i<12;i++) {
                    html+='<a class="'+s_sets.name+'" href="'+url(i+1)+'"><img src="http://odnaknopka.ru/images/blank.gif" width="16" height="16" alt=" #" title="'+titles[i]+'" style="border:0;padding:0;margin:0 4px 0 0;background:url(http://odnaknopka.ru/images/panel.png) no-repeat -270px -'+(i*16)+'px"/></a>';
                }
                el.append(html);
                for (i=0;i<12;i++) {
                    el.find('a').click(function(e){
                        return go(i+1);
                    });
                }
                //onclick="return odnaknopka3.go('+(i+1)+');
            }

            init();

            return this;
        }

        $('#block-views-slider_main-block_1 li').append('<div class="sharepage" style="margin-top: 10px;"></div>');
        $('.sharepage').each(function(ind){
            $(this).sharepage({
                url: location.origin + $(this).prev().attr('href'),
                name: 'sharepage-'+ind,
                title: $(this).prev().attr('href').substr(1).replace('/', ' ')
            });
        });
//                    if($('.hoverBox').length){
//                        //prettyPhoto
//                        $('a[rel^=\'prettyOverlay\'],a[rel^=\'prettyPhoto466\']').prettyPhoto({
//                            animation_speed: 'fast',
//                            show_title: false,
//                            opacity: 0.6,
//                            allowresize: true,
//                            counter_separator_label: '/',
//                            overlay_gallery: 1,
//                            theme: 'dark_rounded'
//                        });
//                    }
    }

});
})(jq171);