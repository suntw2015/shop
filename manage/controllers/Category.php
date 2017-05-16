<?php

class Category extends APP_Controller{

    protected $statusText = array(
        '1' => '正常',
        '2' => '下线'
    );

    public function __construct(){
        parent::__construct();
        $this->load->model(array('Category_model'));
    }

    public function index(){
        $categoryList = $this->Category_model->get();

        foreach($categoryList as $key=>&$value){
            $value['status_text'] = isset($this->statusText[$value['status']]) ? $this->statusText[$value['status']] : '';
        }

        $this->render('category/index.html',array(
            'title'         => '分类管理',
            'categoryList'  => $categoryList
        ));
    }

    public function create(){
        $this->render('category/create.html',array(
            'title'         => '新建分类',
            'statusList'    => $this->statusText
        ));
    }

    public function do_create(){
        $data = $this->input->post();
        if(empty($data) || !is_array($data)){
            $this->return_fail('创建失败，分类信息为空');
        }

        $data['create_by'] = $this->userInfo['id'];
        $res = $this->Category_model->create($data);
        if(!is_int($res)){
            $this->return_fail($res);
        }

        $this->return_success('创建成功');
    }

    public function update(){
        $data = $this->input->get();

        $data['id'] = (int)$data['id'];
        $categoryInfo = $this->Category_model->getCategoryById($data['id']);
        $this->render('category/update.html',array(
            'categoryInfo'  => $categoryInfo,
            'statusList'    => $this->statusText
        ));
    }

    public function do_update(){
        $data = $this->input->post();
        if(empty($data) || !is_array($data)){
            $this->return_fail('更新失败，分类信息为空');
        }

        $data['update_by'] = $this->userInfo['id'];
        $res = $this->Category_model->update($data);
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
        $res = $this->Category_model->deleteCategoryById($data['id']);

        if(!is_int($res) || $res < 1){
            $this->return_fail($res);
        }

        $this->return_success('删除成功');
    }
}