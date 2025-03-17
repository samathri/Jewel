<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Productname = $_POST['Productname'];
    $Category = $_POST['Category'];
    $Material = $_POST['Material'];
    $Gemstone = $_POST['Gemstone'];
    $Weight = $_POST['Weight'];
    $Price = $_POST['Price'];
    $Description = $_POST['Description'];
    
    // Define the target directory and check if it exists
    $targetDir = "uploads/product/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Check if a file is uploaded
    if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] == UPLOAD_ERR_OK) {
        $imageFileType = strtolower(pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION));
        $fileName = uniqid() . "." . $imageFileType; // Unique file name
        $targetFile = $targetDir . $fileName;

        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
            // Insert data into the database, including the image file name
            $sql = "INSERT INTO product (Productname, Category, Material, Gemstone, Weight, Price, Description, image) 
                    VALUES ('$Productname', '$Category', '$Material', '$Gemstone', '$Weight', '$Price', '$Description', '$fileName')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Product uploaded successfully'); window.location.href = '/Serandi/Serandi 2/php/bashbord.php';</script>";
            } else {
                echo "<script>alert('Database error: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error moving uploaded image. Check permissions and directory existence.');</script>";
        }
    } else {
        echo "<script>alert('No image file uploaded or upload error');</script>";
    }

    $conn->close();
}
?>
