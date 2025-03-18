<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serendi & Marquise</title>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet"> -->
  <link rel="stylesheet" href="css/collection.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3.0 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .search-form {
        display: flex;
        justify-content:left; /* Center the form */
        margin: 20px 0; /* Add space around the form */
    }
    .search-input {
        width: 300px; /* Adjust width */
        height: 40px; /* Adjust height */
        padding: 10px; /* Add padding inside the input */
        font-size: 16px; /* Change font size */
        border: 1px solid #ccc; /* Border color */
        border-radius: 5px; /* Rounded corners */
        outline: none; /* Remove outline when focused */
    }
    .search-input:focus {
        border-color: #333; /* Change border color on focus */
    }

    .product-link {
    background-color: transparent; /* Removes background color */
    border: none;                 /* Removes border */
    padding: 0;                   /* Removes padding */
    color: inherit;               /* Inherits the color of the surrounding text */
    font: inherit;                /* Inherits font styling */
    cursor: pointer;              /* Shows pointer cursor on hover */
}

.product-link img {
    display: block;
    margin: 0 auto 5px;           /* Centers the image and adds space below */
}
    </style>
</head>

<body>

  <!-- Logo -->
  <div class="container-fluid logo-line py-2">
    <div class="container text-center">
      <img src="images/logo.svg" alt="Logo" class="img-fluid" class="img-fluid" style="max-width: 300px;">
    </div>
  </div>

  <!-- Header -->
  <header class="container-fluid bg-white py-3 jsdelivr">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
          <!-- Search Icon -->
          <div class="d-flex" id="search">
            <span class="me-3"><i class="fas fa-search"></i></span>
          </div>

          <!-- Hamburger Menu Button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Navbar Links and Icons -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto w-100 justify-content-center">
              <li class="nav-item me-5">
                <a class="nav-link" href="home.php">HOME</a>
              </li>
              <li class="nav-item me-5">
                <a class="nav-link" href="custom.html">CUSTOM ORDERS</a>
              </li>
              <li class="nav-item me-5">
                <a class="nav-link" href="about.html">ABOUT US</a>
              </li>
              <li class="nav-item me-5">
                <a class="nav-link active" aria-current="page" href="collection.php">COLLECTIONS</a>
              </li>
              <li class="nav-item me-5">
                <a class="nav-link" href="blog.html">BLOG</a>
              </li>
              <li class="nav-item me-5">
                <a class="nav-link" href="contact.html">CONTACT</a>
              </li>
            </ul>

            <!-- Right Side Icons -->
            <div class="d-flex" id="icon">
              <a href="loginpage.html">
                <span class="me-3"><i class="fas fa-user" style="color: #000;"></i></span>
              </a>
              <a href="mycart.php">
                <span><i class="fas fa-shopping-bag" style="color: #000;"></i></span>
              </a>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>


  <!-- Search Bar Popup -->
  <div class="search-bar-container" id="searchBarContainer">
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Search here...">
      <!-- Search button with icon -->
      <button class="search-btn" type="submit">
        <i class="fas fa-search"></i>
      </button>
      <span class="close-search" id="closeSearch">&times;</span>
    </div>
  </div>

  <body>
    <div class="container mt-5">

    <div class="title-with-lines">
            <div class="line"></div>
            <h1> Collections </h1>
            <div class="line "></div>
          </div><br>


        <div class="row">
            <!-- Search bar -->
            <div class="col-12 col-md-4 text-center text-md-start mb-3 mb-md-0">
            <form method="POST" action="" class="search-form">
                <input type="search" name="search" class="search-input" placeholder="Search here..." value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                
            </form>
            </div>
            
    
            <!-- Results label -->
            <div class="col-12 col-md-4 text-center text-md-start mb-3 mb-md-0">
                <div class="form-outline">
                    <label for="results">Showing 1-12 of 88 results</label>
                </div>
            </div>
            
    
            <!-- Sorting and List Icon -->
            <div class="col-12 col-md-4 text-center text-md-end">
                <div class="row">
                    <!-- Sorting dropdown -->
                    <div class="col-6">
                        <select id="sortCollection" class="form-select" onchange="sortProducts()">
                            <option value="">Default sorting</option>
                            <option value="low-to-high">Price: Low to High</option>
                            <option value="high-to-low">Price: High to Low</option>
                        </select>
                    </div>
                    <!-- List/Grid Icons -->
                    <div class="col-6 col-md-6 d-flex justify-content-center justify-content-md-end align-items-center">
                        <button class="btn" style="border: 1px;">
                            <i class="fa-solid fa-list fa-2x me-3"></i>
                        </button>
                        <button class="btn" style="border: 1px;">
                            <img src="Asset/grid.png" style="width: 30px; height: 30px;">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-4 align-items-right mt-5 ">
            <form method="POST" action="" class="filter-form" id="filterForm">
   
    <h5>Categories</h5>
    <!-- Categories with Checkboxes -->
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="checkbox" name="categories[]" value="ring" <?php if (isset($_POST['categories']) && in_array("ring", $_POST['categories'])) echo 'checked'; ?>>
                        <label> ring</label>
                    </div>
                    <div class="col-6"><label>(23)</label></div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="checkbox" name="categories[]" value="pendant" <?php if (isset($_POST['categories']) && in_array("pendant", $_POST['categories'])) echo 'checked'; ?>>
                        <label> pendant</label>
                    </div>
                    <div class="col-6"><label>(12)</label></div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="checkbox" name="categories[]" value="Anklets" <?php if (isset($_POST['categories']) && in_array("Anklets", $_POST['categories'])) echo 'checked'; ?>>
                        <label> Anklets</label>
                    </div>
                    <div class="col-6"><label>(12)</label></div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="checkbox" name="categories[]" value="Earrings" <?php if (isset($_POST['categories']) && in_array("Earrings", $_POST['categories'])) echo 'checked'; ?>>
                        <label> Earrings</label>
                    </div>
                    <div class="col-6"><label>(12)</label></div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="checkbox" name="categories[]" value="Necklace" <?php if (isset($_POST['categories']) && in_array("Necklace", $_POST['categories'])) echo 'checked'; ?>>
                        <label> Necklace</label>
                    </div>
                    <div class="col-6"><label>(12)</label></div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="checkbox" name="categories[]" value="Charms" <?php if (isset($_POST['categories']) && in_array("Charms", $_POST['categories'])) echo 'checked'; ?>>
                        <label> Charms</label>
                    </div>
                    <div class="col-6"><label>(12)</label></div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="checkbox" name="categories[]" value="Broooches" <?php if (isset($_POST['categories']) && in_array("Broooches", $_POST['categories'])) echo 'checked'; ?>>
                        <label> Broooches</label>
                    </div>
                    <div class="col-6"><label>(12)</label></div>
                </div>
                
                <div class="mt-3">
                    <button type="submit" style="display: flex; justify-content: flex-start;">Filter</button>
                </div>
            </form>

                <div class="filter-section mt-5">
                    <h5>Filter by Price</h5>
                    <div class="slider-container">
                        <label>Price $78 - $168</label>
                        <input type="range" class="form-range" min="78" max="168" step="1">
                    </div>
                </div>

                <form method="POST" action="" class="filtergemstone-form" id="filtergemstoneForm">


