<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
        #sidebar {
            position: fixed;
            z-index: 1030;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            background-color: #f8f9fa;
            transition: transform 0.3s ease;
        }
        .main-content {
            margin-left: 16.666%; /* Matches sidebar width for desktop */
        }
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }

        #form1 {
        border: 2px solid black; 
        border-radius: 50px; 
        padding: 10px; 
        width: 100%; 
        box-sizing: border-box; 
    }
    #search{
      height: 30px;
      background-color: rgb(158, 155, 155);
      border: none;
      border-radius: 10px;
    }
    .bell-icon {
      padding-right: 10px; /* Add custom space between columns */
    }
    #search-div{
      background-color: gray;
      display: flex;
        align-items: center;
        justify-content: center;
        
    }
    .admin-text{
      color: rgb(12, 12, 12);
    }
    #sidebar a {
    color: black; /* Changes text and icon color to black */
    display: block;
    padding: 10px;
    text-decoration: none;
    background-color:white; /* Optional: Light background for contrast */
}

#sidebar a:hover {
    background-color: #e9ecef; /* Optional: Slight hover effect */
    color: #000; /* Keeps text black on hover */
}
#total{
  background-color: rgb(158, 155, 155);
}
#Total-user{
  background-color: rgb(235, 205, 205);
}
.card{
  border:none;
}

/* status button */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 200px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
}
input:checked + .slider {
  background-color: #4CAF50;
}
input:checked + .slider:before {
  transform: translateX(26px);
}
.slider.round {
  border-radius: 24px;
}
.slider.round:before {
  border-radius: 50%;
}

   /* Customize the background color */
   .bell-icon {
            background-color: #f0f0f0; /* Light gray background */
            padding: 10px;
            border-radius: 5px;
        }
       

    </style>
</head>
<body>
<?php
include 'db.php'; 
session_start(); // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    // If not logged in, redirect to the login page
    header("Location: /Serandi/Serandi 2/login.php");
    exit();
}

// Get the user's first name from the session
$name = $_SESSION['user_name'];

// Get the user's name from the session
// $user_name = $_SESSION['user_name'];


$limitproduct = 5;
$product_sql = "SELECT * FROM product LIMIT $limitproduct";
$product_result = $conn->query($product_sql);





$total_users = 0; 

$count_sql = "SELECT COUNT(*) as total_users FROM user";
$count_result = $conn->query($count_sql);

if ($count_result) {
    $count_row = $count_result->fetch_assoc();
    $total_users = $count_row['total_users']; 
} else {
    echo "Error fetching total users: " . $conn->error;
}

$limit = 5;
$sql = "SELECT id,name, email FROM user  LIMIT $limit";
$result = $conn->query($sql);

$total_customizeoder = 0;
$count_customize = "SELECT COUNT(*) as total_customize FROM customize_oder_table";
$count_customizeresult = $conn->query($count_customize);
if($count_customizeresult){
    $customize_row = $count_customizeresult->fetch_assoc();
    $total_customizeoder = $customize_row['total_customize'];
}else{
    echo "Error fetchning total customizeoder:".$conn->erroe;
}

