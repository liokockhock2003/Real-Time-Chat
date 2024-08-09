<?php
    session_start();
    require_once "config.php";
    $outgoing_id = $_SESSION["unique_id"];
    $result  = mysqli_query($conn, "SELECT * FROM users");
    $output = "";

    if(mysqli_num_rows($result) == 1){
        $output .= "No one is online right now. You might wanna take a walk outside";
    } else if(mysqli_num_rows($result)>0){
        include "data.php";
    }
    echo $output;