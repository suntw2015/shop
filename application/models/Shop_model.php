<?php

class Shop_model extends APP_Model{
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get(){
        $this->db->where('id',1);
        $query = $this->db->get('shop');
        $result = $query->row_array();

        return $result;
    }
}