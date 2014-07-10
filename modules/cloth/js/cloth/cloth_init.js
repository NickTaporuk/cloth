/**
 * Created by nicktaporuk on 05.07.14.
 * email : nictaporuk@yandex.ru
 */
(function (window, document, $, undefined) {
    //объект в котором лежат все данные которые выбираються
    var global = {   idm:0,                                //id material
                     idp:1,                                //id price
                     idtype: false,                        //id тип 0 - основной,1 - компаньён
                     idImageHref:false,                    //src <img>  основной
                     idImageHrefKompanion:false,           //src <img>  компаньён
                     tkm:1,                                //
                     requestUrl:"ajax/clothRequest.php",   // link ajax request
                     no_data:'По вашему запросу нет подходящей ткани для уточнения вашего запроса позвоните нашему менеджеру по тел. (123) 456 789 0<br/> и мы постраемся вам помочь<br/> или можете выбрать ткань из другой ценовой группы или материала :'
    };

    //закрываем наш всплывающее окно
    jQuery('.close-block').on('click',function(){
        jQuery('.popup').fadeOut(500);
    });

    //открываем всплывающее окно основная ткань
    jQuery('#primary-textile-selector').on('click',function(){
        global.idtype = 0;
        console.log(global);
        jQuery('.popup').fadeIn(500);
        return false;
    });

    //открываем всплывающее окно ткань компаньён
    jQuery('#secondary-textile-selector').on('click',function(){
        global.idtype = 1;
        console.log(global);
        jQuery('.popup').fadeIn(500);
        return false;
    });

    //закрываем окно
    jQuery('#select-textile-block').live('click',function(){
        console.log(global);
        jQuery('.popup').fadeOut(500);
        return false;
    });

    //вcтавить изображение в кнопку основная или компаньён,закрыть окно
    jQuery('.select-textile-button ').on('click',function(){
        console.log(jQuery('#textile-pic-preview>img').attr('idi'));
        var idMapToImg = jQuery('#textile-pic-preview>img').attr('idi');
        addImgByType(idMapToImg);
        jQuery('.popup').fadeOut(500);
    });

    //кнопки ценового диапазона
    jQuery('.textile-group').on('click',function(){
        if(jQuery('#textile-group-inner-switcher>#textile-group-inner-1').hasClass('active')){
            jQuery('#textile-group-inner-switcher>#textile-group-inner-1').removeClass('active')
        }
        var price = jQuery(this);
        price.addClass('active');
        global.idp = price.attr('idp');
        getHtml();
//        console.log(global);
//        console.log('кнопки ценового диапазона');
        return false;
    });
    //кнопки типа ткани
    jQuery('.textile-type-wrapper').on('click',function(){
        if(jQuery('#textile-type-0').hasClass('active')){
            jQuery('#textile-type-0').removeClass('active')
        }

        if(jQuery('#textile-type-switcher>.textile-type-wrapper>a').hasClass('active')){
            jQuery('#textile-type-switcher>.textile-type-wrapper>a').removeClass('active')
        }

        var cloth = jQuery(this);
        cloth.find('a').addClass('active');
//        console.log(cloth.attr('idm'));
//        console.log('кнопки типа ткани');
        global.idm = cloth.attr('idm');
        getHtml();
//        console.log(global);

        return false;
    });
    //кнопки типа ткани
    jQuery('.textile-preview').live('click',function(){
        var img = jQuery(this);
//        console.log(img.attr('tkm'));
//        console.log(img.find('img').attr('src'));
        if(global.idtype === 0){
            global.idImageHref = img.find('img').attr('src');
        }
        else if(global.idtype === 1){
            global.idImageHrefKompanion = img.find('img').attr('src');
        }
        global.tkm = img.attr('tkm');
        getHtml();
        console.log(global);
        //
        var preview = '<img idi="'+img.attr('tkm')+'" src="'+img.find('img').attr('src')+'" width="100%" height="100%"/>'
        jQuery('#textile-pic-preview').html(preview);
//        console.log('кнопки типа ткани');
        return false;
    });

    /*
     *
     * */
    function getHtml()
    {
        //чтоб а всех версиях php работало корректно )
        var data = JSON.stringify(global);
        //переменная для переброс на сервер

        jQuery.ajax({
                        url: global.requestUrl,
                        data: {d:data},
                        success: function(data){
//                      console.log(data);
                        if(data){
                            jQuery('#textile-list-content').html(data);
                        }
                        else jQuery('#textile-list-content').html('<div class="no-data">'+global.no_data+'</div>');
                        }
                    });
    }

    /*
    *
    * */
    function addImgByType(idMapToImg)
    {
        console.log(global);
        if(global.idImageHrefKompanion && global.idtype === 1){
                if(jQuery('#secondary-textile-selector .primary-img').hasClass('active')){
                    jQuery('#secondary-textile-selector img').remove();
                    jQuery('#secondary-textile-selector .help-text').after('<img class="primary-img active" idi="'+idMapToImg+'" src="'+global.idImageHrefKompanion+'" />');
                }
                else jQuery('#secondary-textile-selector .help-text').after('<img class="primary-img active" idi="'+idMapToImg+'"  src="'+global.idImageHrefKompanion+'" />');

        }
        else if(global.idImageHref && global.idtype === 0){
                if(jQuery('#primary-textile-selector .primary-img').hasClass('active')){
                    jQuery('#primary-textile-selector img').remove();
                    jQuery('#primary-textile-selector .help-text').after('<img class="primary-img active" idi="'+idMapToImg+'"  src="'+global.idImageHref+'" />');
                }
                else jQuery('#primary-textile-selector .help-text').after('<img class="primary-img active" idi="'+idMapToImg+'"  src="'+global.idImageHref+'" />');
            }
        }
}(window, document, jQuery));