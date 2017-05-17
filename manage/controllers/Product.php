<?php

class Product extends APP_Controller{

	protected $statusText = array(
        '1' => '正常',
        '2' => '下线'
    );

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Product_model'));
	}

	public function index(){
        $productList = $this->Product_model->get();

        foreach($productList as $key=>&$value){
            $value['status_text'] = isset($this->statusText[$value['status']]) ? $this->statusText[$value['status']] : '';
        }

        $this->render('product/index.html',array(
            'title'         => '产品管理',
            'productList'  => $productList
        ));
    }

    public function create(){
        $this->render('product/create.html',array(
            'title'         => '新建产品',
            'statusList'    => $this->statusText
        ));
    }

    public function do_create(){
        $data = $this->input->post();
        if(empty($data) || !is_array($data)){
            $this->return_fail('创建失败，产品信息为空');
        }

        $data['create_by'] = $this->userInfo['id'];
        $res = $this->Product_model->create($data);
        if(!is_int($res)){
            $this->return_fail($res);
        }

        $this->return_success('创建成功');
    }

    public function update(){
        $data = $this->input->get();

        $data['id'] = (int)$data['id'];
        $productInfo = $this->Product_model->getProductById($data['id']);
        $this->render('product/update.html',array(
            'productInfo'   => $productInfo,
            'statusList'    => $this->statusText
        ));
    }

    public function do_update(){
        $data = $this->input->post();
        if(empty($data) || !is_array($data)){
            $this->return_fail('更新失败，分类信息为空');
        }

        $data['update_by'] = $this->userInfo['id'];
        $res = $this->Product_model->update($data);
        if(!is_int($res)){
            $this->return_fail($res);
        }

        $this->return_success('更新成功');
    }

    public function delete(){
        $data = $this->input->post();
        if(!isset($data['id'])){
            $this->return_fail('删除失败');
        }

        $data['id'] = (int)$data['id'];
        $res = $this->Product_model->deleteProductById($data['id']);

        if(!is_int($res) || $res < 1){
            $this->return_fail($res);
        }

        $this->return_success('删除成功');
    }
}