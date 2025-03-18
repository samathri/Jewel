<?php
session_start();  // Start the session to access the cart

// Check if the cart is set and contains products
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<h1>Your Cart</h1>";
    echo "<form action='cart.php' method='POST' id='cartForm'>";  // Form to update cart

    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>PRODUCT</th><th>IMAGE</th><th>PRICE</th><th>QUANTITY</th><th>SUBTOTAL</th><th>ACTION</th></tr></thead>";
    echo "<tbody>";

    // Initialize total price of the cart
    $totalPrice = 0;

    // Loop through each product in the cart and display the details in the table
    foreach ($_SESSION['cart'] as $index => $product) {
        // Calculate subtotal (price * quantity)
        $quantity = $product['quantity'];  // Use the quantity from the session
        $productSubtotal = $product['price'] * $quantity;
        $totalPrice += $productSubtotal;

        echo "<tr id='product_" . $product['id'] . "'>";
        echo "<td>" . $product['name'] . "</td>";
        // Display product image
        echo "<td><img src='" . $product['image'] . "' alt='" . $product['name'] . "' style='width: 50px; height: auto;'></td>";
        echo "<td>$$" . number_format($product['price'], 2) . "</td>";
        echo "<td>
                <input type='number' name='quantity[" . $product['id'] . "]' value='$quantity' min='1' class='form-control' style='width: 60px;' onchange='updateSubtotal(this, " . $product['id'] . ", " . $product['price'] . ")'>
              </td>";
        echo "<td id='subtotal_" . $product['id'] . "'>$$" . number_format($productSubtotal, 2) . "</td>";

        // Add a remove button for each item
        echo "<td>
                <form action='cart.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='remove_id' value='" . $product['id'] . "'>
                    <button type='submit' class='btn btn-danger'>Remove</button>
                </form>
              </td>";

        echo "</tr>";
    }

    echo "</tbody>";
    echo "<tfoot><tr><th colspan='4'>Total Price</th><th id='totalPrice'>$$" . number_format($totalPrice, 2) . "</th></tr></tfoot>";
    echo "</table>";

    // Submit button to update cart
    echo "<button type='submit' class='btn btn-primary'>Update Cart</button>";
    echo "</form>";

    // Optionally, add a button to proceed to checkout
    echo "<a href='checkout.php' class='btn btn-success'>Proceed to Checkout</a>";
} else {
    echo "<p>Your cart is empty.</p>";
}

// Handle quantity update or removal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if quantities are updated
    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            // Ensure quantity is valid and greater than 0
            if ($quantity >= 1) {
                // Loop through the cart and update the quantity for the product
                foreach ($_SESSION['cart'] as &$product) {
                    if ($product['id'] == $product_id) {
                        $product['quantity'] = $quantity;
                        break;
                    }
                }
            }
        }
    }

    // Check if a product should be removed
    if (isset($_POST['remove_id'])) {
        $remove_id = $_POST['remove_id'];

        // Loop through the cart and remove the product
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['id'] == $remove_id) {
                unset($_SESSION['cart'][$key]);  // Remove the product from the cart
                break;
            }
        }

        // Reindex the cart array to prevent gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Redirect back to the cart page to show updated cart
    header("Location: cart.php");
    exit();
}
?>

<script>
// JavaScript to update the subtotal and total price when quantity changes
function updateSubtotal(input, productId, price) {
    // Get the new quantity from the input field
    var newQuantity = parseInt(input.value);
    
    if (newQuantity < 1) {
        input.value = 1;  // Set the minimum quantity to 1
        newQuantity = 1;
    }

    // Calculate the new subtotal for this product
    var newSubtotal = newQuantity * price;
    
    // Update the subtotal cell for this product
    document.getElementById('subtotal_' + productId).innerText = '$' + newSubtotal.toFixed(2);

    // Update the total price of the cart
    var totalPrice = 0;

    // Loop through all products in the cart and update the total price
    var rows = document.querySelectorAll('tbody tr');
    rows.forEach(function(row) {
        var subtotal = parseFloat(row.querySelector('td[id^="subtotal_"]').innerText.replace('$', ''));
        totalPrice += subtotal;
    });

    // Update the total price display
    document.getElementById('totalPrice').innerText = '$' + totalPrice.toFixed(2);
}
</script>
