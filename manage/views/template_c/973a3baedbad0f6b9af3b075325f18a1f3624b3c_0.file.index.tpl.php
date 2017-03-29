<?php
/* Smarty version 3.1.31, created on 2017-03-29 17:05:55
  from "/server/www/self/shop/manage/views/common/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58db78f387c488_95525755',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '973a3baedbad0f6b9af3b075325f18a1f3624b3c' => 
    array (
      0 => '/server/www/self/shop/manage/views/common/index.tpl',
      1 => 1490778344,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58db78f387c488_95525755 (Smarty_Internal_Template $_smarty_tpl) {
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
									Jason
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

					<include file='common/slide.tpl'>

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>
				</div>

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">首页</a>
							</li>
							<li class="active">控制台</li>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								控制台
								<small>
									<i class="icon-double-angle-right"></i>
									 查看
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; 选择皮肤</span>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
							<label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl">切换到左边</label>
						</div>

						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								切换窄屏
								<b></b>
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
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
</html>

<?php }
}
