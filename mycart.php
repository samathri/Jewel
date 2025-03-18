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
    <title>My Cart</title>
    <link rel="stylesheet" href="css/mycart.css">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
      <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
    </head>

    <style>
    .quantity-box {
    display: flex;
    align-items: center;
    justify-content: center; 
    gap: 5px; 
}

 .quantity {
    width: 20px;              
    height: 20px;           
    font-size: 12px;         
    border-radius: 5px;       
    background-color: #f0f0f0;
    border: 1px solid #ccc;  
    text-align: center;      
    cursor: pointer;   
          
} 

.quantity {
    text-align: center;      
    margin: 0 5px;            
}
.btn-custom {
    width: 60px;  
    height: 30px;  
    font-size: 12px; 
    padding: 5px;   
    border-radius: 0px; 
    background-color: black; 
    color: white; 
    border: none;
    cursor: pointer; 
}
    .jsdelivr {
      margin-top: -40px;
      margin-bottom: -20px
    }
    .checkout-btn {
    background-color: black; 
    color: white; 
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;

    
}

.checkout-btn a {
    color: inherit; 
    text-decoration: none;
    color:white;
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

    <body>
    <?php

   
    
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

ob_start();

$session_timeout = 1200; // Set session timeout period (in seconds), e.g., 600 seconds = 10 minutes


// Check if 'last_activity' is set and if the session is expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_timeout) {
    // If session has expired, destroy the session and redirect to the login page
    session_unset();
    session_destroy();
    header("Location: /Serandi/login.html");
    exit();
}

// Update 'last_activity' timestamp
$_SESSION['last_activity'] = time();

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: /Serandi/Serandi 2/login.php");
    exit();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'php/db.php';

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $productId = $item['id'];

        // Check if $productId is valid before using it in SQL
        if (isset($productId) && !empty($productId)) {
            $sql = "SELECT * FROM product WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                // Process product data
                // echo '<p>Product: ' . htmlspecialchars($product['Productname']) . '</p>';
            } else {
                echo "<p>Product not found.</p>";
            }
        } else {
            echo "<p>Invalid product ID.</p>";
        }
    }
} else 
    


$conn->close();
?>




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

<div class="container my-5">

        <!-- My Cart Header -->

        <div class="title-with-lines">
          <div class="line"></div>
          <h1> My Cart </h1>
          <div class="line "></div>
        </div>

        
      <div class="cart-container">
    <div class="cart-header">
        <a href="collection.php" class="continue-shopping"><i class="fa-solid fa-angle-left"></i> Continue Shopping</a>
    </div>
    
    
    <div class="cart-items">
        <div class="scrollable-cart">
            <table>
                <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>SUBTOTAL</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start(); 
                    }

                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = []; 
                    }

                    $cart = $_SESSION['cart']; 

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $productId = $_POST['product_id'];
                        $action = $_POST['action'];

                        foreach ($cart as $key => &$item) {
                            if ($item['id'] == $productId) {
                                if ($action == 'increase') {
                                    $item['quantity']++;
                                } elseif ($action == 'decrease' && $item['quantity'] > 1) {
                                    $item['quantity']--;
                                } elseif ($action == 'delete') {
                                    unset($cart[$key]); // Remove the item from the cart
                                }
                            }
                        }

                        $_SESSION['cart'] = array_values($cart); // Re-index the cart array
                        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page to show updated cart
                        exit;
                    }

                    $totalAmount = 0; // Initialize total amount variable

                    if (!empty($cart)) {
                        foreach ($cart as $item) {
                            if (isset($item['id'])) {
                                $subtotal = $item['price'] * $item['quantity'];
                                $totalAmount += $subtotal; // Add subtotal to total amount

                                echo '
                                    <tr>
                                        <td>
                                            <img src="' . htmlspecialchars($item['image']) . '" alt="Product Image" class="product-img">
                                            <span class="product-name">' . htmlspecialchars($item['name']) . '</span>
                                        </td>
                                        <td>$ ' . number_format($item['price'], 2) . ' <br> </td>
                                        <td>
                                            <div class="quantity-box">
                                                <form method="POST" class="quantity-form" data-product-id="' . htmlspecialchars($item['id']) . '">
                                                    <input type="hidden" name="product_id" value="' . htmlspecialchars($item['id']) . '">
                                                    <button type="button" class="quantity-button" name="action" value="decrease">-</button>
                                                    <input type="text" value="' . htmlspecialchars($item['quantity']) . '" class="quantity" readonly>
                                                    <button type="button" class="quantity-button" name="action" value="increase">+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>$ ' . number_format($subtotal, 2) . '</td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="product_id" value="' . htmlspecialchars($item['id']) . '">
                                                <button class="btn btn-secondary btn-custom" type="submit" name="action" value="delete" id="delete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>';
                            } else {
                                echo '<tr><td colspan="5">Invalid product ID.</td></tr>';
                            }
                        }
                    } else {
                        echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                    }

                    ob_end_flush(); 
                    ?>
                </tbody>
            </table>
        </div> <!-- End of scrollable-cart -->
    </div> <!-- End of cart-items -->
