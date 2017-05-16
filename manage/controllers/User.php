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
		 $searchData = $this->input->get();

		 $this->setDefaultValues($searchData,array(
			 'username'	=> '',
			 'status'	=> ''
		 ));

		 $userList = $this->User_model->getAll();
		 foreach($userList as $key=>$value){
			 $userList[$key]['role_text'] = isset($this->roleList[$value['role']]) ? $this->roleList[$value['role']] : '';
			 $userList[$key]['status_text'] = isset($this->statusList[$value['status']]) ? $this->statusList[$value['status']] : '';
		 }

		 $this->render("user/index.html",array(
			 'searchData'	=> $searchData,
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
		if(empty($params['username']) || empty($params['password'])){
			$this->return_fail('用户名密码不能为空');
		}

		$userInfo = $this->User_model->check_normal($params['username'],$params['password']);

		if(!is_array($userInfo)){
			$this->return_fail('用户名密码错误');
		}

		set_cookie('token',$userInfo['token'],3600*24*30);

		$this->return_success("/product/index");
	 }

	 public function create(){
		 $this->render("user/create.html",array(
			 'title'		=> '创建用户',
			 'roleList' 	=> $this->roleList,
			 'statusList'	=> $this->statusList
		 ));
	 }

	 public function do_create(){
		 $data = $this->input->post();
		 if(empty($data) || !is_array($data)){
			 $this->return_fail('用户数据为空');
		 }

		 $data['create_by'] = $this->userInfo['id'];
		 $res = $this->User_model->create($data);
		 if(!is_int($res)){
			 $this->return_fail($res);
		 }

		 $this->return_success('创建成功');
	 }

	 public function update(){
		 $data = $this->input->get();
		 $userInfo = $this->User_model->getUserInfoByUid((int)$data['uid']);

		 $this->render("user/update.html",array(
			 'title'		=> '创建用户',
			 'roleList' 	=> $this->roleList,
			 'statusList'	=> $this->statusList,
			 'userInfo'		=> $userInfo
		 ));
	 }

	 public function do_update(){
		 $data = $this->input->post();

		 if(empty($data) || !is_array($data)){
			 $this->return_fail('更新失败');
		 }

		 $data['update_by'] = $this->userInfo['id'];
		 $res = $this->User_model->update($data);
		 if(!is_int($res)){
			 $this->return_fail($res);
		 }

		 $this->return_success('更新成功');
	 }
}