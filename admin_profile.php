<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    
    <link rel="stylesheet" href="adminstyle.css">
    <script src="adminscript.js"></script>
    <style>
        body {
            background: linear-gradient(45deg, #23034d, #df1c87);
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            
        }
    
        .update-profile {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .update-profile h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
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
            color: #ff0000;
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
            color: #666;
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
 	
<?php include 'adminheader.php'; ?>
<?php include 'adminmain.php'; ?>

<div class="main"> 
<div class="update-profile">
    <h2>Update Profile</h2>
    <form action="update_admin_profile.php" method="post" enctype="multipart/form-data">
        
        <?php
        $conn = mysqli_connect('localhost','root', '', 'vehicle_bk');

    
    if (mysqli_connect_error())
     {
        die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        
        $sql = "SELECT * FROM adminpro";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $fetch = mysqli_fetch_assoc($result);
            } else {
                
                echo "No data found.";
            }
        } 
        
    }    
        mysqli_close($conn);
     ?>
        <img src="get_image.php" name="update_image" class="profile-pic" alt="Admin Profile Picture">
          <div class="flex">
            <div class="inputBox">
                <span>Name:</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="boxa" pattern="[A-Za-z\s]+" title="Please enter a valid name (alphabet characters only)" required>
                <span>Email:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="boxa" required>
                <span>Update Your Picture:</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="boxa" required>
            </div>
            <div class="inputBox">
                <span>Mobile number:</span>
                <input type="text" name="update_mobile" value="<?php echo $fetch['mobileno']; ?>" class="boxa" pattern="[0-9]{10}" title="Please enter a valid phone number" required>
                <span>Username:</span>
                <input type="text" name="update_user" value="<?php echo $fetch['username']; ?>" class="boxa" required>
                <span>Password:</span>
                <input type="password" name="update_pass" value="<?php echo $fetch['password']; ?>" class="boxa" required>
            </div>
        </div>
        <input type="submit" value="Update Profile" name="update_profile" class="btn">
        <a href="admindashboard.php" class="delete-btn">Go Back</a>
    </form>
</div>
</div>

</body>
</html>
