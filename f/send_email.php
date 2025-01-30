<?php

$from_email = $_POST['email'];
$to_email = 'jagrutikaulkar0@gmail.com';
$cust = $_POST['name'];
$body = $_POST['message'];

// Email content
$subject = "Message from $cust";
$headers = "From: Vehicle Breakdown Assistance <$from_email>\r\n";
$headers .= "Reply-To: $from_email\r\n"; // Add Reply-To header
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n"; 
$email_title = "Vehicle Breakdown Assistance Request";

// Construct the email body
$email_body = "
<!DOCTYPE html>
<html>
<head>
    <title>$email_title</title>
</head>
<body>
    <h1>$email_title</h1>
    <p><strong>Name:</strong> $cust</p>
    <p><strong>Email:</strong> $from_email</p>
    <p><strong>Message:</strong> $body</p>
</body>
</html>
";

// Send the email
if (mail($to_email, $subject, $email_body, $headers)) {
    echo "<script>
    alert('Message sent! We will get back to you as soon as possible.');
    window.location.href='index.html';
    </script>";

} else {
    echo "<script>
    alert('Error in sending Message! Please try again...');
    window.location.href='index.html';
    </script>";
}
?>
