/**
 * Created by storm on 5/12/14.
 */
(function ($) {
    $(document).ready(function(){

        $.ajax({
            type: "POST",
            url: '/zayavka-na-zvonok',
            success: function(data){
                $('.recall').append(
                    '<div id="callto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userinfoLabel" aria-hidden="true" style="display: none;">' +
                        '<div class="modal-dialog">' +
                        '<div class="modal-content">' +
                        '<div class="modal-header">' +
                        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                        '<h2 class="modal-title" id="userinfoLabel">Заявка на звонок</h2>' +
                        '</div>' +
                        '<div class="modal-body">' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>' +
                        '</div>' +
                        '</div><!-- /.modal-content -->' +
                        '</div><!-- /.modal-dialog -->' +
                        '</div>'
                );

                $('#callto .modal-body').append(data);
                $('#callto #important, #callto #dental-bottom-container, ' +
                    '#callto #special_block, #callto #dental-menu-top, #callto #dental-top, ' +
                    '#callto .modal-body h2, #callto #warning, ' +
                    '#callto .xdebug-var-dump').remove();
                $('#callto #edit-captcha-response-wrapper > label').empty()
                    .append('<span class="form-required" title="Обязательное поле">*</span>');

                var sets= {
                    name: false,
                    phone: true,
                    text: false
                };
                $('#callto #edit-submitted-telefon').formatter({
                    'pattern': '+7 ({{999}}) {{999}}-{{9999}}',
                    'persistent': true
                });
//                $('#callto #edit-submitted-telefon').on('input', function(e) {
//                    if ($(this).val().match(/[\d -]+/) == null || $(this).val().match(/\d+/g) == null || $(this).val().match(/\d+/g).join('').length < 6) {
//                        if (!$(this).hasClass('invalid')) {
//                            $(this).toggleClass('invalid');
//                            sets.phone= false;
//                        }
//                    } else
//                    if ($(this).hasClass('invalid')) {
//                        $(this).toggleClass('invalid');
//                        sets.phone= true;
//                    }
//                });
                $('#callto #edit-submitted-imya').on('input', function(e) {
                    if ($(this).val().match(/[a-zA-Zа-яА-Я -]+/) == null || $(this).val().match(/[a-zA-Zа-яА-Я]+/g).join('').length < 4) {
                        if (!$(this).hasClass('invalid')) {
                            $(this).toggleClass('invalid');
                            sets.name= false;
                        }
                    } else
                    if ($(this).hasClass('invalid')) {
                        $(this).toggleClass('invalid');
                        sets.name= true;
                    }
                });
                $('#callto #edit-submitted-dopolnitelno').on('input', function(e) {
                    if ($(this).val().match(/[a-zA-Zа-яА-Я -]+/) == null || $(this).val().match(/[a-zA-Zа-яА-Я]+/g).join('').length < 10) {
                        if (!$(this).hasClass('invalid')) {
                            $(this).toggleClass('invalid');
                            sets.text= false;
                        }
                    } else
                    if ($(this).hasClass('invalid')) {
                        $(this).toggleClass('invalid');
                        sets.text= true;
                    }
                });
                $('#callto #edit-submit').click(function(e){
                    if (!sets.name || !sets.phone || !sets.text
                        || !$('#callto #edit-submitted-telefon').val() || !$('#callto #edit-submitted-imya').val() || !$('#callto #edit-submitted-dopolnitelno').val()
                        )
                        e.preventDefault();
                });

                $('.recall>a').click(function(){
                    $('#callto').modal({keyboard: false});
                });
            }
        });
    });
})(jq171);