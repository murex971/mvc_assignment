<?php

namespace Models;

class Signup {

	public static function getDB()
	{
		include __DIR__."/../../configs/credentials.php" ;
		return new \PDO("mysql:dbname=".
		$db_connect['db_name'].";host=".
		$db_connect['server'] ,
		$db_connect['username'] ,
		$db_connect['password']);
	}

	public static function AddUser($name, $username, $email, $password) {

		$db = self::getDB();

		$password_hash = hash('sha256',
		$password);
		
		$user1 = $db->prepare("SELECT * FROM users WHERE username=:username");

		$data = $user1->execute(array(
			"username" => $username
		));

		$row = $user1->fetch(\PDO::FETCH_ASSOC);
		
		if($row){
			return "username already exists";
		}
		else
		{$user = $db->prepare("INSERT INTO  users (name, username, email, password) VALUES (:name, :username, :email, :password)");

		$user->execute(array(
			"name" => $name,
			"username" => $username,
			"email" => $email,
			"password" => $password_hash));
		return "registered successfully";
	}

	}
}

?>