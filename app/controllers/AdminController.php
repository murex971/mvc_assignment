<?php
    namespace Controllers;
    use Models\Admin;
    
    class AdminController
    {
        protected $twig ;
        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }
        public function get()
        {
            session_start();
            $username=$_SESSION['username'];
            if(isset($_SESSION['username'])){
                if($_SESSION['username']=='admin'){
                echo $this->twig->render("admin.html", array(
                    "title" => "Adminpage",
                    "user"=>$username
                )) ;
            }else{
                header("Location: /quiz");
                 ;
            }
            }else{
                header("Location: /");
            }
        }
        public function post(){


            $question=$_POST['question'];
            $question = filter($question);
            $answer=$_POST['answer'];
            $answer = filter($answer);
            $points=$_POST['points'];
            $points = filter($points);

            
            if(Admin::add_ques($question, $answer, $points)){
                echo "question added !!";
            }else{
                echo "there was some error!!";
            }
        }
        
    }
?>
