<?php

$conn = mysqli_connect('localhost', 'root', '', 'vehicle_bk');

if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    if (isset($_POST['update_profile'])) {
        // Retrieve form data
        $update_name = $_POST['update_name'];
        $update_email = $_POST['update_email'];
        $update_mobile = $_POST['update_mobile'];
        $update_username = $_POST['update_user'];
        $update_password = $_POST['update_pass'];
        
        // Check if an image file was uploaded
        if (isset($_FILES['update_image']) && $_FILES['update_image']['error'] == UPLOAD_ERR_OK) {
            // Process uploaded image
            $image_data = file_get_contents($_FILES['update_image']['tmp_name']);
            $update_image = mysqli_real_escape_string($conn, $image_data);
        } else {
            // If no image was uploaded, retain the existing image data
            $update_image = $_POST['update_image'];
        }

        $sql = "UPDATE adminpro SET name='$update_name', email='$update_email', mobileno='$update_mobile', username='$update_username', password='$update_password', photo='$update_image'"; 
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Profile updated successfully.'); 
            window.location.href='admin_profile.php';</script>";
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
