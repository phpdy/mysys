<?php

class mark_model_type extends BaseController {

	public function init(){
		$this->mark_type_model = $this->initModel('mark_type_model','mark');
	}
	//添加
	public function addAction(){
		$this->view->display('mark_type_add.php');
	}
	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$result = $this->mark_type_model->selectModelType(array('id'=>$id)) ;
		$this->view->assign('marktype',$result[0]) ;
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
		$this->addAction() ;
	}
	public function add_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$name = $_GET['name'] ;
		$info = $_GET['info'] ;
		
		$log .= "|$id,$name,$info" ;
		$obj = array(
			"name"		=>	$name,
			"info"		=>	$info,
			"id"		=>	$id,
		) ;
		if (empty($id)){
			$result = $this->mark_type_model->insertModelType($obj) ;
		} else {
			$result = $this->mark_type_model->updateModelType($obj) ;
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
		$this->listAction();
	}

	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$result = $this->mark_type_model->selectModelType() ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('mark_type_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}


}

?>