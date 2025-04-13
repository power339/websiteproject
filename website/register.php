<?php
session_start();
$conn = new mysqli("localhost", "root", "", "your_database");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $_SESSION["user"] = $email;
        header("Location: dashboard.php");
    } else {
        echo "Signup failed!";
    }
    $stmt->close();
}
$conn->close();
?>
