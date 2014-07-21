    <div id="usl-block-1">
        <div class="width-list">
            <div class="block-name bold">Создание дизайна для вашего сайта</div>
            <div class="block-pre-name">Разработка фирменного стиля для компании<br>3D моделирование</div>
            <div class="hr"></div>
            <div class="pozitiv razrab">
                <div class="pozitiv-name bold">Мы гарантируем вам</div>
                <div class="id-1_11 block">Современный<br>веб-дизайн</div>
                <div class="id-2_22 block">Индивидуальный<br> подход</div>
                <div class="id-3_33 block">Выгодные цены<br> для вас</div>
                <div class="id-4_44 block">Тех поддержка<br> без выходных</div>
            </div>
            <div class="form-zakaz form1">
                <div class="form-name">Заказать бесплатный расчёт стоимости дизайна</div>
                <form action="/design" method="post" id="my-module-example-form" accept-charset="UTF-8">
                    <div>
                        <div class="form-item form-type-textfield form-item-name">
                            <input placeholder="Имя" class="formtxt form-text required" type="text" id="edit-name"
                                   name="name" value="" size="60" maxlength="128">
                        </div>
                        <div class="form-item form-type-textfield form-item-email">
                            <input placeholder="E-mail" class="formtxt form-text required" type="text" id="edit-email"
                                   name="email" value="" size="60" maxlength="128">
                        </div>
                        <input class="button_text form-submit" type="submit" id="edit-submit" name="op"
                               value="Заказать"><input type="hidden" name="form_build_id"
                                                       value="form-N1FoDz0ByizdTA4w6QgmVGzDSx6MlRvkptFSrqtSOk4qEeqVp9JwBqp8">
                        <input type="hidden" name="form_id" value="my_module_example_form">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--    <script src="/sendmail/jquery.formatter.min.js"></script>-->
    <script >
        $(document).ready(function(){

            $('form input#edit-name').on('input', function(){
                tmp= $(this).val();
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
            $('form input#edit-email').on('input', function(){
                tmp= $(this).val().match(/.+@.+\..+/);
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

            $('form #edit-submit').click(function(e){
                e.preventDefault();

                passed= true;
                $('form #edit-email, form #edit-name').each(function(){
                    if (!$(this).hasClass('passed')) {
                        passed= false;
                        if (!$(this).hasClass('invalid'))
                            $(this).addClass('invalid');
                    }
                });
                if (passed) {
                    outdata= {
                        name: $('form #edit-name').val(),
                        email: $('form #edit-email').val(),
                        subject: 'Заказ расчёта стоимости дизайна | webpro.su'
                    }
                    $.post('/sendmail/index.php?send_msg=1', outdata, function(data, msg){
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