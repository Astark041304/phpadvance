<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "personal_data"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   
    error_log("Connection failed: " . $conn->connect_error);
   
    die("Connection to the database failed. Please try again later.");
}


$conn->set_charset("utf8");

?>