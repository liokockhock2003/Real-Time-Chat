<?php
    require_once "config.php";
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE fname LIKE ? OR lname LIKE ?");
    $searchParam = "%".$searchTerm."%";
    mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        include "data.php";
    }
    echo "$output";