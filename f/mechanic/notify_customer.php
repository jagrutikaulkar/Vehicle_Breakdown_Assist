<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password set for root
$dbname = "vehicle_bk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the URL
$cust_id = $_GET['id'];
$to_email = $_GET['custEmail'];
$custName = $_GET['custName'];
$status = $_GET['status'];

// Email content
$subject = "Your Request Status";
$headers = "From: jagrutikaulkar0@gmail.com";

// Check the status and compose the appropriate message
if ($status == "Accepted") {
    $body = "Hi $custName,\n\nYour request has been accepted. We appreciate your business!";
    
    // Update customer_detail table
    $update_query = "UPDATE customer_detail SET is_accepted = 1 WHERE cust_id = $cust_id";
    $conn->query($update_query);
} else {
    $body = "Hi $custName,\n\nWe regret to inform you that your request has been declined.";
} 

// Retrieve data from customer_detail table
$retrieve_query = "SELECT * FROM customer_detail WHERE cust_id = $cust_id";
$result = $conn->query($retrieve_query);

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    
    // Insert retrieved data into customer_history table
    $insert_query = "INSERT INTO customer_history (cust_id, name, email, mobile_no, vehicle_name, vehicle_model, prob_des, type_ass, lat, lon, mlat, mlon, mech_id, is_accepted, request_date)
                     VALUES ('" . $row['cust_id'] . "', '" . $row['name'] . "', '" . $row['email'] . "', '" . $row['mobile_no'] . "', 
                             '" . $row['vehicle_name'] . "', '" . $row['vehicle_model'] . "', '" . $row['prob_des'] . "', 
                             '" . $row['type_ass'] . "', '" . $row['lat'] . "', '" . $row['lon'] . "', 
                             '" . $row['mlat'] . "', '" . $row['mlon'] . "', '" . $row['mech_id'] . "', '" . ($status == "Accepted" ? 1 : 0) . "', '" . $row['request_date'] . "')";

    if ($conn->query($insert_query) === TRUE) {
        // Delete the record from customer_detail table
        $delete_query = "DELETE FROM customer_detail WHERE cust_id = $cust_id";
        if ($conn->query($delete_query) === TRUE) {
            // Send the email
            if (mail($to_email, $subject, $body, $headers)) {
                echo "<script>alert('Email successfully sent to $to_email...');
                      window.location.href = 'notification.php';
                      </script>";
            } else {
                echo "<script>alert('Email sending failed..');
                      window.location.href = 'notification.php';
                      </script>";
            }
        } else {
            echo "Error deleting record from customer_detail table: " . $conn->error;
        }
    } else {
        echo "Error inserting data into customer_history table: " . $conn->error;
    }
} else {
    echo "No data found for the customer with ID: $cust_id";
}

// Close database connection
$conn->close();
?>
