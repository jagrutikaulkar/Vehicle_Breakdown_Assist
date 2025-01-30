<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password set for root in your local environment
$dbname = "vehicle_bk";

if (!isset($_SESSION['mech_id'])) {
    echo "<script>
            alert('Session not set..');
            window.location.href='mech_dashboard.php';
           </script> ";
} else {
    $mid = $_SESSION['mech_id'];

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve selected record
    $sql = "SELECT * FROM mechanic_business WHERE mech_id = $mid";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Display the record in a form-like format
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mechanic Registration Form</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
            <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    background-image: url('b.jpeg');
                    background-size: cover;
                }

                .header {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 20px;
                    background-color: #333;
                    color: white;
                }

                .header h1 {
                    text-align: center;
                    margin: 0;
                }

                .back-button {
                    background-color: #0056b3;
                    color: white;
                    padding: 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                .container {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    max-width: 500px;
                    margin: 20px auto;
                }

                h2 {
                    text-align: center;
                    margin-top: 0;
                }

                form {
                    display: flex;
                    flex-direction: column;
                }

                label {
                    margin-top: 10px;
                    font-weight: bold;
                }

                input,
                select,
                #map {
                    padding: 10px;
                    margin-top: 5px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    font-size: 16px;
                }

                #map {
                    height: 300px;
                    margin-bottom: 10px;
                }

                .error-message {
                    color: red;
                    margin-top: 5px;
                    font-size: 14px;
                }

                button[type="submit"] {
                    margin-top: 20px;
                    padding: 10px;
                    background-color: #0056b3;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                    transition: background-color 0.3s;
                }

                button[type="submit"]:hover {
                    background-color: #004494;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <button class="back-button" onclick="window.history.back();">Back</button>
                <h1>Vehicle Breakdown Assistance</h1>
                <div style="width: 48px;"></div>
            </div>
            <div class="container">
                <h2>Create Business Account</h2>
                <form action="update_record.php" method="POST" onsubmit="return validateForm()">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" value='<?php echo $row['fullname']; ?>' pattern="[A-Za-z\s]+" title="Please enter a valid name (alphabet characters only)" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value='<?php echo $row['email']; ?>' required>

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" pattern="[0-9]{10}"  name="phone" value='<?php echo $row['phone_no']; ?>' pattern="[0-9]{10}" title="Please enter a valid phone number" required>

                    <label for="whatsapp_no">Whatsapp Number:</label>
                    <input type="tel" id="whatsapp_no" pattern="[0-9]{10}" name="whatsapp_no" value='<?php echo $row['whatsapp_no']; ?>' pattern="[0-9]{10}" title="Please enter a valid phone number" required>

                    <label for="expertise">Area of Expertise:</label>
                    <select id="expertise" name="expertise">
                        <option value="general" <?php if ($row['area_ex'] == 'general') echo 'selected'; ?>>General</option>
                        <option value="engine" <?php if ($row['area_ex'] == 'engine') echo 'selected'; ?>>Engine Repair</option>
                        <option value="electrical" <?php if ($row['area_ex'] == 'electrical') echo 'selected'; ?>>Electrical Systems</option>
                        <option value="transmission" <?php if ($row['area_ex'] == 'transmission') echo 'selected'; ?>>Transmission</option>
                        <option value="tires" <?php if ($row['area_ex'] == 'tires') echo 'selected'; ?>>Tires and Wheels</option>
                        <option value="other" <?php if ($row['area_ex'] == 'other') echo 'selected'; ?>>Other</option>
                    </select>

                    <label for="location">Enter Shop Location in text:</label>
                    <input type="text" id="location" name="location" value='<?php echo $row['shop_location']; ?>' required>
                    <span class="error-message" id="error-location"></span>

                    <label for="location">Shop Location:</label>
                    <div id="map"></div>
                    <input type="hidden" id="lat" name="latitude" value='<?php echo $row['lat']; ?>'>
                    <input type="hidden" id="lng" name="longitude" value='<?php echo $row['lon']; ?>'>
                    <button type="button" onclick="getCurrentLocation()">Show My Location</button>

                    <div class="error-message" id="error-message"></div>
                    <button type="submit">Update Business</button>
                </form>
                <form action='delete_record.php' method='post'>
                    <input type='hidden' name='id' value='<?php echo $row['mech_id']; ?>'>
                    <button type='submit'>Delete Business</button>
                </form>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
            <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
            <script>
                var map = L.map('map').setView([<?php echo $row['lat']; ?>, <?php echo $row['lon']; ?>], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                var marker;

                function updateMarker(lat, lng) {
                    if (marker) {
                        marker.setLatLng([lat, lng]);
                    } else {
                        marker = L.marker([lat, lng], { draggable: true }).addTo(map);
                        marker.on('dragend', function (e) {
                            var coords = e.target.getLatLng();
                            document.getElementById('lat').value = coords.lat;
                            document.getElementById('lng').value = coords.lng;
                        });
                    }
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                    map.panTo([lat, lng]);
                }

                var geocoder = L.Control.Geocoder.nominatim();
                var geocoderControl = L.Control.geocoder({
                    geocoder: geocoder,
                    defaultMarkGeocode: false
                }).on('markgeocode', function (e) {
                    var bbox = e.geocode.bbox;
                    var poly = L.polygon([
                        bbox.getSouthEast(),
                        bbox.getNorthEast(),
                        bbox.getNorthWest(),
                        bbox.getSouthWest()
                    ]);
                    map.fitBounds(poly.getBounds());
                    updateMarker(e.geocode.center.lat, e.geocode.center.lng);
                }).addTo(map);

                updateMarker(<?php echo $row['lat']; ?>, <?php echo $row['lon']; ?>); // Set default marker position

                function validateForm() {
                    var location = document.getElementById('location').value;
                    var locationError = document.getElementById('error-location');

                    var locationRegex = /^[a-zA-Z0-9-_ ,]+$/;

                    locationError.textContent = '';

                    var isValid = true;

                    if (!locationRegex.test(location)) {
                        locationError.textContent = 'Location should contain only letters, numbers, underscores, hyphens, commas and spaces.';
                        isValid = false;
                    }

                    return isValid;
                }
                   
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                updateMarker(lat, lng);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "<script>
                alert('Oops..! The Account is not cretaed..');
                window.location.href='create_Business.html';
              </script> ";
    }
    // Close connection
    mysqli_close($conn);
}
?>
