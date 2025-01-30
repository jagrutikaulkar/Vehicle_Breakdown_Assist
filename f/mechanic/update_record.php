<?php
session_start();

if (!isset($_SESSION['mech_id'])) {
    header("Location: mech_login.html");
    exit();
}

$mid = $_SESSION['mech_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $whatsappno = $_POST['whatsapp_no'];
    $servicetype = $_POST['expertise'];
    $loc_words = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Validate and update the record in the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vehicle_bk";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE mechanic_business SET
            fullname = '$name',
            email = '$email',
            phone_no = '$phone',
            whatsapp_no = '$whatsappno',
            area_ex = '$servicetype',
            shop_location='$loc_words',
            lat='$latitude',
            lon='$longitude'
            WHERE mech_id = $mid";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Record updated successfully');
                window.location.href='update_business.php';
              </script> ";
    } else {
        echo "<script>
                alert('Error updating record..');
                window.location.href='update_business.php';
              </script> ";

    }

    mysqli_close($conn);
} else {
    header("Location: mech_dashboard.php");
    exit();
}
?>