$sql = "SELECT * FROM customize_oder_table"; 
$results = $conn->query($sql);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $product_id = $_POST['id'];


    $deleteoder_sql = "DELETE FROM customize_oder_table WHERE id = ?";


    if ($stmt = $conn->prepare($deleteoder_sql)) {
        // Bind the product_id and created_at values
        $stmt->bind_param('i', $id); // 'i' for integer, 's' for string

        if ($stmt->execute()) {
            // Successfully deleted
            echo "<script>alert('Product deleted successfully.');</script>";
        } else {
            // Error during deletion
            echo "<script>alert('Error deleting the product: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing SQL query: " . $conn->error . "');</script>";
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['created_at'])) {
    $product_id = $_POST['product_id'];
    $created_at = $_POST['created_at'];

    // SQL to delete product based on both product_id and created_at
    $delete_sql = "DELETE FROM cart_items WHERE product_id = ? AND created_at = ?";

    if ($stmt = $conn->prepare($delete_sql)) {
        // Bind the product_id and created_at values
        $stmt->bind_param('is', $product_id, $created_at); // 'i' for integer, 's' for string

        if ($stmt->execute()) {
            // Successfully deleted
            echo "<script>alert('Product deleted successfully.');</script>";
        } else {
            // Error during deletion
            echo "<script>alert('Error deleting the product: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing SQL query: " . $conn->error . "');</script>";
    }
}

$limitreview = 5;

// Fetch reviews with a limit
$reviewsql = "SELECT * FROM review LIMIT ?";
$stmt = $conn->prepare($reviewsql);
$stmt->bind_param('i', $limitreview);
$stmt->execute();
$reviewresults = $stmt->get_result();

// Fetch total number of reviews
$total_review = 0; // Initialize the variable
$review_query = "SELECT COUNT(*) as total_review FROM review";
$review_result = $conn->query($review_query);
if ($review_result) {
    $review_row = $review_result->fetch_assoc();
    $total_review = $review_row['total_review'];
} else {
    echo "Error fetching total review: " . $conn->error;
}





// Close the database connection


// Fetch the updated list of products from the database
$limitorder = 5;
$sql = "SELECT * FROM cart_items LIMIT $limitorder";  
$resultss = $conn->query($sql);

$total_oder = 0;
$count_oder = "SELECT COUNT(*) as total_oder FROM cart_items";
$count_oder = $conn->query($count_oder);
if($count_oder){
    $oder_row = $count_oder->fetch_assoc();
    $total_oder = $oder_row['total_oder'];
}else{
    echo "Error fetchning total oder:".$conn->erroe;
}




?>

    <div class="container-fluid">
    <div class="row bell-icon">
        <!-- Column for other content (if any) or empty space -->
        <div class="col-10">
            <!-- You can add content here if needed -->
        </div>

        <!-- Right Column for Bell Icon, User Icon, and Admin Name -->
        <div class="col-12 col-sm-12 col-md-2 mt-4 d-flex justify-content-end align-items-center">
            <!-- Notification and User Icons with Name -->
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-bell me-4"></i>
                <i class="fa-regular fa-user me-2"></i>
                <span class="admin-text"><?php echo htmlspecialchars($name); ?></span>
            </div>
        </div>
    </div>
        <!-- Mobile Toggle Button -->
        <button class="btn btn-dark d-md-none mt-3" id="menuToggle">
            <i class="fas fa-bars"></i> Menu
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="d-md-block">
    <div class="col-12 col-md-12 bg-light vh-100"> <!-- Increased width for medium and larger screens -->
        <a href="#" class="d-block mt-4"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="/Serandi/serandi 2/collectionew.php" class="d-block mt-4"><i class="fas fa-upload"></i> Products Upload</a>
        <a href="/Serandi/serandi 2/php/userdetails.php" class="d-block mt-4"><i class="fas fa-users"></i> User Details</a>
        <a href="/Serandi/serandi 2/php/customizeorderpage.php" class="d-block mt-4"><i class="fas fa-users"></i> Customize Order</a>
        <a href="/Serandi/serandi 2/php/useroder.php" class="d-block mt-4"><i class="fas fa-comments"></i> Product Order</a>
        <a href="/Serandi/serandi 2/php/productveiw.php" class="d-block mt-4"><i class="fas fa-pen-to-square"></i> Product Edit</a>
        <a href="#" class="d-block mt-4"><i class="fas fa-star"></i> Reviews Table</a>
        <a href="#" class="d-block mt-4"><i class="fas fa-money-bill"></i> Payments Table</a>
        <a href="#" class="d-block mt-4"><i class="fas fa-cog"></i> Settings</a>
        <a href="javascript:void(0);" class="d-block mt-4" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>



        <!-- Main Content -->
        <div class="main-content">
            
        <div class="row text-center mt-4">
    <div class="col-6 col-sm-6 col-md-3 mb-4">
        <a href="total-users.html" class="text-decoration-none">
            <div class="card" style="background-color: rgb(232, 207, 207);">
                <div class="card-body p-2">
                    <span class="fs-4 text-danger">U</span>
                    <h6>Total Users</h6>
                    <p class="small"><?php echo htmlspecialchars($total_users); ?></p> <!-- Display total users here -->
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-6 col-md-3 mb-4">
        <a href="pending-sales.html" class="text-decoration-none">
            <div class="card" style="background-color: rgb(232, 207, 225);">
                <div class="card-body p-2">
                    <span class="fs-4 text-secondary">E</span>
                    <h6>Review</h6>
                    <p class="small"><?php echo htmlspecialchars($total_review); ?></p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-6 col-md-3 mb-4">
        <a href="total-orders.html" class="text-decoration-none">
            <div class="card" style="background-color: rgb(207, 232, 212);">
                <div class="card-body p-2">
                    <span class="fs-4 text-success">O</span>
                    <h6>Customized Order
                    </h6>
                    <p class="small"><?php echo htmlspecialchars($total_customizeoder); ?></p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-6 col-md-3 mb-4">
        <a href="total-sales.html" class="text-decoration-none">
            <div class="card" style="background-color: rgb(207, 212, 232);">
                <div class="card-body p-2">
                    <span class="fs-4 text-primary">S</span>
                    <h6>Total Sales</h6>
                    <p class="small"><?php echo htmlspecialchars($total_oder); ?></p>
                </div>
            </div>
        </a>
    </div>
</div>



              <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                               <h3> User Details</h3>
                               <a href="\Serandi\Serandi 2\php\userdetails.php" class="text-primary">See All</a>
                            </div>
                            <div class="card-body">
                               <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                      <th>ID</th>
                                        <th>User Name</th>
                                       
                                        <th>Email</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                           
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No users found</td></tr>";
                    }
                    ?>
                    <!-- This row will hold the "See More" button -->
                    
                </tbody>
                                  </table>
                            </div>
                            </div>
                        </div>



                        <div class="col-md-12">
                           
                                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                               <h3> Customer Feedback</h3>
                               <a href="\Serandi\Serandi 2\php\reviewtable.php" class="text-primary">See All</a>
                            </div>
                            <div class="card-body">
                               <div class="card-body">
                                
                               <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review_id'])) {
    $review_id = intval($_POST['review_id']); // Sanitize the review ID

    // Debug: Check if the review_id is correctly passed
    echo "<p>Review ID: $review_id</p>";

    // Prepare DELETE query
    $delete_sql = "DELETE FROM review WHERE id = ?";

    if ($stmt = $conn->prepare($delete_sql)) {
        $stmt->bind_param('i', $review_id); // Bind the review ID

        if ($stmt->execute()) {
            // Successfully deleted
            echo "<script>alert('Review deleted successfully.'); window.location.href = window.location.href;</script>";
        } else {
            // Error during deletion
            echo "<script>alert('Error deleting the review: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Error preparing query
        echo "<script>alert('Error preparing the delete query: " . $conn->error . "');</script>";
    }
}
if ($reviewresults && $reviewresults->num_rows > 0) {
    // Output data for each row
    while ($row = $reviewresults->fetch_assoc()) {
        echo '<div class="feedback-list">
                  <div class="d-flex align-items-center mb-3">
                      <img src="/Serandi/Serandi 2/Images/image 1.jpeg" class="rounded-circle me-2" style="width: 50px; height: 50px;" alt="User Image">
                      <div>
                          <strong>' . htmlspecialchars($row['name']) . '</strong>
                          <p class="mb-0">' . htmlspecialchars($row['review']) . '</p>
                      </div>
                       
                      <div class="d-flex ms-auto align-items-center">
                         
                          <!-- Second icon (Delete button) -->
                          <form method="POST" action="" onsubmit="return confirm(\'Are you sure you want to delete this review?\');">
                              <input type="hidden" name="review_id" value="' . htmlspecialchars($row['id']) . '">
                              <button type="submit" class="btn btn-link p-0 text-danger" style="border: none; background: none;">
                                  <i class="fas fa-trash-alt text-danger ms-2" style="cursor: pointer;"></i>
                              </button>
                          </form>
                      </div>
                  </div>
              </div>';
    }
} else {
    echo "<p>No reviews found</p>";
}

