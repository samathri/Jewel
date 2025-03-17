<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $description = $_POST['description'];
    $createdays = date('Y-m-d H:i:s');

    // Directory to store uploaded images
    $target_dir = "uploads/";

    // Ensure the uploads directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $uploadedFiles = []; // Array to hold the file paths

    // Loop through uploaded files
    foreach ($_FILES['images']['name'] as $key => $fileName) {
        $imageFile = $target_dir . time() . "_" . basename($fileName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));

        // Check if file is a valid image
        $check = getimagesize($_FILES['images']['tmp_name'][$key]);
        if ($check === false) {
            echo "<script>alert('File {$fileName} is not an image.');</script>";
            $uploadOk = 0;
            continue;
        }

        // Allow only certain file types
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<script>alert('File {$fileName} has an invalid format.');</script>";
            $uploadOk = 0;
            continue;
        }

        // Limit file size to 5MB
        if ($_FILES['images']['size'][$key] > 5000000) {
            echo "<script>alert('File {$fileName} is too large.');</script>";
            $uploadOk = 0;
            continue;
        }

        // Upload the file if all checks passed
        if ($uploadOk && move_uploaded_file($_FILES['images']['tmp_name'][$key], $imageFile)) {
            $uploadedFiles[] = $imageFile; // Save file path for database entry
        } else {
            echo "<script>alert('Error uploading file {$fileName}.');</script>";
        }
    }

    // Convert the array of file paths into a JSON string to store in the database
    $imagesJSON = json_encode($uploadedFiles);

    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO customize_oder_table (firstname, lastname, description, image, createdays) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $description, $imagesJSON, $createdays);

    if ($stmt->execute()) {
        echo "<script>alert('Your Order submitted successfully'); window.location.href = '/Serandi/Serandi 2/home.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
