<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    // Construct email message
    $to = "jagrutikaulkar0@gmail.com"; 
    $subject = "Contact Form Submission";
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n\n";
    $body .= "Message:\n$message";
    
    // Send email
    if (mail($to, $subject, $body)) {
       
        echo "<script>alert('Thank you for contacting us. We will get back to you shortly.');
        window.location.href = 'cust_dashboard.html';
    </script>";

    } else {
   
        echo "<script>alert('Oops! Something went wrong. Please try again later.');
        window.location.href = 'contact.html';
    </script>";
   
    }
} else {
    header("Location: contact.html");
    exit;
}
?>
