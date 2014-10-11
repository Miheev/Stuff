<div id="usl-block-1">
    <div class="width-list">
        <div class="block-name bold">Создание интернет-магазинов для бизнеса</div>
        <div class="block-pre-name">дизайн и разработка интернет магазинов с высокой
                                    конверсией!
        </div>
        <div class="hr"></div>
        <div class="pozitiv razrab">
            <div class="pozitiv-name bold">Почему мы?</div>
            <a class="id-1 block support" tabindex="1">
                Уникальный дизайн для каждого проекта
                <span class="tip">Разработка <strong>уникального дизайна</strong> по желаниям заказчика</span>
            </a>
            <a class="id-2 block support" tabindex="1">
                Разработка сайтов под все устройства
                <span class="tip">Возможность применения <strong>адаптивной</strong> или <strong>резиновой</strong> верстки для улучшения отображения на различных экранах</span>
            </a>
            <a class="id-3 block support" tabindex="1">
               24 реализованных проекта за 2014 г
                <span class="tip">Со многими, недавно реализованными проектами вы можете ознакомиться в разделе портфолио</span>
            </a>
            <a class="id-4 block support" tabindex="1">
                Тех поддержка 24/7<br>без выходных
                <span class="tip">После сдачи проекта <strong>мы проведем обучение</strong>. И если у вас возникнут проблемы с сайтом, придем на помощь!</span>
            </a>
            <a class="id-5 block support" tabindex="1">
                Сайт на любой CMS
                <span class="tip">Готовы разработать сайт на любой из перечисленных CMS: Bitrix, Drupal, Joomla, WP. А так же можем разработать практически с ноля на фреймворке!</span>
            </a>
            <a class="id-6 block support" tabindex="1">
                Партнер 1С
                <span class="tip">Мы являемся официальными партнерами 1С Битрикс. Заказывая у нас, вы будите уверены, что вашим сайтом занимаются сертифицированные специалисты!</span>
            </a>
        </div>
        <div class="form-zakaz form1">
            <div class="form-name">Отправьте заявку <br>на разработку сайта</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "std_composit",
                Array(
                    "WEB_FORM_ID" => "15",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "USE_EXTENDED_ERRORS" => "N",
                    "SEF_MODE" => "N",
                    "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "LIST_URL" => "/blagodarnost/blagodarnost".$_GET['bid'].".php",
                    "EDIT_URL" => "result_edit.php",
                    "SUCCESS_URL" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "CHAIN_ITEM_LINK" => "",
                    "AJAX_MODE" => "Y",  // режим AJAX
                    "AJAX_OPTION_SHADOW" => "N", // затемнять область
                    "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
                    "AJAX_OPTION_STYLE" => "N", // подключать стили
                    "AJAX_OPTION_HISTORY" => "N"
                )
            );?>
        </div>
    </div>
</div>
<div id="zakazati_site"></div>


<!--    <script src="/sendmail/jquery.formatter.min.js"></script>-->
<script>
    $(document).ready(function () {

        $('form input#edit-name').on('input', function () {
            tmp = $(this).val();
            if (tmp.length < 5) {
                if (!$(this).hasClass('invalid'))
                    $(this).addClass('invalid');
                if ($(this).hasClass('passed'))
                    $(this).removeClass('passed');
            }
            else {
                if ($(this).hasClass('invalid'))
                    $(this).removeClass('invalid');
                if (!$(this).hasClass('passed'))
                    $(this).addClass('passed');
            }
        });
        $('form input#edit-email').on('input', function () {
            tmp = $(this).val().match(/.+@.+\..+/);
            if (!tmp) {
                if (!$(this).hasClass('invalid'))
                    $(this).addClass('invalid');
                if ($(this).hasClass('passed'))
                    $(this).removeClass('passed');
            }
            else {
                if ($(this).hasClass('invalid'))
                    $(this).removeClass('invalid');
                if (!$(this).hasClass('passed'))
                    $(this).addClass('passed');
            }
        });

        $('form #edit-submit').click(function (e) {
            e.preventDefault();

            passed = true;
            $('form #edit-email, form #edit-name').each(function () {
                if (!$(this).hasClass('passed')) {
                    passed = false;
                    if (!$(this).hasClass('invalid'))
                        $(this).addClass('invalid');
                }
            });
            if (passed) {
                outdata = {
                    name:    $('form #edit-name').val(),
                    email:   $('form #edit-email').val(),
                    subject: 'Заказ расчёта стоимости разработки | webpro.su'
                }
                $.post('/sendmail/index.php?send_msg=1', outdata, function (data, msg) {
                    console.log(msg);
                    if (msg == 'success') {
                        location.assign('/blagodarnost.php');
                    } else {
                        console.log(data);
                    }
                });
            }
        });

    });
</script>