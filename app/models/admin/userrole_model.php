<?php

class userrole_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbTable = "_userinfo" ;
	protected $items = array('userid','rolses','state') ;
	
	protected function init(){
		$this->dbTable = FinalClass::$_system."_userinfo" ;
	}
	
	protected function getWhere(){
		return "1=1 " ;
	}

	protected function getOrder(){
		return "order by id " ;
	}
	
	/**
	 * 用户权限查询
	 * @param int $userid
	 */
	public function selectUserRankList($userid){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$log .= "|$userid|" ;
		try{
			$result = $this->queryAll(array('userid'=>$userid)) ;
			if (empty($result) || sizeof($result)==0){
				$log .= "|0|".(int)(microtime(true)*1000-$start) ;
				Log::logBehavior($log) ;
				return array() ;
			}
			$rolses = array() ;
			foreach ($result as $item){
				$rolses[] = $item['rolses'] ;
			}
			$rolses = implode(',', array_unique($rolses)) ;
			
			//查角色对应的模块ID
			$sql = "SELECT modules FROM ".$this->da_pre."_rolse WHERE id IN ($rolses)" ;
			$result = $this->getAll($sql) ;
			$log .= ",$sql,".sizeof($result) ;
			
			if (empty($result) || sizeof($result)==0){
				$log .= "|0|".(int)(microtime(true)*1000-$start) ;
				Log::logBehavior($log) ;
				return array() ;
			}
			$models = array() ;
			foreach ($result as $item){
				$models = array_merge($models,explode(",", $item['modules'])) ;
			}
			$models = implode(',', array_unique($models)) ;
			$log .= ",$models," ;
			
			//查模块信息
			$sql = "SELECT * FROM ".$this->da_pre."_module WHERE urltype in (0,2) and id IN ($models) order by type,parentid,id " ;

			$result = $this->getAll($sql) ;
			$log .= ",$sql,".sizeof($result) ;
			
			$log .= "|".sizeof($result) ;
		}catch (Exception $e){
			print_r($e);
		}
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}