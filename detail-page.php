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
  <!-- <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet"> -->
  <link rel="stylesheet" href="css/deatil-page.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap 5.3.0 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
<style>

.reviews-list { margin-top: 20px; }
.review-item { margin-bottom: 15px; }
.review-images img { border: 1px solid #ccc; border-radius: 5px; }


.star {
  font-size: 1.5rem;
}

/* Image Preview */
#imagePreview {
  display: none;
  max-width: 100%;
}
.btn-outline-primary {
  cursor: pointer;
 
}
.btn-outline-primary:hover {
    color: black !important; 
    background-color: transparent;
  }

#imagePreview {
  display: none; 
}

#imageUpload:valid + #imagePreview {
  display: block; 
}


.btn, .modal-content, .modal-header, .modal-body, .modal-footer, 
.card, .input-group, .form-control, .border {
  border-radius: 0 !important; 
}

input[type="file"]::file-selector-button {
    color: black; 
    background-color: transparent; 
  }


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
</style>
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
    <a href="#" class="text-decoration-none text-dark" id="searchToggle" style="margin-right: 20px;">
      <i class="fas fa-search" style="margin-left: 12px; font-size: 16px;"></i>
    </a>

    <!-- Navbar Items -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav" style="margin-left: 19px;">
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
              <i class="fas fa-shopping-bag" style="margin-right: 12px;"></i>
            </a>
          </div>
      </div>
  </nav>
</header>
  


<!-- Item Description -->

<?php
include 'php/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check and sanitize form data
    $ProductID = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : null;
    $ProductName = isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : null;
    $Category = isset($_POST['category']) ? htmlspecialchars($_POST['category']) : null;
    $Material = isset($_POST['material']) ? htmlspecialchars($_POST['material']) : null;
    $Gemstone = isset($_POST['gemstone']) ? htmlspecialchars($_POST['gemstone']) : null;
    $Weight = isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : null;
    $Price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : null;
    $Description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null;
    $image = isset($_POST['image']) ? htmlspecialchars($_POST['image']) : null;

    // Display the product details
    if ($ProductID) {
        echo "<div class='container-fluid product-block'>
            <div class='row'>
                <div class='col-lg-6'>
                    <div id='productCarousel' class='carousel slide' data-bs-ride='carousel'>
                        <div class='carousel-inner'>
                            <div class='carousel-item active'>
                                <img src='$image' class='d-block w-100' style='height: 500px; object-fit: cover;' alt='Product Image'>
                            </div>
                        </div>
                        <!-- Carousel Control Buttons -->
                        <button class='carousel-control-prev' type='button' data-bs-target='#productCarousel' data-bs-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Previous</span>
                        </button>
                        <button class='carousel-control-next' type='button' data-bs-target='#productCarousel' data-bs-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Next</span>
                        </button>
                    </div>
                </div>

                <!-- Text Section -->
                <div class='col-lg-6 text-block'>
                    <h2 class='product-title'>$$Price</h2>
                    <h4 class='product-subtitle'>$ProductName</h4>
                    <div class='line2'></div>
                    <h6 class='product-description'>$Description</h6>
                    <ul>
                        <li>Category: $Category</li>
                        <li>Gemstone: $Gemstone</li>
                        <li>Material: $Material</li>
                        <li>Weight: $Weight</li>
                    </ul>
                    <div class='line1'></div>

                    <!-- Buttons -->
                    <div class='button-group'>
                        <form action='/Serandi/Serandi 2/new.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='$ProductID'>
                            <input type='hidden' name='product_name' value='$ProductName'>
                            <input type='hidden' name='category' value='$Category'>
                            <input type='hidden' name='material' value='$Material'>
                            <input type='hidden' name='gemstone' value='$Gemstone'>
                            <input type='hidden' name='weight' value='$Weight'>
                            <input type='hidden' name='price' value='$Price'>
                            <input type='hidden' name='description' value='$Description'>
                            <input type='hidden' name='image' value='$image'>
                            <button class='btn btn-outline-dark mt-5'>Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";

     
} 
}

$conn->close(); // Close the database connection
?>


