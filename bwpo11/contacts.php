<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Наши контакты");
?>


    <div class="column width-list">

            <a id="main-content"></a>

            <div class="block-name-content">
                <span class="black">Наши</span> <span class="green">контакты</span>
            </div>
            <div class="block-name-hr"></div>


            <div class="tabs"></div>
            <div class="region region-content">
                <div id="block-system-main" class="block block-system">


                    <div class="content">
                        <div id="node-4" class="node node-page clearfix" about="/contacts" typeof="foaf:Document">


                            <div class="content clearfix">
                                <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                                    <div class="field-items">
                                        <div class="field-item even" property="content:encoded">
                                            <style>
                                                <!--
                                                /*--><![CDATA[/* ><!--*/

                                                .korpus input[type="radio"]:checked + label {
                                                    color: #94b507;
                                                }

                                                .korpus label:hover {
                                                    color:  #94b507;
                                                    cursor: pointer;
                                                }

                                                .korpus label:active {
                                                    color: #006414;
                                                }

                                                textarea {
                                                    width:            320px;
                                                    height:           100px;
                                                    margin-top:       10px;
                                                    resize:           none;
                                                    background-color: #fff;
                                                    border-radius:    5px;
                                                    border:           #fff;
                                                }

                                                .blok {
                                                    float: right;
                                                }

                                                .blok {
                                                    padding:          10px 40px 20px 40px;
                                                    border:           15px solid #cccccc;
                                                    border-radius:    10px;
                                                    background-color: #ededed;
                                                }

                                                .chek {
                                                    border-bottom: 1px dashed #bec1c3;
                                                    margin-top:    5px;
                                                    display:       inline-block;
                                                    width:         100%;
                                                }

                                                .chek input {
                                                    width: 25px;
                                                }

                                                .chek label {
                                                    float:       left;
                                                    font-weight: bold;
                                                    width:       49%;
                                                    font-size:   12px;
                                                }

                                                input { margin:       0;
                                                    margin-bottom:    5px;
                                                    width:            320px;
                                                    border-radius:    2px;
                                                    padding:          5px;
                                                    background-color: #fff;
                                                    border:           1px solid #fff;
                                                    color:            rgb(54, 54, 54);
                                                }

                                                .otprav { color:      white;
                                                    float:            right;
                                                    width:            100px;
                                                    height:           29px;
                                                    opacity:          0.5;
                                                    background-color: #414141;
                                                }

                                                .otprav:hover { color: white;
                                                    float:             right;
                                                    width:             100px;
                                                    height:            29px;
                                                    background-color:  #94b507;
                                                    opacity:           1;
                                                    transition:        opacity 1s;
                                                    border:            1px solid #83A009;
                                                }

                                                /*--><!]]>*/
                                            </style>
                                            <div class="kontakt_form">
                                                <p> Наши контакты </p>

                                                <div class="phone">+7 (4212) 944-320</div>
                                                <div class="phone">+7 (909) 858-87-49</div>
                                                <div class="phone">+7 (914) 403-77-93</div>
                                                <div class="email"><a href="mailto:info@webpro.su">info@webpro.su</a>
                                                </div>
                                            </div>
                                            <div class="blok">
                                                <div class="korpus">
                                                    <input type="radio" name="odin" checked="checked" id="vkl1"><label
                                                        style="display: inline-block; margin-left: 25px;" class="vklad"
                                                        for="vkl1">Сделать заказ</label><input type="radio" name="odin"
                                                                                               id="vkl2"><label
                                                        style="display: inline-block; margin-left: 25px;" class="vklad"
                                                        for="vkl2">Задать вопрос</label>

                                                    <div class="bl">
                                                        <form id="form_1" class="appnitro" method="post"
                                                              action="/form/form1.php">
                                                            <p style="border-bottom: 1px dashed #bec1c3; padding-bottom: 5px; margin: 0px; padding-top: 10px;"></p>

                                                            <p>Ведите имя и E-mail<span
                                                                    style="color: rgb(175, 0, 0); font-size: 11px;">(Обязательное поле)</span>:
                                                            </p>
                                                            <input type="text" name="name"
                                                                   placeholder="Введите имя"><input type="text"
                                                                                                    name="email"
                                                                                                    placeholder="Введите E-mail">

                                                            <div class="chek">
                                                                <label><input type="checkbox" name="option[]"
                                                                              value="Разработка">Разработка</label>
                                                                <label>
                                                                    <input type="checkbox" name="option[]" value="a2">Дизайн</label>
                                                                <label> <input type="checkbox" name="option[]"
                                                                               value="SEO">SEO</label>
                                                                <label><input
                                                                        type="checkbox" name="option[]" value="Контекстная реклама">Контекстная
                                                                                                                   реклама</label>
                                                            </div>
                                                            <p style=" margin-bottom: -10px; ">Комментарий к заказу<span
                                                                    style="color: rgb(175, 0, 0); font-size: 11px;">(Обязательное поле)</span>:
                                                            </p>
                                                            <textarea rows="10" cols="45" name="text"
                                                                      placeholder="Ваш комментарий"></textarea><input
                                                                class="otprav order" type="submit" value="Отправить"></form>
                                                    </div>

                                                    <div>
                                                        <p style="border-bottom: 1px dashed #bec1c3; padding-bottom: 5px; margin: 0px; padding-top: 10px;"></p>

                                                        <form id="form_2" class="appnitro" method="post"
                                                              action="/form/form2.php">
                                                            <p>Ведите имя и E-mail<span
                                                                    style="color: rgb(175, 0, 0); font-size: 11px;">(Обязательное поле)</span>:
                                                            </p>
                                                            <input type="text" name="name"
                                                                   placeholder="Введите имя"><input type="text"
                                                                                                    name="email"
                                                                                                    placeholder="Введите E-mail">

                                                            <p style=" margin-bottom: -10px; ">Впишите ваш вопрос <span
                                                                    style="color: rgb(175, 0, 0); font-size: 11px;">(Обязательное поле)</span>:
                                                            </p>
                                                            <textarea rows="10" name="text"
                                                                      placeholder="Введите ваш вопрос"></textarea><input
                                                                class="otprav question" type="submit" value="Отправить"
                                                                style=" color: white; float: right; width: 100px; height: 29px; margin-right: 5px; ">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
    </div>

