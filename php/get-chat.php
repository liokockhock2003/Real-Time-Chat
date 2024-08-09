<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        require_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        $query = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_id WHERE (incoming_id = ? AND outgoing_id = ?) OR (incoming_id = ? AND outgoing_id = ?) ORDER BY msg_id ASC";
        $stmt = mysqli_prepare($conn , $query);
        mysqli_stmt_bind_param($stmt, "ssss", $incoming_id, $outgoing_id, $outgoing_id, $incoming_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                if($rows["outgoing_id"] == $outgoing_id){
                    $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>'.$rows['msg'].'</p>
                            </div>    
                        </div>';
                } else{
                    $output .= '<div class="chat incoming">
                    <img src="images/'.$rows['img'].'" alt="">
                        <div class="details">  
                            <p>'.$rows['msg'].'</p>
                        </div>    
                    </div>';
                }
            }
        }
        echo $output;

    } else {
        header("location: ../login.php");
    }