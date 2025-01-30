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
</head>
<body>

<?php
// Database connection
$con = new mysqli("localhost", "root", "", "vehicle_bk");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user location from cookies
$userLatitude = isset($_COOKIE['userLatitude']) ? $_COOKIE['userLatitude'] : 0;
$userLongitude = isset($_COOKIE['userLongitude']) ? $_COOKIE['userLongitude'] : 0;

// Get selected mechanic's ID from the URL
$selectedMechanicID = isset($_GET['id']) ? $_GET['id'] : 0;

// Query selected mechanic's location from the database
$sql = "SELECT mech_id, fullname, lat, lon FROM mechanic_business WHERE mech_id = $selectedMechanicID";
$result = mysqli_query($con, $sql);

// Check if the mechanic was found
if ($row = mysqli_fetch_assoc($result)) {
    $selectedMechanic = $row;

    // Display the map
    echo '<div id="map" style="height: 500px;"></div>';

    // Close the database connection
    mysqli_close($con);
} else {
    echo "Mechanic not found.";
    // Close the database connection
    mysqli_close($con);
    exit; // Stop execution if the mechanic is not found
}
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
userMarker.bindPopup('<b>Your Location</b>').openPopup();

// Add selected mechanic's marker to the map
var selectedMechanicMarker = L.marker([<?php echo $selectedMechanic['lat']; ?>, <?php echo $selectedMechanic['lon']; ?>]).addTo(map);
selectedMechanicMarker.bindPopup('<b>' + <?php echo json_encode($selectedMechanic['fullname']); ?> + '</b>').openPopup();

// Add routing control with updated waypoints
L.Routing.control({
    waypoints: [
        L.latLng(<?php echo $userLatitude; ?>, <?php echo $userLongitude; ?>),
        L.latLng(<?php echo $selectedMechanic['lat']; ?>, <?php echo $selectedMechanic['lon']; ?>)
    ],
    routeWhileDragging: true
}).addTo(map);
</script>

</body>
</html>
