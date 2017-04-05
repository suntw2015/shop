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

	 public function login(){
		
		$this->render("user/login.tpl",array(
			'title'	=> '管理后台登录'
		));
	 }

	 public function do_login(){
		$params = $this->input->post();
		if(empty($params['username']) || empty($params['password'] || !$params['username'].length || !$params['password'].length)){
			$this->return_fail('用户名密码不能为空');
		}

		$this->load->model('User_model');
		$userInfo = $this->User_model->check_normal($params['username'],$params['password']);

		if($userInfo['code'] != 0){
			$this->return_fail($userInfo['msg']);
		}

		$userInfo = $userInfo['data'];
		set_cookie('token',$userInfo['token'],3600*24*30);

		$this->return_success(sprintf("%s/product/index",$_SERVER['HTTP_ORIGIN']));
	 }
}