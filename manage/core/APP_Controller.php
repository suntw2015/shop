<?php
class APP_Controller extends CI_Controller{
	
	protected $needLogin;

	protected $userInfo;

	public function __construct(){
		parent::__construct();

		$this->load->library(array('smarty'));
		$this->format_menu();
	}

	public function format_menu(){
		$this->config->load('menu_list');
		$menu_list = $this->config->item('menu_list');
		$this->assign('menu_list',$menu_list);
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
}