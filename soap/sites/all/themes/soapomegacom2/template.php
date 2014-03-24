<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

/*function theme_preprocess_page(&$vars)
{
    $css = $vars['css'];
    unset($css['all']['module']['путь до стиля который удаляем']);
    $vars['styles'] = drupal_get_css($css);

    var_dump ($vars['css']);
}

if (preg_match('~^webform/.*~Ui', $_GET['q'], $cozmi)) {
    print '<link rel="stylesheet" href="/sites/all/themes/soapomegacom2/css/webform.css" media="screen, projection" />';
}*/

function soapomegacom2_alpha_preprocess_page(&$vars) {
// custom functionality here
//drupal_get_path('theme', 'название-темы')

    //var_dump ($_GET);

    if ( is_null(arg(0)) || (arg(0) == 'node' && is_null(arg(1))) ) {
        //drupal_add_css(path_to_theme() . '/12345.css');
        drupal_add_css('code/SwatchBook/css/style3.css');
        drupal_add_js('code/SwatchBook/js/modernizr.custom.79639.js');
        //drupal_add_js('code/SwatchBook/js/jquery.1.7.2.min.js');
        drupal_add_js('code/SwatchBook/js/jquery.swatchbook.js');

        return;
    }
    if (arg(0) == 'node' && (arg(1) == '40' || arg(1) == '43')) {
        drupal_add_js('sites/all/themes/soapomegacom2/js/webform.js');
        return;
    }
    if (arg(0) == 'node' && arg(1) == '1') {
        drupal_add_js('http://api-maps.yandex.ru/2.1-dev/?lang=ru-RU&load=package.full');
        drupal_add_js('sites/all/themes/soapomegacom2/js/ymap.contact.js');
        return;
    }
    if (arg(0) == 'node' && arg(1) == '42') {
        drupal_add_js('sites/all/themes/soapomegacom2/js/height.fix.js');
        return;
    }
    if (arg(0) == 'cart') {
        drupal_add_css('sites/all/libraries/bootstrap/css/bootstrap.css');
        drupal_add_js('sites/all/libraries/bootstrap/js/bootstrap.min.js');
        //drupal_add_js('sites/all/libraries/jquery.maskedinput/jquery.maskedinput.min.js');
        return;
    }

}

//function soapomegacom2_alpha_preprocess_views_view(&$view) {
    //$newResults = 'this is simple test text';
    //dpm($view);
    //$view->set_current_page(3);
//}

//function soapomegacom2_alpha_views_post_render(&$view, &$display_id, &$args){
    //if($view->name == 'product_category_sub'){
        /*if(is_numeric($args[0])){//проверяем действительно ли аргумент(у нас он один, тот что %) является числом
            $term = taxonomy_term_load($args[0]);

            switch($term->vid){
                case 1: $display_id = 'display1';break;
                case 3: $display_id = 'somedisplay';break;
                default: $display_id = 'default_display';
            }
            //если у Вас окажется словарь, на который нет своего дисплея, то будет выведен default_display, машинные имена дисплеев и ид словарей подставляйте свои.

            $view->set_display($display_id);
        }*/
    //}
//}
//my_module - имя Вашего модуля и my_view - машинное имя Вашей вьюхи, указанное при её создании, подставляем свои значения
