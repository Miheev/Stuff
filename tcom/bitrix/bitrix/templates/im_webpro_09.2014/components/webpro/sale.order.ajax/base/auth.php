<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
<!--
function ChangeGenerate(val)
{
	if(val)
	{
		document.getElementById("sof_choose_login").style.display='none';
	}
	else
	{
		document.getElementById("sof_choose_login").style.display='block';
		document.getElementById("NEW_GENERATE_N").checked = true;
	}

	try{document.order_reg_form.NEW_LOGIN.focus();}catch(e){}
}
//-->
</script>
<div class="order-auth clearfix">
	<div class="left">
			<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
				<h3><?echo GetMessage("STOF_2REG")?></h3>
			<?endif;?>
        <p>Если вы помните свой логин и пароль, то введите их в соответствующие поля:</p>
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "order_auth",
            array(
                "REGISTER_URL" => "/auth",
                "FORGOT_PASSWORD_URL" => "/auth",
                "PROFILE_URL" => "/personal/profile",
                "SHOW_ERRORS" => "Y",
                "AUTH_SERVICES" => "N"
            ),
            false
        );?>
    </div>
    <div class="right">
			<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
				<h3><?echo GetMessage("STOF_2NEW")?></h3>
			<?endif;?>
        <?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
            <?$APPLICATION->IncludeComponent(
                "webpro:main.register",
                "order_register",
                array(
                    "SHOW_FIELDS" => array(
                        0 => "PERSONAL_MOBILE",
                    ),
                    "REQUIRED_FIELDS" => array(
                        0 => "PERSONAL_MAILBOX",
                    ),
                    "AUTH" => "Y",
                    "USE_BACKURL" => "Y",
                    "SUCCESS_PAGE" => "",
                    "SET_TITLE" => "N",
                    "USER_PROPERTY" => array(
                    ),
                    "USER_PROPERTY_NAME" => ""
                ),
                false
            );?>
        <?endif;?>
    </div>
</div>
<div class="extra-info clearfix">
    <p><?echo GetMessage("STOF_REQUIED_FIELDS_NOTE")?></p>
<!--    --><?//if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
<!--        <p>--><?//echo GetMessage("STOF_EMAIL_NOTE")?><!--</p>-->
<!--    --><?//endif;?>
    <p><?echo GetMessage("STOF_PRIVATE_NOTES")?></p>
</div>
