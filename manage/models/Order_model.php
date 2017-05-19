<?php

class Order_model extends APP_Model{
    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function get($data=array()){
        if(!empty($data['status'])){
            $this->db->where('status',$data['status']);
        }

        if(!empty($data['oid'])){
            $this->db->where('oid',$data['oid']);
        }

        if(!empty($data['create_time_from'])){
            $this->db->where('create_time >=',$data['create_time_from']);
        }

        if(!empty($data['create_time_to'])){
            $this->db->where('create_time <= ',$data['create_time_to']." 23:59:59");
        }

        if(!empty($data['update_time_from'])){
            $this->db->where('update_time >=',$data['update_time_from']);
        }

        if(!empty($data['update_time_to'])){
            $this->db->where('update_time <= ',$data['update_time_to']." 23:59:59");
        }

        $query = $this->db->get('order');
        $result = $query->result_array();

        return $result;
    }
}