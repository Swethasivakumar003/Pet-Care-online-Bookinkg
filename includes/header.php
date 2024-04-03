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
            <li class="nav-item"><a href="frontpage.php" class="nav-link"><h4 style="  font-size: 1rem;" >Logout</h4></a></li>
            <!-- <li class="nav-item">
              <form action="" method="post" class="nav-link">
               <a href="frontpage.php"> <button class="btn btn-info" name="logoutBtn">Logout</button></a>
              </form>
            </li> -->
            <li class="nav-item"><a href="cart.php" class="nav-link"><h4><i class="fa fa-shopping-cart" style="color: black;" aria-hidden="true"></i><div class="position-absolute translate-middle badge rounded-pill bg-info" style="height: 20px; width: font-size: 5px; text-align: center">
              <p style="font-size: 10px;"><?php echo $cartItems ?></p><span class="visually-hidden">unread messages</span></div></h4></a></li>
            <li class="nav-item"><a href="profile.php" class="nav-link"><h4><i class="fa fa-user-circle-o" style="color: black;" aria-hidden="true"></i></h4></a></li>
           

        </ul>
    </div>
</nav>
<style>
@media (min-width: 1200px)
.h4, h4 {
    font-size: 1rem;
}
    </style>