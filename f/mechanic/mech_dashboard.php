<?php
 session_start();

 if(!isset($_SESSION['username']))
    {
        echo"session not set";
        exit();
    }

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Breakdown Assistance Services</title>
    <style>
        html {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #042848, #97074f);
        }


        header {
            display: flex;
            
            justify-content: space-between;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #3494e6, #ec6ead);
            z-index: -1;
        }

        h1 {
            margin: 0;
            font-size: 2em;
            letter-spacing: 2px;
        }

        /* Add animation for header text */
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h1 {
            animation: slideIn 0.8s ease-out;
        }

        h2 {
            color: #333;
            margin-bottom: 0.5em;
        }

        p {
            color: #555;
            margin-bottom: 1em;
        }

        .Btn {
            /* Existing styles */
            padding: 10px;
            /* Adjust padding to ensure icon fits */
            font-size: 16px;
            /* Adjust base font size if necessary */
        }

        .iconb {
            font-size: 1.5em;
            color: white;
            /* Adjust icon size. Smaller values make the icon smaller */
        }


        .service-link {
            text-decoration: none;
            color: inherit;
            /* Use the default text color */
        }

        .Btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 50px;
            height: 45px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition-duration: .3s;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
            background-color: rgb(255, 65, 65);
        }

        /* plus sign */
        .sign {
            width: 100%;
            transition-duration: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sign svg {
            width: 17px;
        }

        .sign svg path {
            fill: white;
        }

        /* text */
        .text {
            position: absolute;
            right: 0%;
            width: 0%;
            opacity: 0;
            color: white;
            font-size: 1.2em;
            font-weight: 600;
            transition-duration: .3s;
        }

        /* hover effect on button width */
        .Btn:hover {
            width: 125px;
            border-radius: 40px;
            transition-duration: .3s;
        }

        .Btn:hover .sign {
            width: 15%;
            transition-duration: .3s;
            padding-left: 20px;
        }

        /* hover effect button's text */
        .Btn:hover .text {
            opacity: 1;
            width: 70%;
            transition-duration: .3s;
            padding-right: 10px;
        }

        /* button click effect*/
        .Btn:active {
            transform: translate(2px, 2px);
        }

      

        .road {
            position: absolute;
            margin-top: -4px;
            width: 100%;
            height: 10px;
            border-radius: 5em;

            animation: road-move 2s linear infinite;
        }

        @keyframes rolling {
            to {
                transform: rotate(-360deg);
            }
        }

        @keyframes road-move {
            from {
                transform: translateX(-140%);
            }

            to {
                transform: translateX(100%);
            }
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;

            color: #fff;
            padding: 0.5rem 1rem;
        }

        .nav-logo a {
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
            padding: 50px 50px;
        }

        .nav-items a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .nav-items a:hover {
            color: #ec6ead;
        }

        .nav-actions .Btn.nav-btn {
            margin-left: 10px;
            background-color: transparent;
            padding: 0.5rem;
            font-size: 1.2rem;
        }

        .nav-actions .icon {
            color: #fff;
            transition: transform 0.3s ease;
        }

        .nav-actions .Btn.nav-btn:hover .icon {
            transform: scale(1.2);
        }

        body {
            font-family: Arial, sans-serif;
           
            margin: 0;
            padding: 0;
        }


        .roadmap {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: nowrap;
            margin-top: 50px;
        }

        .step {
            text-align: center;
        }

        .step img {
            width: 80px;
            height: 80px;
        }

        .step p {
            margin-top: 10px;
        }

        .arrow {
            font-size: 30px;
            color: #007bff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #520445, #030866, #70050b);
            color: #f7f4f4;
            font-size: larger;
        }

        .assistance-container {
            font-size: 20px;
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
           
            background-image: url('backkkk.jpg');
            background-size: cover;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .assistance-container:hover {
            transform: translateY(-10px);
        }

        .assistance-btn {
            display: inline-block;
            background-color: #007bff;
            background-image: linear-gradient(to right, #0062E6, #33AEFF);
            color: white;
            padding: 15px 35px;
            text-align: center;
            text-decoration: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            outline: none;
            font-weight: 600;
            margin-top: 20px;
            font-size: large;
        }

        .assistance-btn:hover {
            background-image: linear-gradient(to left, #0062E6, #33AEFF);
            box-shadow: 0 5px 15px rgba(0, 98, 230, 0.4);
        }
        .jagu{

            color: #0a0300;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .jagu1{

        color: #050000;
        font-size: 15px;
         margin-bottom: 15px;
       }

        h2 {
            color: #ecd60f8c;
            font-size: 29px;
            margin-bottom: 15px;
            
        }

        p {
            color: #faf8f8;
            line-height: 1.5;
            margin-bottom: 20px;
            
        }

      
        .step img {
            width: 50px;
            /* Adjust size as needed */
            height: auto;
            margin-bottom: 10px;
        }

        .step p {
            color: #030000;
            font-size: 16px;
        }

        .arrow {
            font-size: 24px;
            color: #007bff;
            padding: 0 20px;
        }

        .roadmap-section,
        .questions-section,
        .site-footer {
            padding: 20px;
            text-align: center;
            
            
          
        }

        .site-footer {
            margin-top: 20px;
            background-color: #000000;
            color: white;
        }

        
    .contact-section {
  padding: 40px;
  text-align: center;
 
}

.contact-info ul {
  list-style: none;
  padding: 0;
}

.contact-info li {
  margin-bottom: 10px;
}

.contact-form form {
  max-width: 500px;
  margin: auto;
}

.contact-form label {
  display: block;
  margin-top: 20px;
}

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
}


           header {
               color: white;
               padding: 20px 50px;
               text-align: center;
               position: relative;
           }
   
           h1 {
               color: white;
               text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
           }
   
   
           main {
               display: flex;
               flex-wrap: wrap;
               justify-content: space-around;
               padding: 20px;
               
               
           }
   
           .card {
               background-color: white;
               border-radius: 15px;
               box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
               padding: 20px;
               margin: 20px;
               text-align: center;
               width: 280px;
               transition: transform 0.3s ease, box-shadow 0.3s ease;
               color: #000000;
               
           }
   
           .card:hover {
               transform: translateY(-5px);
               box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
           }
   
          
   

           .icon {
               font-size: 48px;
               color: #3498db;
               margin-bottom: 20px;
               transition: transform 0.3s ease;
           }
   
           .card:hover .icon {
               transform: scale(1.1);
           }
   
           a {
               text-decoration: none;
               color: inherit;
           }
   
           a:hover button {
               background-color: #25597f;
           }
          
   
    


    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    <nav class="navbar">
        <div class="nav-logo">
            <a href="#"><b>Mechanic Dashboard</b></a>
        </div>
        <div class="nav-items">
            
                <a href="mech_dashboard.php" class="active">Home</a>
                <a href="services.html">Services</a>
                <a href="about.html">About</a>
                <a href="contact.html">Contact</a>
                <a href="practice.php">Feedback</a>
            
        </div>
        <div class="nav-actions">
            <button onclick="window.location.href='view_profile.php'" class="Btn nav-btn">
                <div class="iconb">&#128100;</div>
            </button>
            <button onclick="logout()" class="Btn nav-btn">
                <div class="iconb"><i class="fas fa-sign-out-alt"></i></div> <!-- Logout Icon -->
            </button>
        </div>
    </nav>

    <div class="assistance-container">
        <main>
            <div class="card">
                    <i class="fas fa-user-circle icon"></i>
                    <h2 class="jagu">Welcome <?php echo $_SESSION['username']; ?>!</h2>
                    <p class="jagu1">Create your new Business here for active breakdown assistance.</p>
                   
                    <button class="assistance-btn" onclick="location.href='create_Business.html'">Create new Business</button>
                    
                </div>
        
                <div class="card">
                    <i class="fas fa-wrench icon"></i>
                    <h2 class="jagu">Update Business</h2>
                    <p class="jagu1">See and manage your currently active breakdown assistance jobs.</p>
                    <button class="assistance-btn" onclick="location.href='update_business.php'">Update Business</button>
                </div>
        
                <div class="card">
                    <i class="fas fa-history icon"></i>
                    <h2 class="jagu">Request History</h2>
                    <p class="jagu1">Review your completed breakdown assistance jobs and their details.</p>
                    <button  class="assistance-btn" onclick="location.href='history_display.php'">View Job History</button>
                </div>
        
                <div class="card">
                    <i class="fas fa-id-card icon"></i>
                    <h2 class="jagu">Profile</h2>
                    <p class="jagu1">Manage your profile information and update your details.</p>
                    <a href="view_profile.php">
                    <button class="assistance-btn" name="Mechanic_profile">View Profile</button>
                    </a>
                </div>
        
                <div class="card">
                    <i class="fas fa-bell icon"></i>
                    <h2 class="jagu">Notifications</h2>
                    <p class="jagu1">Stay informed about new service requests and updates.</p>
                    <button class="assistance-btn" onclick="location.href='notification.php'">View Notifications</button>
                </div>
        
            </main>
        
           
            
        </div>

    </div>

    
   

    <script>
        
        
       function logout() {
        // Redirect to admin login page
        window.location.href = 'logout.php';
        // Replace the current history entry with the admin login page
        window.history.replaceState({}, document.title, 'mech_login.html');
    }

    </script>

    <div id="questions" class="questions-section">
        <h2>Have a Question?</h2>
        <p>If you have any questions about our services or need assistance, feel free to reach out.</p>
        <!-- You can include a form or contact info here -->
    </div>

    <b><section id="contact" class="contact-section">
        <h2>Contact Us</h2>
        <div class="contact-info">
          <p>If you're in need of assistance or have any inquiries, feel free to reach out to us through any of the following channels:</p>
          <ul>
            <li><strong>Phone:</strong> +1 (555) 123-4567</li>
            <li><strong>Email:</strong> support@vehicleassist.com</li>
            <li><strong>Address:</strong> 123 Breakdown Lane, Help City, SOS 91100</li>
          </ul>
        </div>
        <div class="contact-form">
          <h3>Or send us a message directly:</h3>
          <form id="contactForm" action="submit_contact_form.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" pattern="[A-Za-z\s]+" title="Please enter a valid name (alphabet characters only)" required>
      
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>
      
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
      
            <button class="assistance-btn" type="submit">Send Message</button>
          </form>
        </div>
      </section></b>

    </div>
</body>
<script>
      window.embeddedChatbotConfig = {
      chatbotId: "rQgriE9hOhySPzGlGAppI",
      domain: "www.chatbase.co"
      }
      </script>
      <script
      src="https://www.chatbase.co/embed.min.js"
      chatbotId="rQgriE9hOhySPzGlGAppI"
      domain="www.chatbase.co"
      defer>
</script>
<!-- Footer -->
<footer class="site-footer">
    <h2>© 2024 Roadside, All Rights Reserved.</h2>
</footer>

</html>
