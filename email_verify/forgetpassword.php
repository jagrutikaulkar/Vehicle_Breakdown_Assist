
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendemail($email,$v_code)
{
    require("phpmailer/src/PHPMailer.php");
    require("phpmailer/src/SMTP.php");
    require("Phpmailer/src/Exception.php");
    
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'jagrutikaulkar0@gmail.com';                     //SMTP username
        $mail->Password   = 'orlpmbivmfefmoos3';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('jagrutikaulkar0@gmail.com', 'Road assistemce');
        $mail->addAddress($email);     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification from vehicle breakdown Assistence';
        $mail->Body    = "In ordered to keep your emila secure verify that it's you !Click the link below to verify the email address<a href='http://localhost/email_verify/verify.php?email=$email&v_code=$v_code'>Vefify</a>";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }


}

if(isset($_POST['email']))
{
    $email=$_POST['email'];
    $v_code=bin2hex(random_bytes(16));

    if(sendemail($email,$v_code))
    {
        echo"
        <script>
        alert('Email sent,verify the emil to ensure it's you');
        document.location.href='reset_password.html';
        </script> ";
        
    }
    else
    {
        echo"
        <script>
        alert('Cannot run query');
        window.location.href='reset_password.html';
      
        </script> 
        ";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- Custom CSS -->
        <style>
            body {
        background-color: #eee6e6;
    }
    
    .container {
        max-width: 600px;
    }
    
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background-color: #5f95b9;
        color: white;
        text-align: center;
    }
    
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
        </style>
</head>
<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Forgot Password</h3>
            </div>
            <div class="card-body">
                <form action="forgetpassword.php" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>

                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>