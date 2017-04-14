<?php

class Product_model extends APP_Model{

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function get($data){

    }

    public function multi_get($data){
        $checkedParams = array(
            'id'        => $this->check_param($data,'id','string'),
            'title'     => $this->check_param($data,'title','string'),
            'shop_id'   => $this->check_param($data,'shop_id','int'),
            'status'    => $this->check_param($data,'status','int')
        );

        if(!empty($checkedParams['id'])){
            $id = explode(',',$checkedParams['id']);
            if(count($id) == 1){
                $this->db->where('id',$id[0]);
            }else{
                $this->db->where_in('id',$id);
            }
        }

        if(!empty($checkedParams['title'])){
            $this->db->like('title',$checkedParams['title']);
        }

        if(!empty($checkedParams['shop_id'])){
            $this->db->where('shop_id',$checkedParams['shop_id']);
        }

        if(!empty($checkedParams['status'])){
            $this->db->where('status',$checkedParams['status']);
        }

        $query = $this->db->get('product');
        $result = $query->result_array();

        return $result;
    }

    public function create($data){
        
    }
}