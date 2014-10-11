<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Каталог книг");
?>

    <div class="smenu-container">
        <div class="smenu wrapper clearfix">
            <div class="left">
                <ul class="menu">
                    <li class="active potreb"><a href="#"><span class="ico"></span><span class="text">Потребительские кредиты</span></a></li>
                    <li class="micro"><a href="#"><span class="ico"></span><span class="text">Микрозаймы</span></a></li>
                    <li class="cart"><a href="#"><span class="ico"></span><span class="text">Кредитные карты</a></li>
                    <li class="ipo"><a href="#"><span class="ico"></span><span class="text">Ипотека</a></li>
                    <li class="auto"><a href="#"><span class="ico"></span><span class="text">Автокредиты</a></li>
                </ul>
            </div>
            <div class="right">
                <ul class="menu">
                    <li class="output"><a href="#"><span class="ico"></span><span class="text">Вклады</span></a></li>
                    <li class="area"><a href="#"><span class="ico"></span><span class="text">Банковские ячейки</span></a></li>
                    <li class="small"><a href="#"><span class="ico"></span><span class="text">Кредитны/Займы для малого бизнеса</span></a></li>
                    <li class="osago"><a href="#"><span class="ico"></span><span class="text">ОСАГО</span></a></li>
                    <li class="kasko"><a href="#"><span class="ico"></span><span class="text">КАСКО</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="main wrapper clearfix">
            <aside class="right">
                <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php",
                        "PATH" => SITE_TEMPLATE_PATH."/include/right_banner.php"
                    )
                );?>
            </aside>
            <div class="center">
                <section class="service clearfix">
                    <div class="left">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/money.jpg" />
                    </div>
                    <div class="right">
                        <h2>О сервисе</h2>
                        <div class="text">
                            <p>Наш сервис Банковских и страховых продуктов поможет Вам сделать оптимальны выбор для решения финансовых проблем... Существует две основных трактовки понятия "текст" - "имманентная" (расшиенная, философски нагруженная) и репрезентативная (более частная).</p>
                        </div>
                    </div>
                </section>
                <section class="offer">
                    <h2>Последние предложения</h2>
                    <div class="content">
                        <table>
                            <tbody>
                            <tr>
                                <td class="name">Потребительские кредиты</td>
                                <td class="desc">
                                    <p>&laquo;Большие возможности&raquo;</p>
                                    <p>&laquo;Наличными&raquo;</p>
                                </td>
                                <td class="rate">
                                    <p>от 17.9%</p>
                                    <p>от 15.9%</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="name">Вклады</td>
                                <td class="desc">
                                    <p>&laquo;Золотая осень&raquo;</p>
                                    <p>&laquo;Лояльный&raquo;</p>
                                </td>
                                <td class="rate">
                                    <p>от 17.9%</p>
                                    <p>от 15.9%</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="name">Ипотека</td>
                                <td class="desc">
                                    <p>&laquo;Квартира&raquo;</p>
                                    <p>&laquo;Приобретённые квартиры&raquo;</p>
                                </td>
                                <td class="rate">
                                    <p>от 17.9%</p>
                                    <p>от 15.9%</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        <div class="main wrapper clearfix">
            <?$APPLICATION->IncludeComponent("bitrix:news.list", "news_index", array(
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "24",
                    "NEWS_COUNT" => "4",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "ID",
                    "SORT_ORDER2" => "DESC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "PAGER_TEMPLATE" => "",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => ""
                ),
                false
            );?>
            <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "standard.php",
                    "PATH" => SITE_TEMPLATE_PATH."/include/bottom_banner.php"
                )
            );?>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>