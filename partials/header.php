
<?php
session_start(); // Start the session

?>
<header>
        <!-- Navbar -->
        <nav class="navbar">
            <!-- Logo Section -->
            <div class="logo">
                <a href="index.php" class="brand-logo">
                    <img src="https://static-assets-web.flixcart.com/batman-returns/batman-returns/p/images/fkheaderlogo_exploreplus-44005d.svg"
                        width="160" height="40" title="Flipkart" alt="Flipkart Logo">
                </a>
            </div>
            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text"id="search-input" class="search-input" placeholder="Search for products, brands and more">
                <div id="search-results"></div> <!-- Dropdown for showing search results -->
            </div>
             

       
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
            <!-- Show Logout Button if user is logged in -->
            <form method="POST" action="partials/logout.php">
              <button type="submit" name="logout" class="btn btn-danger ms-2">Logout</button>
            </form>
        <?php else: ?>
        <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
        <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign Up</button>
        <?php endif; ?>
        <div class="ms-auto d-flex align-items-center">
          <!-- Cart Image with Redirect -->
        <img src="https://static-assets-web.flixcart.com/batman-returns/batman-returns/p/images/header_cart-eed150.svg"
            alt="Cart" class="_1XmrCc" width="24" height="24" onclick="window.location.href='cart.php';" style="cursor:pointer;">

        <!-- Three Dots Image with Dropdown -->
        <div class="dropdown">
            <img class="-dOa_b" src="https://static-assets-web.flixcart.com/batman-returns/batman-returns/p/images/header_3verticalDots-ea7819.svg"
                width="24" height="24" alt="Dropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;">

            <!-- Dropdown Menu -->
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="about.php">About Us</a></li>
                <li><a class="dropdown-item" href="contact.php">Contact Us</a></li>
                <li><a class="dropdown-item" href="terms.php">Terms & Conditions</a></li>
                <li><a class="dropdown-item" href="privacy.php">Privacy Policy</a></li>
            </ul>
        </div>
    </nav>
</header>
<?php
  // Start the session to access session variables

// Check if there's a login success or error message and display it
$alertMessage = '';
$alertType = ''; // Bootstrap alert type (success, danger, etc.)

if (isset($_SESSION['loginAlert'])) {
    // Set the alert message and alert type based on the session
    $alertMessage = $_SESSION['loginAlert'];
    
    // Determine the type of alert (success or danger)
    if (strpos($alertMessage, 'successful') !== false) {
        $alertType = 'alert-success';  // Success message
    } else {
        $alertType = 'alert-danger';  // Error message
    }
    
    // Unset the session alert after displaying it
    unset($_SESSION['loginAlert']);
}
?>
<?php 
       if ($alertMessage != ''): ?>
            <div class="alert <?php echo $alertType; ?>" role="alert">
                <?php echo $alertMessage; ?>
            </div>
        <?php endif; ?>
         <!-- Check if the user is logged in and show their name -->
    
<!-- Display success or error message here -->
<?php
  // Display success or error alerts based on GET parameters
  if (isset($_GET['signupsuccess'])) {
      if ($_GET['signupsuccess'] == 'true') {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> You can log in now.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
      } else {
          if (isset($_GET['error'])) {
              $errorMessage = htmlspecialchars($_GET['error']);
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> ' . $errorMessage . '
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
          }
      }
  }
  ?>
    <!-- Carousel Section -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/img10.jpg" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="img/img11.jpg" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="img/img12.jpg" class="d-block w-100" alt="Image 3">
            </div>
            <div class="carousel-item">
                <img src="img/img13.jpg" class="d-block w-100" alt="Image 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and Popper.js (required for alerts) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

