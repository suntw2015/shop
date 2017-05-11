<?php
class User extends APP_Controller{

	protected $roleList = array(
		1 => '普通用户',
		2 => '管理员'
	);

	protected $statusList = array(
		1 => '正常',
		2 => '禁用'
	);

	public function __construct(){
		parent::__construct();		
		$this->load->model('User_model');
	}

	 public function index(){

		 $userList = $this->User_model->getAll();
		 foreach($userList as $key=>$value){
			 $userList[$key]['role_text'] = isset($this->roleList[$value['role']]) ? $this->roleList[$value['role']] : '';
			 $userList[$key]['status_text'] = isset($this->statusList[$value['status']]) ? $this->statusList[$value['status']] : '';
		 }

		 $this->render("user/index.html",array(
			 'title'	=> '用户管理',
			 'userList'	=> $userList
		 ));
	 }

	 public function login(){
		
		$this->render("user/login.html",array(
			'title'	=> '管理后台登录'
		));
	 }

	 public function do_login(){
		$params = $this->input->post();
		if(empty($params['username']) || empty($params['password'] || !$params['username'].length || !$params['password'].length)){
			$this->return_fail('用户名密码不能为空');
		}

		$userInfo = $this->User_model->check_normal($params['username'],$params['password']);

		if(!is_array($userInfo)){
			$this->return_fail('用户名密码不能为空');
		}

		set_cookie('token',$userInfo['token'],3600*24*30);

		$this->return_success(sprintf("%s/product/index",$_SERVER['HTTP_ORIGIN']));
	 }
}