<?php

class Configs{
	public static $dbconfig = array(
		"admin"		=>	array(
			'mysql_conn' => 'mysql:host=localhost;port=3306;dbname=sysuser' ,
			'mysql_user' => 'root',
			'mysql_pwd' => 'root',
			'charset'	=> 'utf8'
		),
		"sys"		=>	array(
			'mysql_conn' => 'mysql:host=localhost;port=3306;dbname=sys' ,
			'mysql_user' => 'root',
			'mysql_pwd' => 'root',
			'charset'	=> 'utf8'
		),
		"ali"		=>	array(
			'mysql_conn' => 'mysql:host=localhost;port=3306;dbname=ali' ,
			'mysql_user' => 'root',
			'mysql_pwd' => 'root',
			'charset'	=> 'utf8'
		),
	) ;
	
}
	
?>