<?php

$conn = mysqli_connect (
   getenv("DB_HOST"),
   getenv("DB_USERNAME"),
   getenv("DB_PASSWORD'),
   getenv("DB_DATABASE"),
   getenv("DB_PORT") ?: '3306'
);

if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

                        )

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "user_data"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   
    error_log("Connection failed: " . $conn->connect_error);
   
    die("Connection to the database failed. Please try again later.");
}


$conn->set_charset("utf8");

?>
