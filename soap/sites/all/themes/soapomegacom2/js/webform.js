/**
 * Created with JetBrains PhpStorm.
 * User: leve_000
 * Date: 01.12.13
 * Time: 23:31
 * To change this template use File | Settings | File Templates.
 */

jQuery(document).ready(function(){

    jQuery('#edit-actions input[type="submit"]').val('Отправить');
    jQuery('.form-item.form-type-textfield label').text('');
    jQuery('.form-item.form-type-textfield .description').text('');
    jQuery('#edit-captcha-response').attr('placeholder', 'Введите код с картинки');
});
