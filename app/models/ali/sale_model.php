<?php

class sale_model extends BaseModel {
	protected $dbIndex = 'ali';
	protected $dbTable = "ali_sale" ;
	protected $items = array('goodsid','buyer','buyer_ww','num','price','fare','date') ;
	
	/**
	 * select
	 * @param array $data
	 */
	public function selectSale($data=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "SELECT sale.*,goods.name goodsname,who.name whoname FROM ali_sale sale,ali_goods goods,ali_wholesaler who WHERE sale.goodsid=goods.id AND goods.whoid=who.id " ;
	
		if (isset($data['goodsid'])){
			$sql .= "and sale.goodsid=? ";
			$params[] = $data['goodsid'] ;
		}
		if (isset($data['name'])){
			$sql .= "and sale.name=? ";
			$params[] = $data['name'] ;
		}
		if (isset($data['date'])){
			$sql .= "and sale.date=? ";
			$params[] = $data['date'] ;
		}
		$sql .= "order by who.id, goods.id, sale.id ".$this->getLimit($data) ;
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql > ".implode(",", $params);
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	public function queryCount($data=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "SELECT count(*) count FROM ali_sale sale,ali_goods goods,ali_wholesaler who WHERE sale.goodsid=goods.id AND goods.whoid=who.id " ;
	
		if (!empty($data['whoid'])){
			$sql .= "and who.id=? ";
			$params[] = $data['whoid'] ;
		}
		if (isset($data['goodsid'])){
			$sql .= "and sale.goodsid=? ";
			$params[] = $data['goodsid'] ;
		}
		if (isset($data['name'])){
			$sql .= "and sale.name=? ";
			$params[] = $data['name'] ;
		}
		if (isset($data['date'])){
			$sql .= "and sale.date=? ";
			$params[] = $data['date'] ;
		}
		$sql .= "order by who.id, goods.id, sale.id " ;
		
		$result = $this->getOne($sql,$params) ;
		$pages = (int)(($result['count'] - 1)/FinalClass::$_list_pagesize) + 1 ;
		
		$log .= '|' . $sql.";".implode(",", $params);
		$log .= '|' . $pages;
		$log .= '|' . (int)(microtime(true)*1000-$start);
		Log::logBehavior($log);
		return $pages;	
	}
}