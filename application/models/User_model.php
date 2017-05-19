<?php

class User_Model extends APP_Model{

    protected $tableName = 'user';
    const password_salt = '21h@w4a#!&w3f1e';

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function login($phone,$password){
        $salt_password = $this->create_password($password);
        $query = $this->db->get_where('user',array('phone'=>$phone,'password'=>$salt_password));
        $result = $query->row_array();

        if(empty($result)){
            return '用户名密码错误';
        }

        if($result['status'] == 0){
            return $result['error_reason'];
        }

        if(empty($result['token'])){
            $token = md5($result['id'].time().$result['password']);
            $this->db->where('id',$result['id']);
            $this->db->update('user',array('token'=>$token));
            $result['token'] = $token;
        }

        $this->fullUserInfo($result);

        return $result;
    }

    public function loginByToken($token){
        if(empty($token)){
            return 'token 不能为空';
        }

        $query = $this->db->get_where('user',array('token'=>$token));
        $result = $query->row_array();

        if(empty($result)){
            return ‘找不到用户信息’;
        }

        if($result['status'] == 0){
            return $result['error_reason'];
        }

        $this->fullUserInfo($result);

        return $result;
    }

    private function fullUserInfo(&$userInfo){
        if(empty($userInfo['head_img'])){
            $userInfo['head_img'] = '/assets/image/default_head.jpg';
        }
    }

    public function register($data){
        $checkField = array(
            'username'  => '昵称',
            'password'  => '密码',
            'phone'=> '手机号'
        );
        
        foreach($checkField as $key=>$value){
            if(empty($data[$key])){
                return $value."不能为空";
            }
        }

        if($this->checkPhoneExist($data['phone'])){
            return '手机号已经注册';
        }

        $userinfo = array(
            'username'  => $data['username'],
            'password'  => $this->create_password($data['password']),
            'phone'     => $data['phone'],
            'role'      => 1,
            'create_time'   => time()
        );

        $this->db->insert('user',$userinfo);
        $user_id = $this->db->insert_id();

        return $user_id;
    }

    public function checkPhoneExist($phone){
        $this->db->where('phone',$phone);
        $query = $this->db->get('user');
        $res = $query->result_count();
        return $res;
    }

    public  function update($data){
        
    }

    private function create_password($password){
        return md5($password.self::password_salt);
    }
}