<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 6/19/14
 * Time: 9:35 PM
 */
?>
<form id="login">
    <h1>Log In</h1>
    <fieldset id="inputs">
        <input id="username" type="text" placeholder="Login" autofocus required>
        <input id="password" type="password" placeholder="Password" required>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" value="Log in">
        <a href="">Forgot your password?</a><a href="">Register</a>
    </fieldset>
</form>
<div class="sys-msg">
    <p></p>
</div>
<script>
    $(document).ready(function(){
        $('#submit').click(function(e){
            e.preventDefault();

            $.post( CRM.basepath+'login.php', {
                login: $('#username').val(),
                pass: $('#password').val()
            }, function( data, status ) {
console.log(data);
                if (status == 'success') {
                    if (data == 'Access Granted') {
                        location.reload();
                    } else
                        $( ".sys-msg" ).text('Ваши учётные данные не совпадают. Пожалуйста проверьте правильность ввода');
                } else {
                    $( ".sys-msg" ).text('Произошла ошибка на сервере. Попробуйте ещё раз или свяжитесб с адмигистрацией.');
                }
            });
        });
    });
</script>