?>


                    <!-- This row will hold the "See More" button -->
                    
               
                            </div>
                            </div>
                        </div>



                        <div class="container my-5">
                        <div class="card p-3 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>Customized Order Details</h3>
                                <a href="\Serandi\Serandi 2\php\customizeorderpage.php" class="text-primary">See All</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mt-3">
                                <thead class="table-light">
                                        <tr>
                                            <th>Id</th>
                                            <th>User Name</th>
                                            <th>Jewelry_ID AND Jewelry Name</th>
                                            <th>Description</th>
                                            <th>Created_at</th>
                                           <th>image</th>
                                           <th>Payment Status</th>
                                            
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                        
                                    <?php
// Fetch results from the database
$sql = "SELECT * FROM customize_oder_table"; 
$results = $conn->query($sql);

if ($results && $results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['createdays']) . "</td>";

        // Handle images
        $images = json_decode($row['image']);
        echo "<td>";
        if (!empty($images)) {
            foreach ($images as $image) {
                echo "<img src='" . htmlspecialchars($image) . "' alt='Uploaded Image' style='max-width:100px; max-height:100px; margin: 5px;'>";
            }
        } else {
            echo "No Image";
        }
        echo "</td>";

        // Add delete button form
        echo "<td>";
        echo "<form method='POST' action='' onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<button type='submit' class='btn btn-danger rounded-0'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No Users Found</td></tr>";
}

