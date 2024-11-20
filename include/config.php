<?php
// Database connection details
$host = 'localhost';  // Change to your host if it's different
$username = 'root';   // Change to your database username
$password = '';       // Change to your database password
$dbname = 'phpcrud';  // Change to your database name

// Create connection
$connection = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
