<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Vehicle Breakdown Assistance</title> 
    <link rel="stylesheet" href="adminstyle.css">
    <script src="adminscript.js"></script>
    <style>
   /* CSS for tables */
table {
    
    width: 50%;
    border-collapse: collapse;
    background-color:  #3f0097;
    border: 2px solid #fff;
    border-radius: 8px;
    overflow: hidden;
    
    
    
}

th, td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    
}

th {
    background-color: #f2f2f2;
   
    
}

/* CSS for links inside tables */
table a {
    text-decoration: none;
    color: white;
    
}

table a:hover {
    color: #2980b9;
}

    </style>
</head> 
<body>
    <?php include 'adminheader.php'; ?>
    <?php include 'adminmain.php'; ?>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $dbname = "vehicle_bk";

    // Create connection
    $conn = new mysqli($servername, $username,"", $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve all tables in the database
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    // Close the connection
    $conn->close();
    ?>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Table Name</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php $tableName = $row['Tables_in_' . $dbname]; ?>
                <tr>
                    <td><a href='http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=<?= $dbname ?>&table=<?= $tableName ?>'><?= $tableName ?></a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No tables found in the database.</p>
    <?php endif; ?>
</body>
</html>
