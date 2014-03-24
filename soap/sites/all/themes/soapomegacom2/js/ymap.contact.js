var myMap;

// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);

function init () {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").
    myMap = new ymaps.Map('YMapsID', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center:[48.502442, 135.085508], // Москва
        zoom:16,
        type: 'yandex#map'
        /*behaviors: ['default', 'scrollZoom', 'multiTouch', 'rightMouseButtonMagnifier'],*/
    });
myMap.options.set('scrollZoomSpeed', 0.5);

var myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
    balloonContentBody: [
    '<p style="font-family: Helvetica, Arial; font-style: italic;">Мыльные штучки</p>'

    ].join('')
    }, {
    preset: 'islands#darkOrangeDotIcon'
    });

myMap.geoObjects.add(myPlacemark);
}

jQuery(window).resize(function(){
    //map_size();
    myMap.container.fitToViewport();
});