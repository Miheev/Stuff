<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тест");
?> 
<div class="main-container"> 
  <div class="main wrapper clearfix"> <section class="reg-form"> <header> 
        <h2>Регистрация</h2>
       
        <h4>Войдите с помощью</h4>
       
        <p>Мы ничего не публикуем без Вашего разрешения</p>
       </header> 
      <div class="content"> 
        <div class="qauth"> <a href="#" ><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/btn_facebook.png" width="138" height="39"  /></a> <a href="#" ><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/btn_vk.png" width="139" height="39"  /></a> <a href="#" ><img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/btn_mail.png" width="138" height="39"  /></a> </div>
       
        <p class="or">или</p>
       <?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"user_reg",
	Array(
		"USER_PROPERTY_NAME" => "",
		"SHOW_FIELDS" => array('NAME','LAST_NAME','EMAIL','LOGIN','PASSWORD','CONFIRM_PASSWORD',),
		"REQUIRED_FIELDS" => array(0=>"EMAIL",1=>"NAME",2=>"LAST_NAME",),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array()
	)
);?> 
               
      
       </div>
     <footer> Уже зарегистрированы? <a href="#" >Войти</a> </footer> </section> 
    <div class="description">На DreamStart Вы можите воплотить свои мечты, узнать о мечтах других людей и помощь им их воплотить</div>
   </div>
 
<!-- #main -->
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>