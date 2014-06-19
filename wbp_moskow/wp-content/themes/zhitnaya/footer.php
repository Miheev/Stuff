﻿		<div class="wrap wrap_footer">
            <div class="wrap__inner">
                <div class="footer">
					<ul class="contacts list-with-sep-hor">
                        <li>Москва, Житная дом 10</li>
                        <li><b>+7 (499) 238-11-07</b></li>
                        <li><b>+7 (499) 238-30-10</b></li>
                        <li>Каждый день, с 09:00 до 23:00</li>
                    </ul>
                    <hr class="separator clear" />
                    <div class="mobi">
                        <ul class="ContentBoxes ContentBoxes_social">
                            <li>
                                <a href="#" target="_blank">
                                    <i style="background-image:url(/images/social_fb.png);">Фейсбук</i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i style="background-image:url(/images/social_gp.png);">Форсквер</i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i style="background-image:url(/images/social_tw.png);">Форсквер</i>
                                </a>
                            </li>
                        </ul>
					</div>
                    <ul class="ainfo list-with-sep-hor">
                        <li>Все права защищены <b><i>© Житная 10,</i></b> 2014</li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

<!-- Reserve table -->
<div id="reserveTable" class="reveal-modal Form-index">
	<div class="reserve-form">
		<div class="head" style="background-color:#FFF;">
			<div class="time">Каждый день<br />с 09:00 до 23:00</div>
			<div class="logo"><img src="/images/logo.png" /></div>
			<div class="phone">+7 (499) 238-11-07<br />+7 (499) 238-30-10</div>
			<div class="clear"></div>
		</div>
		<div class="title typo--h3 typo--align_center typo--upc typo--brand_color">Резерв столика</div>
		<div class="message-ok" style="display:none;text-align:center;">
			Спасибо, заявка успешно отправлена.<br />
			Наш менеджер свяжется с вами по указанному телефону,<br />
			чтобы уточнить детали заказа.
		</div>
		<form onsubmit="return false;" name="reserve">
			<input type="hidden" name="mode" value="send"/>
			<input type="hidden" name="form_code" value="reserve"/>
			<div class="form">
				<div class="form-cell">
					<div class="gap name">
						<label for="name"><span>Представьтесь, пожалуйста</span><input type="text" name="name" id="name"/></label>
						<div class="err">&nbsp;</div>
					</div>
				</div>
				<div class="form-cell">
					<div class="gap phone">
						<label for="phone"><span>Ваш контактный телефон</span><input type="text" name="phone" placeholder="+7 000 0000000" id="phone"/></label>
						<div class="err">&nbsp;</div>
					</div>
				</div>
				<div class="form-cell">
					<div class="gap email">
						<label for="email"><span>Электронная почта</span><input type="text" name="email" id="email"/></label>
						<div class="err">&nbsp;</div>
					</div>
				</div>
				<div class="form-cell">
					<div class="gap persons">
						<label for="persons"><span>Количество гостей</span><input type="text" name="persons" id="persons"/></label>
						<div class="err">&nbsp;</div>
					</div>
				</div>
				<div class="form-cell">
					<div class="gap date">
						<label for="date"><span>Дата визита</span><input type="text" name="date" id="date"/></label>
						<div class="err">&nbsp;</div>
					</div>
				</div>
				<div class="form-cell">
					<div class="gap timeFrom timeTo">
						<span>Время визита</span>с&nbsp;<input type="text" name="timeFrom" placeholder="ЧЧ:ММ" id="timeFrom"/> до&nbsp;<input type="text" name="timeTo" placeholder="ЧЧ:ММ" id="timeTo"/>
						<div class="err">&nbsp;</div>
					</div>
				</div>
                <div class="form-cell">
					<div class="gap smoke">
						<label for="smoke"><span>Зал:</span><select name="smoke" id="smoke"><option value="no">Балкон</option><option value="yes">Первый этаж</option></select></label>
						<div class="err">&nbsp;</div>
					</div>
				</div>
				<div class="form-cell form-cell_full typo--align_center">
					<div class="gap submit-block">
						<input type="submit" value="Зарезервировать" class="reserveQuery"/>
					</div>
				</div>
			</div>
		</form>
	</div>
	<a class="close-reveal-modal">&#215;</a>
