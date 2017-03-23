<?php
class APP_Controller extends CI_Controller{
	
	protected $needLogin;

	protected $userInfo;

	public function __construct(){
		parent::__construct();
	}
}