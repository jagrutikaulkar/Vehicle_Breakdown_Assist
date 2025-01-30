<?php
    $uLat = isset($_POST['lat']) ? $_POST['lat'] : null;
    $uLng = isset($_POST['lng']) ? $_POST['lng'] : null;

    setcookie("userLatitude",$uLat,time()+84600, "/");
    setcookie("userLongitude",$uLng,time()+84600, "/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-image: url('cust3.jpg');
             background-size: cover; 
             min-height: 100vh;
              color: #333;
              
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        #location-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           
        }

        .mechanic-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 50px rgba(0, 0, 0, 2);
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            cursor: pointer;
            color:white;
        }

        .mechanic-item:hover {
            background-color: #f0f2f5;
            color:black;
        }

        .mechanic-details, .mechanic-distance {
            margin-right: auto;
        }

        .show-on-map-btn {
            margin-left: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .show-on-map-btn:hover {
            background-color: #0056b3;
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

    <div id="location-container">
        <h2 class="mb-4">Nearby Mechanics</h2>

        <div id="mechanics-list" class="mt-4">
            <?php

            // Retrieve user location from the POST super global
            $userLatitude = isset($_POST['lat']) ? $_POST['lat'] : null;
            $userLongitude = isset($_POST['lng']) ? $_POST['lng'] : null;

            setcookie("userLatitude",$userLatitude,time()+84600,"/");
            setcookie("userLongitude",$userLongitude,time()+84600,"/");
            
            // Fetch mechanics from the database
            $conn = mysqli_connect("localhost", "root", "", "vehicle_bk");
            $sql = "SELECT mech_id, fullname, lat, lon FROM mechanic_business";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch and calculate distance for each mechanic
                $mechanics = array();
                while ($row = $result->fetch_assoc()) {
                    $mechanicId = $row['mech_id'];
                    $mechanicName = $row['fullname'];
                    $mechanicLatitude = $row['lat'];
                    $mechanicLongitude = $row['lon'];

                    // Calculate distance using Haversine formula
                    $distance = haversineDistance($userLatitude, $userLongitude, $mechanicLatitude, $mechanicLongitude);

                    // Store mechanic details along with the calculated distance
                    $mechanics[] = array('mech_id' => $mechanicId, 'fullname' => $mechanicName, 'distance' => $distance);
                }

                // Sort mechanics by distance
                usort($mechanics, function ($a, $b) {
                    return $a['distance'] - $b['distance'];
                });

                // Display the sorted list of mechanics
                foreach ($mechanics as $mechanic) {
                    echo "<div class='mechanic-item' data-mechanic-id='{$mechanic['mech_id']}'>
                            <div>
                                <a href='javascript:void(0);' class='mechanic-details'>Mechanic ID: {$mechanic['mech_id']}<br> Name: {$mechanic['fullname']}</a>
                                <div class='mechanic-distance'>Distance: {$mechanic['distance']} km</div>
                            </div>
                            <button class='show-on-map-btn' data-mechanic-id='{$mechanic['mech_id']}'>Show on Map</button>
                          </div>";
                }
                
            } else {
                echo "No mechanics found in the database.";
            }

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
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Event listener for clicks on the mechanic-item div
        document.querySelectorAll('.mechanic-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const mechanicId = this.getAttribute('data-mechanic-id');
                window.location.href = `display_mechanic_profile.php?id=${mechanicId}`;
            });
        });

        // Event listener for clicks on the "Show on Map" buttons
        document.querySelectorAll('.show-on-map-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering the click event on the parent mechanic-item div
                const mechanicId = this.getAttribute('data-mechanic-id');
                window.location.href = `tp.php?id=${mechanicId}`;
            });
        });
    });
</script>


</body>
</html>