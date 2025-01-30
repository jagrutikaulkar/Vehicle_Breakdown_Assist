<?php
session_start();
$conn = mysqli_connect('localhost','root','','vehicle_bk');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else 
 {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query="select * from mechanic_register where username ='$username' and password='$password'";
  $result=$conn->query($query);

  if($result->num_rows == 1)
  {
    $row=$result->fetch_assoc();
     $_SESSION['mech_id']=$row['id'];
     $_SESSION['username']=$username;
     echo"
    <script>
    alert('Login successfully');
    window.location.href='mech_dashboard.php';
    </script> ";     
  }
  else
  {
    echo"
    <script>
    alert('Invalid username or password....');
    window.location.href='mech_login.html';
    </script> "; 
  }
}
?>