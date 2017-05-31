<?php

class Shop extends APP_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model(array('Category_model','Category_product_model','Product_model','Shop_model'));
    }

    public function index(){
        $shopInfo = $this->Shop_model->get();

        $category = $this->Category_model->getNormalList();
        $product = $this->Product_model->getNormalList();
        $categoryMap = $this->Category_product_model->getNormalList();

        $newProduct = array();
        foreach($product as $key=>$value){
            $newProduct[$value['id']] = $value;
        }

        $newCategory = array();
        foreach($category as $key=>$value){
            $newCategory[$value['id']] = $value;
        }

        $categoryProduct = array();
        $categorySortWeight = array();
        $categoryId = array();

        foreach($categoryMap as $key=>$value){
            $category_id = $value['category_id'];
            $product_id = $value['product_id'];

            if(!isset($newCategory[$category_id])){
                continue;
            }

            if(!isset($categoryProduct[$category_id])){
                $categoryProduct[$category_id] = array(
                    'categoryId'    => $category_id,
                    'categorySort'  => isset($newCategory[$category_id]) ? $newCategory[$category_id]['sort'] : 0,
                    'categoryName'  => isset($newCategory[$category_id]) ? $newCategory[$category_id]['name'] : '',
                    'categoryDesc'  => isset($newCategory[$category_id]) ? $newCategory[$category_id]['desc'] : '',
                    'productList'   => array()    
                );
                $categorySortWeight[$category_id] = $categoryProduct[$category_id]['categorySort'];
                $categoryId[$category_id] = $categoryProduct[$category_id]['categoryId'];
            }

            if(isset($newProduct[$product_id])){
                $categoryProduct[$category_id]['productList'][] = $newProduct[$product_id];
            }
        }

        array_multisort($categorySortWeight,SORT_DESC,$categoryId,SORT_ASC,$categoryProduct);

        foreach($categoryProduct as $key=>$value){
            if(empty($value['productList'])){
                unset($categoryProduct[$key]);
            }
        }
        
        //产品倒排分类索引
        $productCategoryIndex = array();
        foreach($categoryMap as $key=>$value){
            $category_id = $value['category_id'];
            $product_id = $value['product_id'];
            $productCategoryIndex[$product_id] = $category_id;
        }

        $this->render('shop/index.html',array(
            'shop'  => $shopInfo,
            'categoryProduct'   => $categoryProduct,
            'product'   => json_encode($product),
            'productCategoryIndex'  => json_encode($productCategoryIndex)
        ));
    }
}