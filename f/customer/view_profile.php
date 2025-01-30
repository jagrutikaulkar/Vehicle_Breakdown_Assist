
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Update Profile</title>
    <style>
        body {
           
            height: 120vh;
            font-family: Arial, sans-serif;
            background-image: url('12345.jpg');
             background-size: cover; 
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            color: white;
        }
    
        .update-profile {
            max-width: 600px;
            margin: 30px auto;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 50px rgba(0, 0, 0, 2);
            border-radius: 10px;
            padding: 30px;
           
        }
        .update-profile h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }
        .profile-pic {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            color: white;
        }
        .flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .inputBox {
            flex: 0 0 48%;
            
        }
        .inputBox span {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: white;
            font-family: Arial, sans-serif;
        }
        .boxa {
            font-family: "Arial", sans-serif;
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        
            
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
        font-family: Arial, sans-serif;
    }
        
         

    </style>
</head>

<body>
<nav class='navbar bg-dark'>
    <div class='col-sm-12 col-md-12 col-lg-12 col-12'>
        <a style='margin-left: 50%; color: white;' id='contact' class='nav-link' href='cust_dashboard.html'>HOME</a>
    </div>
</nav>
<br>
<br>

<div class="main"> 
<div class="update-profile">
    <h2>Update Profile</h2>
    <form action="update_cust_profile.php" method="post" enctype="multipart/form-data">
        
        <?php
        $conn = mysqli_connect('localhost','root', '', 'vehicle_bk');

    
    if (mysqli_connect_error())
     {
        die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        $cust_id=$_SESSION['cust_id'];
        $sql = "SELECT * FROM customer_profile where cust_id= '$cust_id'";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $fetch = mysqli_fetch_assoc($result);
            } else {
                
                echo "<script>alert('Profile is not created..'); 
                window.location.href='cust_profile.html';</script>";
                
            }
        } 
        
    }    
        mysqli_close($conn);
     ?>
        <img src="get_image.php" name="update_image" class="profile-pic" alt=" ">
          <div class="flex">
            <div class="inputBox">
                <span>Name:</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="boxa" pattern="[A-Za-z\s]+" title="Please enter a valid name (alphabet characters only)" required>
                <span>Email:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="boxa" required>
                <span>Update Your Picture:</span>
                <input type="file" name="update_image"  id="update_image" accept="image/jpg, image/jpeg, image/png" class="boxa" onchange="previewImage(this);" required>
                
            </div>
            <div class="inputBox">
                <span>Mobile number:</span>
                <input type="tel" name="update_mobile" pattern="[0-9]{10}"  value="<?php echo $fetch['mobileno']; ?>" class="boxa" pattern="[0-9]{10}" title="Please enter a valid phone number" required>
                <span>Username:</span>
                <input type="text" name="update_user" value="<?php echo $fetch['username']; ?>" class="boxa" required>
                <span>Password:</span>
                <input type="text" name="update_pass" value="<?php echo $fetch['password']; ?>" class="boxa" required>
            </div>
        </div>
        <input type="submit" value="Update Profile" name="update_profile" class="btn">
        <a href="cust_profile.html" class="delete-btn">Go Back</a>
    </form>
</div>
</div>

</body>

</html>
