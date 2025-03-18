<?php
session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check and assign the product ID
    $product_id = isset($_POST['id']) ? (int) $_POST['id'] : null; // Ensure it's an integer
    $product_name = isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '';
    $price = isset($_POST['price']) ? (float) $_POST['price'] : 0.0; // Ensure it's a float
    $image = isset($_POST['image']) ? htmlspecialchars($_POST['image']) : '';

    // Check if $product_id is set and valid
    if ($product_id === null) {
        echo "Error: Product ID is missing.";
        exit();
    }

    // Initialize the cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $product_id) {
            $item['quantity']++; // Increase quantity
            $found = true;
            break;
        }
    }

    // If not found, add the new product to the cart
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $price,
            'image' => $image,
            'quantity' => 1
        ];
    }

    // Redirect to the cart page
    header('Location: mycart.php');
    exit();
}
?>