<!-- </div> End of cart-container -->



<div class="cart-summary">
            <h2>Cart Totals</h2>
            <ul>
            <li>
                        <span class="label">SUBTOTAL:</span>
                        <span class="value">$ <?php echo number_format($totalAmount, 2); ?></span>
                    </li>
                <hr>
                <li>
                    <span class="label">SHIPPING:</span>
                    
                </li>
                <li>
                    
                    <span class="label">Courier Service Flat Rate: LKR 760.00<br>Shipping To SRI LANKA.</span>
                </li>
                
                
                <hr>
                <li class="total">
                    <span class="label">TOTAL:</span>
                    <span class="value">$ <?php echo number_format($totalAmount, 2); ?></span>
                </li>
                <?php
                $discount=$totalAmount*(20/100);
                ?>
                
                <li>
                        <span class="label">Discount:</span>
                        <span class="value">$ <?php echo number_format($discount); ?><span>
                    </li>
                
                
                <hr>
                <?php
                      
                      $finalAmount = $totalAmount - $discount;
                  ?>
                  <li class="total">
                      <span class="label">TOTAL:</span>
                      <span class="value">$ <?php echo number_format($finalAmount, 2); ?></span>
                  </li>
            </ul>
            <button class="checkout-btn" ><a href="/Serandi/Serandi 2/checkout.php">PROCEED TO CHECKOUT <a><i class="fa-solid fa-greater-than"></i></button>
        </div>
</div>
        

    </div>
    
        
            <div class="container">
        <div class="related-products mt-4">
            <h2>You May Also Like</h2>
            <div class="line2"></div>
            <div class="row">
            <?php
        

        $sql = "SELECT * FROM product ORDER BY id DESC LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $Productname = htmlspecialchars($row['Productname']);
                $Category = htmlspecialchars($row['Category']);
                $Material = htmlspecialchars($row['Material']);
                $Gemstone = htmlspecialchars($row['Gemstone']);
                $Weight = htmlspecialchars($row['Weight']);
                $Price = htmlspecialchars($row['Price']);
                $Description = htmlspecialchars($row['Description']);
                $image = 'php/uploads/product/' . htmlspecialchars($row['image']);
                $ProductID = htmlspecialchars($row['id']);

                echo '
                <div class="col-md-4">
                    <div class="card h-100  p-2" data-price="' . $Price . '" style="min-height: 350px;">
                        <img src="' . $image . '" class="card-img-top" alt="' . $Productname . '" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text small">' . $Gemstone . '</p>
                            <h6 class="card-title font-weight-bold mb-2">' . $Productname . '</h6>
                            <p class="card-price  font-weight-bold mb-2">$' . $Price . '</p>
                            <p class="card-description small text-muted mb-2">' . $Description . '</p>
                              <form action="addtocart.php" method="POST">
                                  <input type="hidden" name="id" value="' . $ProductID . '">
                                  <input type="hidden" name="product_name" value="' . $Productname . '">
                                  <input type="hidden" name="price" value="' . $Price . '">
                                  <input type="hidden" name="image" value="' . $image . '">
                                  <button type="submit" class="add-to-cart">Add to Cart</button>
                              </form>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p>No products found.</p>";
        }

        $conn->close();
        ?>

    </div>
        </div>
    </div>
        


   <!--footer-->
  <footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
      <div class="row">
        <div class="col-lg-4 col-md-12 mb-4">
          <h3> Quick Links </h3>
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
$(document).ready(function() {
    $('.quantity-button').click(function() {
        // Get the form element
        var $form = $(this).closest('.quantity-form');
        
        // Get the action (increase or decrease)
        var action = $(this).attr('value');

        // Prepare the data to send
        var formData = {
            product_id: $form.find('input[name="product_id"]').val(),
            action: action
        };

        // AJAX request to update the cart
        $.ajax({
            type: 'POST',
            url: '', // This sends the request to the same page
            data: formData,
            success: function(response) {
                // Optionally update the cart display here without reloading the page
                location.reload(); // Reload the page to update the display
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.querySelector('.cart-items'); // Container for cart items
    const relatedProductsSection = document.getElementById('related-products'); // Related products section

    function adjustRelatedProductsPosition() {
        const cartHeight = cartItemsContainer.scrollHeight; // Get current height of cart items section
        relatedProductsSection.style.marginTop = `${cartHeight + 90}px`; // Adjust related products position
    }

    // Listen for changes in the cart items container
    const observer = new MutationObserver(adjustRelatedProductsPosition);

    // Observe changes to the cart items
    observer.observe(cartItemsContainer, { childList: true, subtree: true });

    adjustRelatedProductsPosition(); // Initial adjustment
});


</script>



</body>
</html>
