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
            
            $conn = new mysqli($servername, $username, $password, $dbname);

            $result = $conn->query("SELECT * FROM bookings WHERE IsInCart = 1 AND UserID = '". $_SESSION['UserID'] ."'");
            $bookings = $result->num_rows;
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="mypets.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<body style="background:url(Images/bg2.jpeg);background-size:cover;background-color: #fff3cd;">
<nav class="navbar navbar-expand-lg" style="background-color: orange;">
    <a class="navbar-brand px-5"><img src="Images/logotwistpreview.png" style="width: 141px;
    margin-left: 75px;
    height: 86px;
    margin-top: -15px;"></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto px-5">
            <li class="nav-item"><a href="homepage.php" class="nav-link"><h4 style="  font-size: 1rem;">Home</h4></a></li>
            <li class="nav-item"><a href="myPets.php" class="nav-link"><h4 style="  font-size: 1rem;">Pets</h4></a></li>
            <li class="nav-item"><a href="myBookings.php" class="nav-link"><h4 style="  font-size: 1rem;">Bookings</h4></a></li>
            <li class="nav-item"><a href="frontpage.php" class="nav-link"><h4 style="  font-size: 1rem;">Logout</h4></a></li>
            <!-- <li class="nav-item">
              <form action="" method="post" class="nav-link">
               <a href="frontpage.php"> <button class="btn btn-info" name="logoutBtn">Logout</button></a>
              </form>
            </li> -->
            <li class="nav-item"><a href="cart.php" class="nav-link"><h4><i class="fa fa-shopping-cart" style="color: black;" aria-hidden="true"></i><div class="position-absolute translate-middle badge rounded-pill bg-info" style="height: 20px; width: font-size: 5px; text-align: center">
              <p style="font-size: 10px;">7</p><span class="visually-hidden">unread messages</span></div></h4></a></li>
            <li class="nav-item"><a href="profile.php" class="nav-link"><h4><i class="fa fa-user-circle-o" style="color: black;" aria-hidden="true"></i></h4></a></li>
           

        </ul>
    </div>
</nav>
    <div class="wholeDiv">
        <section class="cards-container">
            <?php
            if($bookings > 0) {
                while ($booking = $result->fetch_assoc()) {
                    echo "
                        <div class='card px-1' style='width: 17rem;background-color: rgba(0,0,0,0.5);'>
                            <h4 class='text text-success' style='color:orange !important'>{$booking['Service']}</h4>
                            <h5>Service : {$booking['Type']}</h5>
                            <h5>Appointment Date : {$booking['AppointmentDate']}</h5>
                            <h5>Appointment Time : {$booking['AppointmentTime']}</h5>
                            <h5>Pickup Address : {$booking['PickupAddress']}</h5>";

                    // Conditionally set the status
                    if ($booking['confirmed'] === null) {
                        echo "<h5>Status:<span class='text-warning'>Pending</span></h5>";
                    } else if ($booking['confirmed']== 1) {
                        echo "<h5>Status: <span class='text-success'>Confirmed</span></h5>";
                    } else if (!$booking['confirmed']== 0) {
                        echo "<h5>Status: <span class='text-danger'>Cancelled</span></h5>";
                    }
                    echo "</div>";
                }
            }
                else {
                    echo '<div class="" role="button">
                    <img src="./Images/emptyCart.svg"></img>
                    <h4>No Bookings</h4>
                </div>';
                }
            ?>
        </section>
    </div>
</body>
<style>
    h5 {
    font-size: 15px;
}
.card {
    height: 248px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #d9d9d9;
    border: none;
    border-radius: 142px !important;
    margin: 10px 10px;
    color: white;
}
    </style>
</html>
