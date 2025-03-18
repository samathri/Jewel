<html>
    <head>
        <title></title>
</head>
        <body>
           <h1> mycart </h1>
           <?php
session_start();  // Start the session to store product in the cart

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect product details from the form
    $ProductID = htmlspecialchars($_POST['id']);
    $ProductName = htmlspecialchars($_POST['product_name']);
    $Category = htmlspecialchars($_POST['category']);
    $Material = htmlspecialchars($_POST['material']);
    $Gemstone = htmlspecialchars($_POST['gemstone']);
    $Weight = htmlspecialchars($_POST['weight']);
    $Price = htmlspecialchars($_POST['price']);
    $Description = htmlspecialchars($_POST['description']);
    $image = htmlspecialchars($_POST['image']);
    
    // Create an associative array of the product details
    $product = array(
        "id" => $ProductID,
        "name" => $ProductName,
        "price" => $Price,
        "description" => $Description,
        "image" => $image,
        "category" => $Category,
        "material" => $Material,
        "gemstone" => $Gemstone,
        "weight" => $Weight,
        "quantity" => 1  // Default quantity when the product is first added
    );

    // Check if the cart is already set in the session, otherwise initialize it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product already exists in the cart
    $productExists = false;
    foreach ($_SESSION['cart'] as &$existingProduct) {
        if ($existingProduct['id'] == $product['id']) {
            // If the product exists, increase the quantity
            $existingProduct['quantity'] += 1;
            $productExists = true;
            break;
        }
    }

    // If the product does not exist, add it to the cart
    if (!$productExists) {
        $_SESSION['cart'][] = $product;
    }
    
    // Redirect to the cart page
    header("Location: mycart.php");
    exit();  // Make sure to exit after redirect to prevent further execution
}
?>




</body>
