    <div id="usl-block-1">
        <div class="width-list">
            <div class="block-name bold">Продвижение и реклама для сайта</div>
            <div class="block-pre-name">seo продвижение, оптимизация, контекстно-медийная реклама для вашего сайта</div>
            <div class="hr"></div>
            <div class="pozitiv razrab">
                <div class="pozitiv-name bold">Почему мы?</div>
                <div class="id-1 block">Настройка потока потенциальных клиентов</div>
                <div class="id-2 block">Реклама в ведущих поисковых системах</div>
                <div class="id-3 block">Выгодные цены<br> для вас</div>
                <div class="id-4 block">Ежемесячная отчетность</div>
            </div>
            <div class="form-zakaz form1">
                <div class="form-name">Заказать рекламу или продвижение</div>
                <form action="/prodvizhenie" method="post" id="my-module-example-form" accept-charset="UTF-8">
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
                                                       value="form-RwG715I1CwscoojoddoYyFznfeBK99f4SuU7J2EyIVI8EbTS-o5Gmo6LWnY">
                        <input type="hidden" name="form_id" value="my_module_example_form">
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                        subject: 'Заказ расчёта стоимости продвижения | webpro.su'
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