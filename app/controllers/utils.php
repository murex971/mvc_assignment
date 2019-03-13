<?php

function filter($string){
	$string = mysql_real_escape_string($string);
    $string = htmlentities($string);
    return $string;
}


?>