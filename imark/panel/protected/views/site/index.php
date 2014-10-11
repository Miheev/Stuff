<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Добро пожаловать на <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

    <div class="clear-block">
        <p style="text-align: left;">Одна из самых&nbsp;распространенных задач в интернет-маркетинге —отслеживание
                                     эффективности этого самого интернет-маркетинга.</p>

        <p style="text-align: left;">Львиная доля целевых обращений пользователей идет через обычный телефон. В блоге
                                     бюро есть статья, <a title="Как отслеживать телефонные звонки в малом бизнесе"
                                                          href="http://liraltd.com/kak-otslezhivat-telefonnyie-zvonki-v-malom-biznese"
                                                          target="_blank">посвященная способам отслеживания телефонных
                                                                          обращений (calltracking).</a></p>

        <p style="text-align: left;">Мы точно также сталкиваемся с этой проблемой, в каких-то городах готовые сервисы
                                     колтрекинга не работают, где-то даже, если в городе/регионе есть возможность
                                     подключить «Целевой звонок» Яндекс Директа или другой сервис, клиенты по своим
                                     причинам не хотят этого делать.</p>

        <p style="text-align: left;">Для решения этой нашей проблемы мы разработали скрипт подмены номеров (реализация
                                     статического calltracking`а). Он устанавливается на сайте, прописываются номера
                                     телефонов по источникам, собирается статистика, делаются выводы по эффективности
                                     того или иного канала.</p>

        <p style="text-align: left;">Каждый новый проект приходилось устанавливать и настраивать код подмены вручную,
                                     если нужно внести изменения в номера телефонов или настройки скрипта, снова это
                                     делалось вручную через правку кода на сайте.</p>

        <p style="text-align: left;">Решение рабочее, но не совсем удобное. Поэтому мы разработали собственный сервис —
                                     liracloud.</p>

        <p style="text-align: left;">Liracloud позволяет реализовать на сайте статический calltracking абсолютно
                                     бесплатно. Причем не важно в каком городе, регионе и даже стране вы работаете.
                                     Россия, Украина, Беларусь? — сервис работает везде.</p>

        <h3 style="text-align: left;">Основные возможности liracloud</h3>

        <p style="text-align: left;">Если очень упрощенно, сервис позволяет реализовать «Целевой звонок» Яндекс Директа,
                                     только бесплатно и в любом городе.</p>

        <p style="text-align: left;">На текущий момент сервис умеет отслеживать следующие каналы:</p>
        <ul style="text-align: left;">
            <li>Поиск Яндекса</li>
            <li>Поиск Google</li>
            <li>Яндекс Директ</li>
            <li>Google AdWords</li>
            <li>Facebook</li>
            <li>Вконтакте</li>
        </ul>
        <p style="text-align: left;">В сервисе Liracloud для одного логина можно создавать несколько проектов,
                                     соответственно, настраивать отслеживание телефонных обращений на нескольких
                                     сайтах.</p>

        <h3 style="text-align: left;">Как работает сервис?</h3>

        <p style="text-align: left;">Принцип работы сервиса Liracloud такой же как у&nbsp;Google Tag Manager. От вас
                                     необходимо лишь один раз добавить в код сайта специальный код-контейнер, остальные
                                     настройки и параметры задаются уже непосредственно в самом Liracloud.</p>

        <p><a href="http://liraltd.com/wp/wp-content/uploads/2014/09/intro-cloud.png"><img
                    class="aligncenter wp-image-1357"
                    src="http://liraltd.com/wp/wp-content/uploads/2014/09/intro-cloud.png" alt="Схема работы"
                    width="600" height="326"></a></p>

        <h3 style="text-align: left;">Как подключить сервис Liracloud</h3>

        <p style="text-align: left;">В данный момент сервис находится в закрытом тестировании, но вы можете оставить
                                     заявку на получение доступа и использованию его в своих проектах.</p>

        <div id="wufoo-s6l7gwe1jrp9y3">
            <iframe id="wufooForms6l7gwe1jrp9y3" class="wufoo-form-container" height="359" allowtransparency="true"
                    frameborder="0" scrolling="no" style="width:100%;border:none"
                    src="https://liraltd.wufoo.com/embed/s6l7gwe1jrp9y3/def/embedKey=s6l7gwe1jrp9y3808793&amp;entsource=&amp;referrer=">
                &lt;a href="https://liraltd.wufoo.com/forms/s6l7gwe1jrp9y3/" title="html form"&gt;Fill out my Wufoo
                form!&lt;/a&gt;</iframe>
        </div>

        <p style="text-align: left;">Артем Акулов, руководитель бюро «Лира»</p>

        <p style="text-align: left;">Если у вас есть вопросы по работе сервиса — пишите&nbsp;support@liracloud.com</p>
    </div>


<!--<p>Congratulations! You have successfully created your Yii application.</p>-->
<!---->
<!--<p>You may change the content of this page by modifying the following two files:</p>-->
<!--<ul>-->
<!--	<li>View file: <code>--><?php //echo __FILE__; ?><!--</code></li>-->
<!--	<li>Layout file: <code>--><?php //echo $this->getLayoutFile('main'); ?><!--</code></li>-->
<!--</ul>-->
<!---->
<!--<p>For more details on how to further develop this application, please read-->
<!--the <a href="http://www.yiiframework.com/doc/">documentation</a>.-->
<!--Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,-->
<!--should you have any questions.</p>-->

