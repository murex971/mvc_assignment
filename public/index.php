<?php
require_once __DIR__ . "/../vendor/autoload.php";
Toro::serve(array(
   "/" => "Controllers\\HomeController",
   "/login" => "Controllers\\LoginController",
   "/signup" => "Controllers\\SignupController",
   "/admin" => "Controllers\\AdminController",
   "/quiz" => "Controllers\\QuizController",
   "/logout" => "Controllers\\LogoutController",
   "/leaderboard" => "Controllers\\LeaderController"
 ));
 ?>