<?php

$valid_username = "admin";
$valid_password = "admin123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password
    if ($username === $valid_username && $password === $valid_password) {
        // Set session variables
        $_SESSION['admin_logged_in'] = true;
        header("Location: admindashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        echo "<script>alert('Invalid username or password..');
        window.location.href = 'adminlogin.php';
        </script>";
    }
}
?>