<?php

$weather = ""; // Initialize $weather variable
$trafficPrediction = ""; // Initialize $trafficPrediction variable
$error = "";   // Initialize $error variable

if (isset($_GET['submit'])) {
    // Checking if input is empty
    if (!$_GET['city']) {
        $error = "Sorry, Your Input field is empty";
    } else {
        $city = urlencode($_GET['city']); // Encode city name to handle special characters
        
        // Fetch weather data
        $weatherApiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=346ff1e58872eeefce6a27c8e7a8069c");
        $weatherArray = json_decode($weatherApiData, true);
        
        if ($weatherArray && $weatherArray['cod'] == 200) {
            // Process weather data
            $tempCelsius = intval($weatherArray['main']['temp'] - 273); // Convert temperature to Celsius
            $weather = "<b>".$weatherArray['name'].", ".$weatherArray['sys']['country']." : ".$tempCelsius."&deg;C</b> </br>";
            $weather .= "<b>Weather Condition : </b>".$weatherArray['weather'][0]['description'];
            
            // Fetch traffic prediction (mock implementation)
            // Here, I'm just simulating a random traffic prediction value
            $trafficPrediction = "Traffic prediction for ".$_GET['city'].": ".rand(1, 10)." / 10"; // Simulated traffic prediction
            
            date_default_timezone_set('Asia/Kolkata'); // Set timezone to Asia/Kolkata
            $currentTime = date("F j, Y, g:i a"); // Get current time
            
        } else {
            $error = "Couldn't be processed. Please enter a valid city name.";
        }
    }
}
?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Weather & Traffic App</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            background-image: url(w.jpeg);
            color: black;
            font-family: poppin, 'Times New Roman', Times, serif;
            font-size: large;
            background-size: cover;
            background-attachment: fixed;
        }

        .container {
            text-align: center;
            justify-content: center;
            align-items: center;
            width: 440px;
        }

        h1 {
            font-weight: 700;
            margin-top: 150px;
        }

        input {
            width: 350px;
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Search Global Weather & Traffic</h1>
    <form action="" method="GET">
        <p> <label for="city">Enter your city name</label></p>
        <p><input type="text" name="city" id="city" placeholder="City Name"></p>
        <button type="submit" name="submit" class="btn btn-success">Submit Now</button>
        <p></p>
        <div class="output mt-3">
            <?php
            if ($weather) {
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
            }
            if ($trafficPrediction) {
                echo '<div class="alert alert-info" role="alert">'.$trafficPrediction.'</div>';
            }
            if ($error) {
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            }
            ?>
        </div>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
