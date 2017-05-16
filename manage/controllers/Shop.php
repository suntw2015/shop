<?php

class Shop extends APP_Controller{

    public function __construct(){
        parent::__construct();

        $this->load->model(array('Shop_model'));
    }

    public function index(){
        $shopInfo = $this->Shop_model->get();
        $this->render('shop/index.html',array(
            'shopInfo'  => $shopInfo
        ));    
    }

    public function do_update(){
        $data = $this->input->post();
        if(empty($data) || !is_array($data)){
            $this->return_fail("更新信息为空");
        }

        $data['update_by'] = $this->userInfo['id'];
        $res = $this->Shop_model->update($data);
        $this->return_success("更新成功");
    }
}