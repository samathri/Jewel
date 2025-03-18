<?php
session_start(); // Start the session

include 'php/db.php'; // Include database connection

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_email']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : null; // Get user's name if logged in
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <script src="js/validation.js" defer></script>
    <link rel="stylesheet" href="css/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
      
.dropdown-menu {
  overflow: hidden; /* Prevent scrollbars */
  border: none; /* Remove border */
  background-color: transparent; /* Transparent background */
  text-align: left; /* Align text to the right */
  background-color: #fff;
  border-radius: 0px;
}

.dropdown-item {
  color: #000; /* Black text color */
}

.dropdown-item:hover {
  color: #000; /* Keep text color on hover */
  background-color: transparent !important; /* Prevent hover background */
}

/* Dropdown button - no hover, focus, active color changes */
.dropdown .btn-secondary {
  background-color: transparent !important; /* Transparent background */
  border: none !important; /* No border */
  box-shadow: none !important; /* No shadow */
  color: inherit; /* Keep text color as inherited */
}

.dropdown .btn-secondary:hover,
.dropdown .btn-secondary:focus,
.dropdown .btn-secondary:active,
.dropdown .btn-secondary.show {
  background-color: transparent !important; /* No background color on hover, focus, or active */
  box-shadow: none !important; /* No shadow */
  outline: none !important; /* Remove focus outline */
  color: inherit !important; /* Keep text color consistent */
}

    /* Remove background color from icons */
    .navbar a.text-dark {
      background-color: transparent !important;
      /* Ensure no background color */
      border: none;
      /* Remove any border that might appear */
      box-shadow: none;
      /* Remove any focus or hover box-shadow */
      outline: none;
      /* Remove focus outline */
      color: inherit;
      /* Keep the color consistent */
    }

    /* Ensure no background or border on hover or focus */
    .navbar a.text-dark:hover,
    .navbar a.text-dark:focus,
    .navbar a.text-dark:active {
      background-color: transparent !important;
      /* No background color on hover/focus */
      color: inherit;
      /* Keep icon color unchanged */
      border: none;
      /* Prevent any borders */
      box-shadow: none;
      /* No shadow on focus or hover */
      outline: none;
      /* No focus outline */
    }

   

    /* Navbar Styles */
    .navbar-nav {
      margin: 10px 200px;
      flex: 1;
      gap: 40px;
      justify-content: center;
    }

    @media (min-width: 993px) and (max-width: 1400px) {
    .navbar-nav {
      gap: 0px; /* Reduces space between navbar items */
      
    }
  }

    @media (max-width: 992px) {
      .navbar-nav {
        gap: 0px;
        
      }
    }

    .navbar-nav .nav-link {
      color: black !important;
      text-decoration: none;
      font-weight: 400;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #007bff;
    }

    .navbar-nav .nav-link.active {
      font-weight: bold;
      text-decoration: underline;
      color: black !important;
    }

    /* Search Bar Styles */
    #searchBar {
      position: absolute;
      top: -300px;
      /* Initially hidden by 300px */
      left: 0;
      right: 0;
      width: 100%;
      background: white;
      padding: 10px 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: top 0.5s ease;
      z-index: 1049;
      /* Below the search bar but above content */
    }

    #searchBar.active {
      top: 30%;
      /* Position the search bar to the middle of the page */
      transform: translateY(-30%);
      /* Center the search bar vertically */
    }

    .search-input {
      width: calc(100% - 40px);
      /* Adjust width to account for the button */
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 0px;
      box-sizing: border-box;
      display: inline-block;
      margin-left: 25%;

    }

    .search-btn,
    .close-btn {
      padding: 12px 15px;
      margin-left: 10px;
      border: 1px solid #ddd;
      background-color: #f8f9fa;
      cursor: pointer;
      border-radius: 0px;
      /* Ensures the button has sharp edges */
      display: inline-block;
    }

    .close-btn {
      margin-right: 25%;
    }

    .search-btn {
      background-color: #000;
      color: white;
    }

    .close-btn {
      background-color: #f8f9fa;
      color: #333;
    }

    .search-btn:hover,
    .close-btn:hover {
      background-color: #e2e6ea;
    }

    /* Icon Styles */
    .d-flex.align-items-center i {
      font-size: 1rem;
    }


    /* Responsive Design */
    @media (max-width: 1024px) {
      .search-input {
        margin-left: 0;
        /* Remove left and right margin */
      }

      .close-btn {
        margin-right: 0;
        margin-left: 10px;
        /* Remove left and right margin */

      }

      #searchBar.active {
        top: 20%;
        /* Position the search bar to the middle of the page */
        transform: translateY(-20%);
        /* Center the search bar vertically */
      }
    }

    .password-container{
      position: relative;
    }

    .password-container input{
      width: 100%;
      padding-right: 35px;
    }

    .password-container .eye-icon{
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translate(-50%);
      cursor: pointer;
    }

    
    
  </style>

    <title>Signup</title>
  </head>
  <body>

  
