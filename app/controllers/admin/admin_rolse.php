<?php

class admin_rolse extends BaseController {

	public function init(){
		$this->rolse_model = $this->initModel('rolse_model','admin');
		$this->module_model = $this->initModel('module_model','admin');
	}
	//首页
	public function addAction(){
		$result = $this->userrole_model->query(array('userid'=>$this->getUserID())) ;
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$result = $this->module_model->queryAll();
		}
		$this->view->assign('list',$result) ;
		$this->view->display('rolse_add.php');
	}
	public function add_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$url = $_SERVER["HTTP_REFERER"];

		$name = trim($_GET['rolse']) ;
		if(empty($name)){
			header('Location: '.$url);
			exit;
		}

		$info = trim($_GET['info']) ;
		$modules = $_GET['modules'] ;
		if(empty($modules))
			$modules = array(5,1,12);
		$modules = implode(',', $modules) ;
		$log .= "|$name,$info,$modules" ;
		$_rolse = array(
			"rolse"		=>	$name,
			"info"		=>	$info,
			"modules"	=>	$modules,
		) ;
		$result = $this->rolse_model->insert($_rolse) ;
		if(empty($result)){
			echo "fail" ;
		}
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$module_list = $this->module_model->queryAll() ;
		$this->view->assign('module_list',$module_list) ;
		
		$result = $this->rolse_model->query() ;
		$this->view->assign('list',$result) ;
		$this->view->display('rolse_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$result = $this->rolse_model->queryById($id) ;
		$modules = explode(',', $result['modules']);
		$result['modules'] = $modules;
		
		$this->view->assign('rolse',$result) ;
		
//		$result = $this->module_model->selectModule(array('state'=>1)) ;
		$result = $this->userrole_model->query(array('userid'=>$this->getUserID())) ;
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$result = $this->module_model->queryAll();
		}
		$this->view->assign('list',$result);
		$this->view->assign('id',$id) ;
		$this->view->display('rolse_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	public function up_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$modules = $_GET['modules'] ;
		if(empty($modules)){
			$modules = array();
		}
		$modules = implode(',', $modules) ;
		
		$_GET['modules'] = $modules ;
		$result = $this->rolse_model->update($_GET) ;
		if(empty($result)){
			echo "fail" ;
		}
		$this->listAction();
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>