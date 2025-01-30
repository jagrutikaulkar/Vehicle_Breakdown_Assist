<?php
 session_start();

 if(!isset($_SESSION['username']))
    {
        echo"session not set";
        exit();
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            background-image: url('b.jpeg');
            background-size: cover; 
        }

        header {
            background-color: #f0f0f0;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
            padding: 20px;
            margin: 20px;
            text-align: center;
            width: 300px;
        }

        h1, h2 {
            color: #ce3333;
        }

        p {
            color: #666;
        }

        button {
            padding: 12px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .icon {
            font-size: 24px;
            color: #3498db;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Mechanic Dashboard</h1>
    </header>

    <main>
        <div class="card">
            <i class="fas fa-user-circle icon"></i>
            <h2>Welcome <?php echo $_SESSION['username']; ?>!</h2>
            <p>Create your new Business here for active breakdown assistance.</p>
           
            <button onclick="location.href='create_Business.html'">Create new Business</button>
            
        </div>

        <div class="card">
            <i class="fas fa-wrench icon"></i>
            <h2>Active Jobs</h2>
            <p>See and manage your currently active breakdown assistance jobs.</p>
            <button onclick="location.href='update_business.php'">Update Business</button>
        </div>

        <div class="card">
            <i class="fas fa-history icon"></i>
            <h2>Job History</h2>
            <p>Review your completed breakdown assistance jobs and their details.</p>
            <button onclick="location.href='job_history.html'">View Job History</button>
        </div>

        <div class="card">
            <i class="fas fa-id-card icon"></i>
            <h2>Profile</h2>
            <p>Manage your profile information and update your details.</p>
            <a href="mechanic_profile.html">
            <button name="Mechanic_profile">Edit Profile</button>
            </a>
        </div>

        <div class="card">
            <i class="fas fa-bell icon"></i>
            <h2>Notifications</h2>
            <p>Stay informed about new service requests and updates.</p>
            <button onclick="location.href='notifications.html'">View Notifications</button>
        </div>

    </main>

</body>
</html>
