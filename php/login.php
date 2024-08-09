<?php
    session_start();
    require_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    if(!empty($email) && !empty($password)){
        $query = "SELECT * FROM users WHERE email=? AND password=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        $status = "Active now";
        $qry1 = "UPDATE users SET status = '{$status}' Where unique_id = '{$row['unique_id']}'"; ;
        $sql3 = mysqli_query($conn, $qry1);

        if(mysqli_num_rows($result) > 0){
            $_SESSION["unique_id"] = $row["unique_id"];
            echo "success";

        } else {
            echo "Incorrect Credentials!";
        }

    } else {
        echo "All field must be filled!";
    }
} else {
    echo "Please enter a valid email";
}
    