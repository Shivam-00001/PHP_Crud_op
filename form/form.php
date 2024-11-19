<?php
// Include database connection
include "include/config.php";

// Check if form is submitted
if (isset($_POST["submit"])) {
    // Check if any field is empty on the server side
    if (empty($_POST["name"]) || empty($_POST["lname"]) || empty($_POST["email"]) || 
        empty($_POST["phone"]) || empty($_POST["gender"]) || empty($_POST["address"])) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        // Get form data
        $name = $_POST["name"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];
        $address = $_POST["address"];

        // Check if the email already exists in the database
        $check_email_query = "SELECT * FROM crud_table WHERE email='$email'";
        $check_email_result = mysqli_query($connection, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            // If email exists, show error message and prevent form submission
            echo "<script>document.getElementById('emailExistError').innerHTML = 'This email is already registered. Please use a different email.';</script>";
        } else {
            // Insert data into the database
            $sql_query = "INSERT INTO crud_table(id, name, lname, email, phone, gender, address) 
                        VALUES (NULL, '$name', '$lname', '$email', '$phone', '$gender', '$address')";

            $result_query = mysqli_query($connection, $sql_query);

            if ($result_query) {
                echo "<script>alert('Data Successfully Inserted');</script>";
                echo "<script>location.replace('form.php');</script>";
            } else {
                echo $connection->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/php.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Add this CSS to change the cursor when the submit button is disabled */
        #submitButton:disabled {
            cursor: not-allowed;  /* Change cursor to disabled symbol */
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h2 class="text-primary">PHP CRUD Operation</h2>
    </div>
    <div class="container p-5 card">
        <form action="" method="POST" id="crudForm" onsubmit="return validateForm()">
            <div class="row">
                <div class="col-4">
                    <label class="label">Name<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" placeholder="Enter Your Name" name="name" id="name">
                    <div id="nameError" class="error"></div>
                </div>
                <div class="col-4">
                    <label class="label">Last Name<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" placeholder="Enter Your Last Name" name="lname" id="lname">
                    <div id="lnameError" class="error"></div>
                </div>
                <div class="col-4">
                    <label class="label">Email<span class="text-danger">*</span></label>
                    <input class="form-control" type="email" placeholder="Enter Your Email Address" name="email" id="email" oninput="checkEmail()">
                    <div id="emailError" class="error"></div>
                    <div id="emailExistError" class="error"></div> <!-- Show error if email already exists -->
                </div>
                <div class="col-4 mt-2">
                    <label class="label">Phone<span class="text-danger">*</span></label>
                    <input class="form-control" type="number" placeholder="Enter Your Mobile Number" name="phone" id="phone">
                    <div id="phoneError" class="error"></div>
                </div>
                <div class="col-4 mt-2">
                    <label class="label">Gender<span class="text-danger">*</span></label>
                    <select class="form-control" name="gender" id="gender">
                        <option selected disabled value="-Choose Gender-">-Choose Gender-</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                    <div id="genderError" class="error"></div>
                </div>
                <div class="col-4 mt-2">
                    <label class="label">Address<span class="text-danger">*</span></label>
                    <textarea class="form-control" placeholder="Enter Your Address" name="address" id="address"></textarea>
                    <div id="addressError" class="error"></div>
                </div>
                <div class="text-center mt-4">
                    <button name="submit" class="btn btn-success" id="submitButton">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Function to validate the form before submission
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.getElementById("nameError").innerHTML = "";
            document.getElementById("lnameError").innerHTML = "";
            document.getElementById("emailError").innerHTML = "";
            document.getElementById("phoneError").innerHTML = "";
            document.getElementById("genderError").innerHTML = "";
            document.getElementById("addressError").innerHTML = "";
            document.getElementById("emailExistError").innerHTML = ""; // Clear email existence error

            // Get the values of the form fields
            const name = document.getElementById("name").value.trim();
            const lname = document.getElementById("lname").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const gender = document.getElementById("gender").value.trim(); // Get selected gender value
            const address = document.getElementById("address").value.trim();

            // Validate each field and display an error message if invalid
            if (name === "") {
                document.getElementById("nameError").innerHTML = "Please fill the name field.";
                isValid = false;
            }

            if (lname === "") {
                document.getElementById("lnameError").innerHTML = "Please fill the last name field.";
                isValid = false;
            }

            if (email === "") {
                document.getElementById("emailError").innerHTML = "Please fill the email field.";
                isValid = false;
            }

            if (phone === "") {
                document.getElementById("phoneError").innerHTML = "Please fill the phone field.";
                isValid = false;
            }

            if (gender === "-Choose Gender-") {
                document.getElementById("genderError").innerHTML = "Please select your gender.";
                isValid = false;
            }

            if (address === "") {
                document.getElementById("addressError").innerHTML = "Please fill the address field.";
                isValid = false;
            }

            // Prevent form submission if validation fails
            return isValid;
        }

        // Function to check if the email already exists in the database
        function checkEmail() {
            const email = document.getElementById("email").value.trim();
            const emailError = document.getElementById("emailExistError");
            const submitButton = document.getElementById("submitButton");

            if (email !== "") {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "check_email.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText === "exists") {
                            emailError.innerHTML = "This email is already registered. Please use a different email.";
                            submitButton.disabled = true; // Disable the submit button
                        } else {
                            emailError.innerHTML = "";  
                            submitButton.disabled = false; // Enable the submit button if email doesn't exist
                        }
                    }
                };
                xhr.send("email=" + encodeURIComponent(email));
            }
        }
    </script>

</body>

</html>
