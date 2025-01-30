<?php
session_start();
$conn = mysqli_connect('localhost','root','','mainproject');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

else 
 {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query="select * from register where username ='$username' and password='$password'";
  $result=$conn->query($query);

  if($result->num_rows == 1)
  {
    $row=$result->fetch_assoc();
     $_SESSION['mechanic_id']=$row['Id'];
     $_SESSION['username']=$username;
     echo"
    <script>
    alert('Login successfully');
    </script> ";
     header("location:index.php");
     exit();
  }
  else
  {
    echo"
    <script>
    alert('Invalid username or password....');
    </script> ";
   
  }
}

?>