<?php

class Shop extends APP_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model(array('Category_model','Category_product_model','Product_model'));
    }

    public function index(){
        $this->config->load('shop');
        $shopInfo = $this->config->item('shop');

        $category = $this->Category_model->getNormalList();
        $product = $this->Product_model->getNormalList();
        $categoryMap = $this->Category_product_model->getNormalList();

        $newCategoryMap = array();
        foreach($categoryMap as $key=>$value){
            $category_id = $value['category_id'];
            $product_id = $value['product_id'];

            $newCategoryMap[$category_id][] = $product_id;
        }

        $this->render('shop/index.html',array(
            'shop'  => $shopInfo,
            'category'  => $category,
            'product'   => $product,
            'categoryMap'   => $newCategoryMap
        ));
    }
}