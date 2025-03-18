<?php
include('db.php'); // Include the database connection

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); // Sanitize the input to prevent SQL injection

    // Correct DELETE query
    $query = "DELETE FROM product WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        // Show a success alert using JavaScript and redirect
        echo "<script>
                alert('Record deleted successfully!');
                window.location.href = '/Serandi/Serandi 2/php/productveiw.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID not provided!');
            window.location.href = '/Serandi/Serandi 2/php/productveiw.php';
          </script>";
    exit;
}
?>
