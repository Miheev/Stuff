/**
 * Created by storm on 5/11/14.
 */

jQuery(document).ready(function(){
    jQuery('#node-118 .content').append(
        '<div id="map" style="width: 600px; height: 400px">'+
        '</div>'
    );

    ymaps.ready(init);
    var myMap,
        myPlacemark;

    function init(){
        var myMap = new ymaps.Map('map', {
            center: [48.471216, 135.063509],
            zoom: 16
        });

        // Для добавления элемента управления на карту
        // используется поле map.controls.
        // Это поле содержит ссылку на экземпляр класса map.control.Manager.

        // Добавление элемента в коллекцию производится
        // с помощью метода add.

        // В метод add можно передать строковый идентификатор
        // элемента управления и его параметры.
        myMap.controls
            // Кнопка изменения масштаба.
            .add('zoomControl', { left: 5, top: 5 })
            // Список типов карты
            .add('typeSelector')
            // Стандартный набор кнопок
            .add('mapTools', { left: 35, top: 5 });

        myPlacemark = new ymaps.Placemark([48.471216, 135.063509], {
            hintContent: 'ООО "Дентал Стиль"'
        });

        myMap.geoObjects.add(myPlacemark);
    }
});