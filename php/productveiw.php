<?php
include 'db.php';
include 'functional.php';

$result = display_data();



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    
   
    

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


  </style>
  </head>
  <body>
  
    
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
        <div class="d-flex justify-content-between align-items-center">
            <h3>Ordered Product Details</h3>
            <a href="\Serandi\php\useroder.php" class="text-primary">See All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                      
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Material</th>
                        <th>Gemstone</th>
                        <th>weight</th>
                        <th>price</th>
                        <th>Description</th>
                        
                        <th>Actions</th> <!-- Add Actions column for Delete button -->
                    </tr>
                    <tr>
                        <?php 
                        
                        while($row = mysqli_fetch_assoc($result))
                        {
                            ?>

                           
                            <td><?php echo $row['Productname']; ?></td>
                            <td><?php echo $row['Category'];?></td>
                            <td><?php echo $row['Material']; ?></td>
                            <td><?php echo $row['Gemstone']; ?></td>
                            <td><?php echo $row['Gemstone']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td><a href="/Serandi/Serandi 2/php/productdelete.php?id=<?php echo $row['id'];?>" ><i class="fas fa-trash-alt text-danger ms-2" style="cursor: pointer;"></i></a>
                            <a href="/Serandi/Serandi 2/php/productedit.php?id=<?php echo $row['id']; ?>" ><i class="fa-solid fa-pen-to-square ms-2" style="cursor: pointer; color: green;"></i></a></td>



</tr>





<?php
                        }




?>

                   
                </thead>
                <tbody>
                

                </tbody>
            </table>
        </div>
    </div>
</div>
   

</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/dashbord.js"></script>
</body>
</html>