<?php
session_start(); // Memulai sesi
include "koneksi.php"; // Sertakan file koneksi.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Logika login
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, username, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row["password"]) {
            $_SESSION['user_id'] = $row['id']; // Simpan user_id ke dalam session
            $_SESSION['username'] = $row['username']; // Simpan username ke dalam session
            echo "Login successful!";
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <p>belum punya akun?<a href="register.php">register</a>.</p>
</body>
</html>
