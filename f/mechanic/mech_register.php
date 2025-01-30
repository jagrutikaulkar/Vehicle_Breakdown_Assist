<?php
$username= $_POST['username'];
$email= $_POST['email'];
$pass = $_POST['password1'];
$cpass=$_POST['password2'];


$conn = mysqli_connect('localhost','root','','vehicle_bk');
if($conn->connect_error)
{
	die('Connection Failed...'.$conn->connect_error);
}
else
{
$select = mysqli_query($conn, "SELECT * FROM mechanic_register WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0)
   {
      echo"
        <script>
        alert('User already exist');
        window.location.href='mech_login.html';
        </script> ";
   }
   else
      {
         $insert = mysqli_query($conn, "INSERT INTO mechanic_register(username, email, password) VALUES('$username', '$email', '$pass')") or die('query failed');

         if($insert){
            echo"
            <script>
            alert('Registered successfully');
            window.location.href='mech_login.html';
            </script> ";
         }else{
            echo"
            <script>
            alert('Registeration Failed');
            window.location.href='meach_register.html';
            </script> ";
         }
      }   
}
?>
