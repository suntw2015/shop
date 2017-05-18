<?php
class APP_Controller extends CI_Controller{
	
	protected $needLogin=true;

	protected $userInfo;

	public function __construct(){
		parent::__construct();
		
		$this->load->library(array('smarty'));
		$this->load->helper('cookie');

		if(!in_array($this->router->fetch_method(),array('login','do_login'))){
			$this->check_auth();
		}
		$this->format_menu();
	}

	public function check_auth(){
		$token = get_cookie('token');

		if(empty($token)){
			$this->jump_login();
		}

		$this->load->model('User_model');
		$userInfo = $this->User_model->check_token($token);
		if(empty($userInfo) || !is_array($userInfo) || $userInfo['role'] != 2 || $userInfo['status'] != 1){
			$this->jump_login();
		}

		$this->userInfo = $userInfo;
	}

	public function format_menu(){
		$this->config->load('menu_list');
		$menu_list = $this->config->item('menu_list');

		$bread = array();

		foreach($menu_list as $key=>$value){
			$menu_list[$key]['active'] = strpos($_SERVER['REQUEST_URI'],$value['href']) !== false;

			if($menu_list[$key]['active']){
				$bread[] = $value;
			}

			if(!$menu_list[$key]['active'] && isset($value['submenu'])){
				foreach($value['submenu'] as $k=>$v){
					if(strpos($_SERVER['REQUEST_URI'],$v['href']) !== false){
						$bread[] = $value;
						$bread[] = $v;
						$menu_list[$key]['active'] = true;
						break;
					}
				}
			}
		}
		
		$this->assign('bread',$bread);
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

	private function jump_login(){
		if($this->input->is_ajax_request()){
			$this->ajax_return(array(
				'code' => '-100',
				'msg'  => '登录'
			));
		}

		$this->redirect('/user/login');
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

	protected function setDefaultValues(&$data,$defaultValues){
		foreach($defaultValues as $key=>$value){
			if(!isset($data[$key])){
				$data[$key] = $value;
			}
		}
	}
}