// Handle DELETE request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $product_id = $_POST['id']; // Correctly fetch the id from the form

    $deleteoder_sql = "DELETE FROM customize_oder_table WHERE id = ?";

    if ($stmt = $conn->prepare($deleteoder_sql)) {
        // Bind the fetched product_id
        $stmt->bind_param('i', $product_id); // Bind the correct variable

        if ($stmt->execute()) {
            // Successfully deleted
            echo "<script> window.location.href = window.location.href;</script>";
        } else {
            // Error during deletion
            echo "<script>alert('Error deleting the product: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing SQL query: " . $conn->error . "');</script>";
    }
}
?>




                                     
                                    
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="container my-5">
    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Ordered Product Details</h3>
            <a href="\Serandi\Serandi 2\php\useroder.php" class="text-primary">See All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>oder Date</th>
                        <th>Image</th>
                        
                        <th>Actions</th> <!-- Add Actions column for Delete button -->
                    </tr>
                </thead>
                <tbody>
                <?php
                                        // Check if products are available and display them
                                        if ($resultss && $resultss->num_rows > 0) {
                                            while ($row = $resultss->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['product_id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['subtotal']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                                $imagePath = "../" . $row['image'];
                                                
                                                if (!empty($imagePath) && file_exists($imagePath)) {
                                                    echo "<td><img src='" . htmlspecialchars($imagePath) . "' alt='Uploaded Image' style='max-width:100px; max-height:100px; margin:5px;'></td>";
                                                } 
                                                else {
                                                    echo "<td><img src='../uploads/no-image-placeholder.png' alt='No Image Available' style='max-width:100px; max-height:100px; margin:5px;'></td>";
                                                }
                                                // Add the delete button with a confirmation prompt
                                                echo "<td>";
                                                echo "<form method='POST' action='' onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>";
                                                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($row['product_id']) . "'>";
                                                echo "<input type='hidden' name='created_at' value='" . htmlspecialchars($row['created_at']) . "'>";
                                                echo "<button type='submit' class='btn btn-danger rounded-0'>Delete</button>";
                                                echo "</form>";
                                                echo "</td>";
                                        
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No Products Found</td></tr>";
                                        }
                                        
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="container my-5">
                        <div class="card p-4 shadow-sm">
                            <h3>Products Upload Table</h3>
                           
                            <form id="uploadForm" action="/Serandi/Serandi 2/php/product.php" method="POST" enctype="multipart/form-data"><!-- Add the action URL -->
                
                                <div class="row">
                                    <!-- Image Upload Section -->
                                    <div class="col-12 col-md-4 mb-3">
                                        <div class="border border-primary p-3 text-center" id="dropArea">
                                            <i class="fas fa-cloud-upload-alt fa-3x mb-2"></i> <!-- Upload Icon -->
                                            <input type="file" id="uploadImage" name="productImage" class="form-control-file" accept="image/*" hidden>
                                            <label for="uploadImage" class="d-block btn btn-outline-primary">Drag or Browse to Upload Image</label>
                                           
                                            <div class="progress mt-2">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" id="progressBar"></div>
                                            </div>
                                            <button type="button" class="btn btn-danger mt-2 action-btn" id="deleteImage" style="display: none;">Delete Image</button>
                                            <button type="button" class="btn btn-secondary mt-2 action-btn" id="editImage" style="display: none;">Edit Image</button>
                                        </div>
                                    </div>
                                    <!-- Product Details -->
                                    <div class="col-12 col-md-8">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="Productname" placeholder="Product Name">
                                            </div>
                                            <div class="col-md-6">
                                            <select name="Category" id ="category" class="form-select">
                                                <optgroup label="Category">
                                                    <option value="Charms">Charms</option>
                                                    <option value="Anklets">Anklets</option>
                                                    <option value="necklace">Necklaces</option>
                                                    <option value="Earrings">Earrings</option>
                                                    <option value="ring">Rings</option>
                                                    <option value="Bracelets">Bracelets</option>
                                                    <option value="pendant">Pendant</option>
                                                </optgroup> 
                                                </select>
												
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="Material" placeholder="Material">
                                            </div>
                                            <div class="col-md-6">
                                               
                                                <select name="Gemstone" id ="Gemstone" class="form-select">
                                                <optgroup label="Gemstone Type">
                                                    <option value="Sapphire">Sapphire</option>
                                                    <option value="Ruby">Ruby</option>
                                                    <option value="Emerald">Emerald</option>
                                                    <option value="Amethyst">Amethyst</option>
                                                    <option value="Topaz">Topaz</option>
                                                    <option value="Aquamarine">Aquamarine</option>
                                                    <option value="Garnet">Garnet</option>
                                                    <option value="Pearl">Pearl</option>
                                                    <option value="Turquoise">Turquoise</option>
                                                    
                                                </optgroup> 
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="Weight" placeholder="Carat Weight">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="Price" placeholder="Price">
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" name="Description" placeholder="Product Description" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="reset" class="btn btn-danger action-btn cancel-btn me-2 rounded-0">Cancel</button>
                                    <button type="submit" class="btn btn-primary action-btn submit-btn rounded-0 ">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="container my-5">
    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Ordered Product Details</h3>
            <a href="productveiw.php" class="text-primary">See All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                      
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Material</th>
                        <th>Gemstone</th>
                        <th>weight</th>
                        <th>price</th>
                        <th>Description</th>
                        
                        <th>Actions</th> <!-- Add Actions column for Delete button -->
                    </tr>
                    <tr>
                        <?php 
                        
                        while($row = mysqli_fetch_assoc($product_result))
                        {
                            ?>

                           
                            <td><?php echo $row['Productname']; ?></td>
                            <td><?php echo $row['Category'];?></td>
                            <td><?php echo $row['Material']; ?></td>
                            <td><?php echo $row['Gemstone']; ?></td>
                            <td><?php echo $row['Gemstone']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td><a href="/Serandi/Serandi 2/php/productdelete.php?id=<?php echo $row['id'];?>" ><i class="fas fa-trash-alt text-danger ms-2" style="cursor: pointer;"></i></a>
                            <a href="/Serandi/Serandi 2/php/productedit.php?id=<?php echo $row['id']; ?>" ><i class="fa-solid fa-pen-to-square ms-2" style="cursor: pointer; color: green;"></i></a></td>



</tr>





<?php
                        }




?>

                   
                </thead>
                <tbody>
                

                </tbody>
            </table>
        </div>
    </div>
</div>
   

</div>
                    


                    

                    

                
            </div>
            

            
        </div>
        
    </div>

   

    

</div>

                
                       
              
            
            
            
  
</div>
        </div>
       
  

    <script>
        // Toggle sidebar for mobile
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/dashbord.js"></script>
<script>
    // Sample sales chart using Chart.js
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'This Month',
                borderColor: 'rgba(75, 192, 192, 1)',
                data: [12, 19, 3, 5, 2, 3, 9],
                fill: false
            }, {
                label: 'Last Month',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: [2, 29, 5, 5, 2, 3, 10],
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    
</script>
<script>
    

    document.addEventListener("DOMContentLoaded", function () {
    const uploadImage = document.getElementById("uploadImage");
    const dropArea = document.getElementById("dropArea");
    const previewImage = document.getElementById("previewImage");
    const deleteImage = document.getElementById("deleteImage");
    const editImage = document.getElementById("editImage");
    const progressBar = document.getElementById("progressBar");

    // Function to show image preview
    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewImage.style.display = "block";
            deleteImage.style.display = "block";
            editImage.style.display = "block";
        };
        reader.readAsDataURL(file);
    }

    // Function to reset the upload area
    function resetUploadArea() {
        previewImage.src = "";
        previewImage.style.display = "none";
        deleteImage.style.display = "none";
        editImage.style.display = "none";
        uploadImage.value = "";
        progressBar.style.width = "0%";
    }

    // Drag and drop area events
    dropArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropArea.classList.add("drag-over");
    });

    dropArea.addEventListener("dragleave", (e) => {
        dropArea.classList.remove("drag-over");
    });

    dropArea.addEventListener("drop", (e) => {
        e.preventDefault();
        dropArea.classList.remove("drag-over");
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            showImagePreview(files[0]);
        }
    });

    // File input change event
    uploadImage.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file) {
            showImagePreview(file);
            uploadFile(file); // Upload file via AJAX
        }
    });

    // Delete image button
    deleteImage.addEventListener("click", (e) => {
        resetUploadArea();
    });

    // Edit image button (re-trigger the file input)
    editImage.addEventListener("click", (e) => {
        uploadImage.click();
    });

    // AJAX file upload function
    function uploadFile(file) {
        const formData = new FormData();
        formData.append("image", file);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/upload-image", true);  // Change the URL to your actual server endpoint

        // Show progress bar
        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBar.style.width = percentComplete + "%";
            }
        };

        // xhr.onload = function () {
        //     if (xhr.status == 200) {
        //         // Successfully uploaded
        //         alert("Image uploaded successfully!");
        //     } else {
        //         // Failed to upload
        //         alert("Failed to upload image.");
        //         resetUploadArea();
        //     }
        // };

        xhr.send(formData);
    }
});
//custormize status
$(document).ready(function(){
    $('.toggle-status').on('change', function() {
        var userId = $(this).data('id');  // Use 'data-id' to refer to the user ID in the 'users' table
        var status = $(this).is(':checked') ? 'On' : 'Off';

        $.ajax({
            url: 'update_status.php',
            type: 'POST',
            data: { user_id: userId, status: status },
            success: function(response) {
                alert(response);  // Optional alert for feedback
            },
            error: function() {
                alert('Error updating status');
            }
        });
    });
});


function confirmLogout() {
    // Display a confirmation dialog
    var confirmAction = confirm("Are you sure you want to log out?");
    
    if (confirmAction) {
        // If the user confirms, redirect to the logout script
        window.location.href = "/Serandi/Serandi 2/logout.php";
    } else {
        // If the user cancels, do nothing (stay on the current page)
        return false;
    }
}

    </script>


</body>
</html>
