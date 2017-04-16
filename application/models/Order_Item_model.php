<?php

class Order_Item_model extends APP_Model{

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function getListByOid($oid = 0){

        $this->db->where('oid',$oid);

        $query = $this->db->get('order_item');
        $result = $query->result_array();

        return $result;
    }
}