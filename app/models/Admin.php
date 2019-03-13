<?php
namespace Models;
class Admin {
    public static function getDB()
    {
        include __DIR__."/../../configs/credentials.php" ;
        
        return new \PDO("mysql:dbname=".
        $db_connect['db_name'].";host=".
        $db_connect['server'] , 
        $db_connect['username'] , 
        $db_connect['password']);
    }
    public static function add_ques($question, $answer){
        $db=self::getDB();
        if(!empty($question) || !empty($answer) || !empty(points)){
        $query = $db->prepare("INSERT INTO questions(question, answer, points) VALUES(:question, :answer, :points)");
    
        $query->execute(array(
            "question"=>$question,
            "answer"=>$answer,
            "points"=>$points
        ));
      //  var_dump($query);
       // die();

        return true;
    }
}
}