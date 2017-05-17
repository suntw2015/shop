<?php

class Product_model extends APP_Model{

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function get(){
        $query = $this->db->get('product');
        $res = $query->result_array();
        return $res;
    }

    public function create($data){
        $checkField = array(
            'name'  => '名称',
            'desc'  => '描述',
            'cover_img' => '缩略图',
            'stock'     => '库存',
            'price'     => '价格',
            'status'    => '状态'
        );
        
        foreach($checkField as $key=>$value){
            if(empty($data[$key])){
                return $value."不能为空";
            }
        }

        $info = array(
            'name'  => $data['name'],
            'desc'  => $data['desc'],
            'cover_img'     => $data['cover_img'],
            'stock'         => $data['stock'],
            'price'         => $data['price'],
            'status'        => $data['status'],
            'create_by'     => $data['create_by'],
            'create_time'   => date('Y-m-d H:i:s',time())
        );

        $this->db->insert('product',$info);
        $result = $this->db->insert_id();

        return $result;
    }

    public function update($data){
        if(empty($data['pid'])){
            return '产品ID不能为空';
        }

        $data['pid'] = (int)$data['pid'];

        if(!empty($data['status']) && !in_array($data['status'],array(1,2))){
            return '状态不正确';
        }

        $categoryInfo = $this->getProductByid($data['pid']);
        if(empty($categoryInfo)){
            return '分类信息不存在';
        }

        $updateField = array('name','desc','cover_img','stock','price','status');

        foreach($updateField as $value){
            if(!empty($data[$value]) && $data[$value] != $categoryInfo[$value]){
                $this->db->set($value,$data[$value]);
            }
        }

        $this->db->set('update_by',$data['update_by']);
        $this->db->set('update_time',date('Y-m-d H:i:s',time()));

        $this->db->where('id',$data['pid']);
        $this->db->update('product');
        return $this->db->affected_rows();
    }

    public function getProductById($id){
        $query = $this->db->get_where('product',array('id'=>$id));
        $res = $query->row_array();
        return $res;
    }

    public function deleteProductById($id){
        if(!is_int($id)){
            return 'id错误';
        }

        $this->db->where('id',$id);
        $this->db->delete('product');
        return $this->db->affected_rows();
    }
}