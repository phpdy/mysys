<?php

class ali_sale extends BaseController {

	public function init(){
		$this->ali_sale = $this->initModel('sale_model','ali');
		$this->ali_who = $this->initModel('who_model','ali');
		$this->ali_goods = $this->initModel('goods_model','ali');
	}
	
	//添加
	public function addAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->queryAll() ;
		$this->view->assign('goodslist',$goodslist) ;
		
		$this->view->display('sale_add.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->queryAll() ;
		$this->view->assign('goodslist',$goodslist) ;
		
		$id = $_GET['id'] ;
		$result = $this->ali_sale->queryById($id) ;
		
		$this->view->assign('sale',$result) ;
		$this->view->display('sale_up.php');
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $_POST ;
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->ali_sale->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->ali_sale->update($data) ;
		}
		if(empty($result)){
			echo "操作失败:$result" ;
			die() ;
		}
		
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodslist = $this->ali_goods->queryAll() ;
		$this->view->assign('goodslist',$goodslist) ;
		$wholist = $this->ali_who->queryAll() ;
		$this->view->assign('wholist',$wholist) ;
		
		$data = array() ;
		if(!empty($_POST['whoid'])){
			$data['whoid'] = $_POST['whoid'] ;
		}
		if(!empty($_POST['goodsid'])){
			$data['goodsid'] = $_POST['goodsid'] ;
		}
		if(!empty($_POST['date'])){
			$data['date'] = $_POST['date'] ;
		}
		if(!empty($_POST['page'])){
			$data['page'] = $_POST['page'] ;
		} else {
			$data['page'] = 0 ;
		}
		$pagenum = $this->ali_sale->queryCount($data) ;
		$result = $this->ali_sale->selectSale($data) ;
		
		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('data',$data) ;
		$this->view->assign('list',$result) ;
		$this->view->display('sale_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

}

?>