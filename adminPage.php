<?php
  session_start();
  if(!isset($_SESSION['UserID'])) {
    header('Location: ' . 'index.php', true);
    exit();
  }     

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pets_care";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  $categoryName = "";

// Check if the form is submitted
if (isset($_POST['saveCat'])) {
    // Get the category name from the form
    $categoryName = $_POST["categoryName"];

    // Insert the category name into the 'services' table
    $sql = "INSERT INTO services (PetType) VALUES ('$categoryName')";
    if ($conn->query($sql)) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Include your database connection code if it's not already included

if (isset($_POST['saveService'])) {// Get the form data
        $serviceName = $_POST["serviceName"];
        $serviceCategory = $_POST["serviceCategory"];
        $serviceDescription = $_POST["serviceDescription"];
        $servicePrice = $_POST["servicePrice"];

        // SQL query to insert data into the table (assuming you have a table named 'services')
        $sql1234 = "INSERT INTO services (PetType, `Service`, `Type`, Amount, rating, info) VALUES ('$serviceCategory', '$serviceName','$serviceDescription', '$servicePrice', '4', '$serviceDescription')";
        
        // Use prepared statements to prevent SQL injection
        $stmt1 = $conn->query($sql1234);

        if ($stmt1) {
            // Data inserted successfully
        } else {
            echo "Error: " . $sql1234 . "<br>" . $conn->error;
        }
}

if (isset($_POST['savehospital'])) {// Get the form data
    $hospitalName = $_POST["hospitalname"];
    $hospitalid = $_POST["hospitalid"];

    // SQL query to insert data into the table (assuming you have a table named 'services')
    $sql1234 = "INSERT INTO designation (Id, dest) VALUES ('$hospitalid','$hospitalName')";
    
    // Use prepared statements to prevent SQL injection
    $stmt1 = $conn->query($sql1234);

    if ($stmt1) {
        // Data inserted successfully
    } else {
        echo "Error: " . $sql1234 . "<br>" . $conn->error;
    }
} 
// Establish a database connection (similar to your existing code)

if (isset($_POST['booking_id']) && isset($_POST['status'])) {
    $bookingId = $_POST['booking_id'];
    $status = $_POST['status'];

    // Update the 'confirmed' column to the specified status (1 for Confirm, 0 for Cancel)
    $sql12345 = "UPDATE bookings SET confirmed = $status WHERE BookingID = $bookingId";

    if ($conn->query($sql12345) === TRUE) {
    } else {
        echo "error";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
    margin: 0;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    background-color: #fff3cd;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent;}
    
        </style>
</head>
<body>
<!-- <nav class="navbar navbar-expand-lg" style="background-color: #fff;">
    <a class="navbar-brand px-5"><h3>Pet Care</h3></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <li class="nav-item">
              <form action="" method="post" class="nav-link">
                <button class="btn btn-info" name="logoutBtn">Logout</button>
              </form>
            </li>
    </div>
</nav> -->


<!-- <nav class="navbar navbar-expand-lg" style="background-color: orange;">
    <a class="navbar-brand px-5"><img src="Images/logotwistpreview.png" style="width: 141px;
    margin-left: 75px;
    height: 86px;
    margin-top: -15px;"></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto px-5">
           
            <li class="nav-item"><a href="frontpage.php" class="nav-link"><h4 style="  font-size: 1rem;" >Logout</h4></a></li>
           
           

        </ul>
    </div>
</nav>
    <div class="container-fluid"> -->
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light" style="background-color:orange !important;">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100" style="background-color: orange;
    width: 251px;">
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-black text-decoration-none">
                            <i class="fs-4 bi-person-circle"></i>
                            <span class="d-none d-sm-inline mx-1">Admin
</span>
                        </a>
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" id="dashboard" class="nav-link align-middle">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <hr>
                        
                        <span class="fs-5 d-none d-sm-inline text-black">Maintenance</span>

                        <li class="nav-item">
                            <a href="#" id="categories" class="nav-link align-middle">
                                <i class="fs-4 bi-card-list"></i> <span class="ms-1 d-none d-sm-inline">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="services" class="nav-link align-middle">
                                <i class="fs-4 bi-stack"></i> <span class="ms-1 d-none d-sm-inline">Services List</span></a>
                        </li>
                        <li>
                            <a href="#" id="hospital" class="nav-link align-middle">
                                <i class="fs-4 bi-stack"></i> <span class="ms-1 d-none d-sm-inline">Hospitals</span></a>
                        </li>
                        <li>
                            <a href="frontpage.php" id="hospital" class="nav-link align-middle">
                                <img src="Images/logoff-removebg-preview.png" style="width: 30px;"><span class="ms-1 d-none d-sm-inline">Logout</span></a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col py-3" style="    background-color: #fff3cd;">
                <h2>Welcome Admin Panel</h2>
                <hr>
                <div id="maincontent" style="    margin-top: 88px;
">

                </div>
            </div>
        </div>
    </div>

    
</body>

<script type="text/javascript">
    $('#dashboard').click(function(){
        $("#maincontent").load("dashboard1.php");
        $("#dashboard").addClass("active");
        $("#categories").removeClass("active");
        $("#services").removeClass("active");
        $("#hospital").removeClass("active");


        return false;
    });

    $('#categories').click(function(){
        $("#maincontent").load("categories1.php");
        $("#categories").addClass("active");
        $("#dashboard").removeClass("active");
        $("#services").removeClass("active");
        $("#hospital").removeClass("active");


        return false;
    });

    $('#services').click(function(){
        $("#maincontent").load("services1.php");
        $("#services").addClass("active");
        $("#categories").removeClass("active");
        $("#dashboard").removeClass("active");
        $("#hospital").removeClass("active");


        return false;
    });
    $('#hospital').click(function(){
        $("#maincontent").load("hospital.php");
        $("#hospital").addClass("active");
        $("#services").removeClass("active");
        $("#categories").removeClass("active");
        $("#dashboard").removeClass("active");
       


        return false;
    });
    <?php
      if(isset($_POST['logoutBtn'])) {
        $_SESSION['UserName'] = '';
        unset($_SESSION);
        session_destroy();
        header('Location: ' . 'index.php', true);
        exit();
      }
            ?>


    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }



    $( document ).ready(function() {
        $( "#dashboard" ).trigger( "click" );
    });
</script>
<style>
    .nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    color: #fff;
    background-color: black !important;
}
.nav-link{
    color:white;
}
    </style>
</html>
