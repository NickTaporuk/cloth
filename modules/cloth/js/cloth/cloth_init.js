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
                     tkm:1,                                //id cloth
                     requestUrl:"ajax/clothRequest.php",   // link ajax request
                     no_data:'По вашему запросу нет подходящей ткани для уточнения вашего запроса позвоните нашему менеджеру по тел. (123) 456 789 0<br/> и мы постраемся вам помочь<br/> или можете выбрать ткань из другой ценовой группы или материала :',
                     choice_primary:'Выбор основной ткани',
                     choice_secondary:'Выбор ткани компаньён',
                     idi_prim:0,
                     idi_sec:0
    };
    //
    init();
    //закрываем наш всплывающее окно
    jQuery('.close-block').on('click',function(){
        jQuery('.popup').fadeOut(500);
        jQuery('#textile-pic-preview').html('');
    });

    //открываем всплывающее окно основная ткань
    jQuery('#primary-textile-selector').on('click',function(){
        global.idtype = 0;
        init();
        //console.log(global);
        jQuery('.popup').fadeIn(500);
        return false;
    });

    //открываем всплывающее окно ткань компаньён
    jQuery('#secondary-textile-selector').on('click',function(){
        global.idtype = 1;
        init();
        //console.log(global);
        jQuery('.popup').fadeIn(500);
        return false;
    });

    //закрываем окно
    jQuery('#select-textile-block').live('click',function(){
        //console.log(global);
        jQuery('.popup').fadeOut(500);

        return false;
    });

    //вcтавить изображение в кнопку основная или компаньён,закрыть окно
    jQuery('.select-textile-button ').on('click',function(){

//        var idMapToImg = jQuery('#textile-pic-preview>img').attr('idi');
//        console.log('idMapToImg :'+idMapToImg);
        addImgByType();
        jQuery('.popup').fadeOut(500);
        jQuery('#textile-pic-preview').html('');
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
            global.idi_prim = img.attr('tkm');
            console.log('img.attr prim :'+global.idi_prim);

        }
        else if(global.idtype === 1){
            global.idImageHrefKompanion = img.find('img').attr('src');
            global.idi_sec = img.attr('tkm');
            console.log('img.attr sec :'+global.idi_sec);

        }
//        console.log('img.attr:'+img.attr('tkm'));
        global.tkm = img.attr('tkm');
        getHtml();
//        console.log(global);
        //
        insertPreviewImg();
//        console.log('кнопки типа ткани');
        return false;
    });

    /**
     *
     */
    function insertPreviewImg()
    {
        if(global.idtype===0 && global.idImageHref) {
            if(global.idImageHrefKompanion) {
                var preview = '<div id="main-textile-image"><img  src="'+global.idImageHref+'"  width="300" height="300"></div>'+
                    '<div id="second-textile-image" style=""><img src="'+global.idImageHrefKompanion+'"  width="150" height="150"></div>';
            }
            else {
                var preview = '<img  src="'+global.idImageHref+'" width="100%" height="100%"/>'
            }
        }
        else if(global.idtype===1 && global.idImageHrefKompanion){
            if(global.idImageHref){
                var preview = '<div id="main-textile-image"><img src="'+global.idImageHrefKompanion+'"  width="300" height="300"></div>'+
                    '<div id="second-textile-image" style=""><img src="'+global.idImageHref+'"  width="150" height="150"></div>';

            }
            else {
                var preview = '<img src="'+global.idImageHrefKompanion+'" width="100%" height="100%"/>'
            }

        }
        else if(global.idtype===0 && global.idImageHref==false && global.idImageHrefKompanion){
            var preview = '<div id="no-textile-image" style=""><img src="'+global.idImageHrefKompanion+'"  width="150" height="150"></div>';

        }
        else if(global.idtype===1 && global.idImageHrefKompanion==false && global.idImageHref){
            var preview = '<div id="no-textile-image" style=""><img src="'+global.idImageHref+'"  width="150" height="150"></div>';

        }
        else {
//            var preview = '<img idi="'+img.attr('tkm')+'" src="'+img.find('img').attr('src')+'" width="100%" height="100%"/>'
//            var preview = '<img   width="100%" height="100%"/>'
        }
        jQuery('#textile-pic-preview').html(preview);
    }
    /*
     *
     * */
    function getHtml()
    {
        //переменная для переброса на сервер
        //чтоб во всех версиях php работало корректно )
        var data = JSON.stringify(global);

        jQuery.ajax({
                        url: global.requestUrl,
                        data: {d:data},
                        success: function(data){
//                      console.log(data);
                        if(data){
                            jQuery('#textile-list-content').html(data);
                        }
                        else jQuery('#textile-list-content').html('<div class="no-data">'+global.no_data+'</div>');
                        },
                        error: function (XHR, textStatus, errorThrown) {
                            var  err;
                            if (XHR.readyState === 0 || XHR.status === 0) {
                                return;
                            }
                            switch (textStatus) {
                                case 'timeout':
                                    err = 'The request timed out!';
                                    break;
                                case 'parsererror':
                                    err = 'Parser error!';
                                    break;
                                case 'error':
                                    if (XHR.status && !/^\s*$/.test(XHR.status)) {
                                        err = 'Error ' + XHR.status;
                                    } else {
                                        err = 'Error';
                                    }
                                    if (XHR.responseText && !/^\s*$/.test(XHR.responseText)) {
                                        err = err + ': ' + XHR.responseText;
                                    }
                                    break;
                            }

                            if (err) {
                                alert(err);
                            }
                        }
                    });
    }

    /**
    *
    * */
    function addImgByType()
    {
        console.log('global.idi_prim:'+global.idi_prim+'---->'+'global.idi_sec:'+global.idi_sec);
        if(global.idImageHrefKompanion && global.idtype === 1){
                if(jQuery('#secondary-textile-selector .primary-img').hasClass('active')){
                    jQuery('#secondary-textile-selector img').remove();
                    jQuery('#secondary-textile-selector .help-text').after('<img class="primary-img active" idi="'+global.idi_sec+'" src="'+global.idImageHrefKompanion+'" />');
                }
                else jQuery('#secondary-textile-selector .help-text').after('<img class="primary-img active" idi="'+global.idi_sec+'"  src="'+global.idImageHrefKompanion+'" />');

        }
        else if(global.idImageHref && global.idtype === 0){
                if(jQuery('#primary-textile-selector .primary-img').hasClass('active')){
                    jQuery('#primary-textile-selector img').remove();
                    jQuery('#primary-textile-selector .help-text').after('<img class="primary-img active" idi="'+global.idi_prim+'"  src="'+global.idImageHref+'" />');
                }
                else jQuery('#primary-textile-selector .help-text').after('<img class="primary-img active" idi="'+global.idi_prim+'"  src="'+global.idImageHref+'" />');
            }
        }

    /**
     *
     */
    function init()
    {
        if(global.idtype===0){
            jQuery('.textile-list-title').text(global.choice_primary)
        }
        else jQuery('.textile-list-title').text(global.choice_secondary)
        insertPreviewImg();
    }
}(window, document, jQuery));