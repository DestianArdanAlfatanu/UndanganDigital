<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header('Location: signup.php'); // Ganti pengantin.php dengan halaman yang sesuai
            exit();
        } else {
            $error = "Username atau password salah";
        }
    } else {
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Sign In</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <div class="box">
    <span class="borderLine"></span>
        <form action="pengantin.php" method="post">
            <h2>Sign In</h2>
            
            <div class="inputBox">
                <input type="text" name="username" autocomplete="off" required>
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" autocomplete="off" required>
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="#">Forgot Password</a>
                <a href="signup.php">Sign Up</a>
            </div>
            <input type="submit" value="Sign In">
        </form>
    </div>
</body>
</html>
