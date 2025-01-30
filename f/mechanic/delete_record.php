<?php
session_start();

if (!isset($_SESSION['mech_id'])) {
    header("Location: mech_login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $mid = $_POST["id"];

    // Validate and delete the record from the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vehicle_bk";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM mechanic_business WHERE mech_id = $mid";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Record deleted successfully');
                window.location.href='mech_dashboard.php';
              </script> ";
    } else {
        echo "<script>
                alert('Error in deleting record..');
                window.location.href='mech_dashboard.php';
              </script> ";

    }

    mysqli_close($conn);
} else {
    header("Location: mech_dashboard.php");
    exit();
}
?>