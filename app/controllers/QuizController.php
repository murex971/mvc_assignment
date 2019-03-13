<?php

    namespace Controllers;
    use Models\Quiz;

    class QuizController
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

            $questions = Quiz::Users();
                echo $this->twig->render("quiz.html", array(
                    "data" => $questions,
                    "title" => "quiz platform")) ;
            }
            else{
                 header("Location:/");
            }
        }

        public function post()
        {   
            $qid = $_POST['qid'];
            $answer = $_POST['answer'];
            $result = Quiz::validateAns($qid, $answer) ;
            echo $result;
        }
    }
    ?>