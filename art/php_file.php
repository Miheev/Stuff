<?php  
if ($_POST) { // если передан массив POST
    $name = htmlspecialchars($_POST["name"]); // пишем данные в переменные и экранируем спецсимволы
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $article = htmlspecialchars($_POST["article"]);
}



// В PHP 4.1.0 и более ранних версиях следует использовать $HTTP_POST_FILES
// вместо $_FILES.



 $_POST['mail_to'] = "speed.live@mail.ru";


  // проверяем правильности заполнения с помощью регулярного выражения 
 
 
  $picture = ""; 
 
  // Если поле выбора вложения не пустое - закачиваем его на сервер 
 
  if (!empty($_FILES['file']['tmp_name'])) 
 
  { 
 
    // Закачиваем файл 
 
    $path = $_FILES['file']['name']; 
 
    if (copy($_FILES['file']['tmp_name'], $path)) $picture = $path; 
 
  } 
 
  $thm = $_POST['mail_subject'];
 
  $msg = $_POST['mail_msg'];
 
  $mail_to = $_POST['mail_to'];
 
  // Отправляем почтовое сообщение 
 
  if(empty($picture)) {
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

      $msg .= '<br>
    '."Name: ".$name.'<br>
    '."Phone: ".$phone.'<br>
    '."Email: ".$email.'<br>
    '."Article: ".$article.'<br>
    ';
      // Отправляем почтовое сообщение
      mail($mail_to, $thm, $msg, $headers);
  }else
      send_mail($mail_to, $thm, $msg, $picture);
 
  // Вспомогательная функция для отправки почтового сообщения с вложением (Trianon)
 
  function send_mail($mail_to, $thema, $html, $path)   
 
  { if ($path) {  
 
    $fp = fopen($path,"rb");   
 
    if (!$fp)   
 
    { print "Cannot open file";   
 
      exit();   
 
    }   
 
    $file = fread($fp, filesize($path));   
 
    fclose($fp);   
 
    }

      $path_parts = pathinfo($path);
    $name =  $path_parts['basename']; // в этой переменной надо сформировать имя файла (без всякого пути)
 
    $EOL = "\r\n"; // ограничитель строк, некоторые почтовые сервера требуют \n - подобрать опытным путём
 
    $boundary     = "--".md5(uniqid(time()));  // любая строка, которой не будет ниже в потоке данных.  
 
    $headers    = "MIME-Version: 1.0;$EOL";   
 
    $headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";  
 
    $headers   .= "From: address@server.com";  
 
      
 
    $multipart  = "--$boundary$EOL";   
 
    $multipart .= "Content-Type: text/html; charset=utf8";   
 
    $multipart .= "Content-Transfer-Encoding: base64$EOL";   


    $multipart .= '

    '."Name: ".$_POST["name"].'<br>
    '."Phone: ".$_POST["phone"].'<br>
    '."Message: ".$_POST["email"].'<br>
    ';
 
    $multipart .= $EOL; // раздел между заголовками и телом html-части 
 
    $multipart .= chunk_split(base64_encode($html));   
 
 
 
    $multipart .=  "$EOL--$boundary$EOL";   
 
    $multipart .= "Content-Type: application/octet-stream; name=\"$name\"$EOL";   
 
    $multipart .= "Content-Transfer-Encoding: base64$EOL";   
 
    $multipart .= "Content-Disposition: attachment; filename=\"$name\"$EOL"; 


 
    $multipart .= $EOL; // раздел между заголовками и телом прикрепленного файла 
 
    $multipart .= chunk_split(base64_encode($file));   
 
    $my_data = "";
    $multipart .= "$EOL--$boundary--$EOL";
    

    if(!mail($mail_to, $thema, $multipart, $headers))   
 
         {return False;           //если не письмо не отправлено
 
      }  
 
    else { //// если письмо отправлено
    return True;  
 
    }
      header('Location: /');
  exit;  
 
  }
header('Location: /');
?>
