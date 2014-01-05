<?php
/**
 * 模版管理
 *
 */
class mark_model extends BaseModel {

	/**
	 * insert
	 * @param array $data
	 */
	public function insert($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "insert into mark_model (NAME,info,content,type) values(?,?,?,?)";
		$params = array($data['name'],$data['info'],$data['content'],$data['type']) ;
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
	public function update($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$sql = "update mark_model set id=?";
		$params = array($data['id']) ;
		$log .= "|$data[id]" ;
		if (isset($data['name'])){
			$sql .= ",name=?";
			$params[] = $data['name'] ;
			$log .= ",$data[name]" ;
		}
		if (isset($data['info'])){
			$sql .= ",info=?";
			$params[] = $data['info'] ;
			$log .= ",$data[info]" ;
		}
		if (isset($data['content'])){
			$sql .= ",content=?";
			$params[] = $data['content'] ;
//			$log .= ",$data[content]" ;
		}
		if (isset($data['type'])){
			$sql .= ",type=?";
			$params[] = $data['type'] ;
			$log .= ",$data[type]" ;
		}
		$sql .= " where id=?";
		$params[] = $data['id'] ;
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
	public function select($data=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "select * from mark_model where 1=1" ;
		
		$id = $data['id'] ;
		if (!empty($id)){
			$sql .= " and id=?" ;
			$params[] = $id ;
			$log .= "$id," ;
		}
		$type = $data['type'] ;
		if (!empty($type)){
			$sql .= " and type=?" ;
			$params[] = $type ;
			$log .= "$type," ;
		}
		
		$sql .= " ORDER BY id ";
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}