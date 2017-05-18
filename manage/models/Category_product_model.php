<?php

class Category_product_model extends APP_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get(){
        $query = $this->db->get('category_product');
        $res = $query->result_array();

        return $res;
    }

    public function getProductByCategoryId($cid){
        $this->db->select('product_id');
        $this->db->where('category_id',$cid);
        $query = $this->db->get('category_product');
        $res = $query->result_array();
        return $res;
    }

    public function deleteById($id){
        $this->db->where('id',$id);
        $query = $this->db->delete('category_product');
        $res = $this->db->affected_rows();
        return $res;
    }

    public function deleteByCategoryId($cid){
        $this->db->where('category_id',$cid);
        $query = $this->db->delete('category_product');
        $res = $this->db->affected_rows();
        return $res;
    }

    public function create($data){
        if(empty($data) || !is_array($data)){
            return '数据不正确';
        }

        $info = array(
            'category_id'   => $data['category_id'],
            'product_id'    => $data['product_id'],
            'create_by'     => $data['create_by'],
            'create_time'   => date('Y-m-d')
        );

        $this->db->insert('category_product',$info);
        return $this->db->insert_id();
    }

    public function update($data){
        if(empty($data['cid']) || empty($data['pids'])){
            return '更新失败，信息不完整';
        }

        $pids = explode(",",$data['pids']);
        
        $this->deleteByCategoryId($data['cid']);
        $info =  array();

        foreach($pids as $value){
            $info[] = array(
                'category_id'   => $data['cid'],
                'product_id'    => $value,
                'create_by'     => $data['create_by'],
                'create_time'   => date('Y-m-d')
            );
        }

        $this->db->insert_batch('category_product',$info);
        $res = $this->db->affected_rows();
        return $res;
    }
}
