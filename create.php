<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Include the database connection
include 'conn.php';

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Only admins can create users.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        die("Invalid email format.");
    }

    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $role = $conn->real_escape_string($_POST['role']);
    $status = $conn->real_escape_string($_POST['status']);

    if (!$first_name || !$last_name || !$email || !$phone_number || !$role || !$status || !$password) {
        die("All fields are required.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $created_by = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, password, email, phone_number, role, status, created_by) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $first_name, $last_name, $hashed_password, $email, $phone_number, $role, $status, $created_by);

    if ($stmt->execute()) {
        echo "<p>User account created successfully!</p>";
    } else {
        echo "<p>Error executing statement: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
echo "First Name: $first_name<br>";
echo "Last Name: $last_name<br>";
echo "Email: $email<br>";
echo "Phone: $phone_number<br>";
echo "Role: $role<br>";
echo "Status: $status<br>";
echo "Password (hashed): $hashed_password<br>";
echo "Created By: $created_by<br>";

$conn->close();
?>
