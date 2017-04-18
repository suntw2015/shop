<?php

class User_Model extends APP_Model{

    const password_salt = '21h@w4a#!&w3f1e';

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function check_normal($username,$password){
        $salt_password = $this->create_password($password);
        $query = $this->db->get_where('user',array('username'=>$username,'password'=>$salt_password));
        $result = $query->row_array();

        if(empty($result)){
            return '用户名密码错误';
        }

        if($result['status'] == 0){
            return $result['error_reason'];
        }

        if($result['role'] != 2){
            return '非管理员账号，无法登陆';
        }

        if(empty($result['token'])){
            $token = md5($result['id'].time().$result['password']);
            $this->db->where('id',$result['id']);
            $this->db->update('user',array('token'=>$token));
            $result['token'] = $token;
        }

        return $result;
    }

    public function check_token($token){
        if(empty($token)){
            return false;
        }

        $query = $this->db->get_where('user',array('token'=>$token));
        $result = $query->row_array();

        if(empty($result)){
            return '用户不存在';
        }

        if($result['status'] == 0){
            return $result['error_reason'];
        }

        return $result;
    }

    public function create($data){
        $userinfo = array(
            'username'  => $this->check_param($data,'username','string',false),
            'password'  => $this->create_password($this->check_param($data,'password','string',false)),
            'email'     => $this->check_param($data,'email','string'),
            'phone'     => $this->check_param($data,'phone','string'),
            'create_time'   => time()
        );

        $this->db->insert();

    }

    public  function update($data){
        
    }

    public function getAll(){
        $query = $this->db->get('user');
        $result = $query->result_array();

        return $result;
    }

    private function create_password($password){
        return md5($password.self::password_salt);
    }
}