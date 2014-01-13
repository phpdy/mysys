<?php

class admin_userrole extends BaseController {

	public function init(){
		$this->user_model = $this->initModel('user_model','admin');
		$this->rolse_model = $this->initModel('rolse_model','admin');
	}
	//首页
	public function addAction(){
		$user_list = $this->user_model->queryAll() ;
		$userinfo_list = $this->userrole_model->selectUserinfo() ;
		//剔除已添加的用户信息
		foreach ($user_list as $key=>$user){
			$userid = $user['id'] ;
			foreach ($userinfo_list as $userinfo){
				if ($userinfo['userid']==$userid){
					unset($user_list[$key]) ;
					break ;
				}
			}
		}
		$this->view->assign('user_list',$user_list) ;
		
//		$rolse_list = $this->rolse->selectRolse() ;
		@session_start ();
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$rolse_list = $this->rolse_model->queryAll() ;
		} else {
			$rolseid = $this->userrole_model->selectUserRolseList($this->getUserID()) ;
			$rolse_list = $this->rolse_model->selectRolsesByIds($rolseid[0]['rolses']) ;
		}
//		print_r($rolse_list);
		$this->view->assign('rolse_list',$rolse_list) ;
		$this->view->display('userrole_add.php');
	}
	
	public function add_subAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$rolses = implode(',', $_GET['rolses']) ;
		$_GET['rolses'] = $rolses ;
		$result = $this->userrole_model->insert($_GET) ;
		if($result){
			$this->listAction();
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}
	
	//用户角色列表
	public function listAction(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		$result = $this->userrole_model->selectUserinfo() ;
		$this->view->assign('list',$result) ;
		$user_list = $this->user_model->queryAll() ;
		$this->view->assign('user_list',$user_list) ;
		$rolse_list = $this->rolse_model->queryAll() ;
		$this->view->assign('rolse_list',$rolse_list) ;
		$this->view->display('userrole_list.php');
		
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBusiness($log) ;
	}

	//修改用户角色
	public function upAction(){
		$id = $_GET['id'] ;

		//获取当前用户的角色列表
	
		@session_start ();
		if ($_SESSION [FinalClass::$_session_user]['name']=='admin'){
			$show_rolelist = $this->rolse_model->queryAll() ;
		} else {
			$rolselist = $this->userrole_model->query(array('userid'=>$this->getUserID())) ;
			$show_rolelist = $this->rolse_model->selectRolsesByIds($rolselist[0]['rolses']) ;
		}
		
		//获取要修改用户的角色列表
		$res = $this->userrole_model->queryById($id);
		if (empty($res['rolses'])) {
			$rolelist = '';
		}else {
			$rolelist = $this->rolse_model->selectRolsesByIds($res['rolses']);
		}
		
		$userid = $res['userid'];
		//获取修改用户的username和realname
		$user = $this->user_model->queryById($userid) ;
		
		$this->view->assign('id', $id);
		$this->view->assign('user', $user);
		$this->view->assign('show_rolelist', $show_rolelist);
		$this->view->assign('rolelist', $rolelist);
		$this->view->display('userrole_up.php');
	}
	
	//执行修改用户角色
	public function up_subAction(){
		$_POST['rolses'] = implode(',', $_POST['rolses']) ;
		$_POST['state'] = 1;
		$this->userrole_model->update($data);
		$this->listAction();
	}
	
	//删除用户角色
	public function delAction() {
		$id = $_GET['id'];
		$this->userrole_model->delete($id);
		
		$this->listAction();
	}
}

?>