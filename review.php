<?php

include 'php/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the POST data
    $name = $_POST['name'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $product_id = $_POST['product_id']; // Get product ID from the form

    // Prepare the upload directory
    $target_dir = "reviewimage/";

    // Create the directory if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Array to store uploaded files
    $uploadedFiles = [];
    $uploadOk = 1;

    // Handle file uploads
    foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
        $fileName = basename($_FILES["images"]["name"][$key]);
        $imageFile = $target_dir . time() . "_" . $fileName;
        $imageFileType = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($tmp_name);
        if ($check === false) {
            echo "<script>alert('File {$fileName} is not an image.');</script>";
            $uploadOk = 0;
            continue;
        }

        // Check file type
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed for {$fileName}.');</script>";
            $uploadOk = 0;
            continue;
        }

        // Check file size
        if ($_FILES["images"]["size"][$key] > 5000000) {
            echo "<script>alert('Sorry, {$fileName} is too large.');</script>";
            $uploadOk = 0;
            continue;
        }

        // Move uploaded file and store its path
        if ($uploadOk && move_uploaded_file($tmp_name, $imageFile)) {
            $uploadedFiles[] = $imageFile;
        } else {
            echo "<script>alert('Sorry, there was an error uploading {$fileName}.');</script>";
        }
    }

    // If files are uploaded, store the review
    if (!empty($uploadedFiles)) {
        // Convert array of uploaded files to a JSON string
        $uploadedFilesJson = json_encode($uploadedFiles); 

        // Prepare the SQL statement to insert the review into the database
        $stmt = $conn->prepare("INSERT INTO review (product_id, name, review, imagePath, rating) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $product_id, $name, $review, $uploadedFilesJson, $rating);
        
        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Review submitted successfully'); window.location.href = '/Serandi/Serandi 2/home.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "<script>alert('No valid files were uploaded.');</script>";
    }

    // Close the database connection
    $conn->close();
}

?>
