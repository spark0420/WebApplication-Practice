<?php 
    $conn = mysqli_connect("localhost", "root", "", "chat");
    if($conn){
        //echo "Database connected";
    }else{
        echo "Error!";
    }
?>
