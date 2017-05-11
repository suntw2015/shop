<?php

class Product extends APP_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->render('product/index.html',array(
			'title'	=> '产品列表'
		));
	}
}