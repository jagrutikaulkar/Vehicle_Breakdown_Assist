<?php
session_start();

// Sanitize mechanicId
$mechanicId = isset($_SESSION['mechanicId']) ? intval($_SESSION['mechanicId']) : null;

if ($mechanicId === null) {
    
    exit("Mechanic ID not found.");
}

$email = $_GET['email'];
$subject = $_GET['subject'];
$message = $_GET['message'];
$headers='VEHICLE BREAKDOWN ASSISTANCE';

if (mail($email, $subject, $message, $headers)) {

    echo"
    <script>
    alert('Email successfully sent to $email...');
    window.location.href = `display_mechanic_profile.php?id=$mechanicId`;
            
    </script> ";
     
} else {
    echo "<script>
    alert('Error in sending email');
    window.location.href = `display_mechanic_profile.php?id=$mechanicId`;
            
    </script> ";
}

?>
