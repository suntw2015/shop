<?php
/* Smarty version 3.1.31, created on 2017-04-11 14:44:11
  from "/server/www/self/shop/application/views/shop/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_58ec7b3b366d19_77184553',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12a912d6a3cefafef023ef499c197ee7874f7841' => 
    array (
      0 => '/server/www/self/shop/application/views/shop/index.html',
      1 => 1491892432,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58ec7b3b366d19_77184553 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html lang="zh-cmn-Hans">
<head>
    <title>title</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php echo '<script'; ?>
 src="/assets/js/flexible.js" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/assets/js/perf.min.js" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <link href="/assets/css/vendor.css" rel="stylesheet">
    <link href="/assets/css/shop.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
</head>

<body>
<div class="main">
    <div>
        <div class="shop-header-container_qVoLT_0">
            <div class="shop-header-background_2cwiR_0" style="background-image: url(&quot;//fuss10.elemecdn.com/9/da/99e61b6978553324d485a70c67ebapng.png?imageMogr/format/webp/thumbnail/!40p/blur/50x40/&quot;);">
            </div> 
            <nav class="shop-header-navBar_ibFIP_0">
                <a href="javascript:;">
                    <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-left"></use>
                    </svg>
                </a>
            </nav> 
            <div class="shop-header-main_1B2kH_0">
                <img class="shop-header-logo_3woDQ_0" src="<?php echo $_smarty_tpl->tpl_vars['shop']->value['cover_img'];?>
"> 
                <div class="shop-header-content_3UjPs_0">
                    <h2 class="shop-header-shopName_2QrHh_0"><?php echo $_smarty_tpl->tpl_vars['shop']->value['name'];?>
</h2> 
                    
                    <?php if (!empty($_smarty_tpl->tpl_vars['shop']->value['delivery'])) {?>
                    <p class="shop-header-delivery_1mcTe_0">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['shop']->value['delivery'], 'delivery');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['delivery']->value) {
?>
                        <span class="shop-header-deliveryItem_Fari3_0">
                            <?php echo $_smarty_tpl->tpl_vars['delivery']->value;?>

                        </span> 
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                    </p>
                    <?php }?> 
                <?php if (!empty($_smarty_tpl->tpl_vars['shop']->value['notice'])) {?>                    
                <div class="shop-header-notice_2DzmG_0">
                    <span>公告：</span>
                    <span><?php echo $_smarty_tpl->tpl_vars['shop']->value['notice'];?>
</span>
                </div>
                <?php }?>
            </div> 
            <svg class="shop-header-detailIcon_1IXZI_0"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-right"></use></svg>
        </div> 
        
        <?php if (!empty($_smarty_tpl->tpl_vars['shop']->value['activity'])) {?>
        <div class="shop-header-activities_3NWG9_0">
            <div class="activity-activityWrap_1u6b1_0 activity-nowrap_2JDU4_0 shop-header-activityRow_fbfAg_0">
                <i class="activity-activityIcon_1iJyG_0" style="background-color: rgb(112, 188, 70); color: rgb(255, 255, 255); border-color: rgb(112, 188, 70);">
                    <?php echo $_smarty_tpl->tpl_vars['shop']->value['activity']['icon'];?>

                </i> 
                <span class="activity-description_2q8qg_0">
                    <span><?php echo $_smarty_tpl->tpl_vars['shop']->value['activity']['desc'];?>
</span> 
                </span>
            </div> 
            <!--<div class="shop-header-activityCount_tCsbf_0">
                <?php echo count($_smarty_tpl->tpl_vars['shop']->value['activity']);?>
个活动
            </div>-->
        </div>
        <?php }?>
</div> 

<div>
    <div class="shop-tab-container_3skq8_0">
        <div class="shop-tab-tab_r4SDi_0 shop-tab-active_ZY0C0_0">
            <span class="shop-tab-title_1crD1_0">
                商品
            </span>
        </div>
        <div class="shop-tab-tab_r4SDi_0">
            <span class="shop-tab-title_1crD1_0">
                评价
            </span>
        </div>
    </div> 
</div>

<div class="menuview-2hUkG" style="height: 1100px;">
    <div class="menuview-2iJo3" style="display: none;">
        <img src="//github.elemecdn.com/eleme/fe-static/1cb05f59/media/empty/no-food.png" /> 
        <p>没有商品</p> 
        <p>该商家还未上传商品</p>
    </div>

    <div class="menuview-17K3g">
    <main class="menuview-i6fQ3">

        <!--left-->
        <?php if (!empty($_smarty_tpl->tpl_vars['category']->value)) {?>
        <ul class="menucategory-29kyE menuview-2_lFf" id="categoryList">
            <!--<li class="menucategory-JnDmc menucategory-2MBNs menucategory-3e27M">
                <img src="//fuss10.elemecdn.com/5/da/3872d782f707b4c82ce4607c73d1ajpeg.jpeg" class="menucategory-375ij" /> <span class="menucategory-qwsbd">热销榜</span>
            </li>-->
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value, 'f');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
?>
            <li class="menucategory-3e27M" tag='li' data-id="<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
">
                <span class="menucategory-qwsbd"><?php echo $_smarty_tpl->tpl_vars['f']->value['name'];?>
</span>
            </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

        </ul>
        <?php }?>

        <!--right-->
        <section data-v-81584c58="" class="container menuview-JqDMu" id="productList">
            <div data-v-81584c58="" class="scroller">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categoryProduct']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
                <dl data-v-81584c58="" class="">
                    <dt data-v-81584c58="">
                        <div data-v-81584c58="" class="category-title">
                            <strong data-v-81584c58="" class="category-name"><?php echo $_smarty_tpl->tpl_vars['category']->value['categoryName'];?>
</strong> 
                            <span data-v-81584c58="" class="category-description"><?php echo $_smarty_tpl->tpl_vars['category']->value['categoryDesc'];?>
</span>
                        </div> 
                    </dt>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value['productList'], 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
                    <dd data-v-81584c58="" class="productDetail">
                        <span data-v-81584c58="" class="foodimg">
                            <img data-v-81584c58="" src="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover_img'];?>
" />
                        </span> 
                        <section data-v-81584c58="" class="foodinfo">
                            <header data-v-81584c58="" class="foodtitle">
                                <span data-v-81584c58=""><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</span> 
                            </header> 
                            <p data-v-81584c58="" class="fooddescription"><?php echo $_smarty_tpl->tpl_vars['product']->value['desc'];?>
</p> 
                            <p data-v-81584c58="" class="foodsales">
                                <!--<span data-v-81584c58="">月售403份</span> 
                                <span data-v-81584c58="">好评率90%</span>-->
                            </p> 
                            <strong data-v-81584c58="" class="foodprice">
                                <span data-v-81584c58=""><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</span> 
                            </strong>

                            <?php if ($_smarty_tpl->tpl_vars['product']->value['stock'] > 0) {?>
                            <div data-v-81584c58="" class="cartbutton">
                                <span data-v-81584c58="">
                                    <span class="cartbutton-2tycR">
                                        <a href="javascript:" class="minus" tag="minus" style="display: none">
                                            <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart-add"></use></svg>
                                        </a> 
                                        <span class="cartbutton-2OSi7 count" style="display: none">0</span>
                                        <a href="javascript:" class="plus" tag="plus">
                                            <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart-minus"></use></svg>
                                        </a>
                                    </span>
                                </span>
                            </div>
                            <?php }?>
                        </section>
                    </dd>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </dl>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

            </div>
        </section>
    </main>

    <?php echo '<script'; ?>
 type="text/javascript">
        
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="/assets/js/jquery-2.0.3.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/assets/js/shop.js"><?php echo '</script'; ?>
>
</div>
</body>
</html><?php }
}
