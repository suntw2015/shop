<?php

class User_Model extends APP_Model{

    const password_salt = '21h@w4a#!&w3f1e';

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function get($data=array()){
        if(!empty($data['id'])){
            $ids = explode(",",$data['id']);
            if(count($ids) == 1){
                $this->db->where('id',$ids[0]);
            }else{
                $this->db->where_in('id',$ids);
            }
        }

        $query = $this->db->get('user');
        $res = $query->result_array();

        return $res;
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

        if(empty($data['username'])){
            return '用户名不能为空';
        }

        if(empty($data['password'])){
            return '密码不能为空';
        }

        if(empty($data['phone'])){
            return '手机号不能为空';
        }

        if(!preg_match("/^1[0-9]{10}$/",$data['phone'])){
            return '手机号不正确';
        }

        if(empty($data['role']) || !in_array($data['role'],array(1,2))){
            return '用户角色不能为空';
        }

        if(empty($data['status']) || !in_array($data['status'],array(1,2))){
            return '账号状态不能为空';
        }

        if($this->checkPhoneExist($data['phone'])){
            return '创建失败，手机号已经存在';
        }

        if($this->checkUsernameExist($data['username'])){
            return '创建失败，用户名已经存在';
        }

        $userInfo = array(
            'username'  => $data['username'],
            'head_img'  => empty($data['head_img']) ? '' : $data['head_img'],
            'password'  => $this->create_password($data['password']),
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            'status'    => $data['status'],
            'role'      => $data['role'],
            'create_by'     => $data['create_by'],
            'create_time'   => date('Y-m-d H:i:s',time())
        );

        $this->db->insert('user',$userInfo);
        $result = $this->db->insert_id();

        return $result;
    }

    public function update($data){
        if(empty($data['uid'])){
            return '用户ID不能为空';
        }

        $data['uid'] = (int)$data['uid'];

        if(!empty($data['phone']) && !preg_match("/^1[0-9]{10}$/",$data['phone'])){
            return '手机号不正确';
        }

        if(!empty($data['phone']) && $this->checkPhoneExist($data['phone'],$data['uid'])){
            return '创建失败，手机号已经存在';
        }

        if(!empty($data['username']) && $this->checkUsernameExist($data['username'],$data['uid'])){
            return '创建失败，用户名已经存在';
        }

        if(!empty($data['role']) && !in_array($data['role'],array(1,2))){
            return '角色不正确';
        }

        if(!empty($data['status']) && !in_array($data['status'],array(1,2))){
            return '状态不正确';
        }

        $userInfo = $this->getUserInfoByUid($data['uid']);
        if(empty($userInfo)){
            return '用户信息不存在';
        }

        if(!empty($data['username']) && $data['username'] != $userInfo['username']){
            $this->db->set('username',$data['username']);
        }

        if(!empty($data['password'])){
            $this->db->set('password',$this->create_function($data['password']));
        }

        if(!empty($data['head_img'])  && $data['head_img'] != $userInfo['head_img']){
            $this->db->set('head_img',$data['head_img']);
        }

        if(!empty($data['phone'])  && $data['phone'] != $userInfo['phone']){
            $this->db->set('phone',$data['phone']);
        }

        if(!empty($data['role'])  && $data['role'] != $userInfo['role']){
            $this->db->set('role',$data['role']);
        }

        if(!empty($data['status']) && $data['status'] != $userInfo['status']){
            $this->db->set('status',$data['status']);
        }

        $this->db->set('update_by',$data['update_by']);
        $this->db->set('update_time',date('Y-m-d H:i:s',time()));

        $this->db->where('id',$data['uid']);
        $this->db->update('user');
        return $this->db->affected_rows();
    }

    private function checkPhoneExist($phone,$exceptUid=0){
        $this->db->select('id');
        $this->db->where('phone',$phone);

        $query = $this->db->get('user');
        $result = $query->result_array();

        if($exceptUid && count($result) == 1 && $result[0]['id'] == $exceptUid){
            return 0;
        }

        return count($result);
    }

    private function checkUsernameExist($username,$exceptUid=0){
        $this->db->select('id');
        $this->db->where('username',$username);

        $query = $this->db->get('user');
        $result = $query->result_array();

        if($exceptUid && count($result) == 1 && $result[0]['id'] == $exceptUid){
            return 0;
        }

        return count($result);
    }

    public function getAll(){
        $query = $this->db->get('user');
        $result = $query->result_array();

        return $result;
    }

    private function create_password($password){
        return md5($password.self::password_salt);
    }

    public function getUserInfoByUid($uid){
        if(empty($uid) || !is_int($uid)){
            return array();
        }

        $query = $this->db->get_where('user',array('id'=>$uid));
        $res = $query->row_array();

        return $res;
    }
}