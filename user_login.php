<?php
// Include database connection
include "include/config.php"; 

// Start the session
session_start();

// Initialize error message variables
$emailError = "";
$passwordError = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];

    // Query to check if the email exists in the database
    $query = "SELECT * FROM crud_table WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    
    // Check if any user is found with that email
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password matches, start the session and redirect to dashboard
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: user_profile.php"); // Redirect to dashboard
            exit();
        } else {
            // Invalid password
            $passwordError = "Invalid password";
        }
    } else {
        // No user found with this email
        $emailError = "No user found with that email";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100">
        <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="text-center text-primary mb-4">User_Login</h2>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" required>
                            <!-- Display email error message if email doesn't exist -->
                            <?php if ($emailError): ?>
                                <div class="text-danger mt-2">
                                    <?php echo $emailError; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" required>
                            <!-- Display password error message if password is invalid -->
                            <?php if ($passwordError): ?>
                                <div class="text-danger mt-2">
                                    <?php echo $passwordError; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="user_reg.php">Don't have an account? Register here.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
