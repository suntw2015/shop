<?php

class Order extends APP_Controller{

	protected $orderStatus = array(
		1 => '待确认',
		2 => '已确认',
	);

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Order_model'));
	}

	public function index(){
		$data = $this->input->get();

		$orderList = $this->Order_model->get($data);
		$this->fullOrderInfo($orderList);

		$this->setDefaultValues($data,array(
			'oid'	=> '',
			'status'=> ''
		));

		$this->render('order/index.html',array(
			'orderList'	=> $orderList,
			'searchdata'=> $data
		));
	}

	public function item(){
		$data = $this->input->get();

		$this->load->model(array('OrderItem_model'));

		$orderItemList = $this->OrderItem_model->get($data);

		$this->return_success($orderItemList);
	}

	private function fullOrderInfo(&$orderList){
		$this->load->model(array('User_model'));

		$uids =implode(",",array_column($orderList,'user_id'));
		$tmpUserList = $this->User_model->get(array('id'=>$uids));
		$userList = array();

		foreach($tmpUserList as $key=>$value){
			$userList[$value['id']] = $value;
		}

		foreach($orderList as $key=>&$value){
			$uid = $value['user_id'];
			$status = $value['status'];
			// $value['username'] = $userList[$uid]['username'];
			// $value['phone'] = $userList[$uid]['phone'];
			$value['status_text'] = isset($this->orderStatus[$status]) ? $this->orderStatus[$status] : '';
		}
	}
}