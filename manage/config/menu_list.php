<?php

$config['menu_list'] = array(
    array(
        'title' => '用户管理',
        'icon'  => '',
        'href'  => '/user/index',
        'class' => ''
    ),
    array(
        'title' => '商铺信息',
        'icon'  => '',
        'href'  => '/shop/index',
        'class' => ''
    ),
    array(
        'title' => '分类管理',
        'icon'  => '',
        'href'  => '#',
        'class' => '',
        'submenu' => array(
            array(
                'title' => '分类信息',
                'icon'  => '',
                'href'  => '/category/index',
            ),
            array(
                'title' => '聚合列表',
                'icon'  => '',
                'href'  => '/category_product/index',
            )
        )
    ),
    array(
        'title' => '产品管理',
        'icon'  => '',
        'href'  => '/product/index',
        'class' => ''
    ),
);