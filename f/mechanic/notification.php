<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$dbname = "vehicle_bk";

// Create connection
$conn = mysqli_connect($servername, $username, "", $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$mech_id = $_SESSION['mech_id'];
// SQL query to retrieve data (replace 'your_table_name' with your actual table name)
$sql = "SELECT * FROM customer_detail  where mech_id = $mech_id order by request_date DESC";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo '<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Database Table</title>';

    // Bootstrap CSS link
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';

    // jQuery script
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';

    // Custom CSS style
    echo '<style>
            body {
                padding: 5px;
                background-image: url(backkkk.jpg);
        background-size: cover; 
            }
            table {
                width: 70%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
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
                <th>Action</th>
            </tr>
          </thead><tbody>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        setcookie('id', $row["cust_id"], time() + 86400);
        echo '<tr>
               <td>' . $row["request_date"] . '</td>
               <td>' . $row["name"] . '</td>
               <td>' . $row["mobile_no"] . '</td>
                <td>
                    <button class="btn btn-primary" onclick="openModal(' . $row["cust_id"] . ', \'' . $row["name"] .'\', \'' . $row["email"] . '\')">Action</button>
                </td>
              </tr>';
    }
    
    echo '</tbody></table>';

    // Bootstrap JS and Popper.js scripts
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';

    // Bootstrap Modal HTML
    echo '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Select Action</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                  
                    <button type="button" id="viewButton" class="btn btn-success">View</button>
                    <button type="button" id="acceptButton" class="btn btn-primary">Accept</button>
                     <button type="button" id="rejectButton" class="btn btn-danger">Reject</button>
                    </div>
                </div>
            </div>
        </div>';

    echo '</body></html>';
} else 
{

    echo "<script>
                alert('Oops..! NO request till now..');
                window.location.href='mech_dashboard.php';
              </script> ";
}

// Close connection 
$conn->close();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// JavaScript function to open the modal
function openModal(rowId, custName,cust_email) {
    $('#myModal').modal('show');

    // Event listener for the "View" button in the modal
    $('#viewButton').on('click', function() {
        viewpage(rowId);
    });

    // Event listener for the "Accept" button in the modal
    $('#acceptButton').on('click', function() {
        sendNotification(rowId, custName,cust_email,'Accepted');
    });

    // Event listener for the "Reject" button in the modal
    $('#rejectButton').on('click', function() {
        sendNotification(rowId, custName,cust_email,'Rejected');
    });

    function viewpage(rowId) {
        window.location.href = 'view.php?id=' + rowId;
    }

    function sendNotification(rowId, custName, cust_email, status) {
    window.location.href = 'notify_customer.php?id=' + rowId + '&custName=' + custName + '&custEmail=' + cust_email + '&status=' + status;
    }

    }

</script>
