<?php

class OrderItem_model extends APP_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get($data=array()){
        if(!empty($data['oid'])){
            $this->db->where('oid',$data['oid']);
        }

        $query = $this->db->get('order_item');
        $res = $query->result_array();
        return $res;
    }

}