<?php
// Include database connection
include "../include/config.php";

// Get the email from POST request
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    
    // Query to check if the email exists in the database
    $query = "SELECT * FROM admin_reg WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    // Check if the email exists
    if (mysqli_num_rows($result) > 0) {
        echo "exists"; // Email exists in the database
    } else {
        echo "available"; // Email is available
    }
}
?>
