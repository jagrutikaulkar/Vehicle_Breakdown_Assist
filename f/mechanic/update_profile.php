<?php
session_start();
$mech_id = $_SESSION['mech_id'];

$conn = mysqli_connect('localhost', 'root', '', 'vehicle_bk');

if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Check if profile already exists
    $check_sql = "SELECT * FROM mechanic_profile WHERE mech_id = '$mech_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Profile already exists, display message
        echo "<script>alert('Profile already exists.'); 
        window.location.href='mechanic_profile.html';</script>";
    } else {
        // Profile doesn't exist, proceed with insertion
        if (isset($_POST['save_profile'])) { 
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile_no = $_POST['mobile_no'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $image_path = $_FILES['image']['tmp_name']; // Temporary file path of the uploaded image

            // Read image data
            $image_data = file_get_contents($image_path);

            // Escape special characters in the image data
            $escaped_image_data = mysqli_real_escape_string($conn, $image_data);

            $insert_sql = "INSERT INTO mechanic_profile (mech_id, name, mobile_no, email, username, password,image) 
            VALUES ('$mech_id', '$name', '$mobile_no', '$email', '$username', '$password', '$escaped_image_data')";

            if (mysqli_query($conn, $insert_sql)) {
                echo "<script>alert('Profile saved successfully.'); 
                window.location.href='mechanic_profile.html';</script>";
            } else {
                echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }
}
?>
