<div id="usl-block-1">
    <div class="width-list">
        <div class="block-name bold">Создание продающих сайтов для бизнеса</div>
        <div class="block-pre-name">дизайн и разработка сайтов-визиток,<br>лэндингов и интернет магазинов с высокой
                                    конверсией!
        </div>
        <div class="hr"></div>
        <div class="pozitiv razrab">
            <div class="pozitiv-name bold">Почему мы?</div>
            <a class="id-1_1 block support" tabindex="1">
                Качественный<br> веб-дизайн
                <span class="tip">Разработка <strong>уникального дизайна</strong> по желаниям заказчика</span>
            </a>
            <a class="id-2_2 block support" tabindex="1">
                Разработка сайтов под все устройства
                <span class="tip">Возможность применения <strong>адаптивной</strong> или <strong>резиновой</strong> верстки для улучшения отображения на различных экранах</span>
            </a>
            <a class="id-3_3 block support" tabindex="1">
                Выгодные цены<br> для вас
                <span class="tip">Мы являемся партнерами <strong>многих</strong> организация и можем предложить скидки на некоторые услуги</span>
            </a>
            <a class="id-4_4 block support" tabindex="1">
                Тех поддержка <br>без выходных
                <span class="tip">После сдачи проекта <strong>мы проведем обучение</strong>. И если у вас возникнут проблемы с сайтом, придем на помощь!</span>
            </a>
        </div>
        <div class="form-zakaz form1">
            <div class="form-name">Отправить заявку <br>на разработку сайта</div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:form.result.new",
                "",
                Array(
                    "WEB_FORM_ID" => "4",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "USE_EXTENDED_ERRORS" => "N",
                    "SEF_MODE" => "N",
                    "VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "LIST_URL" => "result_list.php",
                    "EDIT_URL" => "result_edit.php",
                    "SUCCESS_URL" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "CHAIN_ITEM_LINK" => ""
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