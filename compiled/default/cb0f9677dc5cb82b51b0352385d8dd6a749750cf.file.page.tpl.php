<?php /* Smarty version Smarty-3.1.18, created on 2014-07-01 16:27:25
         compiled from "/var/www/simpla/design/default/html/page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78238794753b2b73dc26eb4-79358921%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb0f9677dc5cb82b51b0352385d8dd6a749750cf' => 
    array (
      0 => '/var/www/simpla/design/default/html/page.tpl',
      1 => 1394924618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78238794753b2b73dc26eb4-79358921',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53b2b73dcef5a5_46268194',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b2b73dcef5a5_46268194')) {function content_53b2b73dcef5a5_46268194($_smarty_tpl) {?>


<?php $_smarty_tpl->tpl_vars['canonical'] = new Smarty_variable("/".((string)$_smarty_tpl->tpl_vars['page']->value->url), null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['canonical'] = clone $_smarty_tpl->tpl_vars['canonical'];?>

<!-- Заголовок страницы -->
<h1 data-page="<?php echo $_smarty_tpl->tpl_vars['page']->value->id;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value->header, ENT_QUOTES, 'UTF-8', true);?>
</h1>

<!-- Тело страницы -->
<?php echo $_smarty_tpl->tpl_vars['page']->value->body;?>
<?php }} ?>
