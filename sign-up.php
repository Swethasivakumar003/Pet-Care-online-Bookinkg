<?php
session_start();

// if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != '') {
//     header('Location: index.php');
//     exit();
// }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pets_care";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submitBtn'])) {
    $username1 = $_POST['name'];
    $phn = $_POST['phn'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $designationId = $_POST['designation'];

    try {
        // Use prepared statements to prevent SQL injection
        $stmtCheck = $conn->prepare("SELECT * FROM customer_details WHERE Email=? OR PhoneNumber=?");

if (!$stmtCheck) {
    die('Error preparing statement: ' . $conn->error);
}

$stmtCheck->bind_param("ss", $email, $phn);

if (!$stmtCheck->execute()) {
    die('Error executing statement: ' . $stmtCheck->error);
}

$resultCheck = $stmtCheck->get_result();


        if ($resultCheck->num_rows > 0) {
            echo '<p class="text text-danger">Email or phone number already in use!</p>';
        } else {
            $stmtInsert = $conn->prepare("INSERT INTO customer_details(Name, Email, PhoneNumber, Password, designation) VALUES(?, ?, ?, ?, ?)");
            $stmtInsert->bind_param("ssssi", $username1, $email, $phn, $password, $designationId);

            if (!$stmtInsert) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }

            // Check if the query executed successfully
            if ($stmtInsert->execute()) {
                $_SESSION['UserID'] = $stmtInsert->insert_id;
                $_SESSION['UserName'] = $username1;
                header('Location: index.php');
                exit();
            } else {
                throw new Exception("Error executing query: " . $stmtInsert->error);
            }
        }
    } catch (Exception $e) {
        echo '<p class="text text-danger">' . $e->getMessage() . '</p>';
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
</head>
<body style="background:url(Images/bgcat2.jpg);background-size:cover;">
    <div class="wholeDiv" style="position: absolute;
    top: 5px;
    left: 60%;
    vertical-align: middle;
    background-color: antiquewhite;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    height: 98vh;
    width: 34%;">
        <!-- <div class="sideView">
            <img class="card-img-top" style="width: 90% ; margin-top:10px" src="./Images/mainimage.png" alt="Dog">
        </div> -->
        <div class="form">
        <img style="margin-left: 152px;
    margin-top: -7px;
    width: 161px;" src="Images/logotwistpreview.png">
            <h4>Welcome to Twisty Tails</h4>
           
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="name">Name</label>
                <input type="text" name="name" id="">
                <label for="email">Email</label>
                <input type="email" name="email" id="">
                <label for="phn">Phone Number</label>
                <input type="tel" name="phn" id="">
                <label for="designation">Designation</label>
                <select name="designation" id="" style="border-radius: 11px;
    height: 34px;">
                    <?php
                    $sqlDesignations = "SELECT Id, dest FROM designation";
                    $resultDesignations = $conn->query($sqlDesignations);

                    if ($resultDesignations) {
                        echo "<option value=''>Choose</option>";
                        while ($rowDesignation = $resultDesignations->fetch_assoc()) {
                            echo  "<option value='{$rowDesignation["Id"]}'>{$rowDesignation["dest"]}</option>";
                        }
                    } else {
                        echo "Error: " . $conn->error;
                    }
                    ?>
                </select>

                <label for="pass">Password</label>
                <div class="passwordInput">
                    <input type="password" name="pass" id="id_password">
                    <i class="fa fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; display: inline;"></i>
                </div>
                <button type="submit" class="submitBtn" name="submitBtn" style="border: none;
    border-radius: 10px;
    height: 35px;
    margin: 10px -3px;
    background-color: #f7941d;
    color: #000;
    text-align: center;
    font-size: 20px;
    font-style: italic;
    font-weight: 700;
    line-height: normal;
    width: 110px;
    margin-left: 149px;">Sign Up</button>
            </form>
            <span class="span" style="margin-top: 23px;">Already Have An Account..?</span>
            <a type="button" class="btn btn-success signUpBtn" href="index.php" style="width: 113px;
    margin-left: 176px; margin-top:7px !important;">Log In</a>
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
