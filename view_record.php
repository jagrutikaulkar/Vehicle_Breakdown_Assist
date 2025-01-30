<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible"
		content="IE=edge"> 
	<meta name="viewport"
		content="width=device-width, 
				initial-scale=1.0"> 
	<title>Vehicle Breakdown Assistance</title> 
	<link rel="stylesheet" href="adminstyle.css">
	<script src="adminscript.js"></script>
	<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    table {
        width: 1100px;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
		border: 1px solid #ddd;
    }
    th, td {
        padding: 20px 25px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
        color: #333;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    td {
        color: #666;
    }
</style>

</head> 

<body> 
	
	
<?php include 'adminheader.php'; ?>
<?php include 'adminmain.php'; ?>
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password set
$dbname = "vehicle_bk";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch all mechanics from the profile table
$sql = "SELECT * FROM customer_history ORDER BY request_date DESC";
$result = $conn->query($sql);

?>

<div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Request Time</th>
                <th>Client Name</th>
                <th>Client number</th>
                <th>Status</th>
                <th>View</th>
            </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any mechanics
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $status = $row['is_accepted'] == 1 ? 'Accepted' : 'Rejected';
                        echo '<tr>
                               <td>' . $row["request_date"] . '</td>
                               <td>' . $row["name"] . '</td>
                               <td>' . $row["mobile_no"] . '</td>
                               <td>' . $status . '</td>
                               <td><button class="btn btn-primary" style="background-color: blue; color: white; border: 2px solid black; padding: 10px 20px; border-radius: 5px;" onclick="viewpage(' . $row["cust_id"] . ')">View</button></td>
                              </tr>';
                    }
                } else {
                    echo "<script>
                    alert('Oops..! No request till now..');
                    window.location.href='admindashboard.php';
                  </script> ";  }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
// JavaScript function to open the view page
function viewpage(rowId) {
    window.location.href = 'view2.php?id=' + rowId;
}
</script>
	<?php
// Close database connection
mysqli_close($conn);
?>
</body>
</html>