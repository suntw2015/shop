<?php

class Category_product extends APP_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('Category_product_model'));
    }

    public function index(){

        $this->load->model(array('Category_model','Product_model'));
        $mapList = $this->Category_product_model->get();
        $categoryList = $this->Category_model->get();
        $productList = $this->Product_model->get();

        $newCategoryList = array();
        $newProductList = array();

        foreach($categoryList as $key=>$value){
            $newCategoryList[$value['id']] = $value;
        }

        foreach($productList as $key=>$value){
            $newProductList[$value['id']] = $value;
        }

        $categoryProduct = array();
        foreach($mapList as $key=>$value){
            $categoryId = $value['category_id'];
            $productId = $value['product_id'];
            if(!isset($newCategoryList[$categoryId])){
                continue;
            }

            if(!isset($categoryProduct[$categoryId])){
                $categoryProduct[$categoryId] = array(
                    'categoryId'    => $categoryId,
                    'name'  => $newCategoryList[$categoryId]['name'],
                    'productList' => array()
                );
            }

            if(isset($newProductList[$productId])){
                $categoryProduct[$categoryId]['productList'][$productId] = array(
                    'id'    => $productId,
                    'name'  => $newProductList[$productId]['name']
                );
            }
        }

        $this->render('category_product/index.html',array(
            'mapList'   => $categoryProduct
        ));
    }

    public function update(){
        $data = $this->input->get();
        
        $this->load->model(array('Product_model','Category_model'));
        $productList = $this->Product_model->get();

        $categoryInfo = $this->Category_model->getCategoryById($data['cid']);

        $mapList = $this->Category_product_model->getProductByCategoryId($data['cid']);
        $mapList = array_column($mapList,'product_id');

        foreach($productList as $key=>$value){
            $productList[$key]['checked'] = in_array($value['id'],$mapList) ? 1 : 0;
        }

        $this->render('category_product/update.html',array(
            'productList'   => $productList,
            'categoryInfo'  => $categoryInfo
        ));
    }

    public function do_update(){
        $data = $this->input->post();

        $data['create_by'] = $this->userInfo['id'];
        $res = $this->Category_product_model->update($data);
        if(!is_int($res)){
            $this->return_fail($res);
        }

        $this->return_success('更新成功');
    }

    public function delete(){
        $data = $this->input->post();
        $res = $this->Category_product_model->deleteByCategoryId($data['cid']);
        if(!is_int($res)){
            $this->return_fail($res);
        }

        $this->return_success('删除成功');
    }
}