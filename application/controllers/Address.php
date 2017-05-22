<?php

class Address extends APP_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model(array('Address_model'));
    }

    public function get(){
        $addressList = $this->Address_model->get(array('user_id'=>$this->userInfo['id']));
        $this->return_success($addressList);
    }

    public function do_create(){
        $data = $this->input->post();
        if(empty($data) || !is_array($data)){
            $this->return_fail('数据格式错误');
        }

        $data['user_id'] = $this->userInfo['id'];
        $res = $this->Address_model->create($data);
        if(!is_int($res)){
            $this->return_fail($res);
        }

        $this->return_success();
    }

    public function update(){
        $data = $this->input->get();
        $address = $this->Address_model->get($data);

        if(empty($address)){
            $this->return_fail('地址不存在');
        }

        $this->assign('address',$address);
        $tpl = $this->smarty->fetch('address/update.html');
        $this->return_success($tpl);
    }
}