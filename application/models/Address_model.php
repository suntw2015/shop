<?php

class Address_model extends APP_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function create($data){
        $checkedField = array('user_id'=>'用户id','name'=>'姓名','phone'=>'手机号','address'=>'地址');
        foreach($checkedField as $key=>$value){
            if(!isset($data[$key])){
                return $value."不能为空";
            }
        }

        $info = array(
            'user_id'   => $data['user_id'],
            'name'      => $data['name'],
            'phone'     => $data['phone'],
            'address'   => $data['address'],
            'create_time'   => date('Y-m-d H:i:s')
        );

        foreach(array('sex','tag') as $value){
            if(isset($data[$value])){
                $info[$value] = $data[$value];
            }
        }

        $query = $this->db->insert('address',$info);
        $res = $this->db->insert_id();
        return $res;
    }

    public function get($data=array()){
        foreach(array('user_id','id') as $value){
            if(isset($data[$value])){
                $this->db->where($value,$data[$value]);
            }
        }

        $query = $this->db->get('address');
        $res = $query->result_array();

        if(isset($data['id']) && count($res)){
            return $res[0];
        }
        
        return $res;
    }
}