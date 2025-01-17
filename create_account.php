<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/login.css">
<title>Login Page</title>
</head>

<body>
    <div class="overlay">
        <div class="left">
            <div class="bagh">
            <header class="header">
                <img src="puctur/Asset 1@500x-8.png" alt="Logo" class="logo">
                <h1>hub</h1>
            </header>
            <div class="title">
                <p>HR Management Platform</p>
                <div class="tes"></div>
            </div>
            <div class="title1">
                <p>HManage all employees, payrolls, and other human 
                    resource operations.</p>
            </div>
            <div class="btn">
                <button>Our Features</button>
            </div>
        </div>
    </div>

        <div class="content">
            <form action="create_account.php" method="POST">
            <div class="login-form">
                <h2>Welcome to hub</h2>
                <p>Register your account</p>
                <div class="all_form">
                <div class="forme1">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" required>
    
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" required>
    
                    <label for="email">E-mail Address</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="forme1">

                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" required>
    
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
    
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
            </div>
                <div class="options">
                    <label>
                        <input type="checkbox"> Yes, I want to receive KRIS newsletters
                    </label>
                    
                </div>
                <div class="options">
                    <label>
                        <input type="checkbox">  I agree to all the Terms, Privacy Policy
                    </label>
                    
                </div>
                <button type="submit"> Create Account</button>
                <h5>Already have an account? Log In</h5>
            </div>
        </form>
            </div>
        </div>
</body>
</html>
<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, email, phone_number, password) 
                VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to admin_dashboard.php after successful account creation
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
$conn->close();
?>
