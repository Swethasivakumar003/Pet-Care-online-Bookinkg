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

            $result = $conn->query("SELECT * FROM pets WHERE UserID = '". $_SESSION['UserID'] ."'");
            $pets = $result;
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twisty Tails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="mypets.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body style="background:url(Images/bgcat1.jpg);background-size:cover;">
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
            <li class="nav-item"><a href="homepage.php" class="nav-link "><h4 style="  font-size: 1rem;">Home</h4></a></li>
            <li class="nav-item"><a href="myPets.php" class="nav-link active"><h4 style="  font-size: 1rem;">Pets</h4></a></li>
            <li class="nav-item"><a href="myBookings.php" class="nav-link"><h4 style="  font-size: 1rem;">Bookings</h4></a></li>
            <li class="nav-item"><a href="frontpage.php" class="nav-link"><h4 style="  font-size: 1rem;" >Logout</h4></a></li>
            <!-- <li class="nav-item">
              <form action="" method="post" class="nav-link">
               <a href="frontpage.php"> <button class="btn btn-info" name="logoutBtn">Logout</button></a>
              </form>
            </li> -->
          
            <li class="nav-item"><a href="profile.php" class="nav-link"><h4><i class="fa fa-user-circle-o" style="color: black;" aria-hidden="true"></i></h4></a></li>
           

        </ul>
    </div>
</nav>

   

    <div class="wholeDiv" style="position: absolute;
    top: 35%;
    left: 5%;
    vertical-align: middle;
    background-color: transparent;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 90%;
    border-radius: 20px;">
        <section class="cards-container">
            <?php
                while ($pet = $result->fetch_assoc()) {
                    echo "
                        <div class='card' style='width: 18rem; height: 300px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: #ffa5009c;
                        border: none;
                        border-radius: 142px !important;
                        margin: 10px 10px;'>
                            <h4 class='text text-success' style='color:black !important'>{$pet['PetName']}</h4>
                            <h5>Breed : {$pet['Breed']}</h5>
                            <h5>Gender : {$pet['PetGender']}</h5>
                            <h5>Birthday : {$pet['BirthDay']}</h5>
                            <img src='./Images/{$pet['PetType']}/{$pet['PetType']}.svg' alt='Card image cap'>
                        </div>";
                }
            ?>
        </section>
    </div>
</body>

<style>
    .h5, h5 {
    font-size: 1.25rem;
    color: white;
}
.card img {
    height: 94px;
    width: 87px;
}
    </style>



</html>