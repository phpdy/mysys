<?php

class module_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbTable = "_module" ;
	protected $items = array('name','url','type','parentid','urltype','state') ;
	
	protected function init(){
		$this->dbTable = FinalClass::$_system."_module" ;
	}
	
	protected function getWhere(){
		return "urltype in (0,2) " ;
	}

	protected function getOrder(){
		return "ORDER BY parentid,TYPE,id " ;
	}
	
	
}