<div class="row  mt-5"> <h5>Gemstone</h5></div>

<div class="row mt-2">
    <div class="col-12">
        <!-- <input type="checkbox"> -->
        <input type="checkbox" name="Gemstone[]" value="diamond" <?php if (isset($_Post['Gemstone']) && in_array("diamond",$_POST["Gemstone"])) echo 'checked'; ?>>
        <label>Diamond</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Ruby" <?php if (isset($_Post['Gemstone']) && in_array("Ruby",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label>Ruby</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Sapphire" <?php if (isset($_Post['Gemstone']) && in_array("Sapphire",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label>Sapphire</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Emerald" <?php if (isset($_Post['Gemstone']) && in_array("Emerald",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label>Emerald</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Amethyst" <?php if (isset($_Post['Gemstone']) && in_array("Amethyst",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label> Amethyst</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Topaz" <?php if (isset($_Post['Gemstone']) && in_array("Topaz",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label> Topaz</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Aquamarine" <?php if (isset($_Post['Gemstone']) && in_array("Aquamarine",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label> Aquamarine</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Garnet" <?php if (isset($_Post['Gemstone']) && in_array("Garnet",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label>Garnet</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Pearl" <?php if (isset($_Post['Gemstone']) && in_array("Pearl",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label> Pearl</label>

    </div>
    
</div>
<div class="row mt-2">
    <div class="col-12">
    <input type="checkbox" name="Gemstone[]" value="Turquoise" <?php if (isset($_Post['Gemstone']) && in_array("Turquoise",$_POST["Gemstone"])) echo 'checked'; ?>>
    <label> Turquoise</label>

    </div>
    
</div>

<div class="mt-3">
<button type="submit" style="display: flex; justify-content: flex-start;">Filter</button>
</div>
</form>
               <div class="row mt-5"> 
    <h5>Latest products</h5>
</div>
<form action="" method="POST" id="filterForm">
        <button type="submit" name="Productname[]" value="Moissanite" class="product-link active" aria-current="page">
            <img src="Asset/moissanite.png" alt="Moissanite" style="width:80px; height: 60px; margin-right: 30px;">
            Moissanite
        </button>
        <button type="submit" name="Productname[]" value="White Topaz" class="product-link active" aria-current="page">
            <img src="Asset/white topaz.jfif" alt="White Topaz" style="width:80px; height: 60px; margin-right: 30px;">
            White Topaz
        </button>
        <button type="submit" name="Productname[]" value="Swarovski Crystal" class="product-link active" aria-current="page">
            <img src="Asset/swarovski.jfif" alt="Swarovski Crystal" style="width:80px; height: 60px; margin-right: 30px;">
            Swarovski Crystal
        </button>
        <button type="submit" name="Productname[]" value="Spinel" class="product-link active" aria-current="page">
            <img src="Asset/spinel.jfif" alt="Spinel" style="width:80px; height: 60px; margin-right: 30px;">
            Spinel
        </button>
    </form>

            </div>
            
            <!-- Search Form -->


<!-- Search Form -->
<div class="col-md-8 align-items-left mt-5 ml-3">
    <form action="addtocart.php" method="POST" enctype="multipart/form-data">
        <div class="row" id="productCollection">
            <?php
            include 'php/db.php';

            // Initialize filters array
            $filters = [];

            // Check if a search term is provided
            if (isset($_POST['search']) && !empty($_POST['search'])) {
                $searchTerm = $conn->real_escape_string($_POST['search']);
                $filters[] = "Productname LIKE '%$searchTerm%'";
            }

            // Check if any categories are selected in the checkboxes
            if (isset($_POST['categories']) && !empty($_POST['categories'])) {
                $selectedCategories = array_map(function($category) use ($conn) {
                    return "'" . $conn->real_escape_string($category) . "'";
                }, $_POST['categories']);
                $filters[] = "Category IN (" . implode(", ", $selectedCategories) . ")";
            }

            if (isset($_POST['Gemstone']) && !empty($_POST['Gemstone'])) {
                $selectedGemstone = array_map(function($Gemstone) use ($conn) {
                    return "'" . $conn->real_escape_string($Gemstone) . "'";
                }, $_POST['Gemstone']);
                $filters[] = "Gemstone IN (" . implode(", ", $selectedGemstone) . ")";
            }

            if (isset($_POST['Productname']) && !empty($_POST['Productname'])) {
                $selectedProductname = array_map(function($Productname) use ($conn) {
                    return "'" . $conn->real_escape_string($Productname) . "'";
                }, $_POST['Productname']);
                $filters[] = "Productname IN (" . implode(", ", $selectedProductname) . ")";
            }

            // Set pagination variables
            $limit = 10; // Number of products per page
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
            $offset = ($page - 1) * $limit; // Calculate offset

            // Get the total number of matching products
            $whereClause = !empty($filters) ? 'WHERE ' . implode(' AND ', $filters) : '';
            $totalSql = "SELECT COUNT(*) as total FROM product $whereClause";
            $totalResult = $conn->query($totalSql);
            $totalRow = $totalResult->fetch_assoc();
            $totalProducts = $totalRow['total'];

            // Calculate total pages
            $totalPages = ceil($totalProducts / $limit);

            // Fetch products for the current page
            $sql = "SELECT * FROM product $whereClause LIMIT $limit OFFSET $offset";
            $result = $conn->query($sql);

            // Display all products that match the filters
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

                    // Display each product in a card layout
                    echo '
                    <div class="col-6 mb-4">
                        <div class="card h-100" data-price="' . $Price . '">
                            <img src="' . $image . '" class="card-img-top" alt="' . $Productname . '" style="width: 100%; height: 300px; object-fit: cover;">
                            <div class="card-body text-right">
                                <p>' . $Gemstone . '</p>
                                <h5 class="card-title">' . $Productname . '</h5>
                                <h5 class="card-text">$' . $Price . '</h5>
                                <p class="card-text">' . $Description . '</p>
                                <i class="far fa-heart favorite-icon" onclick="toggleHeart(this)"></i>
                                <form action="/Serandi/addtocart.php" method="POST" style="display:inline;">
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

        <!-- Pagination Links -->
        <nav aria-label="Page navigation mt-4 mb-4">
            <ul class="pagination justify-content-center mt-5" id="pagelink">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    $active = $i == $page ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </form>
</div>

  

                    
                   

                   

                    
                    </div>
                </div>
                    
                </div>
            </div>
            

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <script>
    function changeColor(button) {
    button.classList.toggle("clicked");
}
// Function to update cart count
let cartItemCount = 0; // Initialize cart count

function addToCart() {
    cartItemCount++; // Increment the cart count
    document.getElementById('cartCount').textContent = cartItemCount; // Update the badge
}

// Attach the function to all 'Add to Cart' buttons
const addToCartButtons = document.querySelectorAll('.add-to-cart');
addToCartButtons.forEach(button => {
    button.addEventListener('click', addToCart);
});


//add to cart

    // Array to hold cart items
    let cartItems = [];

    function addToCart(productId, productName, productPrice) {
        // Find if the product is already in the cart
        const existingProduct = cartItems.find(item => item.id === productId);
        
        if (existingProduct) {
            // If it exists, increase the quantity
            existingProduct.quantity++;
        } else {
            // If it doesn't exist, add it to the cart
            cartItems.push({
                id: productId,
                name: productName,
                price: parseFloat(productPrice), // Convert price to a float
                quantity: 1
            });
        }
        
        updateCart();
    }

    function updateCart() {
        const cartBody = document.querySelector('.cart-items tbody');
        cartBody.innerHTML = ''; // Clear the cart

        let total = 0;

        // Populate the cart
        cartItems.forEach(item => {
            const subtotal = item.price * item.quantity;
            total += subtotal;

            const row = `
                <tr>
                    <td>
                        <img src="images/${item.name.replace(/ /g, '-').toLowerCase()}.jfif" alt="Product Image" class="product-img">
                        <span class="product-name">${item.name}</span>
                    </td>
                    <td>$ ${item.price.toFixed(2)} <br> (Ex. VAT 18%)</td>
                    <td>
                        <div class="quantity-box">
                            <button class="quantity-btn minus" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <input type="text" value="${item.quantity}" min="1" class="quantity" readonly>
                            <button class="quantity-btn plus" onclick="updateQuantity(${item.id}, 1)">+</button>
                        </div>
                    </td>
                    <td>$ ${subtotal.toFixed(2)}</td>
                </tr>
            `;
            cartBody.innerHTML += row;
        });
    }
       
    // Add total to the cart

   
   function addToCart(productName, price, image) {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    const existingProductIndex = cart.findIndex(item => item.name === productName);

    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += 1; // Increase quantity if product exists
    } else {
        cart.push({ name: productName, price: price, image: image, quantity: 1 });
    }

    sessionStorage.setItem('cart', JSON.stringify(cart));
    alert(productName + ' has been added to the cart!');
}



       






  </script>

</body>
</html>
