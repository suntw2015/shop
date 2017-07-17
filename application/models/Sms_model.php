<?php

class Sms_model extends APP_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function create($data){
        
        if(empty($data) || empty($data['phone'])){
            return -1;
        }

        $data['create_time'] = date('Y-m-d H:i:s');

        $smsInfo = array();
        foreach(array('phone','type','content','status','fail_reason','create_id','create_time') as $value){
            $smsInfo[$value] = isset($data[$value]) ? $data[$value] : '';
        }

        $this->db->insert('sms',$smsInfo);
        $result = $this->db->insert_id();

        return $result;
    }

    public function update($data){
        if(empty($data) || empty($data['id'])){
            return -1;
        }

        foreach(array('status','fail_reason','update_time') as $value){
            if(!empty($data[$value])){
                $this->db->set($value,$data[$value]);
            }
        }

        $data['id'] = (int)$data['id'];
        $this->db->where('id',$data['id']);
        $this->db->update('sms');
        $row = $this->db->affected_rows();
        return $row;
    }
}