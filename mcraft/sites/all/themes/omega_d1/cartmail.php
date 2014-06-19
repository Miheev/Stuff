<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 4/16/14
 * Time: 11:23 PM
 */

 if (isset($_GET['userdone'])): ?>
    <?php

    // we are processing a valid submited form
    function sendMessage(&$vars) {
        // TODO: send email only after configuring your email server settings
        $name= $vars['name']['validContent'];
        $email= $vars['email']['validContent'];
        $phone= $vars['phone']['validContent'];
        $staff= $vars['staff']['validContent'];
        if (empty($name) || empty($email) || empty($staff)) return false;


        $qq=db_query('SELECT u.mail FROM {users} u WHERE u.name = :n', array(':n' => "admin"));
        if ($qq->rowCount()) $to= $qq->fetchField();

        //$to = "info@tmedia.pro";
        $subject = "=?utf-8?b?".base64_encode("Заказ от ".$email)."?=";
        $headers = "MIME-Version: 1.0\r\n";
        $headers.= "From: =?utf-8?b?".base64_encode($name)."?= <".$email.">\r\n";
        $headers.= "Content-Type: text/html;charset=windows-1251\r\n";
        //$headers.= "Reply-To: $reply\r\n";
        $headers.= "X-Mailer: PHP/" . phpversion();

        // создаем наше сообщение
        $body = 'Имя отправителя: '.$name."<br />".'Контактны: '.$phone.'  '.$email."<br /><br /><br />".$staff;
        //$body = wordwrap($body, 70);

        return mail($to, $subject, iconv('utf-8', 'windows-1251//IGNORE', $body), $headers);

    }

// name validation
    function validatename($name) {
        $name = substr(htmlspecialchars(trim($name)), 0, 100);
        if (strlen($name) > 2) {
            return setElementValidationResult(true, $name);
        } else {
            return setElementValidationResult(false, $name, "Please enter your name.");
        };
    }
    // phone validation
    function validatephone($phone) {
        $phone = substr(htmlspecialchars(trim($phone)), 0, 100);
        if (strlen($phone) > 3) {
            return setElementValidationResult(true, $phone);
        } else {
            return setElementValidationResult(false, $phone, "Please enter your name.");
        };
    }
// email validation
    function validateemail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email= substr(htmlspecialchars(trim($email)), 0, 50);
            return setElementValidationResult(true, $email);
        } else {
            return setElementValidationResult(false, $email, "This email is not valid.");
        }
    }
// message validation
    function validatestaff($message) {
        /*$message = substr(htmlspecialchars(trim($message)), 0, 1000000);
        $headerInjection = preg_match("/(bcc:|cc:|content\-type:)/i", $message);
        if (strlen($message) > 2 && !$headerInjection) {
            return setElementValidationResult(true, $message);
        } else {
            return setElementValidationResult(false, $message, "Please renter your message.");
        }*/
        return setElementValidationResult(true, $message);
    }

    function setElementValidationResult($status, $validContent = null, $validationMessage = null) {
        $result['isValid'] = $status;
        if ($status && $validContent) $result['validContent'] = $validContent;
        if ($validationMessage) $result['validationMessage'] = $validationMessage;

        return $result;
    }
    function showValidationMessage($element) {
        global $validationResult;

        $message = "";
        $messageClass[] = "validatorMessage";

        if (is_array($validationResult) && array_key_exists($element, $validationResult)) {
            $elementStatus = $validationResult[$element];

            if ($elementStatus['isValid'] == false) {
                $messageClass[] = "incorrect";
            } elseif ($elementStatus['isValid'] == true) {
                $messageClass[] = "correct";
            }

            if (array_key_exists('validationMessage', $elementStatus) && $elementStatus['validationMessage'] != null) {
                $message = $elementStatus['validationMessage'];
            }
        }

        $validator = $element . "ValidatorMessage";
        $messageClass = implode(" ", $messageClass);

        $messageHtml = '<span class="' . $messageClass . '" id="' . $validator . '">' . $message . '</span>';

        return $messageHtml;
    }

// An array of validation responses
    $validationResult = array();
    foreach($_POST as $formItem => $value) {
        $validationMethod = "validate" . ucfirst($formItem);
        if (is_callable($validationMethod)) {
            $validationResult[$formItem] = call_user_func($validationMethod, $value);
        }
    }

    // Total form validation result
    $isFormValid = true;
    foreach($validationResult as $formItem){
        $isFormValid = $isFormValid && $formItem['isValid'];
    }
    if (!$isFormValid) {
        // Form validation failed, show our error message
        $validationResult['Form'] = setElementValidationResult(false, null, "Please review your input.");
    } else {
        // We send the message with content from the validator
        // Additional sanitization should be implemented along with the validation
        $isSent = sendMessage($validationResult);
        if ($isSent === true) {
            // each message requires a new Captcha challenge
            $validationResult['Form'] = setElementValidationResult(true, null, 'Your message was sent.');
        } else {
            $validationResult['Form'] = setElementValidationResult(false, null, "The server had problems sending your message.");
        }
    }
    echo json_encode($validationResult);
    exit;
    ?>
<?php endif; ?>