<?php
/* Smarty version 3.1.31, created on 2017-03-29 18:08:16
  from "/server/www/self/shop/manage/views/user/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58db8790b4d906_45728627',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08fc51eeaaf82cff915ed26a81ffe051bf7e70e7' => 
    array (
      0 => '/server/www/self/shop/manage/views/user/index.tpl',
      1 => 1490782089,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58db8790b4d906_45728627 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_59008083758db8790b49833_15296998', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'common/index.tpl');
}
/* {block 'content'} */
class Block_59008083758db8790b49833_15296998 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_59008083758db8790b49833_15296998',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <h1>hello world</h1>
<?php
}
}
/* {/block 'content'} */
}
