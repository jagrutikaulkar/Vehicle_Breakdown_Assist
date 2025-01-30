<?php
$servername = "localhost";
$username = "root";
$dbname = "vehicle_bk";

// Create connection
$conn = new mysqli($servername, $username, "", $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve comment data from GET request
$reaction = $_GET['reaction'];
$uid = $_GET['uid'];

// Check if the user has already liked
$stmt_check = $conn->prepare("SELECT * FROM likes2 WHERE mech_id = ? AND reaction = ?");
$stmt_check->bind_param("ss", $uid, $reaction);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('already liked ...');
    window.location.href = 'practice.php';</script>";
} else {
    // Prepare and bind SQL statement to prevent SQL injection
    $stmt_insert = $conn->prepare("INSERT INTO likes2 (mech_id, reaction) VALUES (?, ?)");
    $stmt_insert->bind_param("ss", $uid, $reaction);

    // Execute SQL statement for insertion
    if ($stmt_insert->execute()) {
        echo "<script>alert('Thank you....');
        window.location.href = 'practice.php';</script>";
    } else {
        echo "<script>alert('Error...');
        window.location.href = 'practice.php';</script>";
    }
}

$stmt_check->close();
$stmt_insert->close();
$conn->close();
?>
