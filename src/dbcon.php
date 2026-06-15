<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$host=localhost";
$user="tiadmin";
$password="tigazh@1234*";
$database="triqulk6_tiecom1";

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    die("Connection Failed : ".mysqli_connect_error());
}
?>