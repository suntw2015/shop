<?php 

Class Order_model extends APP_Model{

    public function __construct(){
        parent::__construct();

        $this->load->database();
        $this->tableName = 'order';
    }

    public function getOrderByUid($uid=0){
        $uid = (int)$uid;

        $this->db->where('user_id',$uid);
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();

        return $result;
    }

    public function getOrderByOid($oid=0){
        $oid = (int)$oid;
        $this->db->where('id',$oid);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();

        return $result;
    }

    public function create($data){
        if(empty($data)){
            return;
        }

        $query = $this->db->insert($this->tableName,$data);
        $result = $this->db->insert_id();

        return $result;
    }
}