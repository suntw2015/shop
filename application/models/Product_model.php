<?php

class Product_model extends APP_Model{

    protected $tableName = 'product';

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function getNormalList(){
        $this->db->where('status',1);
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();

        return $result;
    }
}