<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Site</title>
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&family=Poppins:wght@400&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/checkout.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Bootstrap 5.3.0 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  
<style>
    .cart-items {
    position: relative; /* Ensure it can use z-index */
    z-index: 10; /* Make it appear in front */
    background-color: #fff; /* White background for contrast */
    border: 1px solid #ddd; /* Light border */
    padding: 20px; /* Add padding */
    margin: 20px; /* Adjust space around the cart */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
    
}

.scrollable-cart {
    overflow-y: auto; /* Allow scrolling if content overflows */
    max-height: 400px; /* Set maximum height */
}

@media screen and (max-width:768px){
    .progress-container{
        display:none;
    }
}
    </style>


<body>
<?php
session_start();
ob_start();
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
                
            } else {
                echo "<p>Product not found.</p>";
            }
        } else {
            echo "<p>Invalid product ID.</p>";
        }
    }
} else {
    echo "<p>Your cart is empty.</p>";
}


$conn->close();
?>
  <div class="container mt-5">
    <div class="title-with-lines">
      <div class="line"></div>
      <h1> Checkout </h1>
      <div class="line "></div>
    </div>

        <!-- Checkout Progress Bar -->
        <div class="progress-container text-center my-4">
            <div class="step">
                <div class="circle active">1</div>
                <span class="label">Add Address</span>
            </div>
            <div class="line"></div>
            <div class="step">
                <div class="circle">2</div>
                <span class="label">Checkout</span>
            </div>
        </div>
       
        <div class="cart-items" style="width:100%">
        <h3>Product</h3>
    <?php
include 'php/db.php'; // Database connection file

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

