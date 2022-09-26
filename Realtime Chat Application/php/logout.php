<?php
    session_start();
    if(isset($_SESSION['unique_id'])){//if user logs in again, it bring the user to this page
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){//if logout id is set,
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WEHRE unique_id = {$logout_id}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{ //otherwise, login page
        header("location: ../login.php");
    }
?>