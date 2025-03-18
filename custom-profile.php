<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_email']);
$user_name = $is_logged_in ? $_SESSION['user_name'] : null; // Get user's name if logged in

// Database connection
$mysqli = new mysqli("localhost", "root", "", "serendi_project"); // Update credentials

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch current user data
$query = "SELECT name, email, profile_picture FROM user WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $profile_picture);
$stmt->fetch();
$stmt->close();

// Initialize messages


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle profile update
    $new_name = htmlspecialchars(trim($_POST['name']));
    $new_email = htmlspecialchars(trim($_POST['email']));
    $new_password = $_POST['password'] ?? '';
    $new_password_confirmation = $_POST['password_confirmation'] ?? '';

    // Validate inputs
    if (empty($new_name) || empty($new_email)) {
        $error_message = "Name and email are required.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif ($new_password !== $new_password_confirmation) {
        $error_message = "Passwords do not match.";
    } elseif (!empty($new_password) && strlen($new_password) < 8) {
        $error_message = "Password must be at least 8 characters.";
    }

    // Handle image upload
    $uploaded_image = null;
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] === 0) {
        $file_name = $_FILES["profile_image"]["name"];
        $file_tmp_name = $_FILES["profile_image"]["tmp_name"];
        $file_size = $_FILES["profile_image"]["size"];
        $file_type = mime_content_type($file_tmp_name);
        $allowed_types = ["image/jpeg", "image/png", "image/gif"];

        if (in_array($file_type, $allowed_types) && $file_size <= 5 * 1024 * 1024) {
            $unique_name = uniqid() . "-" . basename($file_name);
            $target_dir = "uploads/";
            $target_file = $target_dir . $unique_name;

            if (move_uploaded_file($file_tmp_name, $target_file)) {
                $uploaded_image = $unique_name;

                // Delete old image if it exists
                if ($profile_picture && file_exists("uploads/{$profile_picture}")) {
                    unlink("uploads/{$profile_picture}");
                }
            } else {
                $error_message = "Error uploading new profile image.";
            }
        } else {
            $error_message = "Invalid file type or size exceeds 5MB.";
        }
    }

    // Update database if no errors
    if (empty($error_message)) {
        $mysqli->begin_transaction();
        try {
            // Update name and email
            $update_query = "UPDATE user SET name = ?, email = ? WHERE id = ?";
            $stmt = $mysqli->prepare($update_query);
            $stmt->bind_param("ssi", $new_name, $new_email, $user_id);
            $stmt->execute();
            $stmt->close();

            // Update password if provided
            if (!empty($new_password)) {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password_query = "UPDATE user SET password_hash = ? WHERE id = ?";
                $stmt = $mysqli->prepare($update_password_query);
                $stmt->bind_param("si", $password_hash, $user_id);
                $stmt->execute();
                $stmt->close();
            }

            // Update profile image if uploaded
            if ($uploaded_image !== null) {
                $update_image_query = "UPDATE user SET profile_picture = ? WHERE id = ?";
                $stmt = $mysqli->prepare($update_image_query);
                $stmt->bind_param("si", $uploaded_image, $user_id);
                $stmt->execute();
                $stmt->close();
            }

            $mysqli->commit();
            header("Location: custom-profile.php?status=success");
            exit;

        } catch (Exception $e) {
            $mysqli->rollback();
            $error_message = "Error updating profile. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/custom-profile.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet" !important>
    <link rel="stylesheet" href="path/to/bootstrap.css">
  <!-- Bootstrap 5.3.0 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

.alert {
    padding: 15px;
    margin: 10px 0;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

    .btn-register {
    border: 1px solid black; /* Border color */
    border-radius: 0px; /* Optional: rounds the corners */
    background-color: white; /* Background color */
    color: black; /* Text color */
    padding: 10px 20px; /* Padding around the text */
    font-size: 16px; /* Font size */
    text-align: center; /* Text alignment */
}

.btn-register:hover {
    
    border-color: black; /* Change border color on hover */
    cursor: pointer; /* Change cursor to pointer on hover */
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
      gap: 38px;
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
  <script>
        // Show alert box if status=success in the URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('status') === 'success') {
                alert('Profile updated successfully!');
            }
        };
    </script>
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
        <i class="fas fa-search" style="margin-right:-20px"></i>
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


  <div class="title-with-lines">
    <div class="line"></div>
    <h1> PROFILE </h1>
    <div class="line "></div>
  </div>
  <form action="custom-profile.php" method="post" id="custom-profile" enctype="multipart/form-data" novalidate>
               

  <div class="container1">
    <div class="header">
      <div class="welcome-text">
        <h1>Welcome,<?= $name ?></h1>
        <p id="date"></p> <!-- Updated to show real date -->
      </div>
      <div class="profile-settings">
        <img src="images/bell.png" alt="Notification" class="bell-icon" id="notification-icon"
          onclick="showNotification()">
      </div>
    </div>
   
    <div class="profile-card">
      <!-- <div class="profile-info">
        <div class="profile-picture" onclick="toggleDropdown()">
          <img id="profile-pic" src="images/profile.jpg" alt="Profile Picture">
          <div class="edit-dropdown">
            <div id="dropdown-menu" class="dropdown-content">
              <a href="#" onclick="takePhoto()">Take photo</a>
              <a href="#" onclick="choosePhoto()">Choose photo</a>
              <a href="#" onclick="deletePhoto()">Delete photo</a>
            </div>
          </div>
        </div>
        <div class="video-container" id="video-container" style="display: none;"></div>

        <div class="profile-details">
          <h2><?= $name ?></h2>
          <p><?= $email ?></p>
        </div>
        <div class="button1">
          <button class="edit-btn">Edit</button>
        </div>
      </div> -->

      <div class="form-row">
        <?php if ($profile_picture): ?>
            <div class="form-group profile-picture">
                
                <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="150"><br>
              
          <h2><?= $name ?></h2>
          <p><?= $email ?></p>
        
                
                
            </div>
        <?php endif; ?>
        
    </div>



      <div class="profile-form">
      <div class="form-column">

      <div class="form-group">
      <div class="form-group">
           
          </div>
         <label for="profile_image">Upload New Profile Image:</label>
            <input type="file" name="profile_image" id="profile_image">
        </div>
          <div class="form-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="name" value="<?= $name ?>" placeholder="Your Full Name">
          </div>
          <div class="form-group">
            <label for="full-name">New Password</label>
            <input type="text" id="full-name"  name="password" placeholder="New Password">
          </div>
          </div>

         

        
        <div class="form-column">
          <div class="form-group">
          <div class="form-group">
           
           </div>
            <label for="country">Email</label>
            <input type="text" id="country" name="email" value="<?= $email ?>" placeholder="Your Country">
          </div>
          <div class="form-group">
            <label for="email">Confirm New Password</label>
            <input type="email" id="email"  name="password_confirmation" placeholder="Confirm New Password">
          </div>
         
        </div>
      </div>

      <form action="custom-profile.php" method="post" id="custom-profile" enctype="multipart/form-data" novalidate>
 
        <!-- Your form fields -->
        <div class="save-section">
            <button type="submit" class="btn btn-register">Update Profile</button>
        </div>
    
</form>
    </div>
  </div>
                  </form>

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
                <input type="email" id="emailInput" class="newsletter-email-input newsletter-input"
                  placeholder="Enter your email" required />
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-8w2NFxBQhX1MprMRHavvPiwRfxIWCu8rZib1/3VvqFT2R2p3mv3YI+N6JcB8o4tq"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>

  
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

 
    // Show success alert for 5 seconds
    <
    // Hide the success alert after 5 seconds
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 5000); // 5000ms = 5 seconds
    }
</script>


    </script>
    
</body>

</html>