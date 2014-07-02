<?php /* Smarty version Smarty-3.1.18, created on 2014-07-01 16:16:18
         compiled from "/var/www/simpla/design/default/html/cart_informer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92662855153b2b4a2907cf6-28747019%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8431785fad582b2d93ef87ce86c4eb0abdacb3f' => 
    array (
      0 => '/var/www/simpla/design/default/html/cart_informer.tpl',
      1 => 1328292006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92662855153b2b4a2907cf6-28747019',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cart' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53b2b4a299e338_54653023',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b2b4a299e338_54653023')) {function content_53b2b4a299e338_54653023($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['cart']->value->total_products>0) {?>
	В <a href="./cart/">корзине</a>
	<?php echo $_smarty_tpl->tpl_vars['cart']->value->total_products;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['cart']->value->total_products,'товар','товаров','товара');?>

	на <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->tpl_vars['cart']->value->total_price);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>

<?php } else { ?>
	Корзина пуста
<?php }?>
<?php }} ?>
