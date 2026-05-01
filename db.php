<?php

$host     = "localhost";    
$username = "root";         
$password = "";              
$database = "tictactoe_db";  
 

$conn = mysqli_connect($host, $username, $password);
 
if (!$conn) {
    die("Could not connect to MySQL. Is XAMPP running? Error: " . mysqli_connect_error());
}
 
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (!mysqli_query($conn, $sql)) {
    die("Could not create database. Error: " . mysqli_error($conn));
}
 
mysqli_select_db($conn, $database);

$sql = "CREATE TABLE IF NOT EXISTS scores (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    player_x  VARCHAR(50) NOT NULL,
    player_o  VARCHAR(50) NOT NULL,
    winner    VARCHAR(50) NOT NULL,
    played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
 
if (!mysqli_query($conn, $sql)) {
    die("Could not create table. Error: " . mysqli_error($conn));
}
 

?>