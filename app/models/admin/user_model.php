<?php

class user_model extends BaseModel {
	protected $dbIndex = 'admin';
	protected $dbTable = "_user" ;
	protected $items = array('name','password','username','registdate','email') ;
	
	protected function init(){
		$this->dbTable = FinalClass::$_system."_user" ;
	}
	
	protected function getWhere(){
		return "1=1 " ;
	}

	protected function getOrder(){
		return "order by name " ;
	}
	

}

