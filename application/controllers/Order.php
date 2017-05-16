<?php

class Order extends APP_Controller{

	protected $orderStatus = array(
		1 => '待确认',
		2 => '已确认',
	);

	public function __construct(){
		parent::__construct();

		$this->load->model(array("Order_model","Order_Item_model","Shop_model"));
	}

	public function index(){

		$this->load->model(array('Order_model'));

		$orderList = $this->Order_model->getOrderByUid($this->userInfo['id']);

		$shopInfo = $this->Shop_model->get();

		foreach($orderList as $key=>$value){
			$orderList[$key]['status_text'] = isset($this->orderStatus[$value['status']]) ? $this->orderStatus[$value['status']] : '';
		}

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
			$this->show_error_page('订单不存在[1]');
		}

		$oid = (int)($data['oid']);
		$orderInfo = $this->Order_model->getOrderByOid($oid);
		if(empty($orderInfo) || !is_array($orderInfo)){
			$this->show_error_page('订单不存在[2]');
		}


		if($orderInfo['user_id'] != $this->userInfo['id']){
			$this->show_error_page('订单不存在[3]');
		}

		if($orderInfo['status'] != 1){
			$this->show_error_page('订单已经确认过了');
		}

		$orderItem = $this->Order_Item_model->getListByOid($oid);
		$orderInfo['productList'] = $orderItem;

		$shopInfo = $this->Shop_model->get();

		$this->render("order/preorder.html",array(
			'orderInfo'	=> $orderInfo,
			'shopInfo'	=> $shopInfo,
			'oid'		=> $oid,
			'isShowBack'	=> true,
			'title'			=> '确认订单',
			'backUrl'		=> '/shop/index'
		));
	}

	public function confirm(){
		$data = $this->input->post();
		if(!isset($data['oid']) || empty($data['oid'])){
			$this->return_fail("订单不存在");
		}

		$oid = (int)($data['oid']);
		$orderInfo = $this->Order_model->getOrderByOid($oid);
		if(empty($orderInfo) || !is_array($orderInfo)){
			$this->return_fail("订单不存在");
		}


		if($orderInfo['user_id'] != $this->userInfo['id']){
			$this->return_fail("订单不存在");
		}

		if($orderInfo['status'] >= 2){
			$this->return_fail("订单已经确认过了");
		}
		$res = $this->Order_model->updateStatus($oid,2);
		if(empty($res) || !is_int($res) || $res < 1){
			$this->return_fail("订单确认失败，请稍后再试");
		}
		
		$this->return_success('/order');
	}

	public function order(){

		$data = $this->input->post();
		if(empty($data)){
			$this->return_fail("产品信息为空,创建订单信息失败，请稍后再试");
		}
		
		$pids = implode(",",array_column($data,"id"));
		$this->load->model("Product_model");
		$tmpProductList = $this->Product_model->getListByIds($pids);
		$productList = array();
		foreach($tmpProductList as $key=>$value){
			$productList[$value['id']] = $value;
		}

		$orderItem = array();
		foreach($data as $key=>$value){
			$productId = $value['id'];

			if($value['count'] == 0){
				continue;
			}

			if(!isset($productList[$productId])){
				$this->return_fail(sprintf("下单失败，【%s】已下架",$value['name'],$productList[$productId]['stock']));
			}

			if($productList[$productId]['stock'] < $value['count']){
				$this->return_fail(sprintf("下单失败，【%s】库存不足,目前剩余%s",$value['name'],$productList[$productId]['stock']));
			}

			$orderItem[] = array(
				'id'	=> $productId,
				'name'	=> $productList[$productId]['name'],
				'count'	=> $value['count'],
				'price'	=> $productList[$productId]['price'],
				'total_price'	=> $value['count'] * $productList[$productId]['price']
			);
		}


		$oid = $this->createOid();
		while($this->Order_model->isOidExist($oid)){
			$oid = $this->createOid();
		}

		$orderInfo = array(
			'oid'		=> $oid,
			'user_id'	=> $this->userInfo['id'],
			'price'		=> array_sum(array_column($orderItem,"total_price")),
			'item_count'=> array_sum(array_column($orderItem,"count")),
			'status'	=> 1,
			'create_by'	=> 1
		);
		$id = $this->Order_model->createOrder($orderInfo);

		if(empty($id) || !is_int($id)){
			$this->return_fail("创建订单失败，请稍后再试");
		}

		$newOrderItem = array();
		foreach($orderItem as $key=>$value){
			$newOrderItem[] = array(
				'oid'	=> $oid,
				'item_name'	=> $value['name'],
				'item_id'	=> $value['id'],
				'item_count'	=> $value['count'],
				'item_price'	=> $value['price'],
				'item_total_price'	=> $value['total_price'],
				'create_by'			=> 1
			);
		}
		$res = $this->Order_Item_model->create($newOrderItem);

		if(empty($res) || !is_int($res)){
			$this->Order_model->removeOrderByOid($oid);
			$this->return_fail('创建订单失败[2]，请稍后再试');
		}

		$res = $this->Product_model->minusStock($orderItem);
		if(empty($res)){
			$this->Order_model->removeOrderByOid($oid);
			$this->Order_Item_model->removeOrderByOid($oid);
			$this->return_fail('创建订单失败[3]，请稍后再试');
		}

		$this->return_success('/order/preorder?oid='.$oid);
	}

	public function detail(){
		$data = $this->input->get();
		if(!isset($data['oid']) && empty($data['oid'])){
			$this->show_error_page('订单不存在');
		}

		$oid = $data['oid'];
		$orderInfo = $this->Order_model->getOrderByOid($oid);
		if(!is_array($orderInfo)){
			$this->show_error_page('订单不存在');
		}

		if($orderInfo['user_id'] != $this->userInfo['id']){
			$this->show_error_page('订单不存在');
		}

		$orderItem = $this->Order_Item_model->getListByOid($oid);
		$orderInfo['productList'] = $orderItem;
		$orderInfo['status_text'] = isset($this->orderStatus[$orderInfo['status']]) ? $this->orderStatus[$orderInfo['status']] : '';

		$shopInfo = $this->Shop_model->get();

		$this->render("order/detail.html",array(
			'orderInfo'	=> $orderInfo,
			'shopInfo'	=> $shopInfo,
			'isShowBack'	=> true,
			'title'			=> '订单详情',
			'backUrl'		=> '/order'
		));
	}

	private function createOid(){
		$randNum = rand(1,1000);
		$date = date("md",time());
		$oid = sprintf("61%s%03d",$date,$randNum);

		return $oid;
	}
}