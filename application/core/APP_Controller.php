<?php
class APP_Controller extends CI_Controller{

	protected $userInfo;

	protected $isShowFooter;

	protected $footerIndex;

	protected $isShowBack;

	protected $backUrl;

	public function __construct(){
		parent::__construct();

		$this->load->library(array('smarty'));
		$this->load->helper('cookie');
        
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();

		$needLogin = array(
			'user'	=> array(
				'index'
			),
			'order'	=> array(
				'*'
			)
		);

		if(isset($needLogin[$controller]) && (in_array('*',$needLogin[$controller]) || in_array($method,$needLogin[$controller]))){
			$this->check_auth();
		}

		$this->isShowFooter = false;
		$this->footerIndex = 1;
		$this->isShowBack = false;
		$this->backUrl = "#";

		$this->assign("isShowFooter",$this->isShowFooter);
		$this->assign("footerIndex",$this->footerIndex);
		$this->assign("isShowBack",$this->isShowBack);

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
		$userInfo = $this->User_model->loginByToken($token);
		if(!is_array($userInfo)){
			$this->redirect('/user/login');
		}

		$this->userInfo = $userInfo;
		$this->assign("userInfo",$this->userInfo);
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
		$this->smarty->display($template);exit;
	}

	public function ajax_return($data){
		$this->output->set_content_type('application/json','utf-8')->set_output(json_encode($data))->_display();
		exit;
	}

	public function return_success($data=array()){
		$this->ajax_return(array(
			'code'	=> 0,
			'data'	=> $data
		));
	}

	public function return_fail($msg=""){
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

	public function show_error_page($msg='有一个错误发生了'){
		$this->render("common/error.html",array(
			'title'			=> '错误',
			'isShowBack'	=> true,
			'msg'			=> $msg,
			'backUrl'		=> isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : empty($this->userInfo) ? '/shop' : '/order',
		));
	}
}
