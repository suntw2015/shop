<?php

class APP_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function check_param($data,$field,$type,$can_empty=false){
        if(!is_array($data)){
            throw new Exception('check data is not array');
        }

        if(!isset($data[$field])){
            throw new Exception("field $field is not exist");
        }

        if(!$can_empty && empty($data[$field])){
            throw new Exception("field $field is empty");
        }

        switch($type){
            case 'int':
                if(!is_int($data[$field])){
                    throw new Exception("field $field is not int");
                }
                break;
            case 'float':
                if(!is_float($data[$field])){
                    throw new Exception("field $field is not float");
                }
                break;
            case 'string':
                if(!is_string($data[$field])){
                    throw new Exception("field $field is not string");
                }
                break;
            default:
                throw new Exception("not support type: $type");
        }
    }
}