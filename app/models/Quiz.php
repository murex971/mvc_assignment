<?php

namespace Models;

class Quiz {

	public static function getDB()
	{
		include __DIR__."/../../configs/credentials.php" ;
		return new \PDO("mysql:dbname=".
		$db_connect['db_name'].";host=".
		$db_connect['server'] ,
		$db_connect['username'] ,
		$db_connect['password']);
	}

	public static function Users() {

		$db = self::getDB();

		$user = $db->prepare("SELECT * FROM questions");
		$user->execute();
		//$data = $user1->fetch_assoc();
		$data = $user->fetchAll(\PDO::FETCH_ASSOC);
		//var_dump($data);
		//die();
		return($data);


	}

	public static function validateAns($qid, $answer){
        $db=self::getDB();
        $user=$db->prepare("SELECT * FROM questions WHERE qid=:qid AND answer=:answer");
        $data=$user->execute(array(
            "qid"=>$qid,
            "answer"=>$answer
        ));
        $row=$user->fetch(\PDO::FETCH_ASSOC);
        $points =(int)$row["points"];
        

        if($row) {									//answer is correct
            session_start();
            $username=$_SESSION['username'];
            $sql=$db->prepare("SELECT * FROM leaderboard WHERE qid=:qid AND username=:username");
            $data1=$sql->execute(array(
                "qid"=>$qid,
                "username"=>$username
            ));
            $all=$sql->fetchAll();
            if(count($all)>0){
                return "question has already been attempted correctly";
            }
            else{
                $sql=$db->prepare("INSERT INTO leaderboard(qid, username) VALUES(:qid, :username)");
                $data2=$sql->execute(array(
                    "qid"=>$qid,
                    "username"=>$username
                ));

                $sql1=$db->prepare("UPDATE users SET score = score + $points WHERE username=:username");
                $data3=$sql1->execute(array(
                	"username"=>$username
                ));
                return "correct answer";
            }
            
        
    }else return "wrong answer";
}
	
}


?>