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

    public function getListByIds($ids){
        $idArray = explode(",",$ids);
        $this->db->where_in('id',$idArray);
        $this->db->where('status',1);

        $query = $this->db->get($this->tableName);
        $result = $query->result_array();

        return $result;
    }

    public function minusStock($data){
        $this->db->trans_begin();
        try{
            foreach($data as $key=>$value){
                $this->db->where("id",$value['id']);
                $this->db->set("stock","stock - ".$value['count'],false);
                $this->db->update($this->tableName);
                $row = $this->db->affected_rows();
                if($row <1){
                    $this->db->trans_rollback();
                    return false;        
                }
            }
        }catch(Exception $e){
            $this->db->trans_rollback();
            return false;
        };

        $this->db->trans_commit();
        return true;
    }
}