<?php
require 'db.php';

$auth_type = $_POST['auth_type'];
$email = $_POST['email'];
$password = $_POST['password'];

if ($auth_type === 'signup') {
    $name = $_POST['name'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if user exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "User already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        if ($stmt->execute()) {
            echo "Signup successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $check->close();

} elseif ($auth_type === 'login') {
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashed);
    if ($stmt->fetch() && password_verify($password, $hashed)) {
        echo "Login successful!";
    } else {
        echo "Invalid credentials!";
    }
    $stmt->close();
}

$conn->close();
?>
    