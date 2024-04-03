<?php
    session_start();
    // if(isset($_SESSION['UserName']) && $_SESSION['UserName'] != '') {
    //     header('Location: ' . 'homepage.php', true);
    //     exit();
    // }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pets_care";
                
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (isset($_POST['submitBtn'])) {
        $email = $_POST['uname'];
        $password = $_POST['pass'];

        $result = $conn->query("SELECT * FROM customer_details WHERE Email='$email' AND Password= '$password'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['UserID'] = $row['UserID'];
            $_SESSION['UserName'] = $row['Name'];

            // Check isAdmin and designation for redirection
            if ($row['isAdmin'] == 1) {
                header('Location: ' . 'adminPage.php', true);
                exit();
            } elseif ($row['designation'] == 1 || $row['designation'] == 2 || $row['designation'] == 3) {
                header('Location: ' . 'doctorpage.php', true);
                exit();
            } else {
                header('Location: ' . 'homepage.php', true);
                exit();
            }
        } else {
            echo '<p class="text text-danger">User not found. Please try again!</p>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twisty Tails</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
<!-- <style>
  
    .button {
        min-width: 123px;
    min-height: 0px;
  font-family: 'Nunito', sans-serif;
  font-size: 22px;
  text-transform: uppercase;
  letter-spacing: 1.3px;
  font-weight: 700;
  color: #313133;
  background: #4FD1C5;
background: linear-gradient(90deg, rgba(129,230,217,1) 0%, rgba(79,209,197,1) 100%);
  border: none;
  border-radius: 1000px;
  /* box-shadow: 12px 12px 24px rgba(79,209,197,.64); */
  transition: all 0.3s ease-in-out 0s;
  cursor: pointer;
  outline: none;
  position: relative;
  padding: 10px;
  margin-left: 156px;
  }

button::before {
content: '';
  border-radius: 1000px;
  min-width: calc(160px + 12px);
    min-height: calc(40px + 12px);
  border: 6px solid #00FFCB;
  box-shadow: 0 0 60px rgba(0,255,203,.64);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: all .3s ease-in-out 0s;
}

.button:hover, .button:focus {
  color: #313133;
  transform: translateY(-6px);
}

button:hover::before, button:focus::before {
  opacity: 1;
}

/* button::after {
  content: '';
  width: 30px; height: 30px;
  border-radius: 100%;
  border: 6px solid #00FFCB;
  position: absolute;
  z-index: -1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: ring 1.5s infinite;
} */

button:hover::after, button:focus::after {
  animation: none;
  display: none;
}

@keyframes ring {
  0% {
    width: 30px;
    height: 30px;
    opacity: 1;
  }
  100% {
    width: 300px;
    height: 300px;
    opacity: 1;
  }
}
    </style> -->
</head>
<body style="background:url(Images/bg1.jpg);background-size:cover;">

    <div class="wholeDiv" style="position: absolute;
    top: 7.5%;
    left: 60%;
    vertical-align: middle;
    background-color: antiquewhite;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    height: 85vh;
    width: 35%;">
        <!-- <div class="sideView">
        <img class="card-img-top" style="width: 90% ; margin-top:10px" src="./Images/footer-img4.png" alt="Dog">
        </div> -->
       
        <div class="form">
        <img style="margin-left: 130px;
    margin-top: -25px;
    width: 209px;" src="Images/logotwistpreview.png">
            <h4>Welcome to Twisty Tails</h4>
            <span class="span"></span>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="loginForm" autocomplete="off">
                <label for="uname">Email</label>
                <input style="background: antiquewhite;" type="text" name="uname" id="" value="">
                <label for="pass">Password</label>
                <div class="passwordInput">
                    <input type="password" style="background: antiquewhite;" name="pass" id="id_password" value="">
                    <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; display: inline;"></i>
                </div>
                <button type="submit" class="submitBtn" name="submitBtn" style="width: 110px;
    margin-left: 149px; background-color: #f7941d;">Login</button>
                <!-- <div class="wrap">
  <button  type="submit" name="submitBtn" class="button">Login</button>
</div> -->
            </form>
           
            <a href="" class="forgotPass">Forgot password?</a>
            <a type="button" class="btn btn-success signUpBtn" href="sign-up.php" style="width: 113px;
    margin-left: 176px;">Sign Up</a>
        </div>
    </div>
</body>

<script>
    const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
</script>

<script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</html>