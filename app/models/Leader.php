<?php

namespace Models;

class Leader {

	public static function getDB()
	{
		include __DIR__."/../../configs/credentials.php" ;
		return new \PDO("mysql:dbname=".
		$db_connect['db_name'].";host=".
		$db_connect['server'] ,
		$db_connect['username'] ,
		$db_connect['password']);
	}

	
	public static function LeaderBoard(){
		$db = self::getDB();
		$user = $db->prepare("SELECT * FROM users ORDER BY score desc");
		$user->execute();
		//$data = $user1->fetch_assoc();
		$data = $user->fetchAll(\PDO::FETCH_ASSOC);
		//var_dump($data);
		//die();
		return($data);

	}
	

}

?>