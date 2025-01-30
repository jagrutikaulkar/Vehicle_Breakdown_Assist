<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$dbname = "mainproject";

if (!isset($_SESSION['mechanic_id'])) {
    echo "Session not set";
} else {
    $mid = $_SESSION['mechanic_id'];

    // Create connection
    $conn = mysqli_connect($servername, $username, '', $dbname);

    // Check connection
    if (mysqli_connect_error()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve selected record
    $sql = "SELECT * FROM mechanic_business WHERE id = $mid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display the record in a form-like format
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    background-image: url('c.jpeg');
                    background-size: cover; 
                }

                .registration-form {
                    max-width: 400px;
                    margin: 50px auto;
                     
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
                }

                h2 {
                    text-align: center;
                    color: #333;
                }

                form {
                    display: flex;
                    flex-direction: column;
                }

                label {
                    margin-bottom: 8px;
                    color: #555;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 14pt;
                    color: #000;
                }

                input, textarea {
                    padding: 10px;
                    margin-bottom: 16px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 14pt;
                    color: #000;
                }

                button {
                    background-color: #333;
                    color: #fff;
                    padding: 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #555;
                }
            </style>
            <title>Manage Mechanic Business</title>
        </head>
        <body>

        <div class='registration-form'>
            <h2>Manage Mechanic Business</h2>
            <form action='update_record.php' method='post'>
                <label for='Name'>Mechanic Name:</label>
                <input type='text' id='Name' name='Name' value='{$row['mechanic_name']}' required>

                <label for='location'>Location:</label>
                <input type='text' id='location' name='location' value='{$row['location']}' required>

                <label for='services'>Services Offered:</label>
                <textarea id='services' name='services' required>{$row['services']}</textarea>

                <label for='mobile_no'>Mobile No:</label>
                <input type='number' id='mobile_no' name='mobile_no' value='{$row['mobile_no']}' required>

                <label for='whatsapp_no'>Whatsapp No:</label>
                <input type='number' id='whatsapp_no' name='whatsapp_no' value='{$row['whatsapp_no']}' required>

                <label for='email'>Email Address:</label>
                <input type='email' id='email' name='email' value='{$row['email']}' required>

                <button type='submit'>Update</button><br>
            </form>
            
            <!-- Add buttons for update and delete -->
            <form action='delete_record.php' method='post'>
                <input type='hidden' name='id' value='{$row['Id']}'>
                <button type='submit'>Delete</button>
            </form>
        </div>

        </body>
        </html>";
    } else {
        echo"
            <script>
            alert('Record not found');
            window.location.href='index.php';
           </script> ";
    }

    // Close connection
    $conn->close();
}
?>