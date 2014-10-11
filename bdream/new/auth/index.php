<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");?>
    <section class="reg-form">
        <header>
            <h2>Авторизация</h2>
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
                "bitrix:system.auth.form",
                "",
                array(
                    "REGISTER_URL" => "/auth/reg",
                    "FORGOT_PASSWORD_URL" => "/auth",
                    "PROFILE_URL" => "/personal",
                    "SHOW_ERRORS" => "Y",
                    "AUTH_SERVICES" => "Y"
                ),
                false
            );?>
        </div>
        <footer>
            Еще не зарегистрированы? <a href="/auth/reg">Зарегистрироваться</a>
        </footer>
    </section>
    <div class="description">На DreamStart Вы можите воплотить свои мечты, узнать о мечтах других людей и помощь им их воплотить</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>