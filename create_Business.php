<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $mechanicName = $_POST["Name"];
    $location = $_POST["location"];
    $services = $_POST["services"];
    $mobileNo = $_POST["mobile_no"];
    $whatsappNo = $_POST["whatsapp_no"];
    $email = $_POST["email"];
    if(!isset($_SESSION['mechanic_id']))
    {
        echo "<script>alert('session not set...');
                    window.location.href = 'mech_signinup.html';
                    </script>";
    }
   else
   {
       $mid=$_SESSION['mechanic_id'];
        // Create connection
         $conn = mysqli_connect('localhost', 'root', '','mainproject');

          // Check connection
           if ($conn->connect_error)
         {
            die("Connection failed: " . $conn->connect_error);
         }
         else
        {
            $select = mysqli_query($conn, "SELECT * FROM mechanic_business WHERE Id=$mid") or die('query failed');

                    if(mysqli_num_rows($select) > 0)
                       {
                           echo"
                              <script>
                               alert('Business Account already Created');
                               window.location.href='update_business.php'
                             </script> ";
                            
        
                        }
                       else
                       {
    

                            $sql = "INSERT INTO mechanic_business (id,mechanic_name, location, services, mobile_no, whatsapp_no, email)
                             VALUES ('$mid','$mechanicName', '$location', '$services', '$mobileNo', '$whatsappNo', '$email')";

                            if (mysqli_query($conn,$sql) === TRUE) 
                            {
                                echo"
                              <script>
                               alert('Business Account created Successfully...');
                               window.location.href='index.php'
                              </script> ";
                            }
                                   
                            else 
                                 echo "Error: " . $sql . "<br>" . $conn->error;
                         }
         }

    // Close connection
    mysqli_close($conn);
 }
}
else 
{
    echo"
         <script>
        alert('Invalid request');
       window.location.href='index.php'
       </script> ";
}
?>