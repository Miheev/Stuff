var a=1;
var file_value;
var artic;

  
var h_hght = 125;  // высота шапки
var h_mrg = 0;     // отступ когда шапка уже не видна
$(function(){
    $(window).scroll(function(){
        var top = $(this).scrollTop();
        var elem = $('.menu_main');
        if (top+h_mrg < h_hght) {
            elem.css('top', (h_hght-top));
        } else {
            elem.css('top', h_mrg);
        }
    });
});

function scroll(p){
	var curPos=$(document).scrollTop();
	var scrollTime=curPos/1.73;
	$("body,html").animate({"scrollTop":p},500);
}


function schot1(){ 
	var a1 = $('#height1').val();
	var b1 = $('#width1').val();
	var c = a1*b1*0.3370;
   $('#cena1').val(c);
}

function schot2(){ 
	var a1 = $('#height2').val();
	var b1 = $('#width2').val();
	var c = a1*b1*0.3370;
   $('#cena2').val(c);
}


function file_send(form){
artic = $('#art').val();
$('#zayavka2').toggle();
}

function zakaz(windows){
$(windows).toggle();
}

function validation(form_name,a){
	var form = $(form_name).first();

    mail_id= $(form_name).attr('data-mail');

	var name = $(form_name).find('input[name="name'+mail_id+'"]').val();
	var phone = $(form_name).find('input[name="phone'+mail_id+'"]').val();
	var email = $(form_name).find('input[name="email'+mail_id+'"]').val();


	if (name == null || name == ""){
		alert("Введите ваше имя!");
		return false;
	}
	if (phone == null || phone == ""){
		alert("Введите ваш телефон!");
		return false;
	}

		$.ajax({ // инициализируем ajax запрос

               type: 'POST', // отправляем в POST формате
               url: 'mail.php?form='+mail_id, // путь до обработчика, у нас он лежит в той же папке
               dataType: 'json', // ответ ждем в json формате
               data : {name : 'name', phone : 'phone', email: 'email'}, // данные для отправки
            });

zakaz('#sps');
	setTimeout($(form).submit(),2500); 
	
	if(a == 1){location.href="https://yadi.sk/d/YXcrGdK2bUY4R";}
	return false;
}

function validation_file(form_name){
	var form = $(form_name).first();
	$(form).find('#art2').val(artic);
	var name = $(form).find('input[name="name"]').val();
	var phone = $(form).find('input[name="phone"]').val();
	var file = $(form).find('#my_file').val();
	var article = $(form).find('input[name=art2]').val();
	if (name == null || name == ""){
		alert("Введите ваше имя!");
		return false;
	}
	if (phone == null || phone == ""){
		alert("Введите ваш телефон!");
		return false;
	}

	$.ajax({ // инициализируем ajax запрос

               type: 'POST', // отправляем в POST формате, можно GET
               url: 'php_fail.php', // путь до обработчика, у нас он лежит в той же папке
               dataType: 'json', // ответ ждем в json формате
               data : {name : 'name', phone : 'phone', email: 'email', file: 'file',article : 'article'}, // данные для отправки
            });
	zakaz('#sps');
	setTimeout($(form).submit(),2500); 
	return false;
}




function rot (key) {
	switch (key) {
	    case 1:
	    	$('.slide').animate({opacity:0},250);
	    	$('#slide1').animate({opacity:1},250);
	    	$('.pag').css({'background': '#4b4941'});
	    	$('#pag1').css({'background': '#c0a03b'});
	    	a=1;
	    	break;
	    case 2:
	    	$('.slide').animate({opacity:0},250);
		    $('#slide2').animate({opacity:1},250);
		    $('.pag').css({'background': '#4b4941'});
	    	$('#pag2').css({'background': '#c0a03b'});
	    	a=2;
		    break;
	    case 3:
		    $('.slide').animate({opacity:0},250);
			$('#slide3').animate({opacity:1},250);
			$('.pag').css({'background': '#4b4941'});
	    	$('#pag3').css({'background': '#c0a03b'});
	    	a=3;
			break;
		case 4:
			$('.slide').animate({opacity:0},250);
			$('#slide4').animate({opacity:1},250);
			$('.pag').css({'background': '#4b4941'});
	    	$('#pag4').css({'background': '#c0a03b'});
	    	a=4;
			break;
	}
}

function next(){
		switch (a) {
	    case 1:
	    	a=2;
	    	rot(a);
	    	break;
	    case 2:
		    a=3;
		    rot(a);
		    break;
	    case 3:
			a=4;
			rot(a);
			break;
		case 4:
			a=1;
			rot(a);
			break;
	}
}

function prev(){
		switch (a) {
	    case 1:
	    	a=4;
	    	rot(a);
	    	break;
	    case 2:
		    a=1;
		    rot(a);
		    break;
	    case 3:
			a=2;
			rot(a);
			break;
		case 4:
			a=3;
			rot(a);
			break;
	}
}

