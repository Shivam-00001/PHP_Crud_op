


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form for Exam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="hero">
<div class="form-box">
<div class="button-box">
    <div id="btn"></div>
    <button type="button" class="toggle-btn" onclick="login()">Log In</button>
    <button type="button" class="toggle-btn" onclick="register()">Register</button>
</div>

<div class="social-icons">
    <img src="" alt="">
    <img src="" alt="">
    <img src="" alt="">
</div>

<!-- Login Form -->
<form id="login" class="input-group" action="">
    <input type="text" class="input-field" placeholder="User Id" required>
    <input type="text" class="input-field" placeholder="Enter Password" required>
    <input type="checkbox" class="chech-box">
    <span>Remember Password</span>
    <button type="submit" class="submit-btn">Log in</button>
</form>

<!-- Registration Form -->
<form id="register" class="input-group" action="" onsubmit="return validatePassword()">
    <input type="text" class="input-field" placeholder="User Name" required>
    <input type="email" class="input-field" placeholder="Email Id" required>
    <input type="password" id="password" class="input-field" placeholder="Enter Password" required>
    <input type="password" id="confirm-password" class="input-field" placeholder="Enter Confirm Password" required>
    
    <!-- Error messages for password validation -->
    <div id="password-error" style="color: red; font-size: 12px; display: none;">
        Password must be at least 4 characters long.
    </div>
    <div id="error-message" style="color: red; font-size: 12px; display: none;">
        Passwords do not match!
    </div>
    
    <input type="checkbox" class="chech-box">
    <span>I agree to the terms & conditions</span>
    <button type="submit" class="submit-btn">Register</button>
</form>

</div>
</div>

<script>
var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("btn");

function register () {
    x.style.left = "-400px";
    y.style.left = "50px";
    z.style.left = "110px";
}

function login () {
    x.style.left = "50px";
    y.style.left = "450px";
    z.style.left = "0px";
}

// Password validation function
function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm-password").value;
    var passwordError = document.getElementById("password-error");
    var errorMessage = document.getElementById("error-message");

    // Check if password is at least 4 characters long
    if (password.length < 4) {
        passwordError.style.display = "block";  // Show password length error
        return false;
    } else {
        passwordError.style.display = "none";  // Hide password length error
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        errorMessage.style.display = "block";  // Show passwords mismatch error
        return false;
    } else {
        errorMessage.style.display = "none";  // Hide passwords mismatch error
    }

    return true;  // Allow form submission if all validations pass
}
</script>

</body>
</html>
