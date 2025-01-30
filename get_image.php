<?php
$conn = mysqli_connect('localhost','root', '', 'vehicle_bk');

    
if (mysqli_connect_error())
 {
    die("Connection failed: " . mysqli_connect_error());
}
else{
// Fetch image data from the database
$sql = "SELECT photo FROM adminpro"; // Assuming the image you want to fetch has id = 1
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imageData = $row['photo'];

    // Output the image content
    header("Content-type: image/jpeg"); // Set appropriate image content type
    echo $imageData;
} else
{
    echo "Image not found.";
}

mysqli_close($conn);
}
?>
