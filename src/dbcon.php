<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$host="127.0.0.1";
$user="root";
$password="";
$database="ecommerce_db";

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    die("Connection Failed : ".mysqli_connect_error());
}
?>