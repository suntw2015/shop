<?php
class User extends APP_Controller{

	public function __construct(){
		parent::__construct();
	}

	 public function index(){
		 $str = "I am a student,study";
		 echo str_replace(array('student','study'),'q',$str);
	 }
}