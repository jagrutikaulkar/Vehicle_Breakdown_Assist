<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$dbname = "vehicle_bk";

// Create connection
$conn = mysqli_connect($servername, $username, "", $dbname);

$mech_id=$_SESSION['mech_id'];
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to retrieve data (replace 'your_table_name' with your actual table name)
$sql = "SELECT * FROM customer_history where mech_id= $mech_id ORDER BY request_date DESC";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo '<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Database Table</title>';

    // Bootstrap CSS link
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
    
    // Custom CSS style
    echo '<style>
    body {
        padding: 10px;
        font-family: Arial, sans-serif; 
        background-image: url(backkkk.jpg);
        background-size: cover; 
        background-color: #f7f7f7; /* Adding a light background color for the body */
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border: 1px solid #ddd; 
        background-color: #fff; /* Adding a white background color for the table */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adding a subtle box shadow for a lifted appearance */
    }
    
    th, td {
        border: 1px solid #ddd;
        padding: 16px; 
        text-align: left;
    }
    
    th {
        background-color: #f2f2f2;
    }
    
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    tr:hover {
        background-color: #f5f5f5;
    }
    
    /* Adding a border-radius to the first and last rows for a rounded appearance */
    tr:first-child th:first-child,
    tr:first-child td:first-child,
    tr:last-child th:first-child,
    tr:last-child td:first-child,
    tr:last-child th:last-child,
    tr:last-child td:last-child {
        border-radius: 8px 0 0 8px;
    }
    
    tr:first-child th:last-child,
    tr:first-child td:last-child {
        border-radius: 0 8px 8px 0;
    }
    
        </style></head><body>';
  echo '<nav  class="navbar  bg-dark " >
  <div class="col-sm-12 col-md-12 col-lg-12 col-12">
    <a  style="margin-left: 50%; color: white " id="contact" class="nav-link" href="mech_dashboard.php">HOME</a>
      </div>
</nav>';
    // Table header
    echo '<table class="table table-striped"><thead class="thead-light">
            <tr>
                <th>Request Time</th>
                <th>Client Name</th>
                <th>Client number</th>
                <th>Status</th>
                <th>View</th>
            </tr>
          </thead><tbody>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $status = $row['is_accepted'] == 1 ? 'Accepted' : 'Rejected';
        echo '<tr>
               <td>' . $row["request_date"] . '</td>
               <td>' . $row["name"] . '</td>
               <td>' . $row["mobile_no"] . '</td>
               <td>' . $status . '</td>
               <td><button class="btn btn-primary" onclick="viewpage(' . $row["cust_id"] . ')">View</button></td>
              </tr>';
    }
    
    echo '</tbody></table>';

    // Bootstrap JS and Popper.js scripts
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';

    echo '</body></html>';
} else {
    echo "<script>
                alert('Oops..! No request till now..');
                window.location.href='mech_dashboard.php';
              </script> ";
}

// Close connection 
$conn->close();
?>

<script>
// JavaScript function to open the view page
function viewpage(rowId) {
    window.location.href = 'view2.php?id=' + rowId;
}
</script>
