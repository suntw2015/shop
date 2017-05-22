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
		if(!isset($data['phone']) || empty($data['phone'])){
			$this->return_fail('手机号不能为空');
		}

		if(!isset($data['password']) || empty($data['password'])){
			$this->return_fail('密码不能为空');
		}

		$phone = $data['phone'];
		$password = $data['password'];

		$this->load->model('User_model');
		$userInfo = $this->User_model->login($phone,$password);

		if(!is_array($userInfo)){
			$this->return_fail($userInfo);
		}

		set_cookie('token',$userInfo['token'],3600*24*30);
		$this->return_success("/user/index");
	}

	public function doregister(){
		$data = $this->input->post();
		if(!isset($data['username']) || empty($data['username'])){
			$this->return_fail('用户名不能为空');
		}

		if(!isset($data['phone']) || empty($data['phone'])){
			$this->return_fail('手机号不能为空');
		}

		if(!preg_match("/^1[0-9]{10}$/",$data['phone'])){
            $this->return_fail('手机号不正确');
        }

		if(!isset($data['password']) || empty($data['password'])){
			$this->return_fail('密码不能为空');
		}

		$this->load->model('User_model');
		$res = $this->User_model->register($data);

		if(!is_int($res) && $res != 1){
			$this->return_fail($res);
		}

		$this->return_success("/user/login");
	}
}