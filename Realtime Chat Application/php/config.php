<?php
    $conn = mysqli_connect("localhost", "root", "", "chat");

    if(!$conn){
        echo "Database connection Error" .mysqli_connect_error();
    }
?>
