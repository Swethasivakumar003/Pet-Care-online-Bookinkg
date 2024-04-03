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

            $isAdmin = false;
            
            $conn = new mysqli($servername, $username, $password, $dbname);

            $bill = 0;

            $res = $conn->query("SELECT isAdmin FROM customer_details WHERE UserID = '" . $_SESSION['UserID'] . "'");
            if ($res) {
                $row = $res->fetch_assoc(); // Fetch the first row as an associative array
                if ($row) {
                    $isAdmin = $row['isAdmin'];
                }
                $res->close(); // Close the result set
            }

            $result = $conn->query("SELECT * FROM bookings WHERE IsInCart = 1 AND UserID = '". $_SESSION['UserID'] ."'");
            $cartItems = $result->num_rows;
            
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
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body style="    background-color: antiquewhite;">
<!-- <body style=" background-image: url('./images/bk.jpg');     background-size: cover;
    background-repeat: no-repeat;"> -->
  <!-- <nav class="navbar navbar-expand-lg" style="background-color: pink;">
    <a class="navbar-brand px-5"><h3>Pet Care</h3></a>
    <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto px-5">
            <li class="nav-item"><a href="#" class="nav-link active"><h4>Home</h4></a></li>
            <li class="nav-item"><a href="myPets.php" class="nav-link"><h4>Pets</h4></a></li>
            <li class="nav-item"><a href="myBookings.php" class="nav-link"><h4>Bookings</h4></a></li>
            <li class="nav-item">
              <form action="" method="post" class="nav-link">
                <button class="btn btn-info" name="logoutBtn">Logout</button>
              </form>
            </li>
            <li class="nav-item"><a href="cart.php" class="nav-link"><h4><i class="fa fa-shopping-cart" aria-hidden="true"></i><div class="position-absolute translate-middle badge rounded-pill bg-info" style="height: 20px; width: font-size: 5px; text-align: center">
              <p style="font-size: 10px;"><?php echo $cartItems ?></p><span class="visually-hidden">unread messages</span></div></h4></a></li>
            <li class="nav-item"><a href="profile.php" class="nav-link"><h4><i class="fa fa-user-circle-o" aria-hidden="true"></i></h4></a></li>
            <?php
            // Check if the user is an admin (assuming $isAdmin contains the isAdmin value)
            if ($isAdmin) {
                echo '<li class="nav-item"><a href="adminPage.php" class="nav-link"><h4>Admin</h4></a></li>';
            }
            ?>

        </ul>
    </div>
</nav> -->

<?php
include 'includes\header.php';
?>
<br><br>
<div class="image-container">
        <div class="slide">
            <div class="slideNumber"></div>
            <img src="./Images/bg3.jpg" style="      margin-top: -32px;   margin-left: -336px;
    height: 598px;
    width: 92em;
">
        </div>
        <div class="slide">
            <div class="slideNumber"></div>
            <img src="./Images/bg6.jpg" style="      margin-top: -32px;   margin-left: -336px;
    height: 598px;
    width: 92em;
">
        </div>
        <div class="slide">
            <div class="slideNumber"></div>
            <img src="./Images/bg4.jpg" style="       margin-top: -32px;  margin-left: -336px;
    height: 598px;
    width: 92em;
