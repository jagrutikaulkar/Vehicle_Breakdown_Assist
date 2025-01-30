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
</head> 

<body> 
	
	
<?php include 'adminheader.php'; ?>
<?php include 'adminmain.php'; ?>

	
		<div class="main">
			 

			<div class="box-container"> 

			<?php

$conn = mysqli_connect("localhost", "root", "", "vehicle_bk");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to count the total number of records in the "customer" table
$sqlCustomerCount = "SELECT COUNT(*) AS customer_count FROM customer_register";
$resultCustomer = mysqli_query($conn, $sqlCustomerCount);

// Query to count the total number of records in the "mechanic" table
$sqlMechanicCount = "SELECT COUNT(*) AS mechanic_count FROM mechanic_register";
$resultMechanic = mysqli_query($conn, $sqlMechanicCount);

// Check if queries were successful
if ($resultCustomer && $resultMechanic) {
    // Fetch the total counts
    $rowCustomer = mysqli_fetch_assoc($resultCustomer);
    $customerCount = $rowCustomer['customer_count'];

    $rowMechanic = mysqli_fetch_assoc($resultMechanic);
    $mechanicCount = $rowMechanic['mechanic_count'];

    // Calculate the sum of customers and mechanics
    $total = $customerCount + $mechanicCount;

    // Close result sets
    mysqli_free_result($resultCustomer);
    mysqli_free_result($resultMechanic);

    // Close connection
    mysqli_close($conn);
}

else{
    echo "Error: " . mysqli_error($conn);
}

?>


				<div class="box box1"> 
					<div class="text"> 
						<h2 class="topic-heading"><?php echo $total; ?></h2> 
						<h2 class="topic">Total Members</h2> 
					</div> 

					<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(31).png"
						alt="Views"> 
				</div> 
				<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "vehicle_bk");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sqlCountComments = "SELECT COUNT(*) AS total_likes FROM likes";
$result = mysqli_query($conn, $sqlCountComments);


$sqlCountComments1 = "SELECT COUNT(*) AS total_likes2 FROM likes2";
$result1 = mysqli_query($conn, $sqlCountComments1);

if ($result && $result1) {
    
    $row = mysqli_fetch_assoc($result);
    $totallikes = $row['total_likes'];

    $row1 = mysqli_fetch_assoc($result1);
    $totallikes2 = $row1['total_likes2'];

    $total=$totallikes+$totallikes2;
} else {
    $totallikes = 0;
}

// Close the database connection
mysqli_close($conn);
?>
				<div class="box box2"> 
					<div class="text"> 
						<h2 class="topic-heading"><?php echo $total; ?></h2> 
						<h2 class="topic">Likes</h2> 
					</div> 

					<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210185030/14.png"
						alt="likes"> 
				</div> 
				<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "vehicle_bk");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to count the total number of rows in the comments table
$sqlCountComments = "SELECT COUNT(*) AS total_comments FROM comment";
$result = mysqli_query($conn, $sqlCountComments);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the total number of comments
    $row = mysqli_fetch_assoc($result);
    $totalComments = $row['total_comments'];
} else {
    $totalComments = 0;
}

// Close the database connection
mysqli_close($conn);
?>
				<div class="box box3"> 
					<div class="text"> 
						<h2 class="topic-heading"><?php echo $totalComments; ?> </h2> 
						<h2 class="topic">Comments</h2> 
					</div> 

					<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(32).png"
						alt="comments"> 
				</div> 
				<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "vehicle_bk");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to count the total number of rows in the comments table
$sqlCountComments = "SELECT COUNT(*) AS service_provided FROM customer_history where is_accepted =1";
$result = mysqli_query($conn, $sqlCountComments);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the total number of comments
    $row = mysqli_fetch_assoc($result);
    $service_provided = $row['service_provided'];
} else {
    $service_provided = 0;
}

// Close the database connection
mysqli_close($conn);
?>

				<div class="box box4"> 
					<div class="text"> 
						<h2 class="topic-heading"><?php echo $service_provided ; ?></h2> 
						<h2 class="topic">service provided</h2> 
					</div> 

					<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="published"> 
				</div> 
			</div> 

			<div class="report-container"> 
				<div class="report-header"> 
					<h1 class="recent-Requests">Recent Requests</h1>  
					<button style="background-color: blue; color: white; border: 2px solid black; padding: 10px 20px; border-radius: 5px;" onclick="location.href='view_record.php'">View All</button>
       
				</div> 

				<div class="report-body"> 
					<div class="report-topic-heading"> 
						<h3 class="t-op">RequestDate</h3> 
						<h3 class="t-op">Name</h3> 
						<h3 class="t-op">MobileNo</h3> 
						<h3 class="t-op">Status</h3> 
					</div> 

					<div class="items"> 
					<?php

$servername = "localhost";
$username = "username";
$database = "vehicle_db";

$conn = mysqli_connect("localhost", "root", "", "vehicle_bk");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch the latest 7 records from the customer_details table
$sql = "SELECT request_date, name, mobile_no, is_accepted FROM customer_history ORDER BY request_date DESC LIMIT 7";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
		$status = $row['is_accepted'] == 1 ? 'Accepted' : 'Rejected';
        echo '<div class="item1">';
        echo '<h3 class="t-op-nextlvl">' . $row["request_date"] . '</h3>';
        echo '<h3 class="t-op-nextlvl">' . $row["name"] . '</h3>';
        echo '<h3 class="t-op-nextlvl">' . $row["mobile_no"] . '</h3>';
        echo '<h3 class="t-op-nextlvl label-tag">' . $status . '</h3>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</div>

</body>
</html>




