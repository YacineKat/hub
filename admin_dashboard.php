<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page - Create User</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body>
        <div class="container">
            <h1>Create New User Account</h1>
            <form action="add_user.php" method="POST">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" id="phone_number" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="agent">Agent</option>
                        <option value="chef_service">Chef Service</option>
                        <option value="chef_personnel">Chef Personnel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Create Account</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Only admins can create users.");
}

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['phone_number']) || empty($_POST['password'])) {
        die("All fields are required.");
    }

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $role = $_POST['role'];
    $status = $_POST['status'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $valid_roles = ['agent', 'chef_service', 'chef_personnel'];
    if (!in_array($role, $valid_roles)) {
        die("Invalid role selected.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $created_by = $_SESSION['user_id'];

    $sql = "INSERT INTO users (first_name, last_name, email, phone_number, role, status, password, created_by)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $first_name, $last_name, $email, $phone_number, $role, $status, $password, $created_by);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        error_log("Error: " . $stmt->error);
        if ($conn->errno === 1062) {
            echo "Error: Email address is already registered.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>


