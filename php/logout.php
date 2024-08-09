<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        require_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $qry = "UPDATE users SET status = '{$status}' Where unique_id = '{$logout_id}'"; ;
            $sql2 = mysqli_query($conn, $qry);
            
            if($sql2){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            } else {
                header("location ../userp.php");
            }
        }
    } else {
        header("location: ../login.php");
    }