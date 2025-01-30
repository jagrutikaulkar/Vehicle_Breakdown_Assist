<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Profile</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body  {    
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-image: url('cust3.jpg');
             background-size: cover; 
            min-height: 100vh;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            
              
        }
        #profile-container {
            justify-content: 50px;
            text-align: center;
            padding: 20px 80px;
            border-radius: 8px;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 50px rgba(0, 0, 0, 2);
            
            max-width: 500px;
            width: 100%;
            
            
        }

        .profile-details {
            font-size: 16px;
            margin-bottom: 10px;
            padding: 8px;
            background-color: #f5f5f5;
            border-radius: 4px;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        #request-assistance-btn {
            background-color: #3494e6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #emailModal {
            text-align: left;
        }

        #emailModal .modal-content {
            border-radius: 10px;
        }

        #emailModal .modal-header {
            border-bottom: none;
            background-color: #3494e6;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        #emailModal .modal-title {
            margin: 0;
            padding: 20px;
            font-size: 24px;
        }

        #emailModal .modal-body {
            padding: 20px;
        }

        #emailModal .modal-footer {
            border-top: none;
            background-color: #f5f5f5;
            border-radius: 0 0 10px 10px;
        }

        #emailForm label {
            color: #3494e6;
            margin-bottom: 5px;
        }

        #emailForm input[type="text"],
        #emailForm textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #emailForm button[type="submit"] {
            background-color: #3494e6;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #emailForm button[type="submit"]:hover {
            background-color: #2674a7;
        }
        
    </style>
</head>
<body>

<div id="profile-container">
    <h2 class="mb-4">Mechanic Profile</h2>
 
    <?php
    $conn = mysqli_connect("localhost", "root", "", "vehicle_bk");

    // Retrieve mechanic ID from the GET super global
    $mechanicId = isset($_GET['id']) ? $_GET['id'] : null;

    if ($mechanicId) {
        // Fetch mechanic details from the database
        $sql = "SELECT * FROM mechanic_business WHERE mech_id = $mechanicId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $mechanic = $result->fetch_assoc();

            $_SESSION['mechanicId']=$mechanicId;
            // Retrieve user's latitude and longitude from the cookie
            $userLatitude = isset($_COOKIE['userLatitude']) ? $_COOKIE['userLatitude'] : null;
            $userLongitude = isset($_COOKIE['userLongitude']) ? $_COOKIE['userLongitude'] : null;

            $mechLatitude = $mechanic['lat'];
            $mechLongitude = $mechanic['lon'];

            setcookie("mechLatitude",$mechLatitude,time()+84600,"/");
            setcookie("mechLongitude",$mechLongitude,time()+84600,"/");

            if ($userLatitude !== null && $userLongitude !== null) {
                // Calculate distance using Haversine formula
                $distance = haversineDistance($userLatitude, $userLongitude, $mechanic['lat'], $mechanic['lon']);
                
                $_SESSION['mech_id'] = $mechanicId;

                echo "<div class='profile-details'>Mechanic ID: {$mechanic['mech_id']}</div>";
                echo "<div class='profile-details'>Name: {$mechanic['fullname']}</div>";
                echo "<div class='profile-details'>Expert in: {$mechanic['area_ex']}</div>";
                echo "<div class='profile-details'>Distance from you: " . number_format($distance, 2) . " km</div>";
            
                echo "<div class='profile-details'><a id='whatsappLink' href='#'><img src='wt.jpg' alt='WhatsApp Icon' width='50' height='50' onclick='sendWhatsApp(\"{$mechanic['phone_no']}\")'></a>";
                echo "<img src='el.png' id='sendEmail' alt='Email Icon' width='50' height='50' onclick='openEmailModal(\"{$mechanic['email']}\")'>";
                echo "<a href='tel:+{$mechanic['phone_no']}'><img src='call.jpg' alt='Phone Icon' width='50' height='50'></a></div>";
            } else {
                echo "User location not found in the cookie.";
            }
        } else {
            echo "Mechanic not found in the database.";
        }
    } else {
        echo "Invalid mechanic ID.";
    }

    // Close the database connection
    $conn->close();

    // Function to calculate distance using Haversine formula
    function haversineDistance($lat1, $lon1, $lat2, $lon2) {
        $R = 6371; // Earth radius in kilometers

        $dlat = deg2rad($lat2 - $lat1);
        $dlon = deg2rad($lon2 - $lon1);

        $a = sin($dlat / 2) * sin($dlat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c;

        return $distance;
    }
    ?>
    <br>
    <br>
    <button id="request-assistance-btn" onclick="location.href= 'get_assistance.html'">Request Assistance</button>
</div>

<!-- Email Modal -->
<div id="emailModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="emailForm">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" class="form-control" required>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" class="form-control" required></textarea><br>

                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   
    function sendWhatsApp(phoneNumber) {
        var dynamicNumber = phoneNumber;

        // Construct the WhatsApp link with the phone number
        var whatsappLink = "https://wa.me/91" + dynamicNumber;

        // Open the WhatsApp link in a new tab
        window.open(whatsappLink, '_blank');
    }




    function openEmailModal(email) {
    document.getElementById('emailForm').reset();
    document.getElementById('emailForm').setAttribute('data-email', email);
    $('#emailModal').modal('show');
}

document.getElementById('emailForm').addEventListener('submit', function (e) {
    e.preventDefault();
    var email = this.getAttribute('data-email');
    var subject = document.getElementById('subject').value;
    var message = document.getElementById('message').value;

    // Make a form submission to PHP script to send email
    document.getElementById('emailForm').action = 'send_email.php?email=' + email + '&subject=' + subject + '&message=' + message;
    document.getElementById('emailForm').method = 'post';
    document.getElementById('emailForm').submit();
});
</script>

</body>
</html>