<header class="bg-white py-3">
  <!-- Logo Section -->
  <div class="container text-center">
    <img src="Images/logo-2.svg" alt="Logo" class="img-fluid" width="300px">
  </div>

  <!-- Search Bar -->
  <div id="searchBar">
    <div class="container d-flex justify-content-between">
      <!-- Search Input -->
      <input type="text" class="search-input" placeholder="Search here...">
      <!-- Search Button -->
      <button class="search-btn">
        <i class="fas fa-search"></i>
      </button>
      <!-- Close Button -->
      <button class="close-btn" id="closeSearchBar">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <!-- Search Icon -->
    <a href="#" class="text-decoration-none text-dark" id="searchToggle" style="margin-left: 10px;">
      <i class="fas fa-search"></i>
    </a>

    <!-- Navbar Items -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav" style="margin-left: 20px;">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="custom.php">CUSTOM ORDERS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="collectionew.php">COLLECTIONS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">BLOG</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">CONTACT</a>
        </li>
      </ul>
    </div>
          <!-- Profile and Cart Icons -->
          <div class="d-flex align-items-center ms-auto" style="gap: 10px;">
            <div class="dropdown">
              <!-- Check if the user is logged in -->
              <?php if ($is_logged_in): ?>
                <!-- Show logout only for logged-in users -->
                <button class="btn btn-secondary dropdown-toggle text-dark" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span><?php echo htmlspecialchars($user_name); ?></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/Serandi/Serandi 2/custom-profile.php">Profile</a>
                <a class="dropdown-item" href="/Serandi/Serandi 2/logout.php">Logout</a>
                </div>
              <?php else: ?>
                <!-- Show login only for non-logged-in users -->
                <button class="btn btn-secondary dropdown-toggle text-dark" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                  <i class="fas fa-user fa-lg"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="/Serandi/Serandi 2/login.php">Login</a>
                </div>
              <?php endif; ?>
            </div>

            <!-- Shopping Bag Icon -->
            <a href="mycart.php" class="text-decoration-none text-dark">
              <i class="fas fa-shopping-bag" style="margin-right: 12px;"></i>
            </a>
          </div>
      </div>
  </nav>
</header>
 
    <!-- Sign-Up Form -->
    <div class="container my-5">
      <div class="title-with-lines">
        <div class="line"></div>
        <h1>Sign Up</h1>
        <div class="line"></div>
      </div>
      <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="sign-up-form text-center p-4">
        <form action="process-signup.php" method="post" id="signup" novalidate onsubmit="return checkTerms();">
        <div class="form-container">
              <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
    <label for="password">Password</label>
    <div class="password-container">
        <!-- Password input field -->
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        <!-- Eye icon for showing/hiding password -->
        <span class="eye-icon" id="togglePassword">
            <i class="fas fa-eye-slash" id="eyeIcon"></i>
        </span>
    </div>
</div>





<label for="password">Password</label>
<div class="password-container">
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
    <span class="eye-icon" id="togglePassword">
        <i class="fas fa-eye-slash" id="eyeIcon"></i>
    </span>