<!--    <script src="/sendmail/jquery.formatter.min.js"></script>-->
    <script >
        $(document).ready(function(){

//            $('input[name="year"]').on('input', function(){
//                tmp= $(this).val().replace(/[\D]/g, '');
//                tmp= tmp.substr(0,4);
//                if (tmp > curyear)
//                    $(this).val(curyear);
//                else
//                    $(this).val(tmp);
//            });
//            $('input[name="ddate"]').formatter({
//                'pattern': '{{99}}.{{99}}.{{9999}}',
//                'persistent': false
//            });

//            $('form input[name="name"]').on('input', function(){
//                tmp= $(this).val();
//                if (tmp.length < 5) {
//                    if (!$(this).hasClass('invalid'))
//                        $(this).addClass('invalid');
//                    if ($(this).hasClass('passed'))
//                        $(this).removeClass('passed');
//                }
//                else {
//                    if ($(this).hasClass('invalid'))
//                        $(this).removeClass('invalid');
//                    if (!$(this).hasClass('passed'))
//                        $(this).addClass('passed');
//                }
//            });
            $('form input[name="email"]').on('input', function(){
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
            $('form textarea').on('input', function(){
                tmp= $(this).val();
                if (tmp.length < 10) {
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


            $('form .otprav').click(function(e){
                e.preventDefault();

                passed= true;
                if ($(this).hasClass('order')) {
                    $('#form_1 input[name="email"], #form_1 textarea').each(function(){
                        if (!$(this).hasClass('passed')) {
                            passed= false;
                            if (!$(this).hasClass('invalid'))
                                $(this).addClass('invalid');
                        }
                    });
                    if (passed) {
                        outck= [];
                        $('#form_1 input[type="checkbox"]').each(function(){
                            if ($(this).prop('checked'))
                                outck.push($(this).val());
                        });
                        outdata= {
                            name: $('#form_1 input[name="name"]').val(),
                            email: $('#form_1 input[name="email"]').val(),
                            message: $('#form_1 textarea').val(),
                            subject: 'Новый заказ | webpro.su',
                            ckbox: outck
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
                }
                if ($(this).hasClass('question')) {
                    $('#form_2 input[name="email"], #form_2 textarea').each(function(){
                        if (!$(this).hasClass('passed')) {
                            passed= false;
                            if (!$(this).hasClass('invalid'))
                                $(this).addClass('invalid');
                        }
                    });
                    if (passed) {
                        outdata= {
                            name: $('#form_2 input[name="name"]').val(),
                            email: $('#form_2 input[name="email"]').val(),
                            message: $('#form_2 textarea').val(),
                            subject: 'Новый вопрос | webpro.su'
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
                }
            });

        });
    </script>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>