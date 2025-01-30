
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Likes and Comments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('12.jpg');
             background-size: cover; 
            flex-direction: column;
            min-height: 100vh;
            text-align: center;
            
        }

        /* Container Styles */
        .post {
            
     
            border-radius: 8px;

            padding: 20px;
            margin: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 50px rgba(0, 0, 0, 2);
            
        }

        /* Post Title Styles */
        .post-title {
            font-size: 30px;
            color: white;
            margin-bottom: 10px;
            text-align: center;
        }

        /* Post Content Styles */
        .post-content {
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Actions Styles */
        .actions {
            display: flex;
            align-items: center;
           
        }

        /* Like Button Styles */
        .like-btn, .comment-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .like-btn:hover, .comment-btn:hover {
            background-color: #0056b3;
        }

        /* Counts Styles */
        .likes-count, .comments-count {
            color: white;
            font-size: 20px;
            text-align:center;
            
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-dialog {
            margin: 100px auto;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .modal-header {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .modal-title {
            font-size: 20px;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            text-align:center;
            
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
                               
.navbar {
    background-color: #333;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 20px;
}

.nav-logo a, .nav-items a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
}

.nav-items a.active {
    color: #ec6ead; /* Highlight the active page */
}

    </style>
</head>
<body>
<nav class="navbar">
        <div class="nav-logo">
            <a href="http://localhost/mainproject/f/index.html">Vehicle Breakdown Assistance</a>
        </div>
        <div class="nav-items">
            <a href="cust_dashboard.html">Home</a>
            <a href="services.html">Services</a>
            <a href="about.html" >About</a>
            <a href="contact.html">Contact</a>
            <a href="practice.php" class="active">Feedback</a>
        </div>
        <div>

        </div>
        <div>

        </div>
    </nav>
<br><br>
<input type="hidden" id="cust_id" value="<?php echo $_SESSION['cust_id']; ?>">
    
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

if ($result && mysqli_num_rows($result) > 0)
 {
    // Fetch the total number of comments
    $row = mysqli_fetch_assoc($result);
    $totalComments = $row['total_comments'];
} else {
    $totalComments = 0;
}

// Close the database connection
mysqli_close($conn);
?>
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
<div class="post">
    <h1 class="post-title"><b>Comments and likes<b></h1>
    <h2 class="post-content">Your opinion matters! Please take a moment to leave us your feedback.</h2><br>
    
    
    <div class="actions">
    
		
            <button class="like-btn" style="margin-left: 450px;">Like</button>
            <span class="likes-count"><?php echo $total; ?>  Likes</span>

        <button class="comment-btn" style="margin-left: 20px;">Comment</button>
        <span class="comments-count" id="totalComments"><?php echo $totalComments; ?>  comments</span>
    </div>
</div>

    <div id="commentModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Comment</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="commentForm">
                        <div class="form-group">
                            <label for="commentName">Name:</label>
                            <input type="text" id="commentName" name="commentName" class="form-control" pattern="[A-Za-z\s]+" title="Please enter a valid name (alphabet characters only)"required>
                        </div>
                        <div class="form-group">
                            <label for="commentText">Comment:</label>
                            <textarea id="commentText" name="commentText" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitComment">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       // Event listener for the comment button
const commentBtn = document.querySelector(".comment-btn");
const commentModal = document.getElementById("commentModal");

commentBtn.addEventListener("click", function() {
    // Show the comment modal when the button is clicked
    commentModal.style.display = "block";
});

// Event listener for the close button in the modal header
const closeModalBtn = document.querySelector("#commentModal .close");

closeModalBtn.addEventListener("click", function() {
    // Hide the comment modal when the close button is clicked
    commentModal.style.display = "none";
});

// Close the modal when the outside area of the modal is clicked
window.addEventListener("click", function(event) {
    if (event.target === commentModal) {
        // Hide the comment modal if the click target is the modal background
        commentModal.style.display = "none";
    }
});

// Event listener for the comment form submission
document.getElementById("commentForm").addEventListener("submit", function(e) {
    e.preventDefault();
    var commentName = document.getElementById("commentName").value;
    var commentText = document.getElementById("commentText").value;

    // Construct the URL with query parameters
    var url = "save_comment.php" + "?name=" + encodeURIComponent(commentName) + "&text=" + encodeURIComponent(commentText);

    // Redirect the user to the new page with the comment data in the query parameters
    window.location.href = url;
});
</script>
<script>
$(document).ready(function() {
    // Event listener for the like button
    $('.like-btn').on('click', function() {

        var id = $('#cust_id').val();
        var url = "save_like.php" + "?reaction=" + encodeURIComponent("like") + "&uid=" + encodeURIComponent(id);

        window.location.href = url;
              
    });

    
});
</script>

</body>
</html>

