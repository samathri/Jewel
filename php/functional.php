<?php
include 'db.php';

function display_data(){
    global $conn;
    $query = "select * from product";
    $result = mysqli_query($conn,$query);
    return $result;
}

?>