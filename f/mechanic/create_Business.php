<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $whatsappno = $_POST['whatsapp_no'];
    $servicetype = $_POST['expertise'];
    $loc_words = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Check if session is set
    if (!isset($_SESSION['mech_id'])) {
        echo "<script>alert('Session not set...');
              window.location.href = 'mech_signinup.html';
              </script>";
    } else {
        $mid = $_SESSION['mech_id'];

        // Create connection
        $conn = mysqli_connect('localhost', 'root', '', 'vehicle_bk');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            // Check if business account already exists for this mechanic
            $select = mysqli_query($conn, "SELECT * FROM mechanic_business WHERE mech_id =$mid") or die('Query failed');
            if (mysqli_num_rows($select) > 0) {
                echo "<script>alert('Business Account already created');
                      window.location.href='update_business.php';
                      </script>";
            } else {
                // Check if email is already registered
                $checkEmail = "SELECT * FROM mechanic_business WHERE email = '$email'";
                $emailResult = $conn->query($checkEmail);
                if ($emailResult->num_rows > 0) {
                    echo "<script>alert('Email already registered.');
                          window.location.href = 'create_Business.html';
                          </script>";
                } else {
                    // Insert business account data into database
                    $sql = "INSERT INTO mechanic_business (mech_id, fullname, email, phone_no, whatsapp_no, area_ex, shop_location, lat, lon)
                            VALUES ('$mid', '$name', '$email', '$phone', '$whatsappno', '$servicetype', '$loc_words', '$latitude', '$longitude')";
                    if (mysqli_query($conn, $sql) === TRUE) {
                        echo "<script>alert('Business Account created Successfully...');
                              window.location.href='mech_dashboard.php';
                              </script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        }
        mysqli_close($conn);
    }
} else {
    echo "<script>alert('Invalid request');
          window.location.href='create_Business.php';
          </script>";
}
?>
