<?php

session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$dbname = "vehicle_bk";

// Create connection
$conn = new mysqli($servername, $username, "", $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $contact_no = $_POST["contact_no"];
    $email = $_POST["email"];
    $vehicleName = $_POST["vehicleName"];
    $vehicleModel = $_POST["vehicleModel"];
    $problemDescription = $_POST["problemDescription"];
    $assistanceType = $_POST["assistanceType"];

    $uLat = $_COOKIE['userLatitude'];
    $uLng = $_COOKIE['userLongitude'];
    $mLat = $_COOKIE['mechLatitude'];
    $mLng = $_COOKIE['mechLongitude'];

    // Sanitize inputs to prevent SQL injection
    $name = $conn->real_escape_string($name);
    $contact_no = $conn->real_escape_string($contact_no);
    $email = $conn->real_escape_string($email);
    $vehicleName = $conn->real_escape_string($vehicleName);
    $vehicleModel = $conn->real_escape_string($vehicleModel);
    $problemDescription = $conn->real_escape_string($problemDescription);
    $assistanceType = $conn->real_escape_string($assistanceType);

    // Get customer ID from session variable
    $cust_id = $_SESSION['cust_id'];
    $mechid = $_SESSION['mech_id'];
    echo "$mechid";
    // Insert data into the database
    $sql = "INSERT INTO customer_detail (cust_id, mech_id, name, mobile_no, email, vehicle_name, vehicle_model, prob_des, type_ass, lat, lon, mlat, mlon, is_accepted) VALUES ($cust_id, " . $_SESSION['mech_id'] . ", '$name', '$contact_no', '$email', '$vehicleName', '$vehicleModel', '$problemDescription', '$assistanceType', $uLat, $uLng, $mLat, $mLng, false)";

    if ($conn->query($sql) === TRUE) {
        // Retrieve mechanic's email and full name
        $mechid = $_SESSION['mech_id'];
        $sql = "SELECT email, fullname FROM mechanic_business WHERE mech_id = $mechid";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $sendmail = $row["email"];
                $mname = $row["fullname"];
            }
            
            // Send email to mechanic
            $to = $sendmail;
            $subject = "New Service Request from $name";
            $message = "Dear $mname,\r\n\r\n";
            $message .= "You have received a new service request from $name:\r\n\r\n";
            $message .= "Please respond to the customer promptly.\r\n\r\n";
            $headers = "From: breakdownassistance2024@gmail.com" . "\r\n" .
                       "Reply-To: $sendmail" . "\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            // Send email
            if (mail($to, $subject, $message, $headers)) {
                echo "<script>
                        alert('Request submitted successfully.');
                        window.location.href = 'cust_dashboard.html';
                      </script>";
            } else {
                echo "<script>
                        alert('Error in submitting the request successfully.');
                        window.location.href = 'cust_dashboard.html';
                      </script>";
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    header("Location: contact.html");
    exit;
}

$conn->close();

?>
