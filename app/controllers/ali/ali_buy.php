<?php

class ali_buy extends BaseController {

	public function init(){
		$this->ali_buy = $this->initModel('buy_model','ali');
		$this->ali_goods = $this->initModel('goods_model','ali');
	}
	//添加
	public function addAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->selectGoods() ;
		$this->view->assign('goodslist',$goodslist) ;
		if(!empty($_POST['name']) && !empty($_POST['goodsid']) && !empty($_POST['price']) && !empty($_POST['num'])){
			$buy = array(
				'goodsid' 	=> $_POST['goodsid'] ,
				'name' 		=> $_POST['name'] ,
				'info' 		=> $_POST['info'] ,
				'price' 	=> $_POST['price'] ,
				'num' 		=> $_POST['num'] ,
				'fare' 		=> $_POST['fare'] ,
				'date' 		=> $_POST['date'] ,
			) ;
			$this->ali_buy->insertBuy($buy) ;
		}
//		print_r($_POST) ;
		$this->view->display('buy_add.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->selectGoods() ;
		$this->view->assign('goodslist',$goodslist) ;
		
		$buy = array() ;
		if(!empty($_POST['goodsid'])){
			$buy['goodsid'] = $_POST['goodsid'] ;
		}
		if(!empty($_POST['date'])){
			$buy['date'] = $_POST['date'] ;
		}
		$result = $this->ali_buy->selectBuy($buy) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('buy_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->selectGoods() ;
		$this->view->assign('goodslist',$goodslist) ;
		if(!empty($_POST['name']) && !empty($_POST['goodsid']) && !empty($_POST['price']) && !empty($_POST['num'])){
			$buy = array(
				'id' 		=> $_POST['id'] ,
				'goodsid' 	=> $_POST['goodsid'] ,
				'name' 		=> $_POST['name'] ,
				'info' 		=> $_POST['info'] ,
				'price' 	=> $_POST['price'] ,
				'num' 		=> $_POST['num'] ,
				'fare' 		=> $_POST['fare'] ,
				'date' 		=> $_POST['date'] ,
			) ;
			$this->ali_buy->updateBuy($buy) ;
			
			$this->listAction();
		} else if(!empty($_GET['id'])){
			$id = $_GET['id'] ;
			$result = $this->ali_buy->selectBuyById($id) ;
			$this->view->assign('buy',$result) ;
			$this->view->display('buy_up.php');
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>