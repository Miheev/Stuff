<?php

if (isset($_GET['form']))
    $id= $_GET['form'];
else
    $id= '';

    if ($_POST) { // если передан массив POST
        $name = isset($_POST["name".$id]) ? '': htmlspecialchars($_POST["name".$id]); // пишем данные в переменные и экранируем спецсимволы
        $phone = isset($_POST["name".$id]) ? '': htmlspecialchars($_POST["phone".$id]);
        $email = isset($_POST["name".$id]) ? '': htmlspecialchars($_POST["email".$id]);
    }
        if (empty($name)) exit();

  	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

 	$mail_to = "speed.live@mail.ru";
	$thema = "Новая заявка";
	$message .= '
    '."Name: ".$name.'<br>
    '."Phone: ".$phone.'<br>
    '."Email: ".$email.'<br>
    ';
  // Отправляем почтовое сообщение
  mail($mail_to, $thema, $message, $headers);


//
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

header('Location: /');
?>