/**
 * Created by storm on 5/12/14.
 */

(function ($) {
    $(document).ready(function(){

        id = parseInt($('.content.clear-block p').length / 2);
        count= $('.content.clear-block p').length;

        $('.content.clear-block').append('<a href="#" class="text-cut-button" style="font-weight: 700; text-transform: uppercase;">Открыть полностью</a>');
        $('.text-cut-button').click(function(e){
            e.preventDefault();

            for (i=id; i < count; i++) {
                $('.content.clear-block p').eq(i).fadeToggle('slow');
            }

            $(this).fadeToggle('fast')
                .text(
                    $('.content.clear-block').hasClass('full-text') ? 'Открыть полностью' : 'Свернуть'
                )
            .fadeToggle('fast');
            $('.content.clear-block').toggleClass('full-text');
        });

        for (i=id; i < count; i++) {
            $('.content.clear-block p').eq(i).css('display', 'none');
        }
    });
})(jq171);