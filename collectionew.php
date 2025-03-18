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
  <title>Jewelry Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<link href="css/collect[1].css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>


button.product-link {
  border: none; /* Remove the border from the button */
  background: none; /* Remove background color */
  padding: 0; /* Remove default padding */
  cursor: pointer; /* Maintain the pointer cursor */
}

button.product-link img {
  border: none; /* Remove any border around the image */
  margin-top:10px;
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
      gap: 60px;
      justify-content: center;
      font-size: 16px;
    }

    @media (min-width: 993px) and (max-width: 1400px) {
    .navbar-nav {
      gap: 20px; /* Reduces space between navbar items */
      
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

    @media (max-width: 480px) {
    .fa-shopping-bag{
        margin-top: 3px;
    }
}

.pagination .page-item.active .page-link {
    color: white !important;
    background-color: black !important;
    border-color: black !important;
}


/* .page-link:hover{
    color: white !important;
    background-color: black !important;
    border-color: black !important;
} */


</style>

</head>
<body>





<?php
include 'php/db.php';

$productCountSql = "SELECT COUNT(*) as total_products FROM product";
$productCountResult = $conn->query($productCountSql);

// Check if the query was successful and fetch the count
if ($productCountResult && $productCountResult->num_rows > 0) {
    $row = $productCountResult->fetch_assoc();
    $totalProducts = $row['total_products'];
    //echo "<p>Total number of products: " . $totalProducts . "</p>";
} else {
    //echo "<p>Error fetching product count.</p>";
}

// Initialize counts
$ringCount = 0;
$PendantCount = 0;
$AnkletsCount = 0;
$EarringCount = 0;
$Necklacecount = 0 ;
$Charmscount = 0;
$Broochescount = 0;

// Combined SQL query to count "ring" and "pendant" products
$countSql = "
    SELECT 
        SUM(CASE WHEN Category = 'ring' THEN 1 ELSE 0 END) AS ring_count,
        SUM(CASE WHEN Category = 'pendant' THEN 1 ELSE 0 END) AS pendant_count,
        SUM(CASE WHEN category = 'Anklets' THEN 1 ELSE 0 END) AS Anklets_count,
        SUM(CASE WHEN category = 'Earrings' THEN 1 ELSE 0 END) AS Earring_count,
        SUM(CASE WHEN category = 'Necklace' THEN 1 ELSE 0 END) AS Necklace_count,
        SUM(CASE WHEN category = 'Charms' THEN 1 ELSE 0 END) AS Charms_count,
        SUM(CASE WHEN category = 'Brooches' THEN 1 ELSE 0 END) AS Brooches_count





    FROM product
";

$countResult = $conn->query($countSql);

// Fetch and store the counts
if ($countResult && $countResult->num_rows > 0) {
    $row = $countResult->fetch_assoc();
    $ringCount = $row['ring_count'];
    $PendantCount = $row['pendant_count'];
    $AnkletsCount = $row['Anklets_count'];
    $EarringCount = $row['Earring_count'];
    $Necklacecount = $row['Necklace_count'];
    $Charmscount = $row['Charms_count'];
    $Broochescount = $row['Brooches_count'];
}





$conn->close();
?>



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
  <div class="container" style="margin:0 12px;">
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
          <a class="nav-link active" aria-current="page" href="collectionew.php">COLLECTIONS</a>
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
  <div class="container mt-5">

    <div class="title-with-lines">
            <div class="line"></div>
            <h1> Collections </h1>
            <div class="line "></div>
          </div><br>
</header>
  
  <div class="container my-4">
      <div class="row">
        
        <!-- Sidebar for mobile (hidden on larger screens) -->
        <div class="d-lg-none mb-3">
          <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            Categories & Filters
          </button>
          <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title">Categories & Filters</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
              <div id="sidebar-content">
                <div class="search-box mb-3">
                <form method="POST" action="" class="search-form">
        <input type="search" name="search" class="form-control" placeholder="Search here..." 
               value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">

              
        
    </form>
    <h5>Categories</h5>
  <form method="POST" id="mobileFilter">
  <ul class="list-unstyled">
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="mobilecategories[]" value="Charms" 
               onchange="document.getElementById('mobileFilter').submit();" 
               <?php echo (isset($_POST['mobilecategories']) && in_array('Charms', $_POST['mobilecategories'])) ? 'checked' : ''; ?>>
        Charms
      </label>
      <span>(<?php echo $Charmscount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="mobilecategories[]" value="Anklets" 
               onchange="document.getElementById('mobileFilter').submit();" 
               <?php echo (isset($_POST['mobilecategories']) && in_array('Anklets', $_POST['mobilecategories'])) ? 'checked' : ''; ?>>
               Anklets
      </label>
      <span>(<?php echo $AnkletsCount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="mobilecategories[]" value="necklace" 
               onchange="document.getElementById('mobileFilter').submit();" 
               <?php echo (isset($_POST['mobilecategories']) && in_array('necklace', $_POST['mobilecategories'])) ? 'checked' : ''; ?>>
               Necklaces
      </label>
      <span>(<?php echo $Necklacecount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="mobilecategories[]" value="Earrings" 
               onchange="document.getElementById('mobileFilter').submit();" 
               <?php echo (isset($_POST['mobilecategories']) && in_array('Earrings', $_POST['mobilecategories'])) ? 'checked' : ''; ?>>
               Earrings
      </label>
      <span>(<?php echo $EarringCount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="mobilecategories[]" value="Ring" 
               onchange="document.getElementById('mobileFilter').submit();" 
               <?php echo (isset($_POST['mobilecategories']) && in_array('Ring', $_POST['mobilecategories'])) ? 'checked' : ''; ?>>
               Rings
      </label>
      <span>(<?php echo $ringCount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="mobilecategories[]" value="Bracelets" 
               onchange="document.getElementById('mobileFilter').submit();" 
               <?php echo (isset($_POST['mobilecategories']) && in_array('Bracelets', $_POST['mobilecategories'])) ? 'checked' : ''; ?>>
               Bracelets
      </label>
      <span>(<?php echo $Broochescount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="mobilecategories[]" value="Pendant" 
               onchange="document.getElementById('mobileFilter').submit();" 
               <?php echo (isset($_POST['mobilecategories']) && in_array('Pendant', $_POST['mobilecategories'])) ? 'checked' : ''; ?>>
               Pendant
      </label>
      <span>(<?php echo $PendantCount; ?>)</span>
    </li>
    
    <!-- Add more categories as needed -->
  </ul>
</form>

  

<div class="row mt-5">
    <h5>Gemstone</h5>
</div>

<form method="POST" id="mobileFilter">
    <ul class="list-unstyled">
    
        <!-- Sapphire -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Sapphire"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Sapphire', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Sapphire 
            </label>
        </li>

        <!-- Ruby -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Ruby"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Ruby', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Ruby 
            </label>
        </li>

        <!-- Emerald -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Emerald"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Emerald', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Emerald 
            </label>
        </li>

        <!-- Amethyst -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Amethyst"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Amethyst', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Amethyst 
            </label>
        </li>

        <!-- Topaz -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Topaz"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Topaz', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Topaz 
            </label>
        </li>

        <!-- Aquamarine -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Aquamarine"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Aquamarine', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Aquamarine 
            </label>
        </li>

        <!-- Garnet -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Garnet"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Garnet', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Garnet 
            </label>
        </li>

        <!-- Pearl -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Pearl"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Pearl', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Pearl 
            </label>
        </li>

        <!-- Turquoise -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="mobileGemstone[]" value="Turquoise"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['mobileGemstone']) && in_array('Turquoise', $_POST['mobileGemstone'])) ? 'checked' : ''; ?>>
                Turquoise 
            </label>
        </li>
    </ul>
</form>

                </div>
            
               
                
                <div class="row mt-5"> 
    <h5>Latest products</h5>
</div>
    <?php
        include 'php/db.php';

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
                
<form action="" method="POST" id="filterForm">
        <button type="submit" name="Description[]" value=' . $Description . ' class="product-link active" aria-current="page">
            <img src="' . $image . '" alt="Moissanite" style="width:80px; height: 60px; margin-right: 30px; ">
            <label class="card-title font-weight-regular mb-2">' . $Productname . '</label>
        </button>
</form>
       
                    
                ';
            }
        } else {
            echo "<p>No products found.</p>";
        }

        $conn->close();
        ?>

</div>
</div>

            
          </div>
        </div>
  

        <!-- ---------------------------------------------------- -->
        <!-- Sidebar for larger devices -->
        <div class="col-lg-3 d-none d-lg-block">
          <div id="sidebar-content">
            <div class="search-box mb-3">
            <form method="POST" action="" class="search-form">
        <input type="search" name="search" class="form-control" placeholder="Search here..." 
               value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
        
    </form>
</div>
<h5>Categories</h5>
<form method="POST" id="desktopFilter">
  <ul class="list-unstyled">
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="desktopcategories[]" value="Charms" 
               onchange="document.getElementById('desktopFilter').submit();" 
               <?php echo (isset($_POST['desktopcategories']) && in_array('Charms', $_POST['desktopcategories'])) ? 'checked' : ''; ?>>
        Charms
      </label>
      <span>(<?php echo $Charmscount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="desktopcategories[]" value="Anklets" 
               onchange="document.getElementById('desktopFilter').submit();" 
               <?php echo (isset($_POST['desktopcategories']) && in_array('Anklets', $_POST['desktopcategories'])) ? 'checked' : ''; ?>>
               Anklets
      </label>
      <span>(<?php echo $AnkletsCount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="desktopcategories[]" value="necklace" 
               onchange="document.getElementById('desktopFilter').submit();" 
               <?php echo (isset($_POST['desktopcategories']) && in_array('necklace', $_POST['desktopcategories'])) ? 'checked' : ''; ?>>
               Necklaces
      </label>
      <span>(<?php echo $Necklacecount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="desktopcategories[]" value="Earrings" 
               onchange="document.getElementById('desktopFilter').submit();" 
               <?php echo (isset($_POST['desktopcategories']) && in_array('Earrings', $_POST['desktopcategories'])) ? 'checked' : ''; ?>>
               Earrings
      </label>
      <span>(<?php echo $EarringCount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="desktopcategories[]" value="Ring" 
               onchange="document.getElementById('desktopFilter').submit();" 
               <?php echo (isset($_POST['desktopcategories']) && in_array('Ring', $_POST['desktopcategories'])) ? 'checked' : ''; ?>>
               Rings
      </label>
      <span>(<?php echo $ringCount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="desktopcategories[]" value="Bracelets" 
               onchange="document.getElementById('desktopFilter').submit();" 
               <?php echo (isset($_POST['desktopcategories']) && in_array('Bracelets', $_POST['desktopcategories'])) ? 'checked' : ''; ?>>
               Bracelets
      </label>
      <span>(<?php echo $Broochescount; ?>)</span>
    </li>
    <li style="display: flex; align-items: center; justify-content: space-between;">
      <label style="display: flex; align-items: center; gap: 5px;">
        <input type="checkbox" name="desktopcategories[]" value="Pendant" 
               onchange="document.getElementById('desktopFilter').submit();" 
               <?php echo (isset($_POST['desktopcategories']) && in_array('Pendant', $_POST['desktopcategories'])) ? 'checked' : ''; ?>>
               Pendant
      </label>
      <span>(<?php echo $PendantCount; ?>)</span>
    </li>
    <!-- Add more categories as needed -->
  </ul>

<!-------------------------------->


</form>


<div class="row mt-5">
    <h5>Gemstone</h5>
</div>

<form method="POST" id="desktopFilter">
    <ul class="list-unstyled">
    
        <!-- Sapphire -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Sapphire"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Sapphire', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Sapphire 
            </label>
        </li>

        <!-- Ruby -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Ruby"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Ruby', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Ruby 
            </label>
        </li>

        <!-- Emerald -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Emerald"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Emerald', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Emerald 
            </label>
        </li>

        <!-- Amethyst -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Amethyst"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Amethyst', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Amethyst 
            </label>
        </li>

        <!-- Topaz -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Topaz"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Topaz', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Topaz 
            </label>
        </li>

        <!-- Aquamarine -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Aquamarine"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Aquamarine', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Aquamarine 
            </label>
        </li>

        <!-- Garnet -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Garnet"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Garnet', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Garnet 
            </label>
        </li>

        <!-- Pearl -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Pearl"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Pearl', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Pearl 
            </label>
        </li>

        <!-- Turquoise -->
        <li style="display: flex; align-items: center; justify-content: space-between;">
            <label style="display: flex; align-items: center; gap: 5px;">
                <input type="checkbox" name="desktopGemstone[]" value="Turquoise"
                    onchange="this.form.submit();"
                    <?php echo (isset($_POST['desktopGemstone']) && in_array('Turquoise', $_POST['desktopGemstone'])) ? 'checked' : ''; ?>>
                Turquoise 
            </label>
        </li>
    </ul>
</form>


      

    <div class="row mt-5"> 
    <h5>Latest products</h5>
    </div>
    <?php
        include 'php/db.php';

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
                
<form action="" method="POST" id="filterForm">
        <button type="submit" name="Description[]" value=' . $Description . ' class="product-link active" aria-current="page">
            <img src="' . $image . '" alt="Moissanite" style="width:80px; height: 60px; margin-right: 30px; ">
            <label class="card-title font-weight-regular mb-2">' . $Productname . '</label>
        </button>
</form>
       
                    
                ';
            }
        } else {
            echo "<p>No products found.</p>";
        }

        $conn->close();
        ?>

</div>
</div>

  
                
  
        <!-- Products Section -->
  <div class="col-lg-9">
 
    
  <div class="d-flex justify-content-between align-items-center mb-3">
  <span>
    <label for="results"><?php echo "<p>Showing 1-10 of ".$totalProducts." results </p>"; ?></label>
  </span>
  
  <form method="GET" action=" " id="sortForm">
    <select class="form-select w-auto" name="sort_order" onchange="document.getElementById('sortForm').submit();">
      <option value="default" <?php echo (isset($_GET['sort_order']) && $_GET['sort_order'] == 'default') ? 'selected' : ''; ?>>Default Sorting</option>
      <option value="low_to_high" <?php echo (isset($_GET['sort_order']) && $_GET['sort_order'] == 'low_to_high') ? 'selected' : ''; ?>>Price: Low to High</option>
      <option value="high_to_low" <?php echo (isset($_GET['sort_order']) && $_GET['sort_order'] == 'high_to_low') ? 'selected' : ''; ?>>Price: High to Low</option>
    </select>
  </form>
</div>
    <div class="container">
    <div class="row g-4">
    <?php
// Include database connection
include 'php/db.php';

// Set the number of products per page
$productsPerPage = 12;

// Get the current page from the URL, default to 1 if not set
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $productsPerPage;

// Initialize filters
$whereClauses = [];
$params = [];
$paramTypes = "";

// Handle search input
if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
    $searchTerm = '%' . trim($_POST['search']) . '%';
    $whereClauses[] = "Productname LIKE ?";
    $params[] = $searchTerm;
    $paramTypes .= "s";
}

// Handle category filtering
if (isset($_POST['categories']) && is_array($_POST['categories']) && !empty($_POST['categories'])) {
    $placeholders = implode(",", array_fill(0, count($_POST['categories']), "?"));
    $whereClauses[] = "Category IN ($placeholders)";
    foreach ($_POST['categories'] as $category) {
        $params[] = $category;
        $paramTypes .= "s";
    }
}

if (isset($_POST['Description']) && is_array($_POST['Description']) && !empty($_POST['Description'])) {
  $placeholders = implode(",", array_fill(0, count($_POST['Description']), "?"));
  $whereClauses[] = "Description IN ($placeholders)";
  foreach ($_POST['Description'] as $Description) {
      $params[] = $Description;
      $paramTypes .= "s";
  }
}

// Combine filters for categories (desktop and mobile)
$combinedCategoriesFilter = [];
if (isset($_POST['desktopcategories']) && is_array($_POST['desktopcategories']) && !empty($_POST['desktopcategories'])) {
    $combinedCategoriesFilter = array_merge($combinedCategoriesFilter, $_POST['desktopcategories']);
}

if (isset($_POST['mobilecategories']) && is_array($_POST['mobilecategories']) && !empty($_POST['mobilecategories'])) {
    $combinedCategoriesFilter = array_merge($combinedCategoriesFilter, $_POST['mobilecategories']);
}

if (!empty($combinedCategoriesFilter)) {
    $placeholders = implode(",", array_fill(0, count($combinedCategoriesFilter), "?"));
    $whereClauses[] = "category IN ($placeholders)";
    foreach ($combinedCategoriesFilter as $category) {
        $params[] = $category;
        $paramTypes .= "s";
    }
}

// Combine filters for gemstones (desktop and mobile)
$combinedGemstoneFilter = [];
if (isset($_POST['desktopGemstone']) && is_array($_POST['desktopGemstone']) && !empty($_POST['desktopGemstone'])) {
    $combinedGemstoneFilter = array_merge($combinedGemstoneFilter, $_POST['desktopGemstone']);
}

if (isset($_POST['mobileGemstone']) && is_array($_POST['mobileGemstone']) && !empty($_POST['mobileGemstone'])) {
    $combinedGemstoneFilter = array_merge($combinedGemstoneFilter, $_POST['mobileGemstone']);
}

if (!empty($combinedGemstoneFilter)) {
    $placeholders = implode(",", array_fill(0, count($combinedGemstoneFilter), "?"));
    $whereClauses[] = "Gemstone IN ($placeholders)";
    foreach ($combinedGemstoneFilter as $gemstone) {
        $params[] = $gemstone;
        $paramTypes .= "s";
    }
}

// Apply filters to WHERE clause
$whereSQL = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";

// Calculate total products (for pagination)
$totalProductsSQL = "SELECT COUNT(*) as total FROM product $whereSQL";
$totalStmt = $conn->prepare($totalProductsSQL);
if (!empty($params)) {
    $totalStmt->bind_param($paramTypes, ...$params);
}
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $productsPerPage);
$totalStmt->close();

// Get sorting order (defaults to 'default')
$sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'default';
$orderBy = 'Productname ASC';  // Default sorting by name

switch ($sortOrder) {
    case 'low_to_high':
        $orderBy = 'Price ASC';
        break;
    case 'high_to_low':
        $orderBy = 'Price DESC';
        break;
    case 'default':
    default:
        $orderBy = 'Productname ASC';  // Default alphabetical order
        break;
}

// Fetch products for the current page with sorting and pagination
$sql = "SELECT * FROM product $whereSQL ORDER BY $orderBy LIMIT ?, ?";
$params[] = $offset;
$params[] = $productsPerPage;
$paramTypes .= "ii";  // Adding integer types for the offset and limit

$stmt = $conn->prepare($sql);
$stmt->bind_param($paramTypes, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Display products
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
        <div class="col-sm-6 col-md-4">
            <div class="card" onclick="changeImage(this)">
                <img src="' . $image . '" class="card-img-top" alt="' . $Productname . '">
                <div class="card-body">
                    <h6>' . $Productname . '</h6>
                    <h6>' . $Gemstone . '</h6>
                    <p style="font-size: 20px;">$' . number_format($Price, 2) . '</p>
                </div>
            </div>
            <form action="/Serandi/Serandi 2/detail-page.php" method="POST" style="display:inline;">
                 <input type="hidden" name="id" value="' . $ProductID . '">
                <input type="hidden" name="product_name" value="' . $Productname . '">
                <input type="hidden" name="category" value="' . $Category . '">
                <input type="hidden" name="material" value="' . $Material . '">
                <input type="hidden" name="gemstone" value="' . $Gemstone . '">
                <input type="hidden" name="weight" value="' . $Weight . '">
                <input type="hidden" name="price" value="' . $Price . '">
                <input type="hidden" name="description" value="' . $Description . '">
                <input type="hidden" name="image" value="' . $image . '">
                <button class="btn btn-outline-dark">Add to Cart</button>
            </form>
        </div>';
    }
} else {
    echo "<p>No products found.</p>";
}

// Display pagination links
if ($totalPages > 1) {
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination justify-content-center">';
    for ($page = 1; $page <= $totalPages; $page++) {
        echo '<li class="page-item ' . ($page == $currentPage ? 'active' : '') . '">';
        echo '<a class="page-link" href="?page=' . $page . '&sort_order=' . $sortOrder . '">' . $page . '</a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>


    </div>
   

    </div>

   
</div>

  
      </div>
    </div>

 

</form>
  </div>
  
  
  <!-- JavaScript to change image -->

  
          
          <!-- <nav class="mt-4">
            <ul class="pagination justify-content-center">
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
            </ul>
          </nav> -->
        </div>
      </div>
    </div>
  
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
  
  <div class="footer-bottom" >
    <p style="align-items: center;">© 2024 Your Company Name. All rights reserved.</p>
  </div>
</footer>
<script>
function submitForm() {
        // Submit the form using AJAX
        $.ajax({
            url: "", // Submit to the same page
            type: "POST",
            data: $("#desktopFilter").serialize(), // Serialize form data
            success: function(response) {
                // You can replace or update the content without a full page reload
                $("#product-list").html(response); // Assuming product list is in an element with id="product-list"
            }
        });
    }
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
</script>
<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-8w2NFxBQhX1MprMRHavvPiwRfxIWCu8rZib1/3VvqFT2R2p3mv3YI+N6JcB8o4tq" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>