/**
 * Created by nicktaporuk on 05.07.14.
 * mail : nictaporuk@yandex.ru
 */
(function (window, document, $, undefined) {
    //закрываем наш всплывающее окно
    jQuery('.close-block').on('click',function(){
        jQuery('.popup').fadeOut(500);
    });
    jQuery('.popup-open').on('click',function(){
        jQuery('.popup').fadeIn(500);
        return false;
    });
}(window, document, jQuery));