// Check if the form to store cart data has been submitted

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['store_cart'])) {
    try {
        // Connect to the database
        $pdo = new PDO('mysql:host=localhost;dbname=serendi_project', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Prepare the SQL statement for insertion
        $stmt = $pdo->prepare("
            INSERT cart_items (product_id, product_name, price, quantity, subtotal, image)
            VALUES (:id, :product_name, :price, :quantity, :subtotal, :image)
        ");
        // Loop through each cart item and insert it into the database
        foreach ($cart as $item) {
            $stmt->execute([
                ':id' => $item['id'],
                ':product_name' => $item['name'],
                ':price' => $item['price'],
                ':quantity' => $item['quantity'],
                ':subtotal' => $item['price'] * $item['quantity'],
                ':image' => $item['image'], // Store the image URL or path
            ]);
        }

    echo "<p>Cart items have been successfully </p>";
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$totalAmount = 0;
?>

<div class="cart-items">
    <div class="scrollable-cart">
        <form method="POST">
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
                    $totalAmount = 0; // Reset total amount
                    foreach ($cart as $index => $item) {
                        $subtotal = $item['price'] * $item['quantity'];
                        $totalAmount += $subtotal;

                        echo '
                        <tr>
                            <td>
                                <img src="' . htmlspecialchars($item['image']) . '" alt="Product Image" class="product-img">
                                <span class="product-name">' . htmlspecialchars($item['name']) . '</span>
                                <input type="hidden" name="cart[' . $index . '][id]" value="' . htmlspecialchars($item['id']) . '">
                                <input type="hidden" name="cart[' . $index . '][name]" value="' . htmlspecialchars($item['name']) . '">
                                <input type="hidden" name="cart[' . $index . '][image]" value="' . htmlspecialchars($item['image']) . '">
                            </td>
                            <td>
                                $ ' . number_format($item['price'], 2) . '
                                <input type="hidden" name="cart[' . $index . '][price]" value="' . htmlspecialchars($item['price']) . '">
                            </td>
                            <td>
                                ' . htmlspecialchars($item['quantity']) . '
                                <input type="hidden" name="cart[' . $index . '][quantity]" value="' . htmlspecialchars($item['quantity']) . '">
                            </td>
                            <td>
                                $ ' . number_format($subtotal, 2) . '
                                <input type="hidden" name="cart[' . $index . '][subtotal]" value="' . number_format($subtotal, 2) . '">
                            </td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="' . htmlspecialchars($item['id']) . '">
                                    <button class="btn btn-danger btn-custom" type="submit" name="action" value="delete">Delete</button>
                                </form>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <button type="submit" name="store_cart" value="1" class="add-to-cart">Confirm</button>
            </div>
        </form>
    </div>
</div>

        <!-- Main row to align both Shipping/Payment and Order Summary -->
        <div class="row">
            <h3>Shipping Address</h3>
            <!-- Left Column: Shipping Address & Payment Method -->
            <div class="col-md-7 mt-3">
                <div class="shipping-address">
                    <!-- Shipping Address -->
                    <div class="card p-5">
                       
                        <form id="address-form pl-5" style="font-family: 'Poppins', sans-serif;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first-name" class="form-label">First Name</label>
                                    <input type="text" id="first-name" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last-name" class="form-label">Last Name</label>
                                    <input type="text" id="last-name" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="street-address" class="form-label">Street Address</label>
                                <input type="text" id="street-address" class="form-control" placeholder="Street Address">
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" class="form-control" placeholder="City">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" id="state" class="form-control" placeholder="State">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" id="zip" class="form-control" placeholder="Zip">
                                </div>
                                <div class="col-md-4 mb-3">
                                   
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="mt-5" style="    font-family: 'Poppins', sans-serif; ">
                    <h4>Payment Method</h4>
                </div>

                <!-- Payment Method Section -->
                <div class="container mt-2">
                    <form class="payment-form p-4 border" style="    font-family: 'Poppins', sans-serif;">
                        
                
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                            <label class="form-check-label" for="creditCard">
                                Credit or Debit card
                            </label>
                        </div>
                
                        <div class="card-details mt-3">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="****" maxlength="4">
                                <input type="text" class="form-control" placeholder="****" maxlength="4">
                                <input type="text" class="form-control" placeholder="****" maxlength="4">
                                <input type="text" class="form-control" placeholder="****" maxlength="4">
                                <span class="input-group-text visa-icon">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" width="30">
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Card name">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control" placeholder="MM / YY">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control" placeholder="CVV">
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="saveCard">
                                <label class="form-check-label" for="saveCard">
                                    Save this credit card for later use
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="billingSameAsShipping">
                                <label class="form-check-label" for="billingSameAsShipping">
                                    Billing address same as shipping address
                                </label>
                            </div>
                
                            <div class="mb-3 mt-2">
                                <input type="text" class="form-control" placeholder="Street Address">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Apt Number">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="State">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Zip">
                                </div>
                            </div>
                           
                        </div>
                
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="googlePay">
                            <label class="form-check-label" for="googlePay">
                                Google Pay 
                                <img src="images/imgg1.png" alt="Google Pay" width="20" style="vertical-align: middle;">
                            </label>
                        </div>
                        
                
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                            <label class="form-check-label" for="paypal">
                                Paypal <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="Paypal" width="40">
                            </label>
                        </div>

                        <div class="d-flex mt-3">
                            <button type="button" class="btn btn-white me-2 clear-address" style="border: 2px solid #000000;">Cancel</button>
                            <button type="button" class="btn btn-save-address save-address"  style="border: 2px solid #000000;" id="buttonsave">Save this Address</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="col-md-5 mt-3" id="order-summary ">
                <div class="order-summary card p-5" style="font-family: 'Poppins', sans-serif;">
                    <button type="button" class="btn btn-success mt-1 w-100 place-order mb-3">Place Order</button>
                    <?php
                                if (session_status() === PHP_SESSION_NONE) {
                                    session_start();
                                }

                                $cart = $_SESSION['cart'];
                                $totalItems = 0;
                                $totalAmount = 0;
                                $shipping = 5.00;
                                $discount=20/100;



                                // Calculate total amount and total items
                                foreach ($cart as $item) {
                                    $totalItems += $item['quantity'];
                                    $totalAmount += $item['price'] * $item['quantity'];
                                }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h4>Order Summary</h4>
    <p>By placing your order, you agree to our privacy policy and conditions of use.</p>
    <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center" id="text">
            Items (<?php echo $totalItems; ?>): 
            <span class="float-end">$<?php echo number_format($totalAmount, 2); ?></span>
        </li>
    
        <li class="list-group-item d-flex justify-content-between align-items-center" id="text">
            Shipping and handling:
            <span class="float-end">$<?php echo number_format($shipping, 2); ?></span>
        </li>

        <?php
                      
                      $discountamount = $totalAmount *(20/100);
                  ?>
       
                    <li class="list-group-item d-flex justify-content-between align-items-center" id="text">
            Discount:
            <span class="float-end">$<?php echo number_format($discountamount, 2); ?></span>
        </li>

                   
                    <?php
                      
                      $finalAmount = ($totalAmount - $discountamount)+ $shipping;
                  ?>
        
        <li class="list-group-item d-flex justify-content-between align-items-center" id="text">
            <strong>Order Total:</strong> 
            <span class="float-end"><strong>$<?php echo number_format($finalAmount, 2); ?></strong></span>
        </li>
    </ul>
</div>
</body>
</html>

                </div>
            </div>
        </div>
    </div>
</div>

     

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

  <!-- JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>

</body>
</html>
