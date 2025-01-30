<?php
session_start();
$conn = mysqli_connect('localhost','root', '', 'vehicle_bk');

    
if (mysqli_connect_error())
 {
    die("Connection failed: " . mysqli_connect_error());
}
else{
$mech_id=$_SESSION['mech_id'];
$sql = "SELECT image FROM mechanic_profile where mech_id='$mech_id'"; 
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imageData = $row['image'];

   
    header("Content-type: image/jpeg"); 
    echo $imageData;
} else
{
    echo "Image not found.";
}

mysqli_close($conn);
}
?>
