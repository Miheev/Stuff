<?php
/**
 * Created by PhpStorm.
 * User: leve_000
 * Date: 26.02.14
 * Time: 20:32
 */

switch ($view_mode):
    case 'teaser':
//        dpm($node, 'teaser node');
//        dpm($content, 'teaser content');
//        print views_embed_view('product_category_sub', 'block_3');
        ?>
        <div class="hats-left left">
        <?php print render($content['body']); ?>
            <div class="hats-buy">
                <?php print render($content['field_product']); ?>
                <?php print render($content['product:commerce_price']); ?>
                <div class="basket_link"><a href="javascript:void(0)">Купить</a></div>
            </div>
        </div>
        <div class="hats-right right slider-viewport">
            <div class="hats-img">
                <img src="/sites/all/themes/soapomegacom2/logo_soap.png"  alt="" />
            </div>
            <?php
            $content['product:field_images']['#prefix']= '<div class="bxslider commerce-product-field commerce-product-field-field-images field-field-images node-33-product-field-images">';
            print render($content['product:field_images']); ?>

        <?php
        $g= <<<EOT
<div class="bxslider">
                <figure><img src="/img/slide/0(1).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(2).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(3).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(4).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(5).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(6).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(7).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(8).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(9).jpg" alt="" /></figure>
                <figure><img src="/img/slide/0(10).jpg" alt="" /></figure>
                </djv>
EOT;
        ?>
            <div class="time-indicator"></div>
        </div>
        <div class="simple clearfix data-tid" data-tid="<?php echo $_GET['cur_tid']; ?>"></div>
       <script>
           do_code= function(){
               jQuery('.basket_link a').click(function(){
                   jQuery('#edit-submit').trigger('click');
               });
               jQuery('.bxslider img').click(function(){
                   jQuery('.hats-img img').attr('src', jQuery(this).attr('src'));
               });

               jQuery('.bxslider img').eq(0).trigger('click');

               jQuery('.view-display-id-block_3 table div').each(function(){
                   if (jQuery(this).find('a').text() == jQuery('.data-tid').data('tid'))
                        jQuery(this).addClass('current');
               });

               if (!jQuery('.field-name-body').text().match(/\S+/)) {
                   jQuery('.hats-left').toggleClass('left').toggleClass('right');
                   jQuery('.hats-right').toggleClass('right').toggleClass('left');
               }

           }

           jQuery(document).ready(function(){
               setTimeout(function tmr(){
                   if (jQuery('.bxslider').length) {
                       if (jQuery('.bxslider img').length > 2) {
                            bx_set();
                            do_code();
                       } else {
                            do_code();
                       }
                   } else
                       setTimeout(tmr, 1000);
               }, 10);
           });
       </script>
        <?php  break;
    case 'full': ?>

        <h1 class="title" id="page-title">Каталог</h1>
    <?php print render($content);
//        dpm($node, 'full node');
//        dpm($content, 'full content');
        break;
endswitch ?>