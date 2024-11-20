<?php
// Include your database connection
include "include/config.php"; 

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']); // Prevent SQL Injection

    // Check if the email already exists in the database
    $query = "SELECT * FROM crud_table WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "exists";  // If email exists
    } else {
        echo "available";  // If email doesn't exist
    }
}
?>
