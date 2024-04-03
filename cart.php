
<?php session_start(); 
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
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="cart.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<body style="background:url(Images/gallery-img4.jpg);background-size:cover;">
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

    <div class="cards-container">
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pets_care";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $bill = 0;

    $result = $conn->query("SELECT * FROM bookings WHERE IsInCart = 1 AND UserID = '". $_SESSION['UserID'] ."'");
    if ($result->num_rows > 0) {
        $count = 0; // Counter to track number of cards printed
        echo '<div class="row">'; // Start the row
        while ($row = $result->fetch_assoc()) {
            if ($count % 3 == 0 && $count != 0) {
                echo '</div><div class="row">'; // Close the previous row and start a new one
            }
            echo '<div class="col-md-4">
                    <div class="card" role="button">
                        <i name="group1" style="margin-top: 135px;
                        margin-right: 35px;"  class="radio fa fa-trash" role="button" id="' . $row['BookingID'] . '" onclick="deleteItem(\'' . $row['BookingID'] . '\')"></i>
                        <h4>' . $row['Service'] . '</h4>
                        <h6>' . $row['Type'] . '</h6> 

                        <div class="card-body">
                            <h5>&#x20b9; ' . $row['Amount'] . '</h5>
                            <a href="javascript:void(0)" style="margin-left: -7px;" class="btn btn-sm btn-primary float-right buy_now" data-img="//www.tutsmake.com/wp-content/uploads/2019/03/jhgjhgjg.jpg" data-amount="' . $row['Amount'] . '"  data-id="3">Book Now</a>
                        </div>
                    </div>
                </div>';
            $count++;
        }
        echo '</div>'; // Close the last row
        echo '<div>
            </div>
            <p class="text text-danger" id="cartError"></p>';
    } else {
        echo '<div class="row" role="button">
                <div class="col">
                    <img src="./Images/emptyCart.svg"></img>
                    <h4>Your Cart is Empty</h4>
                </div>
            </div>';
    }
?>



        
    </div>


    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModelLabel" aria-hidden="true">
    <div class="modal-dialog"  role="document">
        <div class="modal-content" id="modal-content">
            <div class="modal-header" id="modal-header">
                <h5 class="modal-title" id="addPetModalLabel">Confirm</h5>
            </div>
            <div class="modal-body form-group" id="modal-dialog">
                <h4>Pay: <?php echo $bill.'?'; ?></h4>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addPetSubmit" onclick="confirm('<?php echo $_SESSION['UserID']; ?>')">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Assuming you have an array of amounts fetched from the database
    var amounts = <?php echo json_encode($amountsArray); ?>;

    // Get all elements with the class 'buy_now' and update their data-amount attribute
    document.addEventListener('DOMContentLoaded', function() {
        var buyNowButtons = document.querySelectorAll('.buy_now');
        buyNowButtons.forEach(function(button, index) {
            button.setAttribute('data-amount', amounts[index]);
        });
    });
</script>

    <script>
    function deleteItem(id) {
        $.ajax({
            type: "POST",
            url: "deleteItemFromCart.php",
            data: {
                id: id
            },
            success: function (response) {
                if (response == 'Deleted') {
                    window.location.href = "cart.php";
                } else {
                    document.getElementById('cartError').innerHTML = "Some problem occurred. Please try again!";
                }
            },
            error: function (xhr, status, error) {
                // Handle errors here
            }
        });
    }

    function pay() {
        $('#confirmModal').modal('show');
    }

    function confirm(id) {
        $.ajax({
            type: "POST",
            url: "book.php",
            data: {
                id: id
            },
            success: function (response) {
                if (response == 'Success') {
                    document.getElementById('modal-content').innerHTML = "<div class='mx-3 my-5'><h4>Payment Succesful!</h4><i style='transform: scale(2)' class='fa fa-check text text-success'></i></div>";
                    setTimeout(function () {
                        window.location.href = "homepage.php";
                    }, 2000);
                } else {
                    document.getElementById('cartError').innerHTML = "Some problem occurred. Please try again!";
                }
            },
            error: function (xhr, status, error) {
                // Handle errors here
            }
        });

    }
</script>
<!-- razorpay script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

  $('body').on('click', '.buy_now', function(e){
    var prodimg = $(this).attr("data-img");
    var totalAmount = $(this).attr("data-amount");
    var product_id =  $(this).attr("data-id");
    var options = {
    "key": "rzp_test_CPgJvkClvfmATv",
    "amount": (totalAmount*100), // 2000 paise = INR 20
    "name": "Tutsmake",
    "description": "Payment",
 
    "handler": function (response){
          $.ajax({
            url: 'payment-proccess.php',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
            }, 
            success: function (msg) {

               window.location.href = 'https://www.tutsmake.com/Demos/php/razorpay/success.php';
            }
        });
     
    },

    "theme": {
        "color": "#528FF0"
    }
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.`preventDefault`();
  });

</script>

<script src=""></script>
<script>
 
  $('body').on('click', '.buy_now', function(e){
    var prodimg = $(this).attr("data-img");
    var totalAmount = $(this).attr("data-amount");
    var product_id =  $(this).attr("data-id");
    var options = {
    "key": "rzp_test_CPgJvkClvfmATv", // secret key id
    "amount": (totalAmount*100), // 2000 paise = INR 20
    "name": "Tutsmake",
    "description": "Payment",
 
    "handler": function (response){
          $.ajax({
            url: 'payment-proccess.php',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
            }, 
            success: function (msg) {
 
               window.location.href = 'payment-success.php';
            }
        });
      
    },
 
    "theme": {
        "color": "#528FF0"
    }
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
  });
 
</script>
</body>
</html>