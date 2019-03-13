<?php

namespace Models;

class Login {

	public static function getDB()
	{
		include __DIR__."/../../configs/credentials.php" ;
		return new \PDO("mysql:dbname=".
		$db_connect['db_name'].";host=".
		$db_connect['server'] ,
		$db_connect['username'] ,
		$db_connect['password']);
	}

	public static function validateUser($username, $password) {

		$db = self::getDB();

		$password_hash = hash('sha256',
		$password);

		$user = $db->prepare("SELECT * FROM users WHERE username=:username AND password=:password");

		$data = $user->execute(array(
			"username" => $username,
			"password" => $password_hash
		));

		$row = $user->fetch(\PDO::FETCH_ASSOC);

		if($row) return true;
		else return false;
	}

}

?>