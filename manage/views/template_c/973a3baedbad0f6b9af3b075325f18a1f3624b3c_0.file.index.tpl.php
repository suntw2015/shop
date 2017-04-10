<?php
/* Smarty version 3.1.31, created on 2017-04-06 18:28:04
  from "/server/www/self/shop/manage/views/common/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58e618342a8dd0_10706524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '973a3baedbad0f6b9af3b075325f18a1f3624b3c' => 
    array (
      0 => '/server/www/self/shop/manage/views/common/index.tpl',
      1 => 1491474462,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/slide.tpl' => 1,
    'file:common/bread.tpl' => 1,
  ),
),false)) {
function content_58e618342a8dd0_10706524 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php if (empty($_smarty_tpl->tpl_vars['title']->value)) {?>Shop管理系统<?php } else { ?>$title<?php }?></title>
		<meta name="keywords" content="<?php if (!empty($_smarty_tpl->tpl_vars['keywords']->value)) {
echo $_smarty_tpl->tpl_vars['keywords']->value;
}?>" />
		<meta name="description" content="<?php if (!empty($_smarty_tpl->tpl_vars['description']->value)) {
echo $_smarty_tpl->tpl_vars['description']->value;
}?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- ace styles -->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<?php echo '<script'; ?>
 src="assets/js/ace-extra.min.js"><?php echo '</script'; ?>
>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<?php echo '<script'; ?>
 src="assets/js/html5shiv.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/respond.min.js"><?php echo '</script'; ?>
>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							Shop后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>欢迎光临,</small>
									<?php echo $_smarty_tpl->tpl_vars['user_info']->value['username'];?>

								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										设置
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-user"></i>
										个人资料
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="#">
										<i class="icon-off"></i>
										退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<?php $_smarty_tpl->_subTemplateRender('file:common/slide.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>
				</div>

				<div class="main-content">
					<?php $_smarty_tpl->_subTemplateRender('file:common/bread.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


					<div class="page-content">
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_96938740758e6183429c547_91601337', 'content');
?>


						<div class="row">
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<?php echo '<script'; ?>
 src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"><?php echo '</script'; ?>
>

		<!-- <![endif]-->

		<!--[if IE]>
<?php echo '<script'; ?>
 src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><?php echo '</script'; ?>
>
<![endif]-->

		<!--[if !IE]> -->

		<?php echo '<script'; ?>
 type="text/javascript">
			window.jQuery || document.write("<?php echo '<script'; ?>
 src='assets/js/jquery-2.0.3.min.js'>"+"<"+"script>");
		<?php echo '</script'; ?>
>

		<!-- <![endif]-->

		<!--[if IE]>
<?php echo '<script'; ?>
 type="text/javascript">
 window.jQuery || document.write("<?php echo '<script'; ?>
 src='assets/js/jquery-1.10.2.min.js'>"+"<"+"script>");
<?php echo '</script'; ?>
>
<![endif]-->

		<?php echo '<script'; ?>
 type="text/javascript">
			if("ontouchend" in document) document.write("<?php echo '<script'; ?>
 src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
		<?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/bootstrap.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/typeahead-bs2.min.js"><?php echo '</script'; ?>
>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <?php echo '<script'; ?>
 src="assets/js/excanvas.min.js"><?php echo '</script'; ?>
>
		<![endif]-->

		<?php echo '<script'; ?>
 src="assets/js/jquery-ui-1.10.3.custom.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/jquery.ui.touch-punch.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/jquery.slimscroll.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/jquery.easy-pie-chart.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/jquery.sparkline.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/flot/jquery.flot.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/flot/jquery.flot.pie.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/flot/jquery.flot.resize.min.js"><?php echo '</script'; ?>
>

		<!-- ace scripts -->

		<?php echo '<script'; ?>
 src="assets/js/ace-elements.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="assets/js/ace.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
/* {block 'content'} */
class Block_96938740758e6183429c547_91601337 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_96938740758e6183429c547_91601337',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php
}
}
/* {/block 'content'} */
}
