<?php

class ali_who extends BaseController {

	public function init(){
		$this->ali_model = $this->initModel('who_model','ali');
	}
	//添加
	public function addAction(){
		if(!empty($_POST['name']) && !empty($_POST['url'])){
			$who = array(
				'name' => $_POST['name'] ,
				'info' => $_POST['info'] ,
				'url' => $_POST['url'] ,
			) ;
			$this->ali_model->insertWho($who) ;
		}
		$this->view->display('who_add.php');
	}
	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$result = $this->ali_model->selectAllWho() ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('who_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		if(!empty($_POST['name']) && !empty($_POST['url'])){
			$who = array(
				'id'	=> $_POST['id'] ,
				'name' 	=> $_POST['name'] ,
				'info' 	=> $_POST['info'] ,
				'url' 	=> $_POST['url'] ,
			) ;
			$this->ali_model->updateWho($who) ;
			$this->listAction() ;
		} else if(!empty($_GET['id'])){
			$id = $_GET['id'] ;
			$result = $this->ali_model->selectWhoById($id) ;
			$this->view->assign('who',$result) ;
			$this->view->display('who_up.php');
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>