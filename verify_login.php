<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>Login Page</title>
</head>
<body>
    <div class="overlay">
        <div class="content">
            <form action="verify_login.php" method="POST">
                <header class="header">
                    <img src="puctur/Asset 1@500x-8.png" alt="Logo" class="logo">
                    <h1>Your HR Portal Awaits</h1>
                </header>
                <div class="title">
                    <p>Access all your HR tools in one place—track,<br>
                        manage, and empower your workforce effortlessly.</p>
                </div>
                <div class="login-form">
                    <h2>Login</h2>
                    <p>Login to your account.</p>
                    <input type="email" name="email" placeholder="E-mail Address" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="options">
                        <label>
                            <input type="checkbox" name="remember_me"> Remember me
                        </label>
                        <a href="#">Reset Password?</a>
                    </div>
                    <button type="submit">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


<?php
// Database connection
include 'conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        die("Please fill in both email and password.");
    }

    // Query to fetch user details
    $sql = "SELECT id, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    header("Location: admin_dashboard.php");
                    exit();
                case 'chef_personnel':
                    header("Location: chef_personnel_dashboard.php");
                    exit();
                case 'chef_service':
                    header("Location: chef_service_dashboard.php");
                    exit();
                case 'agent':
                    header("Location: agent_dashboard.php");
                    exit();
                default:
                    echo "Role not recognized.";
            }
        } else {
            echo "<div style='color: red;'>Invalid password. <a href='login_page.html'>Try again</a></div>";
        }
    } else {
        echo "<div style='color: red;'>No user found with that email. <a href='login_page.html'>Try again</a></div>";
    }

    $stmt->close();
}

$conn->close();
?>
