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
  <title>Serendi & Marquise</title>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">


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


    .featured-items-wrapper {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      /* Default: Desktop - 3 items per row */
      gap: 20px;
    }


    /* Item Image */
    .item-image {
      width: 100%;
      /* Take full width of its container */
      aspect-ratio: 1 / 1;
      /* Maintain a square aspect ratio */
      object-fit: cover;
      /* Ensure images fill the area without distortion */
      display: block;
    }

    /* Item Info */
    .item-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
    }

    /* Responsive Design */

    /* Tablet: 3 items per row */
    @media screen and (max-width: 1024px) {
      .featured-items-wrapper {
        grid-template-columns: repeat(1, 1fr);
        
        /* Keep 3 items per row */
      }
    }

    /* Mobile: 2 items per row */
    @media screen and (max-width: 992px) {
      .featured-items-wrapper {
        grid-template-columns: repeat(1, 1fr);

        /* 2 items per row */
      }
    }

    /* Show only the first 6 items */
    .featured-items-wrapper .item-box:nth-child(n+7) {
      display: none;
    }


    .add-to-cart {
      background: transparent;
      text-transform: uppercase;
      border: 1px solid #000000;
      color: #000000;
      padding: 10px;
      cursor: pointer;
      margin-top: 10px;
      font-size: 14px;
    }

    .item-name {
      font-size: 18px;
      text-align: left;
      font-weight: 400;
      padding-top: 10px;
      text-transform: capitalize;

    }


    .item-price {
      font-size: 16px;
      font-weight: bold;
      color: #000000;
      text-align: left;
      padding-bottom: 10px;
    }

    .card-link {
      display: block;
      background: #f5f5f5ff;
      padding: 2rem;
      user-select: none;
      text-decoration: none;
      border: 2px solid transparent;
      height: 100%;
      margin: 50px 0px;
    }

    .card-title {
      color: #000000;
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 20px;
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
      
      .navbar {
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
  </style>

</head>

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
    <a href="#" class="text-decoration-none text-dark" id="searchToggle" style="margin-right: 20px;">
      <i class="fas fa-search"></i>
    </a>

    <!-- Navbar Items -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">HOME</a>
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
          <div class="d-flex align-items-center ms-auto  " style="gap: 10px;">
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
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user fa-lg"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="/Serandi/Serandi 2/login.php">Login</a>
                </div>
              <?php endif; ?>
            </div>

            <!-- Shopping Bag Icon -->
            <a href="mycart.php" class="text-decoration-none text-dark">
              <i class="fas fa-shopping-bag"></i>
            </a>
          </div>
      </div>



  </nav>
</header>

<!-- Hero Section -->
<section class="hero-section">
  <div class="hero-content">
    <h1 class="hero-title">Separated in body<br>but united in emotion</h1>
    <p class="hero-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
      labore et dolore magna aliqua. </p><br>

    <button class="btn-1 hero-btn"><a href="collectionew.php">SHOP NOW</a></button>
  </div>
</section>

<!-- Main Content Section -->
<div class="container mt-5">
  <!-- Heading 3 -->
  <div class="title-with-lines">
    <div class="line"></div>
    <h1> Where Heritage Meets Artistry </h1>
    <div class="line "></div>
  </div>


  <div class="content-container">
    <img src="Images/logo.svg" alt="Description of image" class="image" style="width:300px">
    <div class="text-content">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua.</p>

      <!-- "Read More" button directly after the first paragraph -->
      <div class="toggle-button"><a style="background: none;">Read More</a></div>

      <!-- Hidden content (second paragraph) -->
      <div class="hidden-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
          dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
          incididunt ut labore et dolore magna aliqua.</p>
      </div>

      <!-- "Read Less" button after the second paragraph -->
      <div class="toggle-button-hidden"><a style="background: none;">Read Less</a></div>
    </div>
  </div>
</div>
</section>
</div>


<!-- Featured Items Section -->
<section class="featured-items-section">
  <div class="container-fluid">
    <div class="title-container">
      <h3 class="caption-title">Featured Collections</h3>
      <button class="btn-1 featured-btn float-end"><a href="collectionew.php">SHOP NOW</a></button>
    </div>
    <div class="line3"></div>


    <div class="featured-items-wrapper">
      <?php
      include 'php/db.php';

      // Fetch product data from the database
      $sql = "SELECT * FROM product";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $Productname = htmlspecialchars($row['Productname']);
          $Price = htmlspecialchars($row['Price']);
          $Description = htmlspecialchars($row['Description']);
          $image = '/Serandi/Serandi 2/php/uploads/product/' . htmlspecialchars($row['image']);
          $ProductID = htmlspecialchars($row['id']);

          echo '
              <div class="item-box" data-price="' . $Price . '">
                  <img src="' . $image . '" class="item-image" alt="' . $Productname . '">
                  <div class="item-info">
                      <div class="item-details">
                          <span class="item-name">' . $Productname . '</span>
                          <h4 class="item-price">$' . $Price . '</h4>
                      </div>
                      <i class="far fa-heart favorite-icon" onclick="toggleHeart(this)"></i>
                  </div>
                  <form action="/Serandi/Serandi 2/detail-page.php" method="POST">
                      <input type="hidden" name="id" value="' . $ProductID . '">
                      <input type="hidden" name="product_name" value="' . $Productname . '">
                      <input type="hidden" name="price" value="' . $Price . '">
                      <input type="hidden" name="image" value="' . $image . '">
                      <button type="submit" class="add-to-cart">Add to Cart</button>
                  </form>
              </div>';
        }
      } else {
        echo "<p>No products found.</p>";
      }

      $conn->close();
      ?>
    </div>

  </div>
