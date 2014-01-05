<?php

class who_model extends BaseModel {
	protected $dbIndex = 'sys';
	
	/**
	 * insert
	 * @param array $data
	 */
	public function insertWho($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$name = $data['name'] ;
		$info = $data['info'] ;
		$url = $data['url'] ;
		$log .= "|$name,$info,$url" ;
		
		$sql = "insert into ali_wholesaler (name,info,url) values(?,?,?)";
		$params = array($name,$info,$url) ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".$result ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}

	/**
	 * update
	 * @param array $data
	 */
	public function updateWho($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $data['id'] ;
		
		$sql = "update ali_wholesaler set id=?";
		$params = array($id) ;
		$log .= "|$id" ;
		if (isset($data['name'])){
			$sql .= ",name=?";
			$params[] = $data['name'] ;
			$log .= ",$data[name]" ;
		}
		if (isset($data['url'])){
			$sql .= ",url=?";
			$params[] = $data['url'] ;
			$log .= ",$data[url]" ;
		}
		if (isset($data['info'])){
			$sql .= ",info=?";
			$params[] = $data['info'] ;
			$log .= ",$data[info]" ;
		}
		$sql .= " where id=?";
		$params[] = $id ;
		$result = $this->excuteSQL($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".$result ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}

	/**
	 * select
	 * @param array $data
	 */
	public function selectAllWho(){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "select * from ali_wholesaler " ;
		
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}

	/**
	 * select
	 * @param array $data
	 */
	public function selectWhoById($id){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array($id) ;
		$sql = "select * from ali_wholesaler where id=?" ;
		
		$result = $this->getOne($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}