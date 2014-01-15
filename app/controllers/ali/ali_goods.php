<?php

class ali_goods extends BaseController {

	public function init(){
		$this->ali_who = $this->initModel('who_model','ali');
		$this->ali_goods = $this->initModel('goods_model','ali');
	}
	//添加
	public function addAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$wholist = $this->ali_who->selectAllWho() ;
		$this->view->assign('wholist',$wholist) ;
		if(!empty($_POST['name']) && !empty($_POST['whoid'])){
			$goods = array(
				'whoid' => $_POST['whoid'] ,
				'name' 	=> $_POST['name'] ,
				'info' 	=> $_POST['info'] ,
			) ;
			$this->ali_goods->insertGoods($goods) ;
		}
//		print_r($_POST) ;
		$this->view->display('goods_add.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$wholist = $this->ali_who->selectAllWho() ;
		$this->view->assign('wholist',$wholist) ;
		
		$goods = array() ;
		if(!empty($_POST['whoid'])){
			$goods['whoid'] = $_POST['whoid'] ;
		}
		if(!empty($_POST['state'])){
			$goods['state'] = $_POST['state'] ;
		}
		if(!empty($_POST['page'])){
			$goods['page'] = $_POST['page'] ;
		} else {
			$goods['page'] = 0 ;
		}
		$pagenum = $this->ali_goods->queryCount($goods) ;
		$result = $this->ali_goods->selectGoods($goods) ;
		
		$this->view->assign('pagenum',$pagenum) ;
		$this->view->assign('data',$goods) ;
		$this->view->assign('list',$result) ;
		$this->view->display('goods_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$wholist = $this->ali_who->selectAllWho() ;
		$this->view->assign('wholist',$wholist) ;
		
		if(!empty($_POST['name']) && !empty($_POST['whoid'])){
			$goods = array(
				'id' 	=> $_POST['id'] ,
				'whoid' => $_POST['whoid'] ,
				'name' 	=> $_POST['name'] ,
				'info' 	=> $_POST['info'] ,
			) ;
			$this->ali_goods->updateGoods($goods) ;
//			$_POST = null ;
			$this->listAction();
		} else if(!empty($_GET['id'])){
			$id = $_GET['id'] ;
			$result = $this->ali_goods->selectGoodsById($id) ;
			$this->view->assign('goods',$result) ;
			$this->view->display('goods_up.php');
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>