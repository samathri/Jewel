<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
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
  width: 18px;
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

/* end ststus button */




  </style>
  </head>
  <body>
  <?php
include 'db.php'; 

$total_users = 0; 

$count_sql = "SELECT COUNT(*) as total_users FROM users";
$count_result = $conn->query($count_sql);

if ($count_result) {
    $count_row = $count_result->fetch_assoc();
    $total_users = $count_row['total_users']; 
} else {
    echo "Error fetching total users: " . $conn->error;
}


$sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name, location, email FROM users";
$result = $conn->query($sql);



$sql = "SELECT * FROM customize_oder_table"; 
$results = $conn->query($sql);


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



$reviewsql = "SELECT * FROM review "; 
$reviewresults = $conn->query($reviewsql);


// Fetch the updated list of products from the database
$sql = "SELECT * FROM cart_items";  
$resultss = $conn->query($sql);


// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
//     $product_id = $_POST['product_id'];

    
//     $delete_sql = "DELETE FROM cart_items WHERE product_id = ?";
    
    
//     if ($stmt = $conn->prepare($delete_sql)) {
//         $stmt->bind_param('i', $product_id); 
//         if ($stmt->execute()) {
//         } else {
//         }
//         $stmt->close();
//     } else {
//         echo "<script>alert('Error preparing SQL query.');</script>";
//     }
// }

// $sql = "SELECT * FROM cart_items";  
// $resultss = $conn->query($sql);

// // status button
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $user_id = $_POST['user_id'];
//     $status = $_POST['status'];

//     // Update the users table to set payment_status based on the user ID
//     $stmt = $conn->prepare("UPDATE users SET payment_status = ? WHERE id = ?");
//     $stmt->bind_param("si", $status, $user_id);

//     if ($stmt->execute()) {
//         echo "Status updated successfully";
//     } else {
//         echo "Error updating status";
//     }

//     $stmt->close();
//     $conn->close();
// }



// Check if there are any results
?>
    <div class="container-fluid" id="search-div">
      <div class="container">
        <div class="row">
          <div class="col-10">
            <div class="col-md-4 text-center mt-3 mb-3">
            <div class="form-outline" id="search">
                <input type="search" id="search" class="form-control" placeholder="Search Here" />
            </div>
        </div>
          </div>
          <div class="col-2 mt-4 justify-content-left">
            <div class="row ">
              <div class="col-12 bell-icon">
                <i class="fa-regular fa-bell me-4"></i>
                <i class="fa-regular fa-user me-2"></i>
                <span class="admin-text">Admin</span>
              </div>
              <div class="col-6 ">
                
              </div>
            </div>
          </div>
      </div>

      </div>
        
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-light vh-100">
          <div class="col-12" id="sidebar">
            <a href="\Serandi\Serandi 2\php\bashbord.php"><i class="fas fa-tachometer-alt mt-4"></i> Dashboard</a>
        
        </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            
            <div class="container mt-4">
                <!-- Top Stats Section -->
                

                <div class="container my-5">
    <div class="card p-3 shadow-sm">
        
        <div class="table-responsive">
            
                <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                               <h3> Customer Feedback</h3>
                               <a href="\Serandi\Serandi 2\php\userdetails.php" class="text-primary">See All</a>
                            </div>
                            <div class="card-body">
                               <div class="card-body">
                                
                               <?php
if ($reviewresults && $reviewresults->num_rows > 0) {
    // Output data for each row
    while ($row = $reviewresults->fetch_assoc()) {
        echo '<div class="feedback-list">
                  <div class="d-flex align-items-center mb-3">
                      <img src="/Serandi/Serandi 2/Images/image 1.jpeg" class="rounded-circle me-2" style="width: 50px; height: 50px;" alt="User Image">
                      <div>
                          <strong> ' . htmlspecialchars($row['name']) . ' </strong>
                          <p class="mb-0">' . htmlspecialchars($row['review']) . '</p>
                      </div>
                      <div class="d-flex ms-auto">
                          <!-- Form for delete icon -->
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


                </tbody>
            </table>
        </div>
    </div>
</div>




                   
                    <!-- Ordered Product Details Section -->
                    
                    
   
               



<!-- HTML Content Starts Here -->

               

<!-- HTML Content Starts Here -->



               

                    
                    <!-- Products Upload Table -->
                   

                    

                
            </div>
            

            
        </div>
        
    </div>

   

    

</div>




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
    </script>

</body>
</html>