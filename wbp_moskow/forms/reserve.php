<?
if ($_POST){
	$subject="РЕЗЕРВ СТОЛИКА";
	$message="";
	if($_POST['name']!=""){
		$message.="Имя заказчика: ".$_POST['name'];
	}
	if($_POST['phone']!=""){
		$message.="\n\rНомер телефона: ".$_POST['phone'];
	}
	if($_POST['email']!=""){
		$message.="\n\rEmail: ".$_POST['email'];
	}
	if($_POST['persons']!=""){
		$message.="\n\rКоличество гостей: ".$_POST['persons'];
	}
	if($_POST['date']!=""){
		$message.="\n\rДата заказа: ".$_POST['date'];
	}
	if($_POST['timeFrom']!=""){
		$message.="\n\rВремя С: ".$_POST['timeFrom'];
	}
	if($_POST['timeTo']!=""){
		$message.="\n\rВремя ДО: ".$_POST['timeTo'];
	}
	if($_POST['smoke']!=""){
		if($_POST['smoke']=="no"){$smoke="балкон";}
		if($_POST['smoke']=="yes"){$smoke="первый этаж";}
		$message.="Тип зала: ".$smoke;
	}
	
	
	$to="info@webpro.su";
    if (isset($_POST['email']) && !empty($_POST['email']))
        $email= $_POST['email'];
    else
        $email= 'nosigned@mail.com';

    $subject = "=?utf-8?b?".base64_encode($subject)."?=";

    $headers = "MIME-Version: 1.0\r\n";
    $headers.= "From: =?utf-8?b?".base64_encode($_POST['name'])."?= <".$email.">\r\n";
    $headers.= "Content-Type: text/plain;charset=windows-1251\r\n";
    //$headers.= "Reply-To: $reply\r\n";
    $headers.= "X-Mailer: PHP/" . phpversion();

    // создаем наше сообщение
    $body = $message;
    //$body = wordwrap($body, 70);

	if (mail($to, $subject, iconv('utf-8', 'windows-1251//IGNORE', $body), $headers)){
		echo "Заявка отправлена";
	}else{
		echo "Не удалось отправить заявку";	
	}
}
?>