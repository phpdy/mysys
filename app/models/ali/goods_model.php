<?php

class goods_model extends BaseModel {
	protected $dbIndex = 'ali';
	protected $dbTable = "ali_goods" ;
	protected $items = array('whoid','name','info') ;
	
	/**
	 * insert
	 * @param array $data
	 */
	public function insertGoods($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$whoid 	= $data['whoid'] ;
		$name 	= $data['name'] ;
		$info 	= $data['info'] ;
		$state 	= $data['state'] ;
		$log .= "|$whoid,$name,$info,$state" ;
		
		$sql = "insert into ali_goods (whoid,name,info) values(?,?,?)";
		$params = array($whoid,$name,$info) ;
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
	public function updateGoods($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $data['id'] ;
		
		$sql = "update ali_goods set id=? ";
		$params = array($id) ;
		$log .= "|$id" ;
		if (isset($data['whoid'])){
			$sql .= ",whoid=?";
			$params[] = $data['whoid'] ;
			$log .= ",$data[whoid]" ;
		}
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
		if (isset($data['state'])){
			$sql .= ",state=?";
			$params[] = $data['state'] ;
			$log .= ",$data[state]" ;
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
	public function selectGoodsById($id){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array($id) ;
		$sql = "select * from ali_goods where id = ?" ;
		
		$result = $this->getOne($sql,$params) ;
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
	public function selectGoods($data=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "select goods.*,who.name whoname from ali_goods goods,ali_wholesaler who where goods.whoid=who.id " ;
	
		if (isset($data['whoid'])){
			$sql .= "and goods.whoid=? ";
			$params[] = $data['whoid'] ;
			$log .= ",$data[whoid]" ;
		}
		if (isset($data['state'])){
			$sql .= "and goods.state=? ";
			$params[] = $data['state'] ;
			$log .= ",$data[state]" ;
		}
		$sql .= "order by goods.whoid, goods.id ".$this->getLimit($data) ;
		
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}