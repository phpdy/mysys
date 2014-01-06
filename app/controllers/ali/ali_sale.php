<?php

class ali_sale extends BaseController {

	public function init(){
		$this->ali_sale = $this->initModel('sale_model','ali');
		$this->ali_goods = $this->initModel('goods_model','ali');
	}
	//添加
	public function addAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->selectGoods() ;
		$this->view->assign('goodslist',$goodslist) ;
		if(!empty($_POST['buyer']) && !empty($_POST['goodsid']) && !empty($_POST['price']) && !empty($_POST['num'])){
			$sale = array(
				'goodsid' 	=> $_POST['goodsid'] ,
				'buyer' 	=> $_POST['buyer'] ,
				'buyer_ww' 	=> $_POST['buyer_ww'] ,
				'price' 	=> $_POST['price'] ,
				'num' 		=> $_POST['num'] ,
				'fare' 		=> $_POST['fare'] ,
				'date' 		=> $_POST['date'] ,
			) ;
			$this->ali_sale->insertSale($sale) ;
		}
//		print_r($_POST) ;
		$this->view->display('sale_add.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->selectGoods() ;
		$this->view->assign('goodslist',$goodslist) ;
		
		$sale = array() ;
		if(!empty($_POST['goodsid'])){
			$sale['goodsid'] = $_POST['goodsid'] ;
		}
		if(!empty($_POST['date'])){
			$sale['date'] = $_POST['date'] ;
		}
		$result = $this->ali_sale->selectSale($sale) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('sale_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->selectGoods() ;
		$this->view->assign('goodslist',$goodslist) ;
		if(!empty($_POST['buyer']) && !empty($_POST['goodsid']) && !empty($_POST['price']) && !empty($_POST['num'])){
			$sale = array(
				'id' 		=> $_POST['id'] ,
				'goodsid' 	=> $_POST['goodsid'] ,
				'buyer' 	=> $_POST['buyer'] ,
				'buyer_ww'	=> $_POST['buyer_ww'] ,
				'price' 	=> $_POST['price'] ,
				'num' 		=> $_POST['num'] ,
				'fare' 		=> $_POST['fare'] ,
				'date' 		=> $_POST['date'] ,
			) ;
			$this->ali_sale->updateSale($sale) ;
			
			$this->listAction();
		} else if(!empty($_GET['id'])){
			$id = $_GET['id'] ;
			$result = $this->ali_sale->selectSaleById($id) ;
			$this->view->assign('sale',$result) ;
			$this->view->display('sale_up.php');
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>