">
        </div>
 
        <!-- Next and Previous icon to change images -->
        <a class="previous" style="    margin-left: -276px;" onclick="moveSlides(-1)">
            <i class="fa fa-chevron-circle-left"></i>
        </a>
        <a class="next"  style="    margin-right: -277px;" onclick="moveSlides(1)">
            <i class="fa fa-chevron-circle-right"></i>
        </a>
    </div>
    <br>
 
    <div style="text-align:center">
        <span class="footerdot" onclick="activeSlide(1)">
        </span>
        <span class="footerdot" onclick="activeSlide(2)">
        </span>
        <span class="footerdot" onclick="activeSlide(3)">
        </span>
    </div><br>
    <div class="wholeDiv">
        <div class="mb-4">
          <h5>Hi <span class="text text-warning"><?php echo $_SESSION['UserName']; ?></span>. What are you looking for?</h5>
        </div>
        <section class="cards-container" >
            <div class="card" style="width: 18rem;" role="button" onclick="service('Veterinary')">
                <h4>Veterinary</h4>
                <img class="card-img-top" src="Images/corps-removebg.png" alt="Dog">
                <button class="bookBtn" id="vet">Book Now</button>
              </div>
    
              <div class="card" style="width: 18rem;" role="button" onclick="service('Training')">
                <h4>Training</h4>
                <img class="card-img-top" src="Images/train1.png" alt="Dog">
                <button class="bookBtn" id="tr">Book Now</button>
              </div>
    
              <div class="card" style="width: 18rem;" role="button" onclick="service('Grooming')">
                <h4>Grooming</h4>
                <img class="card-img-top" src="Images/groom2.png" alt="Dog">
                <button class="bookBtn" id="gr">Book Now</button>
              </div>
    
              <div class="card" style="width: 18rem;" role="button" onclick="service('Walking')">
                <h4>Walking</h4>
                <img class="card-img-top" src="Images/bg4-removebg.png" style="width: 330px;
    margin-left: -113px;" alt="Dog">
                <button class="bookBtn" id="wlk">Book Now</button>
              </div>
        </section>
    </div>

    <?php
      if(isset($_POST['logoutBtn'])) {
        $_SESSION['UserName'] = '';
        unset($_SESSION);
        session_destroy();
        header('Location: ' . 'index.php', true);
        exit();
      }
            ?>

<script>
  function service(service) {
    window.location.href = "serviceTypes.php?service="+service;
  }
</script>
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
    top: 110%;
    left: 5%;
    vertical-align: middle;
    
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 80vh;
    width: 90%;
    border-radius: 20px;
}
.text-warning {
    --bs-text-opacity: 1;
    
    /* color: rgba(var(--bs-warning-rgb),var(--bs-text-opacity))!important; */
}
.card:hover{
  transform: scaleX(1.1);
}
.card {
  height: 283px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #d9d9d9;
    border: none;
    border-radius: 216px;
    margin: 8px 21px;
}
  </style>

<style>
  img {
	width: 100%;
}

.height {
	height: 10px;
}

/* Image-container design */
.image-container {
	max-width: 800px;
	position: relative;
	margin: auto;
}

.next {
	right: 0;
}

/* Next and previous icon design */
.previous,
.next {
	cursor: pointer;
	position: absolute;
	top: 50%;
	padding: 10px;
	margin-top: -25px;
}

/* caption decorate */
.captionText {
	color: #000000;
	font-size: 14px;
	position: absolute;
	padding: 12px 12px;
	bottom: 8px;
	width: 100%;
	text-align: center;
}

/* Slider image number */
.slideNumber {
	/* background-color: #5574C5; */
	color: white;
	border-radius: 25px;
	right: 0;
	opacity: .5;
	margin: 5px;
	width: 30px;
	height: 30px;
	text-align: center;
	font-weight: bold;
	font-size: 24px;
	position: absolute;
}

.fa {
  color: orange;
	font-size: 32px;
}

.fa:hover {
	transform: rotate(360deg);
	transition: 1s;
	color: white;
}

.footerdot {
	cursor: pointer;
	height: 15px;
	width: 15px;
	margin: 0 2px;
	background-color: #bbbbbb;
	border-radius: 50%;
	display: inline-block;
	transition: background-color 0.5s ease;
}

.active,
.footerdot:hover {
	/* background-color: black; */
}

  </style>

  <script>
    let slideIndex = 1;
displaySlide(slideIndex);

function moveSlides(n) {
	displaySlide(slideIndex += n);
}

function activeSlide(n) {
	displaySlide(slideIndex = n);
}

/* Main function */
function displaySlide(n) {
	let i;
	let totalslides =
		document.getElementsByClassName("slide");
	let totaldots =
		document.getElementsByClassName("footerdot");

	if (n > totalslides.length) {
		slideIndex = 1;
	}

	if (n < 1) {
		slideIndex = totalslides.length;
	}
	for (i = 0; i < totalslides.length; i++) {
		totalslides[i].style.display = "none";
	}
	for (i = 0; i < totaldots.length; i++) {
		totaldots[i].className =
			totaldots[i].className.replace(" active", "");
	}
	totalslides[slideIndex - 1].style.display = "block";
	totaldots[slideIndex - 1].className += " active";
}

  </script>

</body>






</html>