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

    public function update($data){
        if(!is_array($data)){
            return false;
        }

        if(!empty($data['name']) && is_string($data['name'])){
            $this->db->set('name',$data['name']);
        }

        if(!empty($data['cover_img']) && is_string($data['cover_img'])){
            $this->db->set('cover_img',$data['cover_img']);
        }

        if(!empty($data['delivery']) && is_string($data['delivery'])){
            $this->db->set('delivery',$data['delivery']);
        }

        if(!empty($data['delivery_fee']) && is_string($data['delivery_fee'])){
            $this->db->set('delivery_fee',$data['delivery_fee']);
        }

        if(!empty($data['phone']) && is_string($data['phone'])){
            $this->db->set('phone',$data['phone']);
        }

        if(!empty($data['notice']) && is_string($data['notice'])){
            $this->db->set('notice',$data['notice']);
        }

        if(!empty($data['activity_icon']) && is_string($data['activity_icon'])){
            $this->db->set('activity_icon',$data['activity_icon']);
        }

        if(!empty($data['activity_desc']) && is_string($data['activity_desc'])){
            $this->db->set('activity_desc',$data['activity_desc']);
        }

        if(isset($data['status']) && in_array($data['status'],array(0,1))){
            $this->db->set('status',$data['status']);
        }

        if(!empty($data['update_by']) && is_int($data['update_by'])){
            $this->db->set('update_by',$data['update_by']);
        }

        $this->db->set('update_time',time());
        $this->db->where('id',1);
        $this->db->update('shop');

        return $this->db->affected_rows();
    }
}