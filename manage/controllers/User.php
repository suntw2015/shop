<?php
class User extends APP_Controller{

	public function __construct(){
		parent::__construct();
	}

	 public function index(){
		 $this->render("user/index.tpl",array(
			 'title'	=> 'manage'
		 ));
	 }
}