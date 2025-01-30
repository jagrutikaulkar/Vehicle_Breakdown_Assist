

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map with Shortest Path</title>
    <!-- Include Leaflet CSS and JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Include Leaflet Routing Machine plugin for route calculation -->
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        form {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        img {
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php

// Replace 'your_database_credentials' with your actual database connection details
$servername = "localhost";
$username = "root";
$dbname = "vehicle_bk";

// Create connection
$conn = mysqli_connect($servername,$username,"",$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id= $_GET['id'];
if($id)
{
$sql = "SELECT * FROM customer_history where cust_id= '$id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $userLatitude = $row['lat'];
        $userLongitude = $row['lon'];
        $username= $row['name'];
        $mechLatitude = $row['mlat'];
        $mechLongitude = $row['mlon'];

        echo "<form class='container'>";
        echo "<div class='form-group'>";
        echo "<label>Customer Name : </label>  <span>" . $row["name"] . "</span>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label>Contact Number : </label>  <span>" . $row["mobile_no"] . "</span>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label>Email Address : </label>  <span>" . $row["email"] . "</span>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label>Vehicle Name : </label>  <span>" . $row["vehicle_name"] . "</span>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label>Vehicle Model : </label>  <span>" . $row["vehicle_model"] . "</span>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label>Problem description : </label>  <span>" . $row["prob_des"] . "</span>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label>Type of assistance : </label>  <span>" . $row["type_ass"] . "</span>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label>Request Time: </label>  <span>" . $row["request_date"] . "</span>";
        echo "</div>";
        echo '<div id="map" style="height: 400px;"></div>';
        echo "</form><br>";
    }
} else {
    echo "0 results";
}
}

$conn->close();

?>

<script>
// Initialize the map
var map = L.map('map').setView([<?php echo $userLatitude; ?>, <?php echo $userLongitude; ?>], 13);

// Add OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Add user marker to the map
var userMarker = L.marker([<?php echo $userLatitude; ?>, <?php echo $userLongitude; ?>]).addTo(map);
userMarker.bindPopup('<b>' + <?php echo json_encode($username); ?> + '</b>').openPopup();


// Add selected mechanic's marker to the map
var selectedMechanicMarker = L.marker([<?php echo $mechLatitude; ?>, <?php echo $mechLongitude; ?>]).addTo(map);
selectedMechanicMarker .bindPopup('<b>Mechanic Location</b>').openPopup();

// Add routing control with updated waypoints
L.Routing.control({
    waypoints: [
        L.latLng(<?php echo $userLatitude; ?>, <?php echo $userLongitude; ?>),
        L.latLng(<?php echo $mechLatitude; ?>, <?php echo $mechLongitude; ?>)
    ],
    routeWhileDragging: true
}).addTo(map);
</script>

</body>
</html>