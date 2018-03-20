<?php

$server = ""; 
$username = ""; 
$password = ""; 
$dbname = ""; 

$connect = new mysqli($server, $username, $password, $dbname); 

if($connect->connect_error) {
    die("Falha na conexão do banco: " . $connect->connect_error);
}

?>