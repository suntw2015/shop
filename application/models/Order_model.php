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
        $this->db->order_by("id","desc");
        $query = $this->db->get($this->tableName);
        $result = $query->result_array();

        return $result;
    }

    public function getOrderByOid($oid=0){
        $oid = (int)$oid;
        $this->db->where('oid',$oid);
        $query = $this->db->get($this->tableName);
        $result = $query->row_array();

        return $result;
    }

    public function createOrder($data){
        if(empty($data)){
            return;
        }

        $data['create_time'] = date('Y-m-d');
        $query = $this->db->insert($this->tableName,$data);
        $result = $this->db->insert_id();

        return $result;
    }

    public function isOidExist($oid){
        $this->db->where("oid",$oid);
        $this->db->from($this->tableName);
        $count = $this->db->count_all_results();
        return $count;
    }

    public function updateStatus($oid,$status){
        $this->db->where("oid",$oid);
        $this->db->set("status",$status);
        $this->db->set("update_time",date('Y-m-d'));
        $this->db->update($this->tableName);
        $row = $this->db->affected_rows();

        return $row;
    }

    public function removeOrderByOid($oid){
        $this->db->where("oid",$oid);
        $this->db->from($this->tableName);
        
        return $this->db->delete();
    }

    public function confirm($oid){
        $this->db->where("oid",$oid);
        $this->db->set("status",2);
        $this->db->set("confirm_time",date('Y-m-d'));
        $this->db->update($this->tableName);
        $row = $this->db->affected_rows();

        return $row;
    }
}