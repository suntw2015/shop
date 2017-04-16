<?php
class User extends APP_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->render("user/index.html",array(
			'isShowFooter'	=> true,
			'footerIndex'	=> 3,
			'title'			=> '我的'
		));
	}

	public function login(){
		$this->render("user/login.html",array(

		));
	}

	public function dologin(){
		$data = $this->input->post();
		if(!isset($data['username']) || empty($data['username'])){
			$this->return_fail('用户名不能为空');
		}

		if(!isset($data['password']) || empty($data['password'])){
			$this->return_fail('密码不能为空');
		}

		$username = $data['username'];
		$password = $data['password'];

		$this->load->model('User_model');
		$userInfo = $this->User_model->login($username,$password);

		if(!is_array($userInfo)){
			$this->return_fail($userInfo);
		}

		set_cookie('token',$userInfo['token'],3600*24*30);
		$this->return_success("/user/index");
	}
}