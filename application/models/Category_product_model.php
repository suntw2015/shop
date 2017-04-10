<?php

class Category_product_model extends APP_Model{

    protected $tableName = 'category_product';

    public function __construct(){

        parent::__construct();
        $this->load->database();
    }

    public function getNormalList(){
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();

        return $result;
    }
}