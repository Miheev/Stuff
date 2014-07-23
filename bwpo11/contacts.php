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
                                                    font-weight: bold;
                                                    width:       40%;
                                                    font-size:   12px;
                                                    display: inline-block;
                                                }
                                                .chek br {display: none;}

                                                input { margin:       0;
                                                    margin-bottom:    5px;
                                                    width:            320px;
                                                    border-radius:    2px;
                                                    padding:          5px;
                                                    background-color: #fff;
                                                    border:           1px solid #fff;
                                                    color:            rgb(54, 54, 54);
                                                }

                                                .btx-otprav { color:      white;
                                                    float:            right;
                                                    width:            100px;
                                                    height:           29px;
                                                    opacity:          0.5;
                                                    background-color: #414141;
                                                }

                                                .btx-otprav:hover { color: white;
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

                                                    <div class="bl appnitro">

                                                        <?$APPLICATION->IncludeComponent(
                                                                "bitrix:form.result.new",
                                                                "contact1",
                                                                Array(
                                                                    "WEB_FORM_ID" => "8",
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

                                                    <div>
                                                        <?$APPLICATION->IncludeComponent(
                                                            "bitrix:form.result.new",
                                                            "contact2",
                                                            Array(
                                                                "WEB_FORM_ID" => "9",
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
                                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
    </div>

<script>
    $('form').each(function(){
        $(this).find('input[type="text"]').eq(0).attr('placeholder', 'Введите имя');
        $(this).find('input[type="text"]').eq(1).attr('placeholder', 'Введите email');
        $(this).find('textarea').attr('placeholder', 'Ваш комментарий');
    });
</script>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>