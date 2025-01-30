<?php
session_start();

if (!isset($_SESSION['mechanic_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve mechanic ID from the form
    $mid = $_POST["id"];

    // Validate and delete the record from the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mainproject";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM mechanic_business WHERE id = $mid";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: view_records.php");
    exit();
}
?>