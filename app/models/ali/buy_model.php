<?php

class buy_model extends BaseModel {
	protected $dbIndex = 'ali';
	protected $dbTable = "ali_buy" ;
	protected $items = array('goodsid','name','info','price','num','fare','date') ;
	
	/**
	 * insert
	 * @param array $data
	 */
	public function insertBuy($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$goodsid 	= $data['goodsid'] ;
		$name 	= $data['name'] ;
		$info 	= $data['info'] ;
		$price 	= $data['price'] ;
		$num 	= $data['num'] ;
		$fare 	= $data['fare'] ;
		$date 	= $data['date'] ;
		$log .= "|$goodsid,$name,$info,$price,$num,$fare,$date" ;
		
		$sql = "insert into ali_buy (goodsid,name,info,price,num,fare,date) values(?,?,?,?,?,?,?)";
		$params = array($goodsid,$name,$info,$price,$num,$fare,$date) ;
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
	public function updateBuy($data){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$id = $data['id'] ;
		$sql = "update ali_buy set id=? ";
		$params = array($id) ;
		$log .= "|$id" ;
		if (isset($data['goodsid'])){
			$sql .= ",goodsid=?";
			$params[] = $data['goodsid'] ;
			$log .= ",$data[goodsid]" ;
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
	public function selectBuyById($id){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array($id) ;
		$sql = "select * from ali_buy where id = ?" ;
		
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
	public function selectBuy($data=array()){
		$start = microtime(true)*1000 ;
		$log = __CLASS__."|".__FUNCTION__ ;
		
		$params = array() ;
		$sql = "SELECT buy.*,goods.name goodsname,who.name whoname FROM ali_buy buy,ali_goods goods,ali_wholesaler who WHERE buy.goodsid=goods.id AND goods.whoid=who.id " ;
	
		if (!empty($data['goodsid'])){
			$sql .= "and buy.goodsid=? ";
			$params[] = $data['goodsid'] ;
			$log .= ",$data[goodsid]" ;
		}
		if (isset($data['name'])){
			$sql .= "and buy.name=? ";
			$params[] = $data['name'] ;
			$log .= ",$data[name]" ;
		}
		if (isset($data['date'])){
			$sql .= "and date(buy.date)=? ";
			$params[] = $data['date'] ;
			$log .= ",$data[date]" ;
		}
		$sql .= "order by who.id, goods.id, buy.id" ;
		$result = $this->getAll($sql,$params) ;
		$log .= "|$sql" ;
		
		$log .= "|".sizeof($result) ;
		$log .= "|".(int)(microtime(true)*1000-$start) ;
		Log::logBehavior($log) ;
		return $result ;
	}
	
}