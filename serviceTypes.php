<?php
  session_start();
  if(!isset($_SESSION['UserID'])) {
    header('Location: ' . 'index.php', true);
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="vet.css"> -->
</head>
<body style="background:url(Images/bg6.jpg);background-size:cover;">
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

    <main class="banner" id="banner">
    </main>
    <div class="wholeDiv">
        <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="changeBanner('dog')">Dog</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="changeBanner('cat')">Cat</button>
            </li>
        </ul>
        <div class="tab-content tabs-container" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <section class="cards-container">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "pets_care";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    $result = $conn->query("SELECT * FROM services WHERE PetType='Dog' AND Service = '" . $_GET['service'] . "'");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $words = explode(" ", $row['Type']);
                            $acronym = "";
                    
                            foreach ($words as $w) {
                                $acronym .= mb_substr($w, 0, 1);
                            }
                            $word = strtolower($acronym);
                    
                            echo '
                            <a class="card" style="width: 18rem;background-color: #ffa50080; text-decoration: none" role="button" 
                onclick="infoPage(\'' . $row['ServiceID'] . '\')">
                <h4>' . $row['Type'] . '</h4>
                                    <img class="card-img-top" src="./Images/dog/' . $word . '.svg" alt="Dog">
                                    <div class="d-flex col">
                                        <i class="fa fa-star" style="color: #Ffd700"></i>
                                        <h6>&nbsp; ' . $row['Rating'] . '</h6>
                                    </div>
                                    <p>&#x20b9; ' . $row['Amount'] . '</p>
                                </a>
                            ';
                        }
                    }
                ?>
            </section>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <section class="cards-container">
            <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "pets_care";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    $result = $conn->query("SELECT * FROM services WHERE PetType='Cat' AND Service = '" . $_GET['service'] . "'");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $words = explode(" ", $row['Type']);
                            $acronym = "";
                    
                            foreach ($words as $w) {
                                $acronym .= mb_substr($w, 0, 1);
                            }
                            $word = strtolower($acronym);
                    
                            echo '
                            <a class="card" style="width: 18rem;background-color: #ffa50080; text-decoration: none" role="button" 
                onclick="infoPage(\'' . $row['ServiceID'] . '\')">
                <h4>' . $row['Type'] . '</h4>
                                    <img class="card-img-top" src="./Images/cat/' . $word . '.svg" alt="Cat">
                                    <div class="d-flex col">
                                        <i class="fa fa-star" style="color: #Ffd700"></i>
                                        <h6>&nbsp; ' . $row['Rating'] . '</h6>
                                    </div>
                                    <p>&#x20b9; ' . $row['Amount'] . '</p>
                                </a>
                            ';
                        }
                    }
                ?>
            </section>
            </div>
        </div>
    </div>

    <script>
    function changeBanner(dc) {
        var e = document.getElementById('banner');
        if (dc == 'dog') {
            e.style.background = "url(./Images/dog/banner.svg)";
            e.style.backgroundRepeat = "no-repeat";
            e.style.backgroundPosition = "center";
            e.style.backgroundSize = "cover";
        } else {
            e.style.background = "url(./Images/cat/banner.svg)";
            e.style.backgroundRepeat = "no-repeat";
            e.style.backgroundPosition = "center";
            e.style.backgroundSize = "cover";
        }
    }

    function infoPage(id) {
        var url = 'infoPage.php?' +
        'id=' + encodeURIComponent(id)

        // Redirect the user to the new URL
        window.location.href = url;
    }
    </script>
</body>
</html>
    <style>
         .nav-link {
    display: block;
    padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
    font-size: var(--bs-nav-link-font-size);
    font-weight: var(--bs-nav-link-font-weight);
    color: #212529;
    text-decoration: none;
    background: 0 0;
    border: 0;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
}
.wholeDiv {
    position: absolute;
    top: 102px;
    left: 10%;
    
    display: flex;
    flex-direction: column;
    height: 90%;
    width: 80%;
}


.card-container {
    perspective: 1000px;
}

.card {
    width: 18rem;
    height: 250px;
    position: relative;
    transform-style: preserve-3d;
    transition: transform 0.5s;
}

.card:hover {
    transform: rotateY(360deg);
}

.card-front,
.card-back {
    width: 100%;
    height: 100%;
    position: absolute;
    backface-visibility: hidden;
}

.card-back {
    transform: rotateY(360deg);
}

        </style>
</body>
</html>