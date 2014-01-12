<?php

class sale_model extends BaseModel {
	protected $dbIndex = 'ali';
	protected $dbTable = "ali_sale" ;
	protected $items = array('goodsid','buyer','buyer_ww','num','price','fare','date') ;
	
	/**
	 * insert
	 * @param array $data
	 */
	public function insertSale($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodsid 	= $data['goodsid'] ;
		$buyer 		= $data['buyer'] ;
		$buyer_ww 	= $data['buyer_ww'] ;
		$price 		= $data['price'] ;
		$num 		= $data['num'] ;
		$fare 		= $data['fare'] ;
		$date 		= $data['date'] ;
		$log .= "|$goodsid,$buyer,$buyer_ww,$price,$num,$fare,$date" ;
		
		$sql = "insert into ali_sale (goodsid,buyer,buyer_ww,num,price,fare,date) values(?,?,?,?,?,?,?)";
		$params = array($goodsid,$buyer,$buyer_ww,$price,$num,$fare,$date) ;
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
	public function updateSale($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $data['id'] ;
		$sql = "update ali_sale set id=? ";
		$params = array($id) ;
		$log .= "|$id" ;
		if (isset($data['goodsid'])){
			$sql .= ",goodsid=?";
			$params[] = $data['goodsid'] ;
			$log .= ",$data[goodsid]" ;
		}
		if (isset($data['buyer'])){
			$sql .= ",buyer=?";
			$params[] = $data['buyer'] ;
			$log .= ",$data[buyer]" ;
		}
		if (isset($data['buyer_ww'])){
			$sql .= ",buyer_ww=?";
			$params[] = $data['buyer_ww'] ;
			$log .= ",$data[buyer_ww]" ;
		}
		if (isset($data['price'])){
			$sql .= ",price=?";
			$params[] = $data['price'] ;
			$log .= ",$data[price]" ;
		}
		if (isset($data['num'])){
			$sql .= ",num=?";
			$params[] = $data['num'] ;
			$log .= ",$data[num]" ;
		}
		if (isset($data['fare'])){
			$sql .= ",fare=?";
			$params[] = $data['fare'] ;
			$log .= ",$data[fare]" ;
		}
		if (isset($data['date'])){
			$sql .= ",date=?";
			$params[] = $data['date'] ;
			$log .= ",$data[date]" ;
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
	 * @param int $id
	 */
	public function selectSaleById($id){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array($id) ;
		$sql = "select * from ali_sale where id = ?" ;
		
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
	public function selectSale($data=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "SELECT sale.*,goods.name goodsname,who.name whoname FROM ali_sale sale,ali_goods goods,ali_wholesaler who WHERE sale.goodsid=goods.id AND goods.whoid=who.id " ;
	
		if (isset($data['goodsid'])){
			$sql .= "and sale.goodsid=? ";
			$params[] = $data['goodsid'] ;
			$log .= ",$data[goodsid]" ;
		}
		if (isset($data['name'])){
			$sql .= "and sale.name=? ";
			$params[] = $data['name'] ;
			$log .= ",$data[name]" ;
		}
		if (isset($data['date'])){
			$sql .= "and date(sale.date)=? ";
			$params[] = $data['date'] ;
			$log .= ",$data[date]" ;
		}
		$sql .= "order by who.id, goods.id, sale.id" ;
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}