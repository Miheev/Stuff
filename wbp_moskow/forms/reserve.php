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

	
$headers=""; 
	$attachments="";
	
	
	
	
	if(mail($to , $subject , $message, $headers,$attachments)){
		echo "Заявка отправлена";
	}else{
		echo "Не удалось отправить заявку";	
	}
}
?>