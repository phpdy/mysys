<?php

class BaseController extends Controller {
	protected $model ;
	protected $userrole_model ;
	protected $start ;//起始时间
	
	function __construct(){
		$this->dir = $_GET['dir'] ;
		parent::__construct() ;
		$this->start = microtime(true)*1000 ;
		$this->userrole_model = $this->initModel('userrole_model','admin');
		$this->model = new BaseModel() ;
	}
	
	public function safestr($str,$length = 0){
			$str = mysql_escape_string($str);
			$str = preg_replace("/<.*?>/i","",$str);
			if($length){
				$str = substr($str,0,$length);
			}
			$str=str_replace("'","",$str);
			$str=str_replace("\"","",$str);
			$str=str_replace("delete","",$str);
			$str=trim($str);
			return $str;
	}
	protected function getUserID(){
		@session_start ();
		$userid = $_SESSION [FinalClass::$_session_user]['id'] ;
		return $userid ;
	}
	

	//数组字符串编码
	protected function encodeUtf8($array){
		if (is_array($array))
		foreach ($array as $k=>$v){
			if(is_string($v)){
				$array[$k] = iconv('gb2312','utf-8',$v) ;
			}
			elseif(is_array($v)){
				$array[$k] = $this->encodeUtf8($v) ;
			}
			elseif (is_null($v)){
				$array[$k] = "" ;
			}
		}
		return $array ;
	}


	//添加
	public function addAction(){
		$this->view->display($this->dir . '_add.php');
	}
	
	//提交
	public function submitAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$data = $_POST ;
		$result = 0 ;
		if(!isset($_POST['id']) || empty($_POST['id'])){
			$result = $this->model->insert($data) ;
		} else {
			$data['id'] = $_POST['id'] ;
			$result = $this->model->update($data) ;
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
		
		$data = $_POST ;
		$result = $this->model->query($data) ;
		
		$this->view->assign('data',$data) ;
		$this->view->assign('list',$result) ;
		$this->view->display($this->dir .'_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改
	public function upAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$object = $this->model->getById($id) ;
		$this->view->assign('object',$object) ;
		
		$this->view->display($this->dir .'_up.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	//展示页面
	public function showAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $_GET['id'] ;
		$object = $this->model->getById($id) ;
		$this->view->assign('object',$object) ;
		
		$this->view->display($this->dir .'_show.php');
		
		$log .= "|$id|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
}

?>