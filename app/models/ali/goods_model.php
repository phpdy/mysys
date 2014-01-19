<?php

class goods_model extends BaseModel {
	protected $dbIndex = 'ali';
	protected $dbTable = "ali_goods" ;
	protected $items = array('whoid','name','info') ;
	
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
		}
		if (isset($data['state'])){
			$sql .= "and goods.state=? ";
			$params[] = $data['state'] ;
		}
		$sql .= "order by goods.whoid, goods.id ".$this->getLimit($data) ;
		
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql > ".implode(",", $params);
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}