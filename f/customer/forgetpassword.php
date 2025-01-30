
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email address from the form
    $to = $_POST['email'];

    // Check if the entered email exists in your database (replace this with your database connection and query)
    $email_exists = checkEmailExists($to);

    if ($email_exists) {
        // Generate a verification code (you can implement your own logic for this)
        $verification_code = generateVerificationCode();

        // Store the verification code in session
        session_start();
        $_SESSION['verification_code'] = $verification_code;
        $_SESSION['email'] = $to;

        // Subject of the email
        $subject = "Password Reset Verification Code";

        // Message body of the email
        $message = "Welcome to Vehicle Breakdown Assistance"."\r\n\n".
        "Your verification code is: $verification_code";

        // Additional headers
        $headers = "From: jagrutikaulkar0@gmail.com" . "\r\n" .
                   "Reply-To: jagrutikaulkar0@gmail.com" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            // Display JavaScript pop-up with verification code input field
            echo "<script>
                    var code = prompt('Enter the verification code sent to your email:');
                    if (code === '$verification_code') {
                        window.location.href = 'reset_password.html';
                    } else {
                        alert('Invalid verification code. Please try again.');
                        window.location.href='forgetpassword.html';
                    }
                 </script>";
        } else {
         echo"<script>
            alert('Error in sending Email..!');
            window.location.href='forgetpassword.html';
         </script>";
        }
    } else {
        echo"<script>
              alert('Email not matched with existing Email..!');
              window.location.href='forgetpassword.html';
        </script>";
    }
}

function checkEmailExists($email) {
    // Database connection parameters
    $servername = "localhost";  
    $username = "root";        
    $dbname = "vehicle_bk";

    // Create connection
    $conn = new mysqli($servername, $username,"", $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM customer_register WHERE email=?");
    $stmt->bind_param("s", $email);

    // Execute SQL statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if email exists
    if ($result->num_rows > 0) {
        // Email exists
        $conn->close();
        return true;
    } else {
        // Email does not exist
        $conn->close();
        return false;
    }
}



// Function to generate a random verification code
function generateVerificationCode() {
    // Generate a random string (you can adjust the length as needed)
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $verification_code = '';
    $code_length = 6; // Adjust the length of the code if needed
    for ($i = 0; $i < $code_length; $i++) {
        $verification_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $verification_code;
}
?>
