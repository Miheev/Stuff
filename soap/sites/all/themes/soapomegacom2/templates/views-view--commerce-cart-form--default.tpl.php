<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */




if (isset($_GET['userdone'])):

//var_dump($_POST);

function utf8($value)
{
    return stripslashes(mb_check_encoding($value, 'UTF-8') ? $value : utf8_encode($value));
}
function de_escape($v)
{
    return str_replace('##2', '>', str_replace('##1', '<', $v));
}
function escape($v)
{
    return str_replace('>', '##2', str_replace('<', '##1', $v));
}

// we are processing a valid submited form
function sendMessage(&$vars) {
    // TODO: send email only after configuring your email server settings
    $name= $vars['name']['validContent'];
    $email= $vars['email']['validContent'];
    $phone= $vars['phone']['validContent'];
    $staff= $vars['staff']['validContent'];
    if (empty($name) || empty($email) || empty($staff)) return false;


    //$qq=db_query('SELECT u.mail FROM {users} u WHERE u.name = :n', array(':n' => "admin"));
    //if ($qq->rowCount()) $to= $qq->fetchField();

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

    return mail(/*$to*/'nowert@mail.ru', $subject, iconv('utf-8', 'windows-1251//IGNORE', $body), $headers);

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
    return setElementValidationResult(true, htmlspecialchars_decode(de_escape($message)));
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
$tmp = json_decode($_POST['t1']);
foreach($tmp as $formItem => $value) {
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

$validationResult['staff']['validContent']= 'text';
echo json_encode($validationResult);
exit;
?>
<?php endif; ?>

<div class="<?php print $classes; ?>">
<?php print render($title_prefix); ?>
<?php if ($title): ?>
    <?php print $title; ?>
<?php endif; ?>
<?php print render($title_suffix); ?>
<?php if ($header): ?>
    <div class="view-header">
        <?php print $header; ?>
    </div>
<?php endif; ?>

<?php if ($exposed): ?>
    <div class="view-filters">
        <?php print $exposed; ?>
    </div>
<?php endif; ?>

<?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
    </div>
<?php endif; ?>

    <div class="wait-load" style="display:none; max-width:400px; margin: auto;">
        <img src="/sites/all/themes/soapomegacom2/img/wait_please.gif"/>
    </div>

<?php if ($rows): ?>
    <div class="view-content">
        <?php print $rows; ?>
    </div>
<?php elseif ($empty): ?>
    <div class="view-empty">
        <?php print $empty; ?>
    </div>
<?php endif; ?>

<?php if ($pager): ?>
    <?php print $pager; ?>
<?php endif; ?>

<?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
        <?php print $attachment_after; ?>
    </div>
<?php endif; ?>

<?php if ($more): ?>
    <?php print $more; ?>
<?php endif; ?>

<?php if ($footer): ?>
    <div class="view-footer">
        <?php print $footer; ?>
    </div>
<?php endif; ?>

<?php if ($feed_icon): ?>
    <div class="feed-icon">
        <?php print $feed_icon; ?>
    </div>
<?php endif; ?>

    <div id="userinfo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userinfoLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="userinfoLabel">Как с Вами связаться</h4>
                </div>
                <div class="modal-body">
                    <h6>Как Вас зовут? (Ф.И.О)</h6>
                    <p><input type="text" class='text' placeholder="Обязательно для заполнения" autocomplete="on" /></p>

                    <h6>Ваш контактный телефон</h6>
                    <p><input type="text" class='phone' placeholder="Обязательно для заполнения" autocomplete="on" /></p>

                    <h6>Ваш e-mail</h6>
                    <p><input type="text" class='email' placeholder="Обязательно для заполнения" autocomplete="on" /></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Заказать</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id="thanks" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userinfoLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                    <p>Спасибо за обращение, наш менеджер свяжется с Вами в ближайшее время.</p>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id="badinput" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userinfoLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="badinfoLabel">Сообщение не было доставлено!</h3>
                </div>
                <div class="modal-body">
                    <p>Проверьте правильность ввода данных и попробуйте ещё раз.</p>
                    <p>при повторном появлении этого сообщения свяжитесь с нами по <strong>тел. 8(ххх) хх-хх-хх</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Закрыть</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id="error" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userinfoLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="errorinfoLabel">Произошла не предвиденная ошибка.</h3>
                </div>
                <div class="modal-body">
                    <p>Проверьте правильность ввода данных и попробуйте ещё раз.</p>
                    <p>При повторном появлении этого сообщения свяжитесь с нами по <strong>тел. 8(ххх) хх-хх-хх</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        htmlEncode= function(value){
            if (value) {
                return $('<div />').text(value).html();
            } else {
                return '';
            }
        }
        escape= function(v){
            if (v) {
                return v.trim().split('<').join('##1').split('>').join('##2');
            }
        }

        do_code = function () {
            Drupal.settings.sended= 1;

            jQuery('.entity-commerce-product.commerce-product-hats + a').text('Посмотреть товар');
            jQuery('.commerce-price-formatted-components .component-title').text('Итого:');
            jQuery('#page-title').text('Ваши покупки');

            jQuery('td.views-field-commerce-unit-price div, td.views-field-commerce-total div, .component-type-commerce-price-formatted-amount .component-total').each(function () {
                tmp = jQuery(this).text().split(' ');
                tmp[tmp.length - 1] = '<span>Р</span>';
                jQuery(this).html(tmp.join(' '));
            });

            jQuery('.views-field-edit-quantity input[type="text"]').change(function () {
                jQuery('#edit-submit').trigger('click');
            });
            jQuery('.views-field-edit-quantity input[type="text"]').on('input', function(e) {
                if (jQuery(this).val().match(/\d+/) == null) {
                    if (!jQuery(this).hasClass('invalid')) jQuery(this).toggleClass('invalid');
                } else
                if (jQuery(this).hasClass('invalid'))
                    jQuery(this).toggleClass('invalid');
            });


            jQuery('#edit-checkout').click(function (e) {
                e.preventDefault();
                console.log(111);
                jQuery('#userinfo').modal({keyboard: false})
                    .on('hidden.bs.modal', function () {
                        console.log(Drupal.settings.sended);
                        if (Drupal.settings.sended) {
                            jQuery('table.views-table img, .views-field-edit-delete').css('display', 'none');
                            jQuery('table.views-table img').attr('height', 0);
                            jQuery('table.views-table img').attr('width', 0);
                            jQuery('.views-field-edit-quantity input[type="text"]').prop('readonly', 'true');

                            datamail= {
                                name: jQuery('#userinfo input.text').val(),
                                phone: jQuery('#userinfo input.phone').val(),
                                email: jQuery('#userinfo input.email').val(),
                                staff: escape('<table class="views-table cols-5">'+ jQuery('table.views-table').html() +'</table><p>'+ jQuery('.commerce-price-formatted-components').text() +'</p>')
                            };

                            jQuery('table.views-table img').css('display', 'inline');
                            jQuery('.views-field-edit-delete').css('display', 'inline-block');
                            jQuery('th.views-field-edit-delete').css('display', 'table-cell');
                            jQuery('.views-field-edit-quantity input[type="text"]').removeProp('readonly');
                            jQuery('table.views-table img').attr('height', '130');
                            jQuery('table.views-table img').attr('width', '150');
//console.log(datamail);
                            jQuery('.wait-load').css('display', 'block');
                            jQuery.post( location.href+'?userdone=1', {t1: JSON.stringify(datamail)}, function(data) {
                            console.log( "success" );
                            try{
                                fback= eval('(' + data + ')');
                            }
                            catch(err) {
                                jQuery('#error').modal({keyboard: false});
                                console.log(err);
                            }

                            if (fback.Form.isValid)
                                jQuery('#thanks').modal()
                                    .on('shown.bs.modal', function () {
                                        setTimeout(function () {
                                            jQuery('#thanks').modal('hide');
                                        }, 5000);
                                    });
                            else
                                jQuery('#badinput').modal({keyboard: false});
                        });
                        }
                    });
            });
            jQuery('#userinfo .btn-default').click(function(){Drupal.settings.sended= 0;});
            jQuery('#userinfo .btn-primary').click(function(){

                jQuery('#userinfo input[type="text"]').each(function(){
                    if (jQuery(this).css('color') == "rgb(185, 74, 72)") {
                        Drupal.settings.sended= 0;
                        return;
                    } else if (jQuery(this).val().length < 4) {
                        jQuery(this).addClass('invalid');
                        Drupal.settings.sended= 0;
                        return;
                    } else if (jQuery(this).hasClass('invalid')) jQuery(this).removeClass('invalid');

                    Drupal.settings.sended= 1;
                });

                if (Drupal.settings.sended) {
                    jQuery('#userinfo').modal('hide');
                }
            });
            jQuery('#userinfo input.email').on('input', function(e) {
                if (jQuery(this).val().match(/.+@.+\..+/i) == null) {
                    if (!jQuery(this).hasClass('invalid')) jQuery(this).toggleClass('invalid');
                } else
                    if (jQuery(this).hasClass('invalid'))
                        jQuery(this).toggleClass('invalid');
            });
            jQuery('#userinfo input.phone').on('input', function(e) {
                if (jQuery(this).val().match(/[\d -]+/) == null || jQuery(this).val().match(/\d+/g) == null || jQuery(this).val().match(/\d+/g).join('').length < 6) {
                    if (!jQuery(this).hasClass('invalid')) jQuery(this).toggleClass('invalid');
                } else
                    if (jQuery(this).hasClass('invalid'))
                        jQuery(this).toggleClass('invalid');
            });
            jQuery('#userinfo input.text').on('input', function(e) {
                if (jQuery(this).val().match(/[a-zA-Zа-яА-Я -]+/) == null || jQuery(this).val().match(/[a-zA-Zа-яА-Я]+/g).join('').length < 4) {
                    if (!jQuery(this).hasClass('invalid')) jQuery(this).toggleClass('invalid');
                } else
                if (jQuery(this).hasClass('invalid'))
                    jQuery(this).toggleClass('invalid');
            });

            //jQuery('#userinfo input.phone').mask("+7 9999 999-999");

        }
        jQuery(document).ready(function () {
            setTimeout(function tmr() {
                if (jQuery('.view-commerce-cart-form').length) {
                    setTimeout(do_code, 10);
                } else
                    setTimeout(tmr, 1000);
            }, 10);
        });
    </script>

</div><?php /* class view */ ?>