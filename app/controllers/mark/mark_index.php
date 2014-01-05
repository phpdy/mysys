<?php

class mark_index extends BaseController {

	public function init(){
		$this->mark_type_model = $this->initModel('mark_type_model','mark');
		$this->mark_model = $this->initModel('mark_model','mark');
	}
	//添加
	public function addAction(){
		$result = $this->mark_type_model->selectModelType() ;
		$this->view->assign('list',$result) ;
		$this->view->display('mark_add.php');
	}
	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$result = $this->mark_model->select(array('id'=>$id)) ;
		$this->view->assign('object',$result[0]) ;
		
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
		$content = $_GET['content'] ;
		$type = $_GET['type'] ;
		
		$log .= "|$id,$name,$info" ;
		$obj = array(
			"id"		=>	$id,
			"name"		=>	$name,
			"info"		=>	$info,
			"content"	=>	$content,
			"type"		=>	$type,
		) ;
		if (empty($id)){
			$result = $this->mark_model->insert($obj) ;
		} else {
			$result = $this->mark_model->update($obj) ;
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
		$this->listAction();
	}

	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$param = array() ;
		if (!empty($_GET['type'])){
			$param['type'] = $_GET['type'] ;
		}
		$result = $this->mark_model->select($param) ;
		
		$this->view->assign('list',$result) ;
		$this->view->display('mark_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}


}

?>