<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $new_password = $_POST["password1"];
    $re_entered_password = $_POST["password2"];

    
    if ($new_password !== $re_entered_password) {
        echo "<script>alert('Password not matched...');
        window.location.href = 'reset_password.html';
        </script>";
    } else 
    {
        $servername = "localhost";
        $username = "root";
        $dbname = "vehicle_bk";
        $email=$_SESSION['email'];
       
        $conn = new mysqli($servername, $username,"", $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else{
        
          $sql = "UPDATE mechanic_register SET password='$new_password' WHERE email='$email'";
        
                if ($conn->query($sql) === TRUE) 
                {
                    echo "<script>alert('Password Updated Successfully...');
                    window.location.href = 'mech_login.html';
                    </script>";
                } else 
                {
                    echo "<script>alert('Error in Updating the password...');
                    window.location.href = 'mech_password.html';
                    </script>";
                }
            }
        
        $conn->close();
    }
}
?>