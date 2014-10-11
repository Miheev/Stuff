<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("");
/*
$arfields = array(
		"NAME",
		"LAST_NAME",
		"PERSONAL_COUNTRY",
		"PERSONAL_CITY",
		"PERSONAL_BIRTHDAY",
		"PERSONAL_GENDER",
		"PERSONAL_PHONE",
		"UF_WEB",
		"UF_SKYPE",
		"UF_SHOW_LAST_NAME",
		"UF_EN_NAME",
		"UF_EN_LAST_NAME"
		);


$APPLICATION->IncludeComponent("lol:main.register_new","",Array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "Y",
		"SHOW_FIELDS" => $arfields,
		"REQUIRED_FIELDS" => Array(),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/personal/",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => Array(),
		"SEF_FOLDER" => "/",
		"VARIABLE_ALIASES" => Array()
)
);
*/

?>
    <section class="reg-form">
        <header>
            <h2>Регистрация</h2>
            <h4>Войдите с помощью</h4>
            <p>Мы ничего не публикуем без Вашего разрешения</p>
        </header>
        <div class="content">
            <div class="qauth">
                <a href="#"><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/btn_facebook.png" width="138" height="39" /></a>
                <a href="#"><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/btn_vk.png" width="139" height="39" /></a>
                <a href="#"><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/btn_mail.png" width="138" height="39" /></a>
            </div>
            <p class="or">или</p>
            <?$APPLICATION->IncludeComponent(
                "webpro:main.register",
                "user_reg",
                Array(
                    "USER_PROPERTY_NAME" => "",
                    "SHOW_FIELDS" => array(0 => "EMAIL", 1 => "NAME", 2 => "LAST_NAME",),
                    "REQUIRED_FIELDS" => array(0 => "EMAIL", 1 => "NAME", 2 => "LAST_NAME",),
                    "AUTH" => "Y",
                    "USE_BACKURL" => "Y",
                    "SUCCESS_PAGE" => "/auth/reg/success.php",
                    "SET_TITLE" => "Y",
                    "USER_PROPERTY" => array()
                )
            );?>
        </div>
        <footer> Уже зарегистрированы? <a href="#">Войти</a></footer>
    </section>
    <div class="description">На DreamStart Вы можите воплотить свои мечты, узнать о мечтах других людей и помощь им их воплотить</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>