</div>
<script type="text/javascript">
$('#menu-item-104 a').attr("data-reveal-id", "reserveTable");
$('#menu-item-104 a').attr("data-animation", "fade");


 $(document).ready(function(){

    $(".reserveQuery").click(function () {
		var smoke=$("#smoke :selected").val();
		var name=$("#name").val();
		if(name==""){
			$("#name").css("border","1px solid #F00");
			$("#name").css("background","#FDCACA");	
		}else{
			$("#name").css("border","1px solid #BEBCBC");
			$("#name").css("background","#fff");			
		}
	  
		var phone=$("#phone").val();  
		if(!isValidPHONE(phone)){//если номер телефона не подходит
			$("#phone").css("border","1px solid #F00");
			$("#phone").css("background","#FDCACA");
		}else{
			$("#phone").css("border","1px solid #BEBCBC");
			$("#phone").css("background","#fff");			
		}
		
		var email=$("#email").val();
		if(!isValidEMAIL(email)){//если email не верный
			$("#email").css("border","1px solid #F00");
			$("#email").css("background","#FDCACA");	  
		}else{
			$("#email").css("border","1px solid #BEBCBC");
			$("#email").css("background","#fff");			
		}
		
		var persons=$("#persons").val();
		if(!isValidQUEST(persons) || persons==""){//если указано не число или пусто
			$("#persons").css("border","1px solid #F00");
			$("#persons").css("background","#FDCACA");	  
		}else{
			$("#persons").css("border","1px solid #BEBCBC");
			$("#persons").css("background","#fff");			
		}
		
		var date=$("#date").val();
		if(date==""){//если дата не заполнена
			$("#date").css("border","1px solid #F00");
			$("#date").css("background","#FDCACA");	  		
		}else{
			$("#date").css("border","1px solid #BEBCBC");
			$("#date").css("background","#fff");			
		}
		
		var timeFrom=$("#timeFrom").val();
		var timeTo=$("#timeTo").val();
		
		timeFrom_CHANGE = timeFrom.split(':');
		timeTo_CHANGE = timeTo.split(':');
		if(timeFrom_CHANGE[0]<timeTo_CHANGE[0]){
			$("#timeFrom").css("border","1px solid #F00");
			$("#timeFrom").css("background","#FDCACA");
			$("#timeTo").css("border","1px solid #F00");
			$("#timeTo").css("background","#FDCACA");			
		}else{
			$("#timeFrom").css("border","1px solid #BEBCBC");
			$("#timeFrom").css("background","#fff");
			$("#timeTo").css("border","1px solid #BEBCBC");
			$("#timeTo").css("background","#fff");			
		}
		if(timeFrom==""){
			$("#timeFrom").css("border","1px solid #F00");
			$("#timeFrom").css("background","#FDCACA");	
		}else{
			$("#timeFrom").css("border","1px solid #BEBCBC");
			$("#timeFrom").css("background","#fff");			
		}
		if(timeTo==""){
			$("#timeTo").css("border","1px solid #F00");
			$("#timeTo").css("background","#FDCACA");	
		}else{
			$("#timeTo").css("border","1px solid #BEBCBC");
			$("#timeTo").css("background","#fff");			
		}
	  
		if(name!="" && isValidPHONE(phone) && isValidEMAIL(email)){//если все условия выполнены
				$.ajax({
					url: '/forms/reserve.php',
					success: function (success) {
						$(".gap.submit-block").html(success);
					},
					type: 'POST',
					data: {
						'name': name,
						'phone': phone,
						'email': email,
						'persons': persons,
						'date': date,
						'timeFrom': timeFrom,
						'timeTo': timeTo,
						'smoke': smoke
					}			
				});
		}
    });
  });

  
  function isValidPHONE(myPhone) {
	   return /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/.test(myPhone); 
	}
	function isValidEMAIL(myEmail) { 
	   return /^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/.test(myEmail); 
	}
	function isValidQUEST(myQUEST) { 
	   return /^[0-9]{0,1000}$/.test(myQUEST);
	}
</script>

</body>

</html>