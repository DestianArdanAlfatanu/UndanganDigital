<?php
include 'koneksi.php';

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    if($password === $confirm){
        $insert = "INSERT INTO admin (username,password) VALUES ('$username','$password')";
        $query = mysqli_query($conn, $insert);
    if($query){
        ?>
        <script>
        alert('Registrasi berhasil');
        </script>
        <?php
    }else{
        ?>
            <script>
                alert('Registrasi gagal');
            </script>
            <?php
        }
    }else{
        ?>
            <script>
                alert('Password tidak cocok');
            </script>
            <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="box">
    <span class="borderLine"></span>
        <form action="signup.php" method="post">
            <h2>Sign Up</h2>
            <div class="inputBox">
                <input type="text" name="username" id="username" required>
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" id="password" required>
                <span>Password</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <span>Confirm Password</span>
                <i></i>
            </div>
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="Sign Up">
                <p>Do you have account?<b><a href="signin.php"> Sign In</a></b></p>
            </div>
        </form>
    </div>
</body>
</html>

