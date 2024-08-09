<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        require_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $msg = mysqli_real_escape_string($conn, $_POST['message']);


        if(!empty($msg)){
            $query = "INSERT INTO messages (incoming_id, outgoing_id, msg) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sss", $incoming_id, $outgoing_id, $msg);
            $execution_result = mysqli_stmt_execute($stmt);
            $affected_row = mysqli_stmt_affected_rows($stmt);
            if($execution_result && $affected_row === 1){
                echo "success";
            } else {
                echo "no rows inserted!";
            }
        }

    } else {
        header("location: ../login.php");
    }