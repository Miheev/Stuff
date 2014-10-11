<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?> 
<div class="bx_page"> 	 
  <h5> </h5>
 
  <h4><span style="font-weight: normal;">В личном кабинете Вы можете проверить текущее состояние корзины, ход выполнения Ваших заказов, просмотреть или изменить личную информацию, а также подписаться на новости и другие информационные рассылки.
      <br />
     </span><span style="font-weight: normal;"> Личная информация</span></h4>
 
  <h3><a href="profile/" >Изменить регистрационные данные</a></h3>
 
  <h3>Заказы 
    <br />
   
    <br />
   </h3>
 
  <h3><a href="order/" >Ознакомиться с состоянием заказов 
      <br />
     </a><a href="cart/" >Посмотреть содержимое корзины 
      <br />
     </a><a href="order/?filter_history=Y" >Посмотреть историю заказов 
      <br />
     </a> 
    <br />
   </h3>
 
  <h3>Подписка 
    <br />
   <a href="subscribe/" >Изменить подписку</a></h3>
 	 	 	 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>