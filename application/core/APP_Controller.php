<?php
class APP_Controller extends CI_Controller{
	
	protected $needLogin=true;

	protected $userInfo;

	public function __construct(){
		parent::__construct();
		
		$this->load->library(array('smarty'));
		$this->load->helper('cookie');
        
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();
		// if(!in_array($this->router->fetch_method(),array('login','do_login'))){
		// 	$this->check_auth();
		// }
	}

	public function check_auth(){
		$token = get_cookie('token');

		if(empty($token)){
			$this->redirect('/user/login');exit;
		}

		$this->load->model('User_model');
		$userInfo = $this->User_model->check_token($token);
		if(!isset($userInfo['code']) || $userInfo['code'] != 0){
			$this->redirect('/user/login');
		}

		$this->userInfo = $userInfo['data'];
	}

	public function format_menu(){
		$this->config->load('menu_list');
		$menu_list = $this->config->item('menu_list');
		$this->assign('menu_list',$menu_list);
		$this->assign('user_info',$this->userInfo);
	}

	public function assign($key,$value){
		$this->smarty->assign($key,$value);
	}

	public function render($template,$values){
		if(is_array($values)){
			foreach($values as $k=>$v){
				$this->assign($k,$v);
			}
		}
		$this->smarty->display($template);
	}

	public function ajax_return($data){
		$this->output->set_content_type('application/json','utf-8')->set_output(json_encode($data))->_display();
		exit;
	}

	public function return_success($data){
		$this->ajax_return(array(
			'code'	=> 0,
			'data'	=> $data
		));
	}

	public function return_fail($msg){
		$this->ajax_return(array(
			'code'	=> -1,
			'msg'	=> $msg
		));
	}

	public function redirect($url){
		Header("HTTP/1.1 301 Permanently Moved");
		Header("Location: $url");
		exit;
	}
}
