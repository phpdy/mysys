<?php

class buy_model extends BaseModel {
	protected $dbIndex = 'ali';
	protected $dbTable = "ali_buy" ;
	protected $items = array('goodsid','name','info','price','num','fare','date') ;
	
	protected function getWhere(){
		return "1=1 " ;
	}

	protected function getOrder(){
		return "ORDER BY id " ;
	}
	
	/**
	 * select
	 * @param array $data
	 */
	public function selectBuy($data=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "SELECT buy.*,goods.name goodsname,who.name whoname FROM ali_buy buy,ali_goods goods,ali_wholesaler who WHERE buy.goodsid=goods.id AND goods.whoid=who.id " ;
	
		if (!empty($data['whoid'])){
			$sql .= "and who.id=? ";
			$params[] = $data['whoid'] ;
		}
		if (!empty($data['goodsid'])){
			$sql .= "and buy.goodsid=? ";
			$params[] = $data['goodsid'] ;
		}
		if (isset($data['name'])){
			$sql .= "and buy.name=? ";
			$params[] = $data['name'] ;
		}
		if (isset($data['date'])){
			$sql .= "and date(buy.date)=? ";
			$params[] = $data['date'] ;
		}
		$sql .= "order by who.id, goods.id, buy.id ".$this->getLimit($data) ;
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql > ".implode(",", $params);
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	public function queryCount($data=array()) {
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "SELECT count(*) count FROM ali_buy buy,ali_goods goods,ali_wholesaler who WHERE buy.goodsid=goods.id AND goods.whoid=who.id " ;
	
		if (!empty($data['whoid'])){
			$sql .= "and who.id=? ";
			$params[] = $data['whoid'] ;
		}
		if (!empty($data['goodsid'])){
			$sql .= "and buy.goodsid=? ";
			$params[] = $data['goodsid'] ;
		}
		if (isset($data['name'])){
			$sql .= "and buy.name=? ";
			$params[] = $data['name'] ;
		}
		if (isset($data['date'])){
			$sql .= "and date(buy.date)=? ";
			$params[] = $data['date'] ;
		}
		$sql .= "order by who.id, goods.id, buy.id " ;
		
		$result = $this->getOne($sql,$params) ;
		$pages = (int)(($result['count'] - 1)/FinalClass::$_list_pagesize) + 1 ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $pages;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $pages;	
	}
	
}