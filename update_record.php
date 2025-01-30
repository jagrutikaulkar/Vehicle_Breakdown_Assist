<?php
session_start();

if (!isset($_SESSION['mechanic_id'])) {
    header("Location: login.php");
    exit();
}

$mid = $_SESSION['mechanic_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["Name"];
    $location = $_POST["location"];
    $services = $_POST["services"];
    $mobile_no = $_POST["mobile_no"];
    $whatsapp_no = $_POST["whatsapp_no"];
    $email = $_POST["email"];

    // Validate and update the record in the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mainproject";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE mechanic_business SET
            mechanic_name = '$name',
            location = '$location',
            services = '$services',
            mobile_no = '$mobile_no',
            whatsapp_no = '$whatsapp_no',
            email = '$email'
            WHERE id = $mid";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: view_records.php");
    exit();
}
?>