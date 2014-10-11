<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - Инструкция';
$this->breadcrumbs = array(
    'Инструкция',
);
?>
<h1>Как пользоваться сервисом</h1>

<div class="clear-block">
    <p>Спасибо, что решили использовать Liracloud. Давайте создадим и настроим ваш первый проект.</p>

    <p>Для начала вам необходимо зайти в сам сервис по адресу</p>

    <p><a href="http://my.liracloud.com/" target="_blank">http://my.liracloud.com/</a></p>

    <p>Теперь переходим на вкладку «Мои проекты». Добавляем новый проект.</p>

    <p>
        <a href="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-27-41-Liracloud.com-Profiles-Google-Chrome.png"><img
                class="aligncenter wp-image-1364"
                src="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-27-41-Liracloud.com-Profiles-Google-Chrome-1024x476.png"
                alt="Новый проект liracloud" width="600" height="279"></a></p>

    <p>&nbsp;</p>

    <p>Указываем название проекта и адрес сайта проекта.</p>

    <p>
        <a href="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-29-15-Liracloud.com-Create-Profiles-Google-Chrome.png"><img
                class="aligncenter wp-image-1365"
                src="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-29-15-Liracloud.com-Create-Profiles-Google-Chrome.png"
                alt="Указываем название проекта" width="600" height="267"></a></p>

    <p>&nbsp;</p>

    <p>Теперь необходимо разместить на вашем сайте код-контейнер, который реализует подмену номера на сайте. Для этого
       скопируйте код со страницы, на которую вы попадете после создания нового проекта. Этот код необходимо один раз
       разместить на вашем сайте перед закрывающим тегом &lt;/head&gt;</p>

    <p>
        <a href="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-30-37-Liracloud.com-Padmin-Profiles-Google-Chrome.png"><img
                class="aligncenter wp-image-1366"
                src="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-30-37-Liracloud.com-Padmin-Profiles-Google-Chrome.png"
                alt="Код для вставки на сайт" width="600" height="395"></a></p>

    <p>&nbsp;</p>

    <p>Отлично, теперь осталось только настроить параметры подмены номеров телефонов. Переходим по ссылке «В менеджер
       скриптов». Выбираем «Статический calltracking (подмена номеров)». Переходим в настройки подмены.</p>

    <p>
        <a href="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-32-24-Liracloud.com-View-Profiles-Google-Chrome.png"><img
                class="aligncenter wp-image-1367"
                src="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-32-24-Liracloud.com-View-Profiles-Google-Chrome.png"
                alt="Менеджер скриптов" width="600" height="267"></a></p>

    <p>&nbsp;</p>

    <p>Для начала необходимо указать название контейнера, в котором на вашем сайте прописывается номер телефона.
       Например, можно номер телефона заключить в тег &lt;span id=»phone»&gt;+7 (495) 123-45-67&lt;/span&gt; и указать
       его id в сервисе Liracloud.</p>

    <p>Затем необходимо выбрать (поставить галки) у источников, для которых будем делать подмену номеров. Обратите
       внимание на «Номер по-умолчанию», это обязательное поле (вставьте в него ваш текущий общий номер телефона). Этот
       номер подставится, если вдруг сервис Liracloud не сможет определить источник трафика или произойдет какой-то
       сбой.</p>

    <p>Дальше осталось только прописать номера телефонов для каналов. Номера телефонов будет отображаться в таком же
       формате, как вы указываете его на этой странице.</p>

    <p>Например, телефон можно задать с +7 в начала, а можно с 8, с кодом города и без него — как укажите, так и
       будет.</p>

    <p>После настройки телефонов, <strong>обязательно нажмите кнопку «Сохранить»</strong>. Иначе подмена номеров
       телефонов работать не будет.</p>

    <p><a href="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-33-47-Rabochiy-stol.png"><img
                class="aligncenter wp-image-1368"
                src="http://liraltd.com/wp/wp-content/uploads/2014/09/2014-09-19-12-33-47-Rabochiy-stol.png"
                alt="Настройки подмены номеров телефонов" width="600" height="462"></a>Для отслеживания кампаний в
                                                                                       Яндекс Директе, URL ссылки в
                                                                                       рекламных объявлениях должны быть
                                                                                       обязательно размечены UTM-метками&nbsp;utm_source=yandex&amp;utm_medium=cpc
    </p>

    <p>По любым вопросам работы сервиса Liracloud — пишите на support@liracloud.com</p>

    <p>&nbsp;</p>

    <p>&nbsp;</p>
</div>