</div>


              <div class="form-check text-left mb-3">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
              </div>
              
              <button type="submit" class="btn btn-register">Sign Up</button>
            </div>
            <div class="divider">or</div>
            <div class="social-login">
              <a href="#" class="social-icon google">
                <i class="fab fa-google"></i> Google
              </a>
              <a href="#" class="social-icon facebook">
                <i class="fab fa-facebook-f"></i> Facebook
              </a>
            </div>
            <div class="login-link">
              <p>Already have an account? <a href="login.php" class="login-text">Login</a></p>
            </div>
          </form>
          
          <?php
          // Check if the sign-up was successful
          if (isset($_GET['signup']) && $_GET['signup'] == 'success') {
              echo "<script>
            alert('Sign-up is successful! Now you can log in.');
            // After the user clicks OK, redirect to login.php
            window.location.href = 'home.php';
          </script>";
          }

          
        
          ?>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
      <div class="container p-4">
        <div class="row">
          <div class="col-lg-4 col-md-12 mb-4">
            <h3>Quick Links</h3>
            <ul class="footer-links">
              <li><a href="#">Home</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Custom Orders</a></li>
              <li><a href="#">Collections</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Shop</a></li>
              <li><a href="/Serandi/Serandi 2/faqs.php">Customer Care</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 contact-info-container" style="margin-left:-10px;">
            <h3>Contact Information</h3>
            <ul class="footer-contact">
              <li><i class="fas fa-phone rotated-phone"></i> 011-1231234</li>
              <li><i class="fas fa-phone rotated-phone"></i> 011-1231234</li>
              <li><i class="fas fa-envelope"></i> serendiM@gmail.com</li>
              <li><i class="fas fa-map-marker-alt"></i> Colombo 3, Sri Lanka</li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="footer-column2">
              <p>Join our email list for exclusive offers and the latest news.</p>
              <form class="newsletter-form" onsubmit="validateEmail(event)">
                <div class="newsletter-input-container">
                  <input type="email" id="emailInput" class="newsletter-email-input" placeholder="Enter your email" required />
                  <button type="submit" class="submit-btn">Subscribe</button>
                </div><br>
                <div class="social-media">
                  <h4>Connect</h4>
                  <ul class="social-icons">
                    <li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.pinterest.com" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2024 Your Company Name. All rights reserved.</p>
      </div>
    </footer>

    <script>
      
    // search bar

    const searchToggle = document.getElementById('searchToggle');
    const searchBar = document.getElementById('searchBar');
    const closeSearchBar = document.getElementById('closeSearchBar');

    // Toggle search bar visibility
    searchToggle.addEventListener('click', (e) => {
      e.preventDefault();
      searchBar.classList.toggle('active'); // Show or hide the search bar
    });

    // Close search bar when close button is clicked
    closeSearchBar.addEventListener('click', (e) => {
      searchBar.classList.remove('active'); // Hide the search bar
    });

    </script>

    <script>
          // Search bar toggle
          const searchToggle = document.getElementById('searchToggle');
          const searchBar = document.getElementById('searchBar');
          const closeSearchBar = document.getElementById('closeSearchBar');
      
          searchToggle.addEventListener('click', () => {
              searchBar.classList.add('active');  // Show search bar when the toggle is clicked
          });
      
          closeSearchBar.addEventListener('click', () => {
              searchBar.classList.remove('active');  // Hide search bar when the close button is clicked
          });
      </script>

<script>
      // Add event listener to the password toggle button
document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');  // Get the password input field
    const eyeIcon = document.getElementById('eyeIcon');  // Get the eye icon

    // Toggle the password visibility
    if (passwordField.type === 'password') {
        passwordField.type = 'text';  // Change input type to 'text'
        eyeIcon.classList.remove('fa-eye-slash');  // Remove 'eye-slash' icon
        eyeIcon.classList.add('fa-eye');  // Add 'eye' icon
    } else {
        passwordField.type = 'password';  // Change input type back to 'password'
        eyeIcon.classList.remove('fa-eye');  // Remove 'eye' icon
        eyeIcon.classList.add('fa-eye-slash');  // Add 'eye-slash' icon
    }
});


</script> 



  </body>
</html>
