<?php
// Include database connection
include "../include/config.php";

// Check if form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Server-side validation
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } elseif (strlen($password) < 4) {
        echo "<script>alert('Password must be at least 4 characters long.');</script>";
    } elseif (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        echo "<script>alert('Password must contain at least one special character.');</script>";
    } else {
        // If validation passes, proceed with inserting the data
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Always hash passwords before saving

        // Insert data into the database
        $sql_query = "INSERT INTO admin_reg (id, name, email, password) 
                      VALUES (NULL, '$name', '$email', '$hashedPassword')";

        $result_query = mysqli_query($connection, $sql_query);

        if ($result_query) {
            echo "<script>alert('Data Successfully Added');</script>";
            echo "<script>location.replace('admin_login.php');</script>";
        } else {
            echo $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Client-side validation for password and confirm password
    function validatePassword() {

        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;
        var errorMessage = document.getElementById("error-message");
        
        // Check if password and confirm password match
        if (password !== confirmPassword) {
            errorMessage.textContent = "Passwords do not match!";
            errorMessage.style.display = "block";
            return false;
        } else {
            errorMessage.style.display = "none";
        }

        // Check if password is at least 4 characters long
        if (password.length < 4) {
            errorMessage.textContent = "Password must be at least 4 characters long!";
            errorMessage.style.display = "block";
            return false;
        }

        // Check if password contains at least one special character
        var specialCharPattern = /[^a-zA-Z0-9]/;
        if (!specialCharPattern.test(password)) {
            errorMessage.textContent = "Password must contain at least one special character!";
            errorMessage.style.display = "block";
            return false;
        }

        return true; // All checks passed, submit the form
    }


    function checkEmail() {
        const email = document.getElementById("email").value.trim();
        const emailError = document.getElementById("emailExistError");
        const submitButton = document.getElementById("submitButton");

        // Make sure the email input is not empty before sending the request
        if (email !== "") {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "checkem.php", true); // Ensure the correct path to checkem.php
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // If the response from PHP script is "exists", show the error message
                    if (xhr.responseText === "exists") {
                        emailError.innerHTML = "This email is already registered. Please use a different email.";
                        emailError.style.color = "red";
                        submitButton.disabled = true; // Disable the submit button
                    } else {
                        emailError.innerHTML = ""; // Clear the error message if email is available
                        submitButton.disabled = false; // Enable submit button
                    }
                }
            };
            xhr.send("email=" + encodeURIComponent(email));
        } else {
            emailError.innerHTML = ""; // Clear error message if email field is empty
            submitButton.disabled = false; // Enable submit button
        }
    }


    </script>

</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100">
        <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="text-center text-primary mb-4">Admin Register</h2>
                    <form action="" method="POST" onsubmit="return validatePassword()">
    <div class="mb-3">
        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" required>
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email" id="email" oninput="checkEmail()" required>
        <div id="emailExistError" class="error"></div> <!-- This is where the error message will appear -->
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="confirm-password" class="form-label">Confirm Password<span class="text-danger">*</span></label>
        <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
        <div id="error-message" class="text-danger mt-2" style="display: none;"></div>
    </div>
    
    <button type="submit" class="btn btn-primary w-100" name="submit" id="submitButton">Register</button>
</form>
<div class="mt-3 text-center">
                        <a href="admin_login.php">You have account? Login here.</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
