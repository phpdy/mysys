<?php

class BaseModel extends Model {
	protected $dbIndex = 'admin';			//链接数据库
	protected $dbTable = "" ;				//查询表
	protected $items = array('id','name') ;	//表字段
	
	protected $start ;//起始时间
	protected $da_pre = "yd" ;
	
	function __construct(){
		try {
			$this->dbconfig = Configs::$dbconfig[$this->dbIndex] ;
			parent::__construct() ;
		} catch (Exception $e) {
			log::logError($e->__toString() ) ;
			throw new Exception($e) ;
		}
		$this->da_pre = FinalClass::$_system ;
	}
	
	/**
	 * 查询一条结果
	 * @param string $sql
	 * @param array $params
	 */
	protected function getOne($sql,$params=array()){
		$list = $this->querySQL($sql,$params) ;
		
		if (!is_array($list) || sizeof($list)!=1){
			return array() ;
		}
		return $list[0] ;
	}

	/**
	 * 查询所有结果
	 * @param string $sql
	 * @param array $params
	 */
	protected function getAll($sql,$params=array()){
		$list = $this->querySQL($sql,$params) ;
		
		return $list ;
	}
	
	/**
	 * 根据ID号查询结果
	 * @param int $id
	 */
	public function getById($id){
		$sql = "select * from ".$this->dbTable." where id = ?" ;
		$list = $this->querySQL($sql,array($id)) ;
		
		if (!is_array($list) || sizeof($list)!=1){
			return array() ;
		}
		return $list[0] ;
	}
	
	/**
	 * 查询表所有数据
	 * @param int $lenth
	 * @param int $start
	 */
	public function getAllData($lenth=30,$start=0){
		$sql = "select * from ".$this->dbTable." order by id limit $start,$lenth" ;
		$list = $this->querySQL($sql,array()) ;
		return $list ;
	}


	/**
	 * insert
	 * @param array $data
	 */
	public function insert($data) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;

		$k = array() ;
		$v = array() ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if(empty($value)){
				continue ;
			}
			if(in_array($key, $this->items)){
				$k[] = "$key" ;
				$v[] = "?" ;
				$params[] = $value ;
			}
		}
		$p1 = implode(",", $k) ;
		$p2 = implode(",", $v) ;
		
		$sql = "INSERT INTO ".$this->dbTable." ($p1) VALUES ($p2)";
		$result = $this->excuteSQL($sql,$params) ;
		
		$log .= '|' . $sql." > ".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	/**
	 * 更新信息
	 * @param array $data
	 */
	function update($data) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$k = array() ;
		$params = array() ;
		
		foreach ($data as $key=>$value){
			if(in_array($key, $this->items)){
				$k[] = "$key=?" ;
				$params[] = $value ;
			}
		}
		
		$p1 = implode(",", $k) ;
		$params[] = $data['id'] ;
		
		$sql = "update ".$this->dbTable." set $p1 where id=?";
		$result = $this->excuteSQL($sql,$params) ;
		
		$log .= '|' . $sql." > ".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
	
	/**
	 * 查询
	 * @param array $data
	 */
	public function query($data=array()) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;

		$k = array() ;
		$params = array() ;
		foreach ($data as $key=>$value){
			if(empty($value)){
				continue ;
			}
			if(in_array($key, $this->items)){
				$k[] = " $key=? " ;
				$params[] = $value ;
			}
		}
		$p1 = "" ;
		if(!empty($k)){
			$p1 = "and ".implode("and", $k) ;
		}
		$sql = "select * from ".$this->dbTable." where 1=1 $p1 order by id ";
		$result = $this->excuteSQL($sql,$params) ;
		
		$log .= '|' . $sql." > ".implode(",", $params);
		$log .= '|' . $result;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $result;	
	}
}
