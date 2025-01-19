<?php
include('./db_connect.php'); // Include database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $user_type = $_POST['user_type']; // Expecting 1 (Admin) or 2 (Staff)
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo 0; // Password mismatch
        exit;
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 2; // Username already exists
        exit;
    }

    // MD5 Hashing the password (Note: MD5 is insecure for password hashing)
    $hashed_password = md5($password); // MD5 hashing

    // Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (name, user_type, username, password, status) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param("siss", $name, $user_type, $username, $hashed_password);

    if ($stmt->execute()) {
        echo 1; // Registration successful
    } else {
        echo 0; // Error
    }

    $stmt->close();
    $conn->close();
}
?>
