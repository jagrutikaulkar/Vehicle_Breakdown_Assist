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

  $query="select * from customer_register where username ='$username' and password='$password'";
  $result=$conn->query($query);

  if($result->num_rows == 1)
  {
    $row=$result->fetch_assoc();
     $_SESSION['cust_id']=$row['id'];
     $_SESSION['username']=$username;
     echo"
    <script>
    alert('Login successfully');
    window.location.href='cust_dashboard.html';
    </script> ";
     
  }
  else
  {
    echo"
    <script>
    alert('Invalid username or password....');
    window.location.href='cust_login.html';
    </script> ";
   
  }
}

?>