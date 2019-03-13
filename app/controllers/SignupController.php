<?php 

namespace Controllers;
use Models\Signup;

class SignupController {


 protected $twig ;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }

        public function get()
        {
                echo $this->twig->render("signup.html", array(
                    "title" => "SignUp")) ;
        }

        public function post(){
            $name = $_POST["name"];
        	$username = $_POST["username"];
            $email = $_POST["email"];
        	$password = $_POST["password"];
            $error=Signup::AddUser($name, $username, $email, $password);
                echo $this->twig->render("signup.html", array(
                    "title" => "Signup",
                    "error"=>$error
                )) ;
        }
    }
    

 ?>