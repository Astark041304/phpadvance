<?php
// db.php
$servername = "localhost"; // or your server name
$username = "root"; // default username for XAMPP
$password = ""; // default password for XAMPP (usually empty)
$dbname = "personal_data"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>