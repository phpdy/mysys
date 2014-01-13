<?php
class rolse_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbTable = "_rolse" ;
	protected $items = array('rolse','info','modules','state') ;
	
	protected function init(){
		$this->dbTable = FinalClass::$_system."_rolse" ;
	}
	
	protected function getWhere(){
		return " 1=1 " ;
	}

	protected function getOrder(){
		return "ORDER BY id DESC" ;
	}

	public function selectRolsesByIds($ids) {
		$start = microtime ( true ) * 1000;
		$log = __CLASS__ . "|" . __FUNCTION__."|";

		$sql = "select * from " . $this->dbTable . " where 1=1";

		$params = array() ;
		
		if (!empty($ids)) {
			$sql .= " and id in ($ids)";
		}
		$sql .= " ORDER BY id DESC ";
		$result = $this->getAll($sql,$params);
		$log .= "|$sql";
		
		$log .= "|" . sizeof ( $result );
		$log .= "|" . ( int ) (microtime ( true ) * 1000 - $start);
		Log::logBehavior ( $log );
		return $result;
	}
	
}