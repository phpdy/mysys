<?php

class ali_who extends BaseController {

	public function init(){
		$this->ali_model = $this->initModel('who_model','ali');
	}
	//添加
	public function addAction(){
		$this->view->display($this->control . '_add.php');
	}
	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$id = $_GET['id'] ;
		$result = $this->ali_model->queryById($id) ;
		$this->view->assign('who',$result) ;
		$this->view->display('who_up.php');
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $_POST ;
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->ali_model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->ali_model->update($data) ;
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
		$result = $this->ali_model->queryAll() ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('who_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

}

?>