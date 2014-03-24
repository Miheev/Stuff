/**
 * Created with JetBrains PhpStorm.
 * User: leve_000
 * Date: 07.12.13
 * Time: 11:42
 * To change this template use File | Settings | File Templates.
 */

jQuery(document).ready(function(){
    obj= jQuery('.node-type-page.page-node-42 #region-content');

    if (obj.height() < 400) {
        obj.height(400+'px');
        obj.css('background-image', 'url("/sites/all/themes/soapomegacom2/img/where_to_buy_back_300.png")');
    }
    if (obj.height() > 400 && obj.height() < 700) {
        obj.height(700+'px');
        obj.css('background-image', 'url("/sites/all/themes/soapomegacom2/img/where_to_buy_back.png")');
    }
});