<?php
include 'php/db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;
    $user_name = isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : null;
    $review_text = isset($_POST['review_text']) ? htmlspecialchars($_POST['review_text']) : null;
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;

    

    if ($product_id && $user_name && $review_text && $rating) {
        $stmt = $conn->prepare("INSERT INTO product_reviews (product_id, user_name, review_text, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $product_id, $user_name, $review_text, $rating);
        if ($stmt->execute()) {
            header("Location: detail-page.php?id=$product_id&success=1");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } 
}

$conn->close();
?>




  


<!-- Customer Reviews Section -->
 
<div class="customer-reviews-section">
  <!-- Customer Review Header -->
  <div class="review-header">
      <div class="left-title">
          <h2>Customer Reviews</h2>
          <div class="rating">
              <span class="number-1">4.0</span> <span class="number-2">/5</span>
              <span class="stars">★★★★</span>
          </div>
      </div>
      <div class="right-description">
          <p>No reviews yet. Be the first to add a review</p>
          <button type="button" class="btn btn-dark write-review-btn mb-3" data-bs-toggle="modal" data-bs-target="#writeReviewModal">
            Write a Review
          </button>

          <form method="POST" action="">
         <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($ProductID); ?>"> <!-- Ensure $ProductID is set -->
         <button type="submit">View Reviews</button>
         </form>
      </div>
<!-- Modal Structure -->
<div id="writeReviewModal" class="modal fade" tabindex="-1" aria-labelledby="writeReviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h5 class="modal-title" id="writeReviewModalLabel">Share Your Experience</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form form enctype="multipart/form-data" method="POST" action="review.php">
      <input type="hidden" name="product_id" value="<?php echo $ProductID; ?>">
      <div class="modal-body">
          <!-- Rating Section -->
          <label class="form-label">Rating:</label>
          <div class="d-flex mb-3">
          <div class="d-flex mb-3" id="rating">
          <span class="star text-warning" onclick="setRating(1)">&#9733;</span>
          <span class="star text-warning" onclick="setRating(2)">&#9733;</span>
          <span class="star text-warning" onclick="setRating(3)">&#9733;</span>
          <span class="star text-warning" onclick="setRating(4)">&#9733;</span>
          <span class="star text-warning" onclick="setRating(5)">&#9733;</span>
        </div>
        <input type="hidden" id="ratingValue" name="rating" value="0">

        </div>

          <div class="row g-2 mb-3">
  <div class="col">
    <label for="rating" class="form-label">Rating:</label>
    <select id="rating" name="rating" class="form-control" required>
      <option value="" disabled selected>Select your rating</option>
      <option value="1">1 - Poor</option>
      <option value="2">2 - Fair</option>
      <option value="3">3 - Good</option>
      <option value="4">4 - Very Good</option>
      <option value="5">5 - Excellent</option>
    </select>
  </div>
          </div>

          <!-- Name and Phone Row -->
          <div class="row g-2 mb-3">
            <div class="col">
              <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col">
              <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" required>
            </div>
          </div>

          <!-- Email Field -->
          <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Email" required>

          <!-- Review Field -->
          <label for="review" class="form-label">Review:</label>
          <textarea id="review" name="review" class="form-control mb-3" rows="4" placeholder="Your Review" required></textarea>

          <!-- Image Upload Section -->
          <label class="form-label">We'd love to see your pictures</label>
          <div class="text-center p-3 border border-secondary rounded mb-3 position-relative">
            <input type="file" id="imageUpload" name="images[]" accept="image/*" class="d-none" multiple onchange="previewImages(event)">
            <label for="imageUpload" class="btn btn-outline d-flex align-items-center justify-content-center">
              <i class="fas fa-upload me-2"></i> Upload
            </label>
            <div id="imagePreviews" class="d-flex flex-wrap mt-3"></div>
          </div>
        </div>
        <!-- Buttons Row -->
        <div class="modal-footer d-flex justify-content-between"> <!-- Flex utility for spacing -->
         
          <button type="submit" class="btn btn-dark w-100">Submit</button>
          <button type="button" class="btn btn-outline-secondary w-100 me-2" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>



  </div>
  <hr class="divider" />
 



<?php
include 'php/db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) { // Check if 'product_id' is set
    $product_id = htmlspecialchars($_POST['product_id']); // Get the product ID from the form

    // Prepare SQL to fetch reviews for the specific product
    $stmt = $conn->prepare("SELECT name, review, imagePath, rating FROM review WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if reviews exist
    if ($result->num_rows > 0) {
        echo "<div class='reviews-list'>";
        while ($row = $result->fetch_assoc()) {
            $name = htmlspecialchars($row['name']);
            $review = htmlspecialchars($row['review']);
            $rating = htmlspecialchars($row['rating']);
            $images = json_decode($row['imagePath'], true); // Decode JSON string for images

            echo "<div class='review-item'>";
            echo "<h5>$name</h5>";
            echo "<p>Rating: <strong>$rating/5</strong></p>";
            echo "<p>$review</p>";

            // Display uploaded images
            if (!empty($images) && is_array($images)) {
                echo "<div class='review-images'>";
                foreach ($images as $image) {
                    echo "<img src='$image' alt='Review Image' class='review-image' style='width:100px; margin:5px;'>";
                }
                echo "</div>";
            }
            echo "</div>";
            echo "<hr>"; // Separator between reviews
        }
        echo "</div>";
    } else {
        echo "<p>No reviews yet for this product.</p>";
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close(); // Close the database connection
?>
 



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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>

 <script>
// Star rating functionality
document.querySelectorAll('.star').forEach((star, index) => {
  star.addEventListener('click', () => {
    // Clear previous ratings
    document.querySelectorAll('.star').forEach(star => {
      star.classList.remove('text-warning');
      star.classList.add('text-secondary');
    });

    // Highlight selected stars
    for (let i = 0; i <= index; i++) {
      document.querySelectorAll('.star')[i].classList.remove('text-secondary');
      document.querySelectorAll('.star')[i].classList.add('text-warning');
    }
  });
});

// Image preview function
function previewImage(event) {
  const imagePreview = document.getElementById("imagePreview");
  const removeImageBtn = document.getElementById("removeImageBtn"); // Get the remove button
  const file = event.target.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      imagePreview.src = e.target.result;
      imagePreview.style.display = "block";
      removeImageBtn.style.display = "block"; // Show the remove button
    };
    reader.readAsDataURL(file);
  } else {
    imagePreview.src = "";
    imagePreview.style.display = "none";
    removeImageBtn.style.display = "none"; // Hide the remove button
  }
}

// Remove image function
document.getElementById("removeImageBtn").addEventListener("click", function() {
  const imagePreview = document.getElementById("imagePreview");
  const imageUpload = document.getElementById("imageUpload");
  const removeImageBtn = document.getElementById("removeImageBtn");

  // Reset file input
  imageUpload.value = "";
  imagePreview.src = "";
  imagePreview.style.display = "none";
  removeImageBtn.style.display = "none"; // Hide the remove button
});

// Form submission handling
document.getElementById("reviewForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Gather form data
  const formData = new FormData();
  formData.append("name", document.getElementById("name").value);
  formData.append("phone", document.getElementById("phone").value);
  formData.append("email", document.getElementById("email").value);
  formData.append("review", document.getElementById("review").value);
  
  // Rating: Count the highlighted stars
  const rating = document.querySelectorAll(".star.text-warning").length;
  formData.append("rating", rating);

  // Image file (if uploaded)
  const imageFile = document.getElementById("imageUpload").files[0];
  if (imageFile) {
    formData.append("image", imageFile);
  }

  // Submit form data (e.g., via AJAX)
  fetch("YOUR_BACKEND_ENDPOINT", {
    method: "POST",
    body: formData
  })
  .then(response => {
    if (response.ok) {
      // Handle success (e.g., show a success message, close modal)
      alert("Review submitted successfully!");
      document.getElementById("reviewForm").reset();
      document.querySelectorAll('.star').forEach(star => {
        star.classList.remove('text-warning');
        star.classList.add('text-secondary');
      });
      document.getElementById("imagePreview").style.display = "none";
      document.getElementById("removeImageBtn").style.display = "none"; // Hide the remove button after submission
    } else {
      // Handle server error
      alert("There was an issue submitting your review. Please try again later.");
    }
  })
  .catch(error => {
    console.error("Error:", error);
    alert("There was an error submitting your review. Please check your connection and try again.");
  });
});


function previewImages(event) {
    const imagePreviews = document.getElementById("imagePreviews");
    imagePreviews.innerHTML = ""; // Clear previous previews
    const files = event.target.files;

    Array.from(files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.alt = "Image Preview";
            img.style.maxWidth = "100px";
            img.style.margin = "5px";
            img.classList.add("img-fluid");
            imagePreviews.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}


  </script>

</body>
</html>
