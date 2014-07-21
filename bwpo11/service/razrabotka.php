<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Разработка сайтов");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "raz_1",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "raz_2",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "raz_3",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "raz_4",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "raz_5",
		"EDIT_TEMPLATE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "raz_6",
		"EDIT_TEMPLATE" => ""
	)
);?>
    <script src="/bitrix/templates/webpro_theme/js/zoom.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var currentPosition = 0;
            var slideWidth = 1000;
            var slides = $('.slide');
            var numberOfSlides = slides.length;

            // Remove scrollbar in JS
            $('#slidesContainer').css('overflow', 'hidden');

            // Wrap all .slides with #slideInner div
            slides
                .wrapAll('<div id="slideInner"></div>')
                // Float left to display horizontally, readjust .slides width
                .css({
                    'float' : 'left',
                    'width' : slideWidth
                });

            // Set #slideInner width equal to total width of all slides
            $('#slideInner').css('width', slideWidth * numberOfSlides);

            // Insert controls in the DOM
            $('#slideshow')
                .prepend('<span class="control" id="leftControl"></span>')
                .append('<span class="control" id="rightControl"></span>');

            // Hide left arrow control on first load
            manageControls(currentPosition);

            // Create event listeners for .controls clicks
            $('.control')
                .bind('click', function(){
                    // Determine new position
                    currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;

                    // Hide / show controls
                    manageControls(currentPosition);
                    // Move slideInner using margin-left
                    $('#slideInner').animate({
                        'marginLeft' : slideWidth*(-currentPosition)
                    });
                });

            // manageControls: Hides and Shows controls depending on currentPosition
            function manageControls(position){
                // Hide left arrow if position is first slide
                if(position==0){ $('#leftControl').hide() } else{ $('#leftControl').show() }
                // Hide right arrow if position is last slide
                if(position==numberOfSlides-1){ $('#rightControl').hide() } else{ $('#rightControl').show() }
            }
        });

        $(document).ready(function() { // вся магия после загрузки страницы

            /* Закрытие модального окна, тут делаем то же самое но в обратном порядке */
            $('#modal_close, #overlay').click( function(){ // ловим клик по крестику или подложке
                $('#modal_form')
                    .animate({opacity: 0, top: '45%'}, 200,  // плавно меняем прозрачность на 0 и одновременно двигаем окно вверх
                    function(){ // после анимации
                        $(this).css('display', 'none'); // делаем ему display: none;
                        $('#overlay').fadeOut(400); // скрываем подложку
                    }
                );
            });
        });

        function popup(x){

            event.preventDefault(); // выключаем стандартную роль элемента
            $.ajax({
                url: "/include/form.php",
                data : {types:x},
                type : "POST",
                cache: false,
                beforeSend: function() {
                    $('#modal_form_content').html('Получаем контент');},
                success: function(html){
                    $("#modal_form_content").html(html);}
            });

            $('#overlay').fadeIn(400, // сначала плавно показываем темную подложку
                function(){ // после выполнения предъидущей анимации
                    $('#modal_form')
                        .css('display', 'block') // убираем у модального окна display: none;
                        .animate({opacity: 1, top: '50%', left: 'x'}, 200); // плавно прибавляем прозрачность одновременно со съезжанием вниз
                });
        }

        function portfolio(x){

            event.preventDefault(); // выключаем стандартную роль элемента
            $.ajax({
                url: "/include/portfolio.php",
                data : {types:x},
                type : "POST",
                cache: false,
                beforeSend: function() {
                    $('#modal_form_content').html('Получаем контент');},
                success: function(html){
                    $("#modal_form_content").html(html);}
            });

            $('#overlay').fadeIn(400, // сначала плавно показываем темную подложку
                function(){ // после выполнения предъидущей анимации
                    $('#modal_form')
                        .css('display', 'block') // убираем у модального окна display: none;
                        .animate({opacity: 1, top: '230px', left: '30%'}, 200); // плавно прибавляем прозрачность одновременно со съезжанием внизtop:
                });
        }


    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>