</section>



<!-- About Us -->
<div class="container mt-5">
  <div class="title-with-lines">
    <h1>About Us</h1>
  </div>
  <div class="line2"></div>
  <div class="row mt-5 align-items-center text-center">



    <!-- Image Slider Block -->
    <div class="col-lg-6">
      <div id="imageSlider" class="carousel slide row2" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="Images/about-1.jpeg" class="d-block" width="600px" height="350px" alt="Image 1">
            <div class="carousel-caption d-none d-md-block text-left">
              <h5 class="carousel-caption-image">We select only the finest gemstones</h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="Images/about-2.jpeg" class="d-block" width="600px" height="350px" alt="Image 2">
            <div class="carousel-caption d-none d-md-block text-left">
              <h5 class="carousel-caption-image">we customize our services for your satitsfaction
              </h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="Images/about-3.jpg" class="d-block" width="600px" height="350px" alt="Image 3">
            <div class="carousel-caption d-none d-md-block text-left">
              <h5 class="carousel-caption-image">we work with the most talented artisans</h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="Images/about-4.jpeg" class="d-block" width="600px" height="350px" alt="Image 4">
            <div class="carousel-caption d-none d-md-block text-left">
              <h5 class="carousel-caption-image">we work with the most talented artisans</h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="Images/about-5.jpeg" class="d-block" width="600px" height="350px" alt="Image 5">
            <div class="carousel-caption d-none d-md-block text-left">
              <h5 class="carousel-caption-image">we work with the most talented artisans</h5>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
      </div>
    </div>

    <!-- Text Block -->
    <div class="col-lg-6 text-center text-lg-center">
      <img src="Images/logo.svg" alt="" style="width:300px">
      <p>Discover the unparalleled elegance of Serendi co, a pioneering name in Sri Lanka's jewellery scene since
        1962. Renowned for exquisite craftsmanship and premium quality. </p>
      <a href="about.php" class="text-center-btn ">Read More</a>
    </div>
  </div>
</div>
<img src="" alt="">

<div class="newsletter-section">
  <div class="form-container">
    <h3 class="form-title">SIGN UP NOW!</h3>
    <p>Subscribe now and receive 20% for your next online purchase.</p>
    <form class="newsletter-form">
      <div class="input-container">
        <input type="email" placeholder="your email" required class="email-input">
        <button type="submit" class="submit-button">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill"
            viewBox="0 0 16 16">
            <path
              d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
          </svg>
        </button>
      </div>
    </form>
  </div>
</div>



<!-- Testimonials Section -->
<section class="testimonials-section">
  <div class="container">
    <div class="title-with-lines">
      <h1>Testimonials</h1>

    </div>
    <div class="line2"></div>

    <div class="swiper testimonial-slider">
      <div class="swiper-wrapper">
        <!-- Card 1 -->

        <?php
        include 'php/db.php';
        $limitreview = 10;
        $reviewsql = "SELECT * FROM review LIMIT $limitreview";
        $reviewresults = $conn->query($reviewsql);

        if ($reviewresults && $reviewresults->num_rows > 0) {
          // Output data for each row
          while ($row = $reviewresults->fetch_assoc()) {
            echo '<div class="swiper-slide">
            <div class="card-link">
              <img src="https://i.pravatar.cc/150?img=1" alt="Ellen Parker" class="card-image">
              <h2 class="card-title">' . htmlspecialchars($row['name']) . '</h2>
              <p class="content">' . htmlspecialchars($row['review']) . '</p>
              <div class="rating">
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
              </div>
            </div>
          </div>';
          }
        } else {
          echo "<p>No reviews found</p>";
        }

        ?>




        <!-- Card 3 -->


        <!-- Card 4 -->


        <!-- Card 5 -->

        <!-- Card 6 -->

      </div>

      <!-- Navigation -->
      <div class="swiper-button-next" style="color: rgb(0, 0, 0, 0.7);"></div>
      <div class="swiper-button-prev" style="color: rgb(0, 0, 0, 0.7);"></div>

      <!-- Pagination -->
      <div class="swiper-pagination" style="color: rgb(0, 0, 0, 0.7);"></div>
    </div>
  </div>
</section>





<!--footer-->
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
            <li><a href="#">Customer Care</a></li>
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
            <form class="newsletter-form newsletter-form" onsubmit="validateEmail(event)">
              <div class="newsletter-input-container">
                <input type="email" id="emailInput" class="newsletter-email-input newsletter-input" placeholder="Enter your email" required />
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-8w2NFxBQhX1MprMRHavvPiwRfxIWCu8rZib1/3VvqFT2R2p3mv3YI+N6JcB8o4tq" crossorigin="anonymous"></script>


<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-8w2NFxBQhX1MprMRHavvPiwRfxIWCu8rZib1/3VvqFT2R2p3mv3YI+N6JcB8o4tq" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script>

  document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.testimonial-slider', {
      slidesPerView: 3,
      spaceBetween: 30,
      loop: true,
      centeredSlides: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        }
      }
    });
  });
</script>

<script>
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

</body>

</html>