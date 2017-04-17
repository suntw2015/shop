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

    public function create($data){
        if(empty($data) || !is_array($data)){
            return false;
        }

        $this->db->insert_batch('order_item',$data);
        $row = $this->db->affected_rows();

        return $row;
    }

    public function removeOrderByOid($oid){
        $this->db->where("oid",$oid);
        $this->db->from('order_item');
        
        return $this->db->delete();
    }
}