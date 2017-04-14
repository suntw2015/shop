<?php

class APP_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function return_error($msg=''){
        return array(
            'code'  => -1,
            'msg'   => $msg
        );
    }

    public function return_success($data){
        return array(
            'code'  => 0,
            'data'  => $data
        );
    }

    public function check_param($data,$field,$type,$can_empty=false){
        if(!is_array($data)){
            $this->return_error('check data is not array');
        }

        if(!isset($data[$field])){
            $this->return_error("field $field is not exist");
        }

        if(!$can_empty && empty($data[$field])){
            $this->return_error("field $field is empty");
        }

        switch($type){
            case 'int':
                if(!is_int($data[$field])){
                    $this->return_error("field $field is not int");
                }
                break;
            case 'float':
                if(!is_float($data[$field])){
                    $this->return_error("field $field is not float");
                }
                break;
            case 'string':
                if(!is_string($data[$field])){
                    $this->return_error("field $field is not string");
                }
                break;
            default:
                $this->return_error('not support type: $type');
        }
    }
}