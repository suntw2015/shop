<?php

class Order extends APP_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$this->load->model(array('Order_model'));

		$orderList = $this->Order_model->getOrderByUid($this->userInfo['id']);

		$this->config->load("shop");
		$shopInfo = $this->config->item("shop");

		$this->render("order/index.html",array(
			'shopInfo'	=> $shopInfo,
			'orderList'	=> $orderList,
			'isShowFooter'	=> true,
			'footerIndex'	=> 2,
			'title'			=> '订单',
		));
	}

	public function preorder(){
		$data = $this->input->get();

		if(!isset($data['oid']) || empty($data['oid'])){
			echo "订单号不能为空";exit;
		}

		$oid = (int)($data['oid']);
		$this->load->model(array("Order_model","Order_Item_model"));
		$orderInfo = $this->Order_model->getOrderByOid($oid);
		if(!is_array($orderInfo)){
			echo "订单不存在";exit;
		}

		$orderItem = $this->Order_Item_model->getListByOid($oid);
		$orderInfo['productList'] = $orderItem;

		$this->config->load("shop");
		$shopInfo = $this->config->item("shop");

		$this->render("order/preorder.html",array(
			'orderInfo'	=> $orderInfo,
			'shopInfo'	=> $shopInfo,
			'isShowBack'	=> true,
			'title'			=> '确认订单',
			'backUrl'		=> '/shop/index'
		));
	}

	public function order(){
		
	}

	public function detail(){
		$data = $this->input->get();
		if(!isset($data['oid']) && empty($data['oid'])){
			echo "找不到该订单";exit;
		}

		$oid = $data['oid'];
		$this->load->model(array("Order_model","Order_Item_model"));
		$orderInfo = $this->Order_model->getOrderByOid($oid);
		if(!is_array($orderInfo)){
			echo "订单不存在";exit;
		}

		$orderItem = $this->Order_Item_model->getListByOid($oid);
		$orderInfo['productList'] = $orderItem;

		$this->config->load("shop");
		$shopInfo = $this->config->item("shop");

		$this->render("order/detail.html",array(
			'orderInfo'	=> $orderInfo,
			'shopInfo'	=> $shopInfo,
			'isShowBack'	=> true,
			'title'			=> '订单详情',
			'backUrl'		=> '/order'
		));
	}
}