<?php
session_start();
require_once('../api/Simpla.php');
$simpla = new Simpla();
$simpla->cart->add_item($simpla->request->get('variant', 'integer'), $simpla->request->get('amount', 'integer'));
//var_dump($simpla->request->get('amount', 'integer'));
$cart = $simpla->cart->get_cart();
$simpla->design->assign('cart', $cart);
	
	$currencies = $simpla->money->get_currencies(array('enabled'=>1));
	if(isset($_SESSION['currency_id']))
		$currency = $simpla->money->get_currency($_SESSION['currency_id']);
	else
		$currency = reset($currencies);

	$simpla->design->assign('currency',	$currency);
	
	$result = $simpla->design->fetch('cart_informer.tpl');
	header("Content-type: application/json; charset=UTF-8");
	header("Cache-Control: must-revalidate");
	header("Pragma: no-cache");
	header("Expires: -1");
if(isset($_SESSION['shopping_cart'][$_GET['variant']])){
    $data = json_decode($_GET['cloth']);
    $primary = (isset($data->idi_primary))?$data->idi_primary:0;
    $primary_img = (isset($data->src_primary))?$data->src_primary:0;
    $secondary = (isset($data->idi_secondary))?$data->idi_secondary:0;
    $secondary_img = (isset($data->src_secondary))?$data->src_secondary:0;
    $_SESSION['cloth'][] = array($_GET['variant']=>array('idi_primary'=>$primary,'idi_secondary'=>$secondary,'src_primary'=>$primary_img,'src_secondary'=>$secondary_img,
                                                            'JSON_IDI'=>(urlencode("idi_primary=$primary&idi_secondary=$secondary&src_primary=$primary_img&src_secondary=$secondary_img")))

    );
}

//print('<pre>');
//print_r($_SESSION);
//print_r($_GET);
//print_r($data);
//print('</pre>');
print json_encode($result);
