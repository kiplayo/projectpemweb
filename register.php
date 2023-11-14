<?php
session_start(); // Memulai sesi
include "koneksi.php"; // Sertakan file koneksi.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Logika pendaftaran
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validasi apakah username atau email sudah ada
    $checkExisting = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($checkExisting);

    if ($result->num_rows > 0) {
        echo "Username atau email sudah digunakan. Silakan gunakan yang lain.";
    } else {
        // Simpan data ke database dengan peran (role) diatur menjadi "pengguna"
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'pengguna')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['id'] = $conn->insert_id; // Simpan user_id ke dalam session
            $_SESSION['username'] = $username; // Simpan username ke dalam session
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Register">
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a>.</p>
</body>
</html>
