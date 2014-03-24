/**
 * Created with JetBrains PhpStorm.
 * User: leve_000
 * Date: 09.12.13
 * Time: 23:44
 * To change this template use File | Settings | File Templates.
 */

var fix_resize= function() {
    hw= jQuery(window).height();
    hh= jQuery('#section-content').height();

    if (hw > hh) {
        delta= hw-hh;

        htop= delta/3.0;
        hbottom= delta * 2/3.0;

        if ( jQuery('body').hasClass('node-type-wherebuy-map') || jQuery('body').hasClass('node-type-webform'))
        {
            htop= 50;
            hbottom=0;
        }
        if ( jQuery('body').hasClass('node-type-wherebuy')) {
            htop= 100;
            hbottom= 0;
        }

        /*if (hw > 700 && hw < 1000) {
            htop= htop*1.125;
            hbottom= hbottom*1.125;
        }
        if (hw > 1000) {
            htop*= 1.2;
            hbottom*= 1.2;
        }*/

        jQuery('#section-content').css({
            'margin-top':  htop+'px',
            'margin-bottom':  hbottom+'px'
        });
    }

//    if (hh != hw) jQuery('html').height(hw+'px');
//
//    jQuery('#page').height('100%');
//    htop= jQuery('#section-header').height();
//    hbottom= jQuery('#section-footer').height();
//    if (htop > 0 && hbottom > 0 && jQuery('#section-header').css('display') != 'none' && jQuery('#section-footer').css('display') != 'none') {
//        hcontent= (hh - htop - hbottom) / hh * 100;
//        jQuery('#section-content').height(hcontent + '%');
//        //jQuery('#section-header').height((htop/hh*100) + '%');
//        //jQuery('#section-footer').height(hbottom/hh*100 + '%');
//    }
//};

};

jQuery(document).ready(function () {
    setTimeout(fix_resize,1);
});
jQuery(window).resize(function () {
    fix_resize();
});