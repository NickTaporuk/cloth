//alert(window.location.href);
//дополнение к карзине для работы с тканями
// добавляем в request

/**
 * @idi_primary      - основная ткань
 * @idi_secondary    - ткань компаньён
 * @src_primary      - ссылка на картинку основная ткань
 * @src_secondary    - ссылка на картинку компаньён
 */
(function (window, document, $, undefined) {
    var cloth = {idi_primary:0,idi_secondary:0,src_primary:'',src_secondary:''};

// Аяксовая корзина
$('form.variants').live('submit', function(e) {
    e.preventDefault();
    //основная
    cloth.idi_primary   = jQuery('#primary-textile-selector > a > .primary-img').attr('idi');
    cloth.src_primary   = jQuery('#primary-textile-selector > a > .primary-img').attr('src');
    //компаньён
    cloth.idi_secondary = jQuery('#secondary-textile-selector > a > .primary-img').attr('idi');
    cloth.src_secondary = jQuery('#secondary-textile-selector > a > .primary-img').attr('src');
    //чтоб а всех версиях php работало корректно )
    var jsonCloth = JSON.stringify(cloth);
    console.log('cloth :'+cloth.idi_primary +'--->'+cloth.idi_secondary);

    button = $(this).find('input[type="submit"]');
    if($(this).find('input[name=variant]:checked').size()>0)
        variant = $(this).find('input[name=variant]:checked').val();
    if($(this).find('select[name=variant]').size()>0)
        variant = $(this).find('select').val();
    $.ajax({
        url: "ajax/cart.php",
        data: {variant: variant,cloth:jsonCloth},
        dataType: 'json',
        success: function(data){
            $('#cart_informer').html(data);
            if(button.attr('data-result-text'))
                button.val(button.attr('data-result-text'));
        }
    });

    //обнуляем позиции для дальнейшего использования
    cloth.idi_primary   = 0;
    cloth.idi_secondary = 0;

    var o1 = $(this).offset();
    var o2 = $('#cart_informer').offset();
    var dx = o1.left - o2.left;
    var dy = o1.top - o2.top;
    var distance = Math.sqrt(dx * dx + dy * dy);
    $(this).closest('.product').find('.image img').effect("transfer", { to: $("#cart_informer"), className: "transfer_class" }, distance);
    $('.transfer_class').html($(this).closest('.product').find('.image').html());
    $('.transfer_class').find('img').css('height', '100%');
    return false;
});
}(window, document, jQuery));

/*
// Аяксовая корзина
$('a[href*="cart?variant"]').live('click', function(e) {
	e.preventDefault();
	//variant_id = $(this).attr('id');
	
	href = $(this).attr('href');
	pattern = /\/?cart\?variant=(\d+)$/;
	variant_id = pattern.exec(href)[1];
	
	link = $(this);
	$.ajax({
		url: "ajax/cart.php",
		data: {variant: variant_id},
		dataType: 'json',
		success: function(data){
			$('#cart_informer').html(data);
			//if(link.attr('added_text'))
			//	link.html(link.attr('added_text'));
			//link.attr('href', '/cart');
		}
	});

	var o1 = $(this).offset();
	var o2 = $('#cart_informer').offset();
	var dx = o1.left - o2.left;
	var dy = o1.top - o2.top;
	var distance = Math.sqrt(dx * dx + dy * dy);

	$(this).closest('.product').find('.image img').effect("transfer", { to: $("#cart_informer"), className: "transfer_class" }, distance);	
	$('.transfer_class').html($(this).closest('.product').find('.image').html());
	$('.transfer_class').find('img').css('height', '100%');
	return false;
});
*/