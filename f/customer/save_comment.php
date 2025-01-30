
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

// Retrieve comment data from POST request
$commentName = $_GET['name'];
$commentText = $_GET['text'];

// Prepare SQL statement
$sql = "INSERT INTO comment (name, comment) VALUES ('$commentName', '$commentText')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('commnet addede Successfully...');
    window.location.href = 'practice.php';
    
    </script>";
    
} else 
{
    echo "<script>alert('Error...');
    window.location.href = 'practice.php';
    </script>";
    
}

$conn->close();
?>
