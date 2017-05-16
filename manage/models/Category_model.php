<?php

class Category_model extends APP_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get(){
        $this->db->order_by('sort desc,id asc');
        $query = $this->db->get('category');
        $res = $query->result_array();

        return $res;
    }

    public function create($data){

        $checkField = array(
            'name'  => '分类名称',
            'desc'  => '描述',
            'status'=> '状态'
        );
        
        foreach($checkField as $key=>$value){
            if(empty($data[$key])){
                return $value."不能为空";
            }
        }

        $categoryInfo = array(
            'name'  => $data['name'],
            'desc'  => $data['desc'],
            'sort'  => $data['sort'],
            'status'=> $data['status'],
            'create_by'     => $data['create_by'],
            'create_time'   => date('Y-m-d H:i:s',time())
        );

        $this->db->insert('category',$categoryInfo);
        $result = $this->db->insert_id();

        return $result;
    }

    public function update($data){
        if(empty($data['cid'])){
            return '分类ID不能为空';
        }

        $data['cid'] = (int)$data['cid'];

        if(!empty($data['sort']) && !is_int($data['sort'])){
            return '排序不正确';
        }

        if(!empty($data['status']) && !in_array($data['status'],array(1,2))){
            return '状态不正确';
        }

        $categoryInfo = $this->getCategoryByid($data['cid']);
        if(empty($categoryInfo)){
            return '分类信息不存在';
        }

        $updateField = array('name','desc','sort','status');

        foreach($updateField as $value){
            if(!empty($data[$value]) && $data[$value] != $categoryInfo[$value]){
                $this->db->set($value,$data[$value]);
            }
        }

        $this->db->set('update_by',$data['update_by']);
        $this->db->set('update_time',date('Y-m-d H:i:s',time()));

        $this->db->where('id',$data['cid']);
        $this->db->update('category');
        return $this->db->affected_rows();
    }

    public function getCategoryById($id){
        $query = $this->db->get_where('category',array('id'=>$id));
        $res = $query->row_array();
        return $res;
    }

    public function deleteCategoryById($id){
        if(!is_int($id)){
            return 'id错误';
        }

        $this->db->where('id',$id);
        $this->db->delete('category');
        return $this->db->affected_rows();
    }
}