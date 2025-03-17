<?php
include 'db.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); // Sanitize the input
} else {
    die("ID not provided in the URL.");
}

$query = "SELECT * FROM product WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn)); // Correct mysqli_error usage
} else {
    $row = mysqli_fetch_assoc($result);
}
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <style>
    #editform{
        margin-top:100px;
        width: 800px;
        border: 1px solid #ddd;
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
       
        
    }

    .form-group label{
       
    }

    #form{
        margin-top:25px;
        margin-bottom:25px; 
        margin-left:25px;
        margin-right:25px;
    }

    </style>
 <body>

<?php
if (isset($_POST['update_product'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id']; // Correct variable name
    } else {
        die("ID not provided.");
    }

    // Sanitize input to prevent SQL injection
    $Productname = mysqli_real_escape_string($conn, $_POST['Productname']);
    $Category = mysqli_real_escape_string($conn, $_POST['Category']);
    $Material = mysqli_real_escape_string($conn, $_POST['Material']);
    $Gemstone = mysqli_real_escape_string($conn, $_POST['Gemstone']);
    $Weight = mysqli_real_escape_string($conn, $_POST['Weight']);
    $Price = mysqli_real_escape_string($conn, $_POST['Price']);
    $Description = mysqli_real_escape_string($conn, $_POST['Description']);

    // Update query
    $query = "UPDATE product 
    SET Productname = '$Productname', 
        Category = '$Category', 
        Material = '$Material', 
        Gemstone = '$Gemstone', 
        Weight = '$Weight', 
        Price = '$Price', 
        Description = '$Description' 
    WHERE id = '$id'";


    $result = mysqli_query($conn, $query);

    // Check result
    if ($result) {
        // Success alert
        echo "<script>alert('Product updated successfully!');</script>";
        echo "<script>window.location.href = '/Serandi/Serandi 2/php/productveiw.php';</script>"; // Redirect after alert
    } else {
        // Error alert
        echo "<script>alert('Failed to update product. Please try again.');</script>";
    }
}



?>


  <div class="container" id="editform">
    <form id="form" action="productedit.php?id=<?php echo $id; ?>" method="post" >
      <div class="form-group mb-4">
        <h3><center>Product Edit</center></h3>
      </div>

      <div class="row">
        <div class="col-6">
        <div class="form-group">
            <label for="exampleFormControlInput1">Product ID</label>
            <input type="text" class="form-control" name="id" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $row['id']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Product Name</label>
            <input type="text" class="form-control" name="Productname" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $row['Productname']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" id="exampleFormControlSelect1" name="Category">
              <option value="Charms" <?php echo $row['Category'] == 'Charms' ? 'selected' : ''; ?>>Charms</option>
              <option value="Anklets" <?php echo $row['Category'] == 'Anklets' ? 'selected' : ''; ?>>Anklets</option>
              <option value="necklace" <?php echo $row['Category'] == 'necklace' ? 'selected' : ''; ?>>necklace</option>
              <option value="Earrings" <?php echo $row['Category'] == 'Earrings' ? 'selected' : ''; ?>>Earrings</option>
              <option value="ring" <?php echo $row['Category'] == 'ring' ? 'selected' : ''; ?>>ring</option>
              <option value="Bracelets" <?php echo $row['Category'] == 'Bracelets' ? 'selected' : ''; ?>>Bracelets</option>
              <option value="pendant" <?php echo $row['Category'] == 'pendant' ? 'selected' : ''; ?>>pendant</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Material</label>
            <input type="text" name="Material" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $row['Material']; ?>">
          </div>
        </div>

        <div class="col-6">
          <div class="form-group">
            <label for="exampleFormControlInput1">Gemstone</label>
            <input type="text" name="Gemstone"  class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $row['Gemstone']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Weight</label>
            <input type="text" class="form-control"  name="Weight" id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $row['Weight']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Price</label>
            <input type="text" class="form-control" name="Price"  id="exampleFormControlInput1" placeholder="name@example.com" value="<?php echo $row['Price']; ?>">
          </div>
        </div>
      </div>

      <div class="row ">
        <div class="col-12">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="Description" rows="4" placeholder="Enter description"><?php echo $row['Description']; ?></textarea>
          </div>
        </div>
      </div>
<input type="submit" class="btn btn-outline-dark" name="update_product" value=" Update Product">
      <!-- <button class="btn btn-outline-dark">Edit Product</button> -->
    </form>
  </div>
</body>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>