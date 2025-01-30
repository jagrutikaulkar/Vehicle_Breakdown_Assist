<?php

$weather = ""; // Initialize $weather variable
$error = "";   // Initialize $error variable
    if(array_key_exists('submit',$_GET))
    {
         //checking if input is empty
         if(!$_GET['city'])
         {
           $error="Sorry, Your Input field is empty";

         }
         if($_GET['city'])
         {
           $apiData= file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=". $_GET['city']."&appid=bd378b09e447952a16d7bc1e418e3121");
           $weatherArray= json_decode($apiData, true);
           if($weatherArray['cod']==200)
           {
             
           //C =K-273.15
           $tempCelsius =$weatherArray['main']['temp'] - 273;
           $weather = "<b>".$weatherArray['name'].", ".$weatherArray['sys']['country']." : ".intval($tempCelsius)."&deg;C</b> </br>";
 
           $weather .= "<b>Weather Condition : </b>".$weatherArray['weather']['0']['description'];
           $weather .= "<br><b>Atmosperic Pressure : </b>".$weatherArray['main']['pressure']." hPa";
           $weather .= "<br><b>Wind Speed : </b>".$weatherArray['wind']['speed']." meter/sec";
           $weather .= "<br><b>Cloudness : </b>".$weatherArray['clouds']['all']." %";
           date_default_timezone_set('Asia/Karachi');
           $sunrise = $weatherArray['sys']['sunrise'];
            $weather .= "<br><b>Sunrise : </b>" .date("g:i a", $sunrise);
            $weather .= "<br><b>Current Date : </b>" .date("F j, Y");

         }
         else{

          $error="Couldn't be process, your city name is not valid";
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

    <title>Weather App</title>
    <style>
      body{
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        background-image: url(now.jpg);
        color: white;
        font-family: poppin, 'Times New Roman', Times, serif;
        font-size: large;

        background-size: cover;
        background-attachment: fixed;
      }
      .container{
        text-align: center;
        justify-content: center;
        align-items: center;
        width: 440px;

      }
      .back-to-home-container {
    position: absolute;
    top: 20px; /* Adjust top positioning as needed */
    left: 1300px; /* Adjust left positioning as needed */
    background-color: white;
    padding: 10px; /* Adjust padding as needed */
    border-radius: 5px; /* Add rounded corners */
}

.back-to-home {
    text-decoration: none;
    color: black; /* Change color if needed */
    display: flex;
    align-items: center; /* Align items vertically */
}

.back-to-home img {
    width: 50px;
    height: 50px;
    margin-right: 5px; /* Adjust margin as needed */
}

      h1{
         font-weight: 700;
         margin-top: 150px;

      }
      input{
        width: 350px;
        padding: 5px;

      }
    </style>
  </head>
  <body>
  <div class="back-to-home-container">
    <a href="f/index.html" class="back-to-home"><!-- Replace "index.php" with the actual filename of your homepage -->
        <img src="home.jpg" alt="Home" width="50" height="50"> <!-- Replace "home_icon.png" with the path to your home icon image -->
        Back To Home
    </a>
</div>

    <div class="container">
    <h1>Search Global Weather</h1>
    <form action="" method="GET">
     <p> <label for="city"><h2>Enter your city name</h2></label></p>
     <p><input type="text" name="city" id="city" placeholder="City Name"></p>
      <button type="submit" name="submit" class="btn btn-success"><h3>Submit Now </h3></button>
      <p></p>
   <div class="output mt-3">
    
    <?php 
    if($weather)
    {
      echo'<div class="alert alert-success" role="alert">
      '.$weather.'
      </div>';
    }
    if($error)
    {
      echo'<div class="alert alert-danger" role="alert">
      '.$error.'
      </div>';
    }
    ?>
       
    </div>
    </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>