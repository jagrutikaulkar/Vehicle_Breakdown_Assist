<?php
$username= $_POST['username'];
$email= $_POST['email'];
$pass = $_POST['password1'];
$cpass=$_POST['password2'];


$conn = mysqli_connect('localhost','root','','mainproject');
if($conn->connect_error)
{
	die('Connection Failed...'.$conn->connect_error);
}
else
{
$select = mysqli_query($conn, "SELECT * FROM register WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0)
   {
      echo"
        <script>
        alert('User already exist');
        </script> ";
      header('location:register.php');
        
   }
   else
      {
         $insert = mysqli_query($conn, "INSERT INTO register(username, email, password) VALUES('$username', '$email', '$pass')") or die('query failed');

         if($insert){
            echo"
            <script>
            alert('Registered successfully');
            </script> ";
            header('location:login.php');
         }else{
            echo"
            <script>
            alert('Registeration Failed');
            </script> ";
            header('location:register.php');
         }
      